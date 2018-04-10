<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;

if($_POST['collectionName'] == 'tsusers') {
	$tscollection = $timesheetdb->tsusers;

	$deleteResult = $tscollection->deleteOne(['euname' => $_POST['euname']]);
} else if($_POST['collectionName'] == 'tsdept') {
	$tscollection = $timesheetdb->tsdept;
	$deleteResult = $tscollection->deleteOne(['dname' => $_POST['dname']]);
}

echo "Success"; exit; 
