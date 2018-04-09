<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tscollection = $timesheetdb->tsusers;

$deleteResult = $tscollection->deleteOne(['euname' => $_POST['euname']]);

echo "Success"; exit; 
