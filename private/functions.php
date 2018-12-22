<?php
require_once 'config.php';

function is_post() {
    return $_SERVER['REQUEST_METHOD']  === 'POST';
}
function authenticated() {
    global $con;
    if (isset($_SESSION['_token'])) {
        if (!isset($_SESSION['auth_user'])) {
            $_SESSION['auth_user'] = mysqli_fetch_assoc(
                mysqli_query($con, "SELECT * FROM employees WHERE auth_token = '". secure($_SESSION['_token']) ."'")
            );
        }
        return true;
    } elseif (isset($_COOKIE['_token'])) {
        $_SESSION['auth_user'] = mysqli_fetch_assoc(
            mysqli_query($con, "SELECT * FROM employees WHERE auth_token = '". secure($_COOKIE['_token']) ."'")
        );
        return true;
    } else {
        return false;
    }
}

function secure($value)
{
    global $con;
    return trim(
        htmlspecialchars(
            mysqli_real_escape_string($con, $value)
        )
    );
}

function login($login, $password, $remember = false)
{
    global $con;
    if (filter_var($login, FILTER_VALIDATE_EMAIL))
    $user_q = mysqli_query($con, "SELECT * FROM `employees` WHERE email = '". secure($login) ."' and password = '". secure( sha1($password) ) ."'");
    else
    $user_q = mysqli_query($con, "SELECT * FROM `employees` WHERE phone = '". secure($login) ."' and password = '". secure( sha1($password) ) ."'");
    echo mysqli_error($con);

    if (mysqli_num_rows($user_q)) {
        $user = mysqli_fetch_assoc($user_q);
        $auth_token = sha1($user['first_name'] . $user['last_name'] . $user['phone']. rand(999, 9999));
        mysqli_query($con, "UPDATE `employees` SET auth_token = '". secure($auth_token) ."'");
        if ($remember)
        setcookie('_token', $auth_token, time() + (10 * 365 * 24 * 60 * 60), '/');
        return true;
    } else {
        return false;
    }
}

function is_home()
{
    return basename($_SERVER['REQUEST_URI']) == '' || basename($_SERVER['REQUEST_URI']) == 'index' || basename($_SERVER['REQUEST_URI']) == 'co-coworking-space';
}
