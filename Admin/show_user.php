<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tscollection = $timesheetdb->tsusers;

//$page  = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$page  = $_POST['page'];
$limit = 5;
$skip  = ($page - 1) * $limit;
$next  = ($page + 1);
$prev  = ($page - 1);
$sort  = array('euname' => -1);

$userslists = $tscollection->find([],['skip'=>$skip,'limit'=> $limit]);

if(isset($_POST['show'])){
?>
<table class = "table table-bordered alert-warning table-hover">
	<thead>
		<th>Name</th><th>Department</th><th>Projects</th><th>Action</th>
	</thead>
	<tbody>
	<?php foreach($userslists as $userslist) { 
	if($userslist['euname']!= 'admin') {
	?>
		<tr>
			<td><?php echo $userslist['efname']. ' ' . $userslist['elname']; ?></td>
			<td><?php echo $userslist['edept']; ?></td>
			<td><?php if(isset($userslist['eproject'])) { echo $userslist['eproject']; } ?></td>
			<td>
				<button class="btn btn-success edit" value="<?php echo $userslist['euname']; ?>"><span class = "glyphicon glyphicon-pencil"></span> Edit</button> 
			| <button class="btn btn-danger delete" value="<?php echo $userslist['euname']; ?>"><span class = "glyphicon glyphicon-trash"></span> Delete</button>
						
			<?php //include('edit_modal.php'); ?>						
			</td>
		</tr>		
	<?php }
	} ?>
	</tbody>
	
</table>
<?php $total=  ($tscollection->count()-1);
		if($page > 1){
			echo '<a href="?page=' . $prev . '">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;'. $page . ' of '. $total;
			if($page * $limit < $total) {
				echo '&nbsp;&nbsp;&nbsp;&nbsp; <a href="?page=' . $next . '">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;';
			}
		} else {
			if($page * $limit < $total) {
				echo ' <a href="?page=' . $next . '">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;'. $page . ' of '. $total;
			}
		} ?>
<?php
	}     
?>