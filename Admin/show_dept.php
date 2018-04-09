<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tsdeptcollection = $timesheetdb->tsdept;

$deptlists = $tsdeptcollection->find();
?>


<?php
if(isset($_POST['show'])){
?>
<table class = "table table-bordered alert-warning table-hover">
	<thead>
		<th>Department</th>
	</thead>
	<tbody>
	<?php foreach($deptlists as $deptlist){ ?>
		<tr>
			<td><?php echo $deptlist['dname']; ?></td>
			<td><button class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $deptlist['dname']; ?>"><span class = "glyphicon glyphicon-pencil"></span> Edit</button> 
				<button class="btn btn-danger delete" value="<?php echo $deptlist['dname']; ?>">
				<span class = "glyphicon glyphicon-trash"></span> Delete</button>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php
   	} else if(isset($_POST['listshow'])) { 
   		foreach($deptlists as $deptlist){
?>
   			<option value="<?php echo ucfirst(strtolower($deptlist['dname'])); ?>"><?php echo ucfirst(strtolower($deptlist['dname'])); ?></option>   			
<?php 
   		}
 }
 ?>