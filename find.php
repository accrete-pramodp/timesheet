<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$companydb = $client->companydb;
$empcollection = $companydb->empcollection;

/*  $document = $empcollection->findOne(['_id' => '2']);
echo "<pre>"; print_r($document); */


$documentlist = $empcollection->find();


 /* $documentlist = $empcollection->find(
			['dept' => 'java']
		); */ 

 foreach($documentlist as $doc){
	echo "<pre>"; print_r($doc); 
} 
?>