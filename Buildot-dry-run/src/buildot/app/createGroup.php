<?php
//ini_set("display_errors",1);
checkAdmin();

$member_email = $_SESSION['user']['email'];
$memberId = $_SESSION['user']['member_id'];

if($_POST){

	$error = 0;
		
		$groupname = $_POST['groupname'];
		$grouptype = $_POST['grouptype'];
		$groupowner = $_POST['groupowner'];
		$website = $_POST['website'];
		$privacy = $_POST['privacy'];
		$summary = $_POST['summary'];
		$description = $_POST['description'];
		
	
		if(empty($groupname)){
			$_SESSION['errors'][] = "Please Enter the Group Name";
			$error = 1;
		}
		
		if(empty($description)){
			$_SESSION['errors'][] = "Please enter the description";
			$error = 1;
		}
	
		if(empty($privacy)){
			$_SESSION['errors'][] = "Please mention the type of access";
			$error = 1;
		}

		
	if($error != 1){
		
		$sql = "SELECT * FROM groups where group_name = '$groupname'";
		$row = $db->numrows($sql);
		if($row > 0){
			$_SESSION['errors'][] = "Group Name already exists ";
		}
		else{
		
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			
			$group_data = array();
			$group_data['group_name'] =  $groupname;
			$group_data['group_type'] = $grouptype;
			$group_data['group_owner'] = $memberId;
			$group_data['website'] =  $website;
			$group_data['privacy'] =  $privacy;
			$group_data['summary'] =  $summary;
			$group_data['description'] =  $description;
			$group_data['created'] =  'NOW()';
			if(!empty($_FILES['logo']['tmp_name'])){
		
				$ext = get_ext($_FILES['logo']['tmp_name']);
				$imagepath = $_FILES['logo']['tmp_name'];
				$output = 'image' . str_replace('.', '', microtime(true));
				$result = resizeImage($imagepath,80, 0, true, UPLOADED_LOGO_THUMB_DIR . $output, false);
				$result = resizeImage($imagepath,400, 0, true, UPLOADED_LOGO_DIR . $output . "-big", true);
				
				$group_data['group_image'] = $output.$ext;
		
			}
			
			$db->insert("groups",$group_data);
			$groupId = $db->insertid();
			
			$data = array();
			$data['group_id'] = $groupId;
			$data['member_id'] = $memberId;
	
			$db->insert("group_members",$data);
			
			$update_data = array();
			$update_data['update_message'] = 'added the group:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'groups';
			$update_data['ids'] = $groupId;
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Group has been added";

			header("Location: index.php?view=createGroup");
		}

	}

	
	header("Location: index.php?view=createGroup");
	exit;
}


if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>