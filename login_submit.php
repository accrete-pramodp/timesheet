<?php 
session_start();

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************

$timesheetdb = $client->timesheet;
$userscollection = $timesheetdb->tsusers;

$userslists = $userscollection->find(["euname"=> $_POST['username'], "password"=> $_POST['password']]);

$usersdata = array();
foreach($userslists as $userslist) { 
	$usersdata[] = $userslist;	
}

if(count($usersdata) > 0){
	$_SESSION['username'] = $userslist['username'];
	$_SESSION['password'] = $userslist['password'];
	
	
	header('location: welcome.php');
} else {
	header('location: index.php?e=y');
}

?>