<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">
		<title>Signin Template for Bootstrap</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
	</head>
<body>
<div class="container">
<?php 
if(isset($_GET['e']) && $_GET['e'] == 'y') {
?>
<div style="margin-left:400px;"><font color="red">Credentials not matched! Try again</font></div>
<?php
}
?>
<form name="Login_form" method="POST" action="login_submit.php" class="form-signin">
<h2 class="form-signin-heading">Please sign in</h2>
<label class="sr-only" for="Username">Username</label>
<input id="username" name="username" class="form-control" placeholder="Username" value="" required="" autofocus="" type="text">
<label class="sr-only" for="Password">Password</label>
<input id="password" name="password" class="form-control" placeholder="Password" value="" required="" type="password">
<div class="checkbox">
<label>
<input value="remember-me" type="checkbox">
Remember me
</label>
</div>
<input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-primary btn-block">
</form>
</div>

</body>
</html>