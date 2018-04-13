<?php 
session_start();

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
switch($_POST['content']) {
	
	case 'get_dept_name':
		$tscollection = $timesheetdb->tsusers;
		$projectlists = $tscollection->find(['edept' => ucfirst($_POST['dept_name'])]);
		
		$projects = array();
		foreach($projectlists as $projectlist) {
			if($projectlist['projects'] != '') {
				$projects[] = $projectlist;
			}
		}
				
		echo json_encode(array_filter($projects)); exit;
		
		break;
		
	default :
	break;
}

?>