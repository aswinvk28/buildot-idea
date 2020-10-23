<?php
//ini_set("display_errors",1);
checkAdmin();

$member_email = $_SESSION['user']['email'];
$memberId = $_SESSION['user']['member_id'];

if($_POST){

	$error = 0;
		
		$jobtitle = $_POST['jobtitle'];
		$location = $_POST['location'];
		$contactnum = $_POST['contactnum'];
		$email = $_POST['email'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$expirydate = explode("-",$_POST['expirydate']);
	
		if(empty($jobtitle)){
			$_SESSION['errors'][] = "Please EnterJob Title";
			$error = 1;
		}
		
		if(empty($description)){
			$_SESSION['errors'][] = "Please enter the description";
			$error = 1;
		}
		if(!empty($email)){
		if(!validateEmail($email)){
			$_SESSION['errors'][] = "Email id is invalid";
			$error = 1;
		}	}

		
	if($error != 1){

			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			
			$job_data = array();
			$job_data['title'] =  $jobtitle;
			$job_data['location'] = $location;
			$job_data['contact_number'] = $contactnum;
			$job_data['email'] = $email;
			$job_data['job_cat_id'] =  $category;
			$job_data['description'] =  $description;
			$job_data['expiry_date'] =  $expirydate[2].'-'.$expirydate[1].'-'.$expirydate[0];
			$job_data['created_by'] =  $memberId;
			$job_data['created'] =  'NOW()';
			
			$db->insert("job_openings",$job_data);
			$jobOpeningId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'posted a job you may be interested in:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'job_openings';
			$update_data['ids'] = $jobOpeningId;
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Job has been posted";

			header("Location: index.php?view=jobOpenings");

	}
	
	header("Location: index.php?view=jobOpenings");
	exit;
}

$sql ="SELECT * from job_categories";
$jobCategories = $db->select($sql);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>