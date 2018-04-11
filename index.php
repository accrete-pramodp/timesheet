<?php 
include_once('header.php');
?>
<div class="container-fluid body-content" style="padding-right: 50px; min-height:500px; overflow-y:scroll;">
<body>
	<div class="modal-login fade login in" id="loginModal" aria-hidden="false" style="display: block; position:absolute !important; margin-top: 0px; margin-bottom: 150px !important; margin-right: 15px;">
		<div class="modal-dialog login animated">
			<div class="modal-content" style="margin-bottom:180px !important;">
				<div class="modal-body">
					<div class="box">
						<div class="content">
							<div class="social" style="height:85px;">
								<img src="assets/images/gns_logo.jpg" />
							</div>
							<div class="error">
							<?php 
							if(isset($_GET['e']) && $_GET['e'] == 'y') {
							?>
							<font color="red">Credentials not matched! Try again</font>
							<?php
							}
							?>
							</div>
							<div class="form loginBox">
								<form class = "form-horizontal" id="user_details" method="POST" action="login_submit.php">
									<input type="text" name="username" id="username" class="form-control logincontrol" placeholder="Login Name" title="Login name is your 'FirstName+EmployeeCode' e.g. ABC1001 or Company EmailId">								
								
								<span style="color: red" class="logincontrol"><span class="field-validation-valid" data-valmsg-for="LoginName" data-valmsg-replace="true"></span></span>
								
									<br><input type="password" name="password" id="password" class="form-control logincontrol" placeholder="Password" title="GNS Portal Password (If you don't remember, click on forget password link below.">
								<span style="color: red" class="logincontrol"><span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span></span>
								<div class="clearfix" style="color: Red;margin-left:14px;"></div>
									<input type="submit" value="Login" class="btn btn-default btn-login logincontrol"  style="margin-left:14px;">
								</form>
							</div>
						</div>
					</div>
                    
				</div>
				<div class="modal-footer" style="padding-top: 1px; margin-bottom: 5px;">
					<div class="forgot login-footer">
						<span><a href="/Account/ForgotPassword">Forgot password ?</a></span>
                    </div>                    
				</div>
			</div>
		</div>
	</div>
</body>
</div> 
<?php
include_once('footer.php');
?>