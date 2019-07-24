<?php
require_once 'config.php';
ob_start();

require_once 'admin/private/functions.php';
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Spase - Business and Coworking</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/animate-heading.css">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/meanmenu.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/et-line-icon.css">
        <link rel="stylesheet" href="css/ionicons.min.css">
        <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Header Area Start -->
		<header class="top">
			<div class="header-area header-sticky">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-12">
							<div class="logo">
								<a href="index.html"><img src="img/logo/logo.png" alt="spase" /></a>
							</div>
						</div>
						<div class="col-md-8 col-sm-10 col-xs-12">
                            <div class="content-wrapper">
                                <!-- Main Menu Start -->
                                <div class="main-menu text-right">
                                    <nav>
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="about.php">About us</a></li>
                                            <li><a href="events.php">events</a></li>
                                            <li><a href="reserve.php">reserve your seat</a></li>
                                            <?php if (authenticated()): ?>
                                                <li>
                                                    <?php echo $_SESSION['auth_user']['first_name'] ?>
                                                </li>
                                                <li><a href="logout.php">logout</a></li>
                                            <?php else: ?>
                                                <li><a href="register.php">login/register</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="mobile-menu hidden-lg hidden-md"></div>
                                <!-- Main Menu End -->
                            </div>
						</div>
						<div class="col-md-2 hidden-sm hidden-xs">
						    <div class="header-social text-right">
						        <ul>
						            <li><a href=""><i class="zmdi zmdi-facebook"></i></a></li>
						            <li><a href=""><i class="zmdi zmdi-tumblr"></i></a></li>
						            <li><a href=""><i class="zmdi zmdi-pinterest"></i></a></li>
						            <li><a href=""><i class="zmdi zmdi-twitter"></i></a></li>
						        </ul>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- Header Area End -->
