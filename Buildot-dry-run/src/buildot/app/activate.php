<?php
$code = $_GET['code'];

if(!empty($_GET['code']) )
{
	$sql = "SELECT * FROM activation WHERE code = '$code'";
	if($db->numrows($sql) > 0){
		
		$member = $db->fetch($sql);
		$memberId = $member['member_id'];
	
	$sql ="SELECT * from company AS comp 
			LEFT JOIN members as mem ON (mem.company_id = comp.company_id)
			WHERE mem.member_id = '$memberId'";
			$company = $db->fetch($sql);
			$count = $db->numrows($sql);
			if($count > 0){
			if($company['company_status'] == 1){
				$db->sqlQuery("SET autocommit=0");
				$db->sqlQuery("START TRANSACTION");
		
				$data = array();
				$data['status'] = 1;
				$rs = $db->update("members",$data,"member_id=".$member['member_id']);
		
				$sql = "SELECT * from members where member_id = ".$member['member_id'];
				$user=$db->fetch($sql);
				$user_data = array();
				$user_data['status'] = 1;
				 $db->update("users",$user_data,"user_id=".$user['user_id']);
				$db->sqlQuery("COMMIT");
		
				$_SESSION['messages'] = "Your account has been activated";
			
				$db->delete("activation","code = '$code'");

				header("Location: /index.php?view=login");
				exit;
			}else{
				$_SESSION['messages'] = "Your account is pending for verification, you will receive a mail in 48 hours";
				header("Location: /index.php");
				exit;
				}}else{
						$db->sqlQuery("SET autocommit=0");
				$db->sqlQuery("START TRANSACTION");
					$data = array();
					$data['status'] = 1;
					$rs = $db->update("members",$data,"member_id=".$member['member_id']);
					
					$sql = "SELECT * from members where member_id = ".$member['member_id'];
					$user=$db->fetch($sql);
					$user_data = array();
					$user_data['status'] = 1;
					$db->update("users",$user_data,"user_id=".$user['user_id']);
					$db->sqlQuery("COMMIT");
		
			$_SESSION['messages'] = "Your account has been activated";
			
			$db->delete("activation","code = '$code'");

			header("Location: /index.php?view=login");
			exit;
		}
		}else{
			$_SESSION['errors']  = "Invalid Confirmation Code";
			header("Location: /index.php?view=login");
			exit;
		}	
	
}

?>

