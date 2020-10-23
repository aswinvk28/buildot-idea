<?php
//ini_set("display_errors",1);
checkAdmin();

$member_email = $_SESSION['user']['email'];
$memberId = $_SESSION['user']['member_id'];
$companyId = $_GET['companyId'];
if($_POST){

	$error = 0;
		
		$projectname = $_POST['projectname'];
		$projecttype = $_POST['projecttype'];
		$projectlocation = $_POST['projectlocation'];
		$countryId = $_POST['country'];
		$projectowner = $_POST['projectowner'];
		$description = $_POST['description'];
		
	
		if(empty($projectname)){
			$_SESSION['errors'][] = "Please Enter the Project Name";
			$error = 1;
		}
		
		if(empty($description)){
			$_SESSION['errors'][] = "Please enter the description";
			$error = 1;
		}
	
		if(empty($projectlocation)){
			$_SESSION['errors'][] = "Please mention the location";
			$error = 1;
		}
	if($error != 1){
		
		$sql = "SELECT * FROM company_projects where project_name = '$projectname'";
		$row = $db->numrows($sql);
		if($row > 0){
			$_SESSION['errors'][] = "Project Name already exists ";
		}
		else{
		
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			
			$project_data = array();
			$project_data['project_name'] =  $projectname;
			$project_data['project_type'] = $projecttype;
			$project_data['project_location'] =  $projectlocation;
			$project_data['countryId'] =  $countryId;
			$project_data['project_owner'] = $memberId;
			$project_data['companyId'] = $companyId;
			$project_data['project_description'] =  $description;
			$project_data['created'] =  'NOW()';
		
			$db->insert("company_projects",$project_data);
			$cprojectId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'added the project:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'company_projects';
			$update_data['ids'] = $cprojectId;
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Project has been added";

			header("Location: index.php?view=createProject&companyId=$companyId");
			exit;
		}
	}
	header("Location: index.php?view=createProject&companyId=$companyId");
	exit;
}

$sql ="SELECT * from countries";
$countries = $db->select($sql);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>