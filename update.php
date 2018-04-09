<?php 
require 'vendor/autoload.php';

$client = new MongoDB\Client;

$companydb = $client->timesheet;
$empcollection = $companydb->tsdata;

//************UPDATE SINGLE DOCUMENT*****************
 //$updateone = $empcollection->updateMany(['dept' => 'php'], ['$set' => ['dept' => 'PHP']]);
$updateone = $empcollection->updateOne(['name' => 'Pramod'], ['$set' => ['uname' => 'pramodp']]);
printf("Modified %d document", $updateone->getModifiedCount());


//************UPDATE MULTIPLE DOCUMENT*****************
/* $updateresult = $empcollection->updateMany(['dept' => 'php'], ['$set' => ['manager' => 'Madhusudan']]);
printf("Matched %d document \n", $updateresult->getMatchedCount());
printf("Modified %d document \n", $updateresult->getModifiedCount()); */


//************REPLACE DOCUMENT*****************
/* $replaceresult = $empcollection->replaceOne(['_id' => '1'], ['_id' => '1', 'favColor' => 'Blue']);
printf("Matched %d document \n", $replaceresult->getMatchedCount());
printf("Modified %d document \n", $replaceresult->getModifiedCount()); */
?>