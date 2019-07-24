<?php
require_once '../private/config.php';
require '../private/functions.php';

header('content-type: application/json');

if (is_post()) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;

    if (login($login, $password, $remember))
    echo json_encode([
        'code' => '200',
        'response' => 'Success',
    ]);
    else
    echo json_encode([
        'code' => '401',
        'response' => 'User Credentials didn\'t match any existing user',
    ]);

} else {
    http_response_code(405);
    echo json_encode([
        'code' => '405',
        'response' => 'method not allowed'
    ]);
}
