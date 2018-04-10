<?php 
session_start();

require '../vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tsdeptcollection = $timesheetdb->tsdept;

//$deptlists = $tsdeptcollection->find();
$page  = $_POST['page'];
$limit = 5;
$skip  = ($page - 1) * $limit;
$next  = ($page + 1);
$prev  = ($page - 1);
$sort  = array('dname' => -1);

$deptlists = $tsdeptcollection->find([],['skip'=>$skip,'limit'=> $limit]);
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
			<td>
				<button class="btn btn-success edit" value="<?php echo $deptlist['dname']; ?>">
					<span class = "glyphicon glyphicon-pencil"></span> Edit
				</button> 
				<button class="btn btn-danger delete" value="<?php echo $deptlist['dname']; ?>">
					<span class = "glyphicon glyphicon-trash"></span> Delete
				</button>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php 
		$total=  $tsdeptcollection->count();
		if($page > 1){
			echo '<a href="?page=' . $prev . '">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;';
			if($page * $limit < $total) {
				echo ' <a href="?page=' . $next . '">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;';
			}
		} else {
			if($page * $limit < $total) {
				echo ' <a href="?page=' . $next . '">Next</a>&nbsp;&nbsp;&nbsp;&nbsp;';
			}
		}
?>

<?php 

   	} else if(isset($_POST['listshow'])) { 
   		foreach($deptlists as $deptlist){
?>
   			<option value="<?php echo ucfirst(strtolower($deptlist['dname'])); ?>"><?php echo ucfirst(strtolower($deptlist['dname'])); ?></option>   			
<?php 
   		}
 }
 ?>