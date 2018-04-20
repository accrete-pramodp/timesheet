<?php session_start();

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tsdatacollection = $timesheetdb->tsusers;

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$documentlists = $tsdatacollection->find(['euname' => 'Ppal']);
/* 
$columns = array(
// datatable column index  => database column name
		0 =>'employee_name',
		1 => 'employee_salary',
		2=> 'employee_age'
); */


//$totalData = $tsdatacollection->count();

$totalFiltered = array();
$data = array();
$totalData = 0;
foreach($documentlists as $doc) {
	
	if(isset($doc->tsentry)) {
		foreach($doc->tsentry as $key=>$tentry){
			$data[][] = $key;
		}
	}
	/* echo "<pre>"; print_r($doc); exit;
	$totalFiltered[] = $doc;
	if(isset($doc->projects) && ($doc->projects != '' || $doc->projects != NULL)) {	
		$data[0][0] = $doc->projects;
		
		$totalData += 1; 
	}
	
	if(isset($doc->tsentry)) {
		//echo "<pre>"; print_r($doc->tsentry); exit;
		$data[0][1] = $doc->tsentry;
	} */
}


$json_data = array(
		"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
		"recordsTotal"    => intval( $totalData ),  // total number of records
		"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
		"data"            => $data   // total data array
);

echo json_encode($json_data); exit;

?>