<?php
session_start();

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tsdatacollection = $timesheetdb->tsdata;

$documentlists = $tsdatacollection->find();

$clients = array();
$projects = array();
$entry_type = array();

foreach($documentlists as $doc){	
	$clients[] = $doc->clients;
	$projects[] = $doc->projects;
	$entry_type[] = $doc->type;
}

$clients_names = array_unique($clients);
$projects_names = array_unique($projects);
$entry_type_names = array_unique($entry_type);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="jquery.js"></script>
	<title>GNS - Welcome to Portal</title>
</head>
<body>
	<div>
		<a href="logout.php" style="font-size:30px; float:right; color:green;">LOGOUT</a>
	</div>

	<div>
		<h3 class="PageHeading">Timesheet View</h3>
		<hr>
	</div>
	
	<div >
		<div>
			<span>Client</span>
			<span>
				<select id="clients_list">
				<option value="">-- All --</option>
				<?php foreach($clients_names as $clients_name) {?>
					<option value="<?php echo $clients_name; ?>"><?php echo $clients_name; ?></option>
				<?php } ?>
				</select>
			</span>
			
			<span>Project</span>
			<span>
				<select id="projects_list">
					<option value="">-- All --</option>
					<?php foreach($projects_names as $projects_name) {?>
						<option value="<?php echo $projects_name; ?>"><?php echo $projects_name; ?></option>
					<?php } ?>
				</select>
			</span>
			
			<span>Entry Type</span>
			<span>
				<select id="entry_type_list">
					<option value="">-- All --</option>
					<?php foreach($entry_type_names as $entry_type_name) {?>
						<option value="<?php echo $entry_type_name; ?>"><?php echo $entry_type_name; ?></option>
					<?php } ?>
				</select>
			</span>
			
			<span><input type="button" name="Search" value="SEARCH" onclick="search_submit();"></span>
		</div>
	</div>
	

</body>
</html>
<script>
function search_submit() {
	alert($( "#clients_list option:selected" ).val());
}
</script>