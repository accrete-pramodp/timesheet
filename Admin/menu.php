<?php 
if($_SESSION['issuperadmin'] != 'yes'){
	header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8" name = "viewport" content = "width-device=width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../assets/css/bootstrap.min.css" />
		<title>Employee's List</title>
    	</head>
    <body>

<div style="height:30px;">
		<nav id="myNavbar" class="navbar navbar-inverse navbar-fixed-top" style="padding-top:0px;" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="container">
				<div class="navbar-header">
					<div class="navbar-header" style="padding-left: 40px; padding-top: 0%; padding-bottom: 0%;">
                        <a href="/#/" title="Go To Home Page"><label style="color:white;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:xx-large">GNS Timesheet</label></a>
                    </div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbardiv">
					<ul class="nav navbar-nav" style="padding-top:0%;float:right">						
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle">Employee <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="/timesheet/admin/index.php">List</a></li>
								</ul>
						</li>
						
						<li class="dropdown">                                    
                                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">                                            
                                        <li>
                                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>
                        
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
	</div>