<?php
    session_start();
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "co_coworking";
    $con =  new mysqli($db_host, $db_username, $db_password, $db_name) ?  : die(mysqli_connect_error());
    define('ROOT', 'http://localhost/co-coworking-space/');


    mysqli_query($con, "set names 'utf8'");
