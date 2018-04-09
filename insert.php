<?php 
require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************INSERT INTO DATABASE*****************
$companydb = $client->timesheet;
$empcollection = $companydb->tsdata;

$insertOneResult = $empcollection->insertOne(
		[
				'_id' => '11',
				'name' => 'Sagar Unkale',
				'dept' => '.NET',
				'type' => 'Billable',
				'clients' => 'Champion Solutions',
				'projects' => 'Angular',
				'activestatus' => '1'				
		]);

printf("Inserted %d document", $insertOneResult->getInsertedCount());

?>