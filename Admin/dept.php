<?php include_once('menu.php'); ?>

<div class = "row">	
		<div class = "col-md-2"></div>
		<div class = "col-md-8 well">
			<div class="row">
				<div class="col-lg-12">
					<center><h2 class = "text-primary">Department's List</h2></center>
					<hr>
					<div>
						<form class = "form-inline" id="department">
							<table width="100%">
								<tr>
		    						<td width="20%"><label>Department Name:</label></td>
		    						<td width="25%"><input type="text" id="dname" value="">
		    						<input type="hidden" id="dnameactual" value=""></td>
		    						<td>
		    							<button type = "button" id="addnew" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span> Add</button>
		    							<button type = "button" id="editnew" class = "btn btn-primary hide"><span class = "glyphicon glyphicon-pencil"></span> Edit</button>
		    							<button type = "button" id="cancel" class = "btn btn-primary">Cancel</button>
		    						</td>
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
    					success: function(data){
    						if(data == 'error') {
								alert('Already registered!');
            				} else {
            					$('#dname').val('');
    							showDept();
            				}
    					}
    				});
    			}
    		});

    		//Cancel
    		$(document).on('click', '#cancel', function(){
    			$('#department')[0].reset();
    			//$('#addnew').removeClass('hide');
    			//$('#editnew').addClass('hide'); 
    		});

    		//Update
    		$(document).on('click', '.edit', function(){
    			$('#addnew').addClass('hide');
    			$('#editnew').removeClass('hide');
    			$('#dnameactual').val($(this).val());    			
    			getDeptDetailsforedit($(this).val());

    		});

    		$(document).on('click', '#editnew', function() {
    			if ($('#dname').val()=="") {
    				alert('Please input department name');
    			}
    			else {
    				$.ajax({
    					type: "POST",
    					url: "addnew.php",
    					data: {    						
    						dname: $('#dname').val(),  
    						dnameactual: $('#dnameactual').val(),  						
    						collectionName: 'tsdeptedit',
    						edit: 1,
    					},
    					success: function(response) {
        					if(response == 'success') {
        						$('#dnameactual').val($('#dname').val());
        						$('#dname').val('')
        						showDept();
        						alert('Department updated successfully'); 
        						       						     						
            				} else {
            					alert('Unable to update! Try again');
            				}
    					}
    				});
    			}     
    		});


    		//Delete
    		$(document).on('click', '.delete', function(){
    			$dname=$(this).val();
    				$.ajax({
    					type: "POST",
    					url: "delete.php",
    					data: {
    						collectionName: 'tsdept',
    						dname: $dname,
    						del: 1,
    					},
    					success: function(data){
    						if(data == 'success') {
								alert('Records deleted successfully');
            				}
    						showDept();
    					}
    				});
    		});
    		
    	});

    	//Showing our Table
    	function showDept(){
    		var page = location.search.split('page=')[1] ? location.search.split('page=')[1] : '1';
    		$.ajax({
    			url: 'show_dept.php',
    			type: 'POST',
    			async: false,
    			data:{
    				page: page,
    				show: 1
    			},
    			success: function(response){
    				$('#deptTable').html(response);
    			}
    		});
    	}

    	function getDeptDetailsforedit($dname) {
    		$.ajax({
    			url: 'find_data_for_edit.php',
    			type: 'POST',
    			async: false,
    			data:{
    				collectionName: 'tsdept',
    				dname: $dname,
    				show: 1
    			},
    			success: function(response){
    				var obj = jQuery.parseJSON( response );
    				
					$("#dname").val(obj.dname);
    			}
    		});
    	}
    	
    </script>