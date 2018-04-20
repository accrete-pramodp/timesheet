<?php session_start();

include_once('header.php');

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tsdatacollection = $timesheetdb->tsusers;

$documentlists = $tsdatacollection->find();

$department = array();

foreach($documentlists as $doc) {
	$department[] = $doc->edept;
}

$dept_names = array_filter(array_unique($department));
?>
   
<div class="container-fluid body-content" style="padding-right: 50px; min-height:500px; overflow-y:scroll;">
	<div class="center-block loading-indicator hide">
		<div id="spinPageContent" class="loading-indicator-target"></div>
	</div>
	<div class="fullscreen scope">
		<div>
    		<ol class="breadcrumb" style="padding-top:0px;">
				<li>
					<a href="#/">Home</a>
				</li>
				<li >
					<span>Timesheet View</span>
				</li>
			</ol>    
		</div>

		<div>
			<div>
        <h3 class="PageHeading">Timesheet View</h3>
        <hr>
    </div>
    <form name="Timesheetview">
        <fieldset>
            <div class="well" style="min-height:120px;">
                <div class="form-group">
                    <label class="col-md-1" style="padding-left:20px;">Department:</label>
                    <div class="col-md-3">
                        <select class="form-control" style="width:80%" id="dept_name">
                        	<option value="" class="" selected="selected">-- All --</option>
                        	<?php 
                        	foreach($dept_names as $dept_name) {	?>
							<option value="<?php echo $dept_name; ?>"><?php echo $dept_name; ?></option>
							<?php } ?>
                        </select>
                    </div>

                    <label class="col-md-1" style="padding-left:20px;">Project :</label>
                    <div class="col-md-2">
                        <select class="form-control" style="width:116%" id="projects">
                        	<option value="" class="" selected="selected">-- All --</option>
                        </select>
                    </div>

                    <label class="col-md-1" style="padding-left:3px; margin-left: 98px;">Entry Type:</label>
                    <div class="col-md-2">
                        <select class="form-control" name="EntryType">
                        	<option value="" class="" selected="selected">-- All --</option>
                        	<option value="string:BILL" label="Billable">Billable</option>
                        	<option value="string:INTRL" label="Internal">Internal</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group" style="margin-top: 20px;">
                    <label class="col-md-1" style="padding-left:0px;">Start Date:</label>
                    <div class="col-md-3">
                        <input type="text" id="startdate">
						<button type="button" class="ui-datepicker-trigger startdatepicker"><i class="glyphicon glyphicon-calendar"></i></button>
                    </div>

                    <label class="col-md-1" style="padding-left:9px;">End Date:</label>
                    <div class="col-md-3">
                        <input type="text" id="enddate">
                        <button type="button" class="ui-datepicker-trigger enddatepicker"><i class="glyphicon glyphicon-calendar"></i></button>
                    </div>

                    <div class="col-md-4" style="padding-left:0px;">
                        <input value="Search" id="search_but" class="btn btn-primary" title="Search Timesheet" type="button">

                        <a type="button" title="Add Timesheet" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-left: 5%;">Add Timesheet</a>
























                        <button onclick="export()" class="btn btn-warning hide" style="MARGIN-LEFT: 5%;background-color: #E8A317;border-color: #E8A317;" title="Export Data to Excel as see in the Grid">Export Report</button>
                        <div class="col-md-2">
                            <div id="spinwrapper" class="center-block hide"><div id="spinContent"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            
            
			<div class="well">
				<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>		
							<th>Date</th>					
							<th>Project</th>
							<th>Task Overview</th>
							<th>Module</th>
							<th>Task Details</th>
							<th>Hours</th>
							<th>Billable Id</th>
							<th>Entry Type</th>
							<th>Added By</th>
							<th>Status</th>
							
						</tr>
					</thead>
				</table>
			</div>
	
            </div></div></div>

            <div style="margin-top:-11px; margin-bottom:11px;"><b>Note: </b>Approved Timesheets can not edited/deleted.</div>



        </fieldset>
    </form>

</div>




<!-- Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="DeleteTimesheetResult" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Delete Timesheet Record</h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                Are you sure want to delete timesheet record?
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary">Yes</a>
                <a class="btn btn-default">No</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="deleteTResult" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                
                <br>

            </div>
            <div class="modal-footer">
                <input value="Ok" onclick="CloseDialogDeleteTResult()" class="btn btn-default btn-primary" type="submit">
            </div>
        </div>
    </div>
</div>
<!-- Timesheet Result Link Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="TimesheetResultLink" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Timesheet Report Link</h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                <span class="hide">Click on link to download reports: <a href=""> </a></span>
                <span class="hide"> </span>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" onclick="CloseDialogTimesheetLink()">Ok</a>
            </div>
        </div>
    </div>
</div>


<div data-backdrop="static" data-keyboard="false" class="modal fade" id="DeleteTMST" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Delete Timesheet</h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-warning-sign error alert-danger"></i>
                Do you want delete Timesheet?
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" onclick="CloseDialogDeleteConfYes()">Yes</a>
                <a class="btn btn-default" onclick="CloseDialogDeleteConfNo()">No</a>
            </div>
        </div>
    </div>
