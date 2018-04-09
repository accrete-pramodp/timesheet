<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tscollection = $timesheetdb->tsdata;

$userslists = $tscollection->find(['name' => ucfirst($_POST['euname'])]);

foreach($userslists as $userslist) {
	if(count($userslist) > 0 ) {
		echo "Already registered user<br><a href='index.php'>Back</a>"; exit;
	}
}



$insertOneResult = $tscollection->insertOne(
		[
				'name' => ucfirst($_POST['euname']),
				'password' => '1234',
				'dept' => $_POST['edept'],
				'type' => $_POST['ebillabletype'],
				'clients' => $_POST['eclient'],
				'projects' => $_POST['eproject'],
				'activestatus' => '1'
		]);

printf("Inserted %d document<br><a href='index.php'>Back</a>", $insertOneResult->getInsertedCount());

printf("<a href='elist.php'>Employee's List</a>");


?>