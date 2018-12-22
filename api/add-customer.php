<?php
require_once '../private/config.php';
require '../private/functions.php';

header('content-type: application/json');

if (is_post()) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $add_customer = mysqli_query($con, "INSERT INTO `customers`(
        `first_name`,
        `last_name`,
        `phone`,
        `email`
    ) VALUES (
        '". secure($first_name) ."',
        '". secure($last_name) ."',
        '". secure($phone) ."',
        '". secure($email) ."'
    )");

    if ($add_customer)
    echo json_encode([
        'code' => '200',
        'response' => 'Success',
    ]);
    else
    echo json_encode([
        'code' => '500',
        'response' => mysqli_error($con),
    ]);

} else {
    http_response_code(405);
    echo json_encode([
        'code' => '405',
        'response' => 'method not allowed'
    ]);
}
