<?php
//ini_set("display_errors",1);
checkAdmin();

$memberId = $_SESSION['user']['member_id'];

if($_POST){

	$error = 0;
		$eventname = $_POST['eventname'];
		$location = $_POST['location'];
		$countryId = $_POST['country'];
		$eventdate = explode("-",$_POST['eventtime']);
		$eventdatetime = explode(" ",$eventdate[2]);
		$website = $_POST['website'];
		$description = $_POST['description'];
		
	
		if(empty($eventname)){
			$_SESSION['errors'][] = "Please Enter the Event Name";
			$error = 1;
		}
		
		if(empty($location)){
			$_SESSION['errors'][] = "Please enter the location";
			$error = 1;
		}

	if($error != 1){
		
		$sql = "SELECT * FROM events where event_title = '$eventname'";
		$row = $db->numrows($sql);
		if($row > 0){
			$_SESSION['errors'][] = "Event Name already exists ";
		}
		else{
		
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			
			$event_data = array();
			$event_data['event_title'] =  $eventname;
			$event_data['location'] = $location;
			$event_data['countryId'] = $countryId;
			$event_data['event_date'] =  $eventdatetime[0].'-'.$eventdate[1].'-'.$eventdate[0].' '.$eventdatetime[1];
			$event_data['created_by'] =  $memberId;
			$event_data['website'] =  $website;
			$event_data['description'] =  $description;
			$event_data['created'] =  'NOW()';
		
			if(!empty($_FILES['file']['tmp_name'])){

					$event_data['image'] = DocUpload('file');
			}
			
			$db->insert("events",$event_data);
			$eventId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'added the event:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'events';
			$update_data['ids'] = $eventId;
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Event has been created";

			header("Location: index.php?view=createEvent");
		}

	}
	
	header("Location: index.php?view=createEvent");
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