

    <div class="modal fade" id="edit<?php echo $userslist['name']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    	<?php

			require '../vendor/autoload.php';
			
			$client = new MongoDB\Client;
			
			//************FIND DOCUMENTS*****************
			$timesheetdb = $client->timesheet;
			$tscollection = $timesheetdb->tsdata;

			$employees = $tscollection->findOne(['name' => $userslist['name']]);
			

    	?>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
    		<div class = "modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<center><h3 class = "text-success modal-title">Update Member</h3></center>
    		</div>
    		<form class="form-inline">
    		<div class="modal-body">
    			Firstname: <input type="text" value="<?php echo $employees['name']; ?>" id="ufirstname<?php echo $employees['name']; ?>" class="form-control">

    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-default" data-dismiss="modal"><span class = "glyphicon glyphicon-remove"></span> Cancel</button> | <button type="button" class="updateuser btn btn-success" value="<?php echo $employees['name']; ?>"><span class = "glyphicon glyphicon-floppy-disk"></span> Save</button>
    		</div>
    		</form>
        </div>
      </div>
    </div>