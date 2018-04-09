<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tscollection = $timesheetdb->tsdata;

$userslists = $tscollection->find();
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
	<div style="float:right">
		<a href='addemp.php'>Add Employee's</a>
	</div>
	
	<div>
		<h3 class="PageHeading">Employee & Projects</h3>
		<hr>
	</div>
<table cellpadding="3" cellspacing="15" width="750px;">
<tr><th>Username</th><th>Department</th><th>Projects</th><th>Client's Name</th><th>Action</th></tr>
<?php foreach($userslists as $userslist){
	
?>
<tr>
<td><?php echo $userslist['name']; ?></td>
<td><?php echo $userslist['dept']; ?></td>
<td><?php echo $userslist['projects']; ?></td>
<td><?php echo $userslist['clients']; ?></td>
<td><a href="#" onclick="editemp('<?php echo $userslist['name']; ?>')">Edit</a>/<a href="#" onclick="deleteemp('<?php echo $userslist['name']; ?>')"">Delete</a></td>
</tr>
<?php } ?>
</table>
</body>
</html>

<script>
function editemp(str) {
	$.ajax({
        url: "test.php",
        type: "post",
        data: values ,
        success: function (response) {
           // you will get response from your php page (what you echo or print)                 

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
}
</script>
