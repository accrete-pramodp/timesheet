<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;

if($_POST['collectionName'] == 'tsusers') {
	$tscollection = $timesheetdb->tsusers;
	$datas = $tscollection->findOne(['euname' => $_POST['euname']]);
} else if($_POST['collectionName'] == 'tsdept') {
	$tscollection = $timesheetdb->tsdept;
	$datas = $tscollection->findOne(['dname' => $_POST['dname']]);
}

echo json_encode($datas); exit;

?>