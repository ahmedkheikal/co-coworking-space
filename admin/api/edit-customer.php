<?php
require_once '../private/config.php';
require '../private/functions.php';

header('content-type: application/json');

if (is_post()) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $add_customer = mysqli_query($con, "UPDATE `customers` SET
        `first_name` = '". secure($first_name) ."',
        `last_name` = '". secure($last_name) ."',
        `phone` = '". secure($phone) ."',
        `email` = '". secure($email) ."'
        WHERE `id` = '". secure($id) ."'
    ");

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
