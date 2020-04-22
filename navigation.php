<?php 
require "config/mysqli_connect.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>	
    
  <script src="https://cdn.jsdelivr.net/npm/fuse-js-latest@3.1.0/dist/fuse.min.js" integrity="sha256-7f3wLI5WWMPufBdf3U8CNW6K7WYPoO83Iqvr+dd6k4Q=" crossorigin="anonymous"></script>																						
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href= <?php echo BASEURL."/css/style.css";?>>
	
</head>
<body>
	<header class="wrapper">
				<div class="container">
					<div class="container-wrap">
						<div class="img-container">
                <img src=<?php echo BASEURL."/images/logo.png"?> class="logo-image">
					</div>
					<div class="nav-container">
							<nav class="navbar">
							      	<ul class="nav navbar-nav">
							        	<li class="active"><a href=<?php echo BASEURL."/index.php"?>>Home</a></li>
							        	<li class="active"><a href=<?php echo BASEURL."/Gallery.php"?>>Collection</a></li>
                                        <li class="active"><a href=<?php echo BASEURL."/aboutus.php"?>>About Us</a></li>
							        	<li class="active"><a href=<?php echo BASEURL."/contact.php"?>>Contact Us</a></li>
												<?php
												session_start();
												 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                                        echo '<li class="active"><a href= "'.BASEURL.'/Authentication/Login.php">Login/Register</a></li>';
																			}
																			else{
																				echo '<li class="active"><a href="'.BASEURL.'/Authentication/logout.php">logout</a>'.$_SESSION["username"].'</li>';
																			}
																			?>
							      	</ul>
							</nav>

						</div>


				</div>
			</div><!--header_bottom-->
		</header><!--header-->
