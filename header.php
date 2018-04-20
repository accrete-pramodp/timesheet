<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GNS - Welcome to Portal</title>
    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="assets/css/content.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">

	<script type="text/javascript" src = "assets/js/jquery.js"></script>	
	<script type="text/javascript" src = "assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src = "assets/js/jquery.dataTables.js"></script>
	<script src="assets/js/jquery-ui.js"></script>
	
	<link rel="shortcut icon" href="assets/images/favicon.ico" />   
</head>



<div>
	<nav id="myNavbar" class="navbar navbar-inverse navbar-fixed-top" style="padding-top:10px;" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="container">
			<div class="navbar-header">

				<!--<a class="navbar-brand" href="#">Brand</a>-->
    			<div class="navbar-header" style="padding-left: 40px; padding-top: 0%; padding-bottom: 0%;">
					<a href="#/"><label style="color:white;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:xx-large">GNS Portal</label></a>
				</div>
			</div>
			
			<div class="collapse navbar-collapse" id="navbardiv">
				<ul class="nav navbar-nav" style="padding-top:0%;float:right">						
					<?php if(isset($_SESSION['username'])) {?>
					<li class="dropdown">                                    
						<a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php  echo $_SESSION['username']; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">                                            
							<li>
								<a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
							</li>
						</ul>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
</div>