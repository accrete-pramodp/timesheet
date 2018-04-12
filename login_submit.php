<?php 
session_start();

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************

$timesheetdb = $client->timesheet;
$userscollection = $timesheetdb->tsusers;

$userslists = $userscollection->find(["euname"=> $_POST['username'], "password"=> $_POST['password']]);

$usersdata = array();
$issuperadmin = '';
foreach($userslists as $userslist) { 
	$usersdata[] = $userslist;	
	if(isset($userslist['issuperadmin'])){
		$issuperadmin = 'yes';
	} else {
		$issuperadmin = 'no';
	}
}

if(count($usersdata) > 0 && $issuperadmin == 'yes') { 
	$_SESSION['username'] = $userslist['euname'];
	$_SESSION['password'] = $userslist['password'];
	$_SESSION['issuperadmin'] = $issuperadmin;
	
	header('location: Admin/index.php');
} else if(count($usersdata) > 0 && !isset($usersdata['issuperadmin'])) {
	$_SESSION['username'] = $userslist['euname'];
	$_SESSION['password'] = $userslist['password'];
	
	
	header('location: welcome.php');
} else {
	header('location: index.php?e=y');
}

?>