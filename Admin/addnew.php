<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
switch($_POST['collectionName']) {
	case 'tsdept': 
		$tscollection = $timesheetdb->tsdept;
		$deptLists = $tscollection->find(['dname' => ucfirst(strtolower($_POST['dname']))]);
		
			foreach($deptLists as $deptList) {
				if(count($deptList) > 0 ) {
					echo "This department is already registered<br><a href='index.php'>Back</a>"; exit;
				}
			}
			
			$insertOneResult = $tscollection->insertOne(
					[
							'dname' => ucfirst(strtolower($_POST['dname']))
					]);
			
			printf("Inserted %d document<br><a href='index.php'>Back</a>", $insertOneResult->getInsertedCount());
		break;
		
	case 'tsusers':
		$tscollection = $timesheetdb->tsusers;
		$userslists = $tscollection->find(['euname' => ucfirst($_POST['euname'])]);
			
		
			foreach($userslists as $userslist) { 
				if(count($userslist) > 0 ) {
					echo "error"; exit;
				}
			}		
			 
			$insertOneResult = $tscollection->insertOne(
				[
						'efname' => ucfirst(strtolower($_POST['efname'])),
						'elname' => ucfirst(strtolower($_POST['elname'])),
						'euname' => ucfirst($_POST['euname']),
						'password' => '1234',
						'edept' => ucfirst(strtolower($_POST['edept'])),
						'ebillabletype' => ucfirst(strtolower($_POST['ebillabletype'])),
						'projects' => ucfirst(strtolower($_POST['eproject'])),
						'activestatus' => '1'
				]);
		
		printf("Inserted %d document<br>", $insertOneResult->getInsertedCount());		
		break;
		
		case 'tsusersedit':
			$tscollection = $timesheetdb->tsusers;
			$userslists = $tscollection->find(['euname' => ucfirst($_POST['euname'])]);

			
			foreach($userslists as $userslist) {
				if(count($userslist) > 0 ) {
					
					$updateone = $tscollection->updateOne(['euname' => $_POST['euname']],
														['$set' => ['efname' => ucfirst(strtolower($_POST['efname'])),
																	'elname' => ucfirst(strtolower($_POST['elname'])),
																	'euname' => ucfirst($_POST['euname']),
																	'edept' => ucfirst(strtolower($_POST['edept'])),
																	'ebillabletype' => ucfirst(strtolower($_POST['ebillabletype'])),
																	'projects' => ucfirst(strtolower($_POST['eproject']))
														]]);
					echo "success"; exit;					
				} 
			} 

			break;
		
	default:
		$tscollection = $timesheetdb->tsdept;
		$deptLists = $tscollection->find(['name' => ucfirst($_POST['dname'])]);
}