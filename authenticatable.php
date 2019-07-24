<?php

if (!authenticated()) {
    header('location: login.php');
}
