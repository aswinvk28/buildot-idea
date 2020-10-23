<?php
checkAdmin();
$userId = $_SESSION['user']['user_id'];
$memberId = $_SESSION['user']['member_id'];
$firstname = $_SESSION['user']['first_name'];
$lastname = $_SESSION['user']['last_name'];

if($_POST){
	
		$publish = $_POST['publishto']; 
	
	if($publish == 1){
		$prjrefnum = $_POST['prjrefnum'];
		$projectname = $_POST['projectname'];
		$location = $_POST['location'];
		$countryId = $_POST['country'];
		//$allotedbudget = $_POST['allotedbudget'];
		$openingdate = explode("-",$_POST['openingdate']);
		$closingdate = explode("-",$_POST['closingdate']);
		$description = $_POST['description'];

		if(empty($prjrefnum)){
			$_SESSION['errors'][] = "Please Enter Project Ref. No.";
			$error = 1;
		}
		if(empty($projectname)){
			$_SESSION['errors'][] = "Please Enter Project Name";
			$error = 1;
		}
		if(empty($location)){
			$_SESSION['errors'][] = "Please Enter Location";
			$error = 1;
		}
		if(empty($openingdate)){
			$_SESSION['errors'][] = "Please Enter Opening Date";
			$error = 1;
		}
		if(empty($closingdate)){
			$_SESSION['errors'][] = "Please Enter Closing Date";
			$error = 1;
		}
		
		if($error != 1){
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");

			$project_data = array();
			$project_data['project_ref_no'] = $prjrefnum;
			$project_data['project_name'] = $projectname;
			$project_data['project_location'] = $location;
			$project_data['countryId'] = $countryId;
				if(!empty($_FILES['map']['tmp_name'])){
		
					$ext = get_ext($_FILES['map']['tmp_name']);
					$imagepath = $_FILES['map']['tmp_name'];
					$output = 'image' . str_replace('.', '', microtime(true));
					$result = resizeImage($imagepath,400, 0, true, UPLOADED_MAP_DIR . $output, false);
					$project_data['location_map'] = $output.$ext;
				}
			//$project_data['max_alloc_budget'] = $allotedbudget;
			$project_data['opening_date'] =  $openingdate[2].'-'.$openingdate[1].'-'.$openingdate[0];
			$project_data['closing_date'] =  $closingdate[2].'-'.$closingdate[1].'-'.$closingdate[0];
			$project_data['description'] =  $description;
			if(!empty($_FILES['file']['tmp_name'])){

					$project_data['attachment1'] = DocUpload();
				}
			
			$project_data['member_id'] =  $memberId;
			$project_data['publishto'] =  1;
			$project_data['created'] = 'NOW()';
			
			$db->insert("projects",$project_data);
			$projectId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'invited a tender:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'projects';
			$update_data['ids'] = $projectId;
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			
			$sql ="SELECT fr.from_member_id,u.email FROM friend_requests AS fr
						LEFT JOIN members AS mem ON (mem.member_id = fr.from_member_id)
						LEFT JOIN users AS u ON (u.user_id =mem.user_id)
						WHERE fr.to_member_id = $memberId AND fr.STATUS ='request accepted'
				  UNION 
						SELECT fr.to_member_id,u.email FROM friend_requests AS fr
						LEFT JOIN members AS mem ON (mem.member_id = fr.to_member_id)
						LEFT JOIN users AS u ON (u.user_id =mem.user_id)
						WHERE fr.from_member_id = $memberId AND fr.status='request accepted'";
			$friends=$db->select($sql);
			if(!empty($friends)){
				foreach($friends as $friend){
					$email = $friend['email'];
					$subject = "A tender has been published by ".$firstname." ".$lastname;
					$body ="Hello,
A new tender is invited
This is an auto generated email

						
Best Regards
buildot.com team";
						@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
					}
				}
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Your Tender has been published.";

			header("Location: index.php?view=inviteTenders");
		}
				
			}else{
			$prjrefnum = $_POST['prjrefnum'];
		$projectname = $_POST['projectname'];
		$location = $_POST['location'];
		$countryId = $_POST['country'];
		//$allotedbudget = $_POST['allotedbudget'];
		$openingdate = explode("-",$_POST['openingdate']);
		$closingdate = explode("-",$_POST['closingdate']);
		$description = $_POST['description'];

		if(empty($prjrefnum)){
			$_SESSION['errors'][] = "Please Enter Project Ref. No.";
			$error = 1;
		}
		if(empty($projectname)){
			$_SESSION['errors'][] = "Please Enter Project Name";
			$error = 1;
		}
		if(empty($location)){
			$_SESSION['errors'][] = "Please Enter Location";
			$error = 1;
		}
		if(empty($openingdate)){
			$_SESSION['errors'][] = "Please Enter Opening Date";
			$error = 1;
		}
		if(empty($closingdate)){
			$_SESSION['errors'][] = "Please Enter Closing Date";
			$error = 1;
		}
		
		if($error != 1){
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");

			$project_data = array();
			$project_data['project_ref_no'] = $prjrefnum;
			$project_data['project_name'] = $projectname;
			$project_data['project_location'] = $location;
			$project_data['countryId'] = $countryId;
				if(!empty($_FILES['map']['tmp_name'])){
		
					$ext = get_ext($_FILES['map']['tmp_name']);
					$imagepath = $_FILES['map']['tmp_name'];
					$output = 'image' . str_replace('.', '', microtime(true));
					$result = resizeImage($imagepath,400, 0, true, UPLOADED_MAP_DIR . $output, false);
					$project_data['location_map'] = $output.$ext;
				}
			//$project_data['max_alloc_budget'] = $allotedbudget;
			$project_data['opening_date'] =  $openingdate[2].'-'.$openingdate[1].'-'.$openingdate[0];
			$project_data['closing_date'] =  $closingdate[2].'-'.$closingdate[1].'-'.$closingdate[0];
			$project_data['description'] =  $description;
			if(!empty($_FILES['file']['tmp_name'])){

					$project_data['attachment1'] = DocUpload();
				}
			
			$project_data['member_id'] =  $memberId;
			$project_data['publishto'] =  2;
			$project_data['created'] = 'NOW()';
			
			$db->insert("projects",$project_data);
			$projectId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'invited a tender:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'projects_selected';
			$update_data['ids'] = $projectId;
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			$db->sqlQuery("COMMIT");
			//$_SESSION['messages'] = "Your Tender has been published.";
		header("Location: index.php?view=member_list&from_page=inviteTenders&project=$projectId ");
		exit;
		}
	}
	header("Location: index.php?view=inviteTenders");
	exit;
}
$sql ="SELECT m.member_photo,m.first_name,m.last_name,m.company_id,m.designation,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = $userId";

$memberDetails = $db->fetch($sql);

$sql ="SELECT * from countries";
$countries = $db->select($sql);

?>