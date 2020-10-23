<?php
checkAdmin();

$project_id = $_REQUEST['projectId'];
$userId = $_SESSION['user']['user_id'];
$memberId = $_SESSION['user']['member_id'];
$firstname = $_SESSION['user']['first_name'];
$lastname = $_SESSION['user']['last_name'];
if($_POST){
		
		$prjrefnum = $_SESSION['prjrefnum'];
		$totBudget = $_POST['totBudget'];
		$sector = $_POST['sector'];
		$description = $_POST['description'];

		if(empty($totBudget)){
			$_SESSION['errors'][] = "Please Enter the Budget";
			$error = 1;
		}
		
		if($error != 1){
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");

			$tender_data = array();
			$tender_data['project_id'] = $project_id;
			$tender_data['proposed_budget'] = $totBudget;
			$tender_data['sector'] = $sector;
			$tender_data['description'] =  $description;

			if(!empty($_FILES['file']['tmp_name'])){

					$tender_data['attachment'] = DocUpload();
			
		
				}
			
			$tender_data['member_id'] =  $memberId;
			$tender_data['created'] = 'NOW()';
			
			$db->insert("tenders",$tender_data);
			$tenderId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'tender quote has been sent for:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'tenders';
			$update_data['ids'] = $tenderId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
			
			$sql ="SELECT p.member_id,p.project_name,u.user_id,u.email FROM projects AS p
					LEFT JOIN members AS mem ON (mem.member_id = p.member_id)
					LEFT JOIN users AS u ON (u.user_id = mem.user_id)
					WHERE p.project_id = $project_id";
			$projectOwner = $db->fetch($sql);
			if(!empty($projectOwner)){
			
					$email = $projectOwner['email'];
					$subject = "A tender quotation has been sent by ".$firstname." ".$lastname;
					$body ="Hello,
					
A tender quotation has been sent for your project/tender.
This is an auto generated email.
						
Best Regards
buildot.com team";
						@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
					}
	/*				$sql = "SELECT distinct si.to_member_id,u.email FROM share_invites AS si
						LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
						LEFT JOIN users AS u ON (u.user_id =mem.user_id)
						WHERE si.from_member_id = ".$projectOwner['member_id']." AND si.page IN ('tenderReceivedDetails','tenderDetails','inviteTenders')";
						$owner_friends = $db->select($sql);
							
			if(!empty($owner_friends)){
				foreach($owner_friends as $owner_friend){
					$email = $owner_friend['email'];
					$subject = "A tender has been published by ".$firstname." ".$lastname;
					$body ="Hello,
A  tender quote has been received for ".$projectOwner['project_name']."
This is an auto generated email

						
Best Regards
buildot.com team";
						@mail($email,$subject,$body,"from: Buildot<noreply@buildot.com>");
					}
				}*/
			
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Your Quote has been sent";

			header("Location: index.php?view=tendersPublished");

	}
	header("Location: index.php?view=tendersPublished");
	exit;
}
$sql ="SELECT m.member_photo,m.company_id,m.first_name,m.last_name,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = $userId";

$memberDetails = $db->fetch($sql);

$sql ="SELECT m.first_name,m.last_name,m.company_id,comp.company_name,p.* FROM members AS m
LEFT JOIN projects AS p ON p.member_id = m.member_id
LEFT JOIN company AS comp ON comp.company_id = m.company_id
WHERE p.project_id = $project_id AND m.status = 1";
$projectDetails = $db->fetch($sql);

?>