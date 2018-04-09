<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tscollection = $timesheetdb->tsdata;

$userslists = $tscollection->find();

$dept = array();
foreach($userslists as $userslist) {
	$dept[] = $userslist->dept;
}

$dept_names = array_unique($dept);


?>
<style>
.mar30{
margin-top: 30px;
}
.mar80{
margin-top: 80px;
}

.hide{
	display:none;
}
</style>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../jquery.js"></script>
	<title>GNS - Welcome to Portal</title>
</head>
<body>
	<!--<div>
		<a href="logout.php" style="font-size:30px; float:right; color:green;">LOGOUT</a>
	</div>-->

	<div style="float:right">
		<a href='index.php'>Employee's List</a>
	</div>
	<div>
		<h3 class="PageHeading">Employee & Projects</h3>
		<hr>
	</div>
	
	<form name="edetails" method="POST" action="edetails_submit.php">
	<div >
		<div class="mar30">
			<span>Username</span>
			<span>
				<input type="text" name="euname" id="euname" value="">
			</span>
		</div>
		
		<div class="mar30">
			<span>Employee Department</span>
			<span>
				<select id="edept" name="edept" onchange="newOpt(this.value);">
					<?php foreach($dept_names as $dept_name) {?>
					<option value="<?php echo $dept_name; ?>"><?php echo $dept_name; ?></option>
					<?php } ?>
					<option value="Other">Other</option>
				</select>
			</span>
			<span><input name="edeptoth" id="edeptoth" value="" type="text" class="hide"></span>
		</div>
		
		
		
		<div class="mar30">			
			<span>Project</span>
			<span>
				<input type="text" name="eproject" id="eproject" value="">
			</span>
		</div>
		
		<div class="mar30">		
			<span>Client Name</span>
			<span>
				<input type="text" name="eclient" id="eclient" value="">
			</span>
		</div>
		
		<div class="mar30">
			<span>Billable Type</span>
			<span>
				<select id="ebillabletype" name="ebillabletype">
					<option value="Billable">Billable</option>
					<option value="Internal">Internal</option>
				</select>
			</span>
		</div>
		<div class="mar30">			
			<span><input type="submit" name="submit" value="SUBMIT"></span>
		</div>
	</div>
	</form>	

</body>
</html>
<script>
function newOpt(str) {
	if(str == 'Other') {
	$("#edeptoth").removeClass('hide');
	//$("#edeptoth[type='hidden']").remove();
		//$('#edeptoth input').remove();
	} else {
	$("#edeptoth").addClass('hide');
	$("#edeptoth").val('');
	
	//$("#edeptoth[type='hidden']").add();
		//$('#edeptoth input').add();
	}
}
</script>
