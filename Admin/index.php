<?php include_once('menu.php'); ?>
	
	<div class = "row">	
		<div class = "col-md-2"></div>
		<div class = "col-md-8 well">
			<div class="row">
				<div class="col-lg-12">
					<center><h2 class = "text-primary">Employee's List</h2></center>
					<hr>
					<div>
						<form class = "form-inline" id="user_details">
							<table width="100%">
								<tr>
		    						<td width="20%"><label>Firstname:</label><span style="color:red;">*</span></td>
		    						<td width="25%"><input type  = "text" id = "efname"></td>
		    						<td width="10%">&nbsp;</td>
		    						<td width="20%"><label>Lastname:</label><span style="color:red;">*</span></td>
		    						<td width="25%"><input type  = "text" id = "elname"></td>
	    						</tr>
	    						<tr><td colspan="5">&nbsp;</td></tr>
	    						<tr>
		    						<td width="20%"><label>Username:</label><span style="color:red;">*</span></td>
		    						<td width="25%"><input type  = "text" id = "euname"></td>
		    						<td width="10%">&nbsp;</td>
		    						<td width="20%"><label>Employee Department:</label><span style="color:red;">*</span></td>
		    						<td width="25%">
		    						<select id="edept" style="width:150px;">		    										    								
		    							</select>
		    						</td>
	    						</tr>
	    						<tr><td colspan="5">&nbsp;</td></tr>
	    						<tr>
		    						<td width="20%"><label>Project:</label></td>
		    						<td width="25%"><input type  = "text" id = "eproject"></td>
		    						<td width="10%">&nbsp;</td>
		    						<td width="20%"><label>Billable Type:</label><span style="color:red;">*</span></td>
		    						<td width="25%">
		    							<select id="ebillabletype" style="width:150px;">
		    								<option value="Billable">Billable</option>
		    								<option value="Internal">Internal</option>		    								
		    							</select>
		    						</td>
	    						</tr>
	    						<tr><td colspan="5">&nbsp;</td></tr>
	    						<tr>
	    							<td >&nbsp;</td>
		    						<td colspan="2" align="right">
		    							<button type = "button" id="addnew" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span> Add</button>
		    							<button type = "button" id="editnew" class = "btn btn-primary hide"><span class = "glyphicon glyphicon-pencil"></span> Edit</button>
		    							<button type = "button" id="cancel" class = "btn btn-primary">Cancel</button>
		    						</td>
	    							<td colspan="2">&nbsp;</td>
	    						</tr>    						
    						</table>						
    					</form>
    				</div>
				</div>
			</div><br>
			<div class="row">
				<div id="userTable"></div>
			</div>
		</div>
	</div>
</body>
    <script src = "../jquery.js"></script>	
    <script src = "../bootstrap.min.js"></script>
    <script type = "text/javascript">
    	$(document).ready(function(){
        	showDept();
    		showUser();
    		//Add New
    		$(document).on('click', '#addnew', function() {
    			if (	$('#efname').val()=="" || 
    	    			$('#elname').val()=="" ||
    	    			$('#euname').val()==""
        	    	) {
    				alert('Please input proper data first');
    			}
    			else{				
    				$.ajax({
    					type: "POST",
    					url: "addnew.php",
    					data: {
    						efname: $('#efname').val(),
    						elname: $('#elname').val(),
    						euname: $('#euname').val(),
    						edept: $('#edept').val(),
    						eproject: $('#eproject').val(),
    						ebillabletype: $('#ebillabletype').val(),    						
    						collectionName: 'tsusers',
    						add: 1,
    					},
    					success: function(data){
        					if(data == 'error') {
								alert('Already registered user');
            				} else {
            					$('#user_details')[0].reset();
    							showUser();
            				}
    					}
    				});
    			}
    		});
    		
    		//Delete
    		$(document).on('click', '.delete', function(){
    			$euname=$(this).val();
    				$.ajax({
    					type: "POST",
    					url: "delete.php",
    					data: {
    						collectionName: 'tsusers',
    						euname: $euname,
    						del: 1,
    					},
    					success: function(data){
    						if(data == 'success') {
								alert('Username '+$euname+' deleted successfully');
            				}
    						showUser();
    					}
    				});
    		});
    		
    		//Update
    		$(document).on('click', '.edit', function(){
    			//$('#addnew').addClass('hide');
    			$('#editnew').removeClass('hide');    			
    			getUserDetailsforedit($(this).val());

    		});

    		$(document).on('click', '#editnew', function() {
    			if (	$('#efname').val()=="" || 
    	    			$('#elname').val()=="" ||
    	    			$('#euname').val()==""
        	    	) {
    				alert('Please input proper data first');
    			}
    			else {
    				$.ajax({
    					type: "POST",
    					url: "addnew.php",
    					data: {
    						efname: $('#efname').val(),
    						elname: $('#elname').val(),
    						euname: $('#euname').val(),
    						edept: $('#edept').val(),
    						eproject: $('#eproject').val(),
    						ebillabletype: $('#ebillabletype').val(),    						
    						collectionName: 'tsusersedit',
    						edit: 1,
    					},
    					success: function(response) {
        					if(response == 'success') {
        						showUser();
        						alert('User records updated successfully');        						     						
            				} else {
            					alert('This is new user details. Please use Add button for new entries');
            				}
    					}
    				});
    			}     
    		});

    	});

    	function getUserDetailsforedit($euname) {
    		$.ajax({
    			url: 'find_data_for_edit.php',
    			type: 'POST',
    			async: false,
    			data:{
    				collectionName: 'tsusers',
    				euname: $euname,
    				show: 1
    			},
    			success: function(response){
    				var obj = jQuery.parseJSON( response );
    				
    				$('#efname').val(obj.efname);
					$('#elname').val(obj.elname);
					$('#euname').val(obj.euname);
					$("#edept").val(obj.edept).change();
					$('#eproject').val(obj.projects);
					$("#ebillabletype").val(obj.ebillabletype).change();
    				
    				//$('#userTable').html(response);
    			}
    		});
        }

    	//Cancel
		$(document).on('click', '#cancel', function(){
			$('#user_details')[0].reset();
			$('#addnew').removeClass('hide');
			//$('#editnew').addClass('hide'); 
		});
     
    	//Showing our Table
    	function showUser() {
    		var page = location.search.split('page=')[1] ? location.search.split('page=')[1] : '1';
    		$.ajax({
    			url: 'show_user.php',
    			type: 'POST',
    			async: false,
    			data:{
        			page: page,
    				show: 1
    			},
    			success: function(response){
    				$('#userTable').html(response);
    			}
    		});
    	}

    	function showDept() {
    		$.ajax({
    			url: 'show_dept.php',
    			type: 'POST',
    			async: false,
    			data:{
    				listshow: 1
    			},
    			success: function(response){
    				$('#edept').html(response);
    			}
    		});
    	}
     
    </script>
    </html>