</div>

<!-- Timesheet Result Link Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="ApprovalPendingTimesheet" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Timesheet Approval Pending List</h4>
            </div>
            <div class="modal-body" style="padding-top: 6px;">
                <span>
                    Timesheet approval pending from:
                    <!-- ngRepeat: itmMgr in ApprovalIdLst -->
                </span>
                <div>
                    <i class="glyphicon glyphicon-warning-sign alert-warning"></i>
                    Do you want to continue for Export Timesheet?
                </div>
            </div>
             
            <div class="modal-footer">
                <a class="btn btn-primary" onclick="CloseDialogApprovalPendingConfYes()">Yes</a>
                <a class="btn btn-primary" onclick="CloseDialogApprovalPendingConfNo()">No</a>
            </div>
        </div>
    </div>
</div></div>



    </div> 

    <footer class="navbar-fixed-bottom" style="background-color:#303030; color:white;">
        <section id="bottom" style="border-bottom: 5px solid #c52d2f;"></section>
        <div class="container" style="height:20px; padding-top:5px;">
            &copy; 2018 <a target="_blank" href="http://www.globalnestsolutions.com/" title="G N Solutions Pvt. Ltd." style="color:#c52d2f">G N Solutions Pvt. Ltd.</a> All Rights Reserved.
           
             <!--SD_11072017 Removed from Header and added to footer-->
            &nbsp;&nbsp;<span <li=""> <a href="/#/about">About Us</a>       </span> &nbsp;&nbsp;
            <span <li=""> <a href="/#/contact">Contact Us</a>  </span> &nbsp;&nbsp;
            <span <li=""> <a href="/#/helpdesk">Helpdesk</a>  </span> &nbsp;&nbsp;
            <!--SD_11072017 Removed from Header and added to footer-->

            <!-- ngIf: !($window.navigator.userAgent.indexOf('Chrome') > -1) --><span class="pull-right">1.0.8</span>
            <span class="pull-right messagealign">Best viewed in google chrome.</span>
        </div>
    </footer>

    <div class="modal fade" id="UserRoleResult" role="dialog">
        <div class="modal-dialog modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Application Error</h4>
                </div>
                <div class="modal-body">
                    <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                    Error ocurred while processing the request
                </div>
                <div class="modal-footer">
                    
                    <a class="btn btn-default" onclick="CloseDialogRole()">Close</a>
                </div>
            </div>
        </div>
    </div>



<div class="container">
  <!-- Trigger the modal with a button -->  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Timesheet</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
</div>

<?php include_once('footer.php'); ?>
<script>
$(document).ready(function()
{

	$( "#startdate" ).datepicker();
    $(".startdatepicker").click(function() { 
        $("#startdate").datepicker( "show" );
    })

	$( "#enddate" ).datepicker();
    $(".enddatepicker").click(function() { 
        $("#enddate").datepicker( "show" );
    })
	
	
	var dataTable = $('#employee-grid').DataTable( {
		"processing": true,
		"serverSide": true,		
		"ajax":{
			url :"find-employee-data.php", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".employee-grid-error").html("");
				$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#employee-grid_processing").css("display","none");
				
			}
		}
	} );

	
    $("#dept_name").change(function()
    {
        var deptartment_name = $('#dept_name :selected').val();
    	$.ajax({
			url: 'ajax_data.php',
			type: 'POST',
			async: false,
			data:{
    			content: 'get_dept_name',
    			dept_name: deptartment_name
			},
			success: function(response){
				var obj = jQuery.parseJSON( response );

				if(obj.length > 0){
					$.each(obj, function(index, value) {
					  $('#projects').append('<option value="'+value['projects']+'" class="">'+value['projects']+'</option>');
					});
				} else {
					$('#projects').append().html('<option value="" class="" selected="selected">-- All --</option>');
				}
			}
		});
    });  

    
    $("#search_but").click(function() {

    	var dataTable = $('#employee-grid').DataTable( {
    		"destroy": true,
    		"processing": true,
    		"serverSide": true,    		
    		"ajax":{
    			url :"find-employee-data.php", // json datasource
    			type: "post",  // method  , by default get
    			data: {'action':'test'},
    			error: function(){  // error handling
    				$(".employee-grid-error").html("");
    				$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
    				$("#employee-grid_processing").css("display","none");
    				
    			}
    		}
    	} );
        
    });

    $("#addupdatetimesheet").click(function() {

    	var dataTable = $('#employee-grid').DataTable( {
    		"destroy": true,
    		"processing": true,
    		"serverSide": true,    		
    		"ajax":{
    			url :"find-employee-data.php", // json datasource
    			type: "post",  // method  , by default get
    			data: {'action':'test'},
    			error: function(){  // error handling
    				$(".employee-grid-error").html("");
    				$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
    				$("#employee-grid_processing").css("display","none");
    				
    			}
    		}
    	} );
        
    });
    
    
});


</script>