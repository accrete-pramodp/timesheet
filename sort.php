<?php 
require 'vendor/autoload.php';

$client = new MongoDB\Client;

$companydb = $client->companydb;
$empcollection = $companydb->empcollection;

$empSortResults = $empcollection->find(
		[],
		['sort'=>['_id' => -1]]
		);

foreach($empSortResults as $empSortResult) {
	echo "<pre>"; print_r($empSortResult); 
}
?>