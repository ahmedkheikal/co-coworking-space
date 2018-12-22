<?php require_once 'private/config.php';
include 'private/functions.php'; ?>
<?php
session_start();

if (basename($_SERVER['REQUEST_URI']) !== 'login')
if (!authenticated())
header('location: login');
else {
    $user = $_SESSION['auth_user'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="node_modules/materialize-css/dist/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="assets/css/master.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body style="position: relative">
    <div id="mainLoader">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#!" class="brand-logo">Logo</a>
                <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="<?php echo ROOT ?>">Home</a></li>
                    <li><a href="about">About</a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-nav">
            <li><a href="<?php echo ROOT ?>">Home</a></li>
            <li><a href="about">About</a></li>
        </ul>
    </header>
