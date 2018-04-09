<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tscollection = $timesheetdb->tsusers;

$userdatas = $tscollection->findOne(['euname' => $_POST['euname']]);

echo json_encode($userdatas); exit;

?>