<?php include_once('menu.php'); ?>

<div class = "row">	
		<div class = "col-md-2"></div>
		<div class = "col-md-8 well">
			<div class="row">
				<div class="col-lg-12">
					<center><h2 class = "text-primary">Department's List</h2></center>
					<hr>
					<div>
						<form class = "form-inline">
							<table width="100%">
								<tr>
		    						<td width="20%"><label>Department Name:</label></td>
		    						<td width="25%"><input type  = "text" id = "dname"></td>
		    						<td><td><button type = "button" id="addnew" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span> Add</button></td></td>
	    						</tr>	    						  						
    						</table>						
    					</form>
    				</div>
				</div>
			</div><br>
			<div class="row">
				<div id="deptTable"></div>
			</div>
		</div>
	</div>
</body>


    <script src = "../jquery.js"></script>	
    <script src = "../bootstrap.min.js"></script>
    <script type = "text/javascript">
    	$(document).ready(function(){
    		showDept();

    		$(document).on('click', '#addnew', function(){
    			if ($('#dname').val()==""){
    				alert('Please input department name');
    			} else {
    			$dname=$('#dname').val();				
    				$.ajax({
    					type: "POST",
    					url: "addnew.php",
    					data: {
    						dname: $dname,
    						collectionName: 'tsdept',
    						add: 1,
    					},
    					success: function(){
    						showDept();
    					}
    				});
    			}
    		});
    	});

    	//Showing our Table
    	function showDept(){
    		$.ajax({
    			url: 'show_dept.php',
    			type: 'POST',
    			async: false,
    			data:{
    				show: 1
    			},
    			success: function(response){
    				$('#deptTable').html(response);
    			}
    		});
    	}
    </script>