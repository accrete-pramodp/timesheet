<?php 
session_start();

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$userscollection = $timesheetdb->users;

$userslists = $userscollection->find(["username"=> $_POST['username'], "password"=> $_POST['password']]);


foreach($userslists as $userslist) {
	if(count($userslist) > 0 ) {
		
		$_SESSION['username'] = $userslist['username'];
		$_SESSION['password'] = $userslist['password'];
		$_SESSION['name'] = $userslist['first name']. ' ' . $userslist['last name'];;
		
		
		header('location: welcome.php');
	}
}



?>