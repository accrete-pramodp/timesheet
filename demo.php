<?php 
require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************CREATE DATABASE*****************
$companydb = $client->timesheet;

//************LIST DATABASES*****************
/* foreach($client->listDatabases() as $db)
{
	echo "<pre>";
	print_r($db);
} */

//************DROP DATABASES*****************
/* $result4 = $client->dropDatabase('newdb');
echo "<pre>"; print_r($result4); */

//************CREATE COLLECTION*****************
 $result1 = $companydb->createCollection('entrytype');
echo "<pre>";
print_r($result1); 

//************LIST COLLECTION*****************
/* foreach($companydb->listCollections() as $collection) {
	echo "<pre>";
	print_r($collection);	
} */

//***********DROP COLLECTION******************
/* $result2 = $companydb->dropCollection('mycollection');

echo "<pre>";
print_r($result2); */
?>