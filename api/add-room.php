<?php
require_once '../private/config.php';
require '../private/functions.php';

header('content-type: application/json');

if (is_post()) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $capacity = $_POST['capacity'];
    $type = $_POST['type'];
    $individual_price = $_POST['individual_price'];
    $room_price = $_POST['room_price'];

    $add_room = mysqli_query($con, "INSERT INTO `rooms`(
        `name`,
        `description`,
        `capacity`,
        `type`
    ) VALUES (
        '". secure($name) ."',
        '". secure($description) ."',
        '". secure($capacity) ."',
        '". secure($type) ."'
    )");
    $new_room_id = mysqli_insert_id($con);

    $add_individual_price = mysqli_query($con, "INSERT INTO `pricing`(
        `amount`,
        `type`,
        `room_id`
    ) VALUES (
        '". secure($individual_price) ."',
        'individual',
        '". secure($new_room_id) ."'
    )");
    $add_room_price = mysqli_query($con, "INSERT INTO `pricing`(
        `amount`,
        `type`,
        `room_id`
    ) VALUES (
        '". secure($room_price) ."',
        'group',
        '". secure($new_room_id) ."'
    )");

    if ($add_room && $add_individual_price && $add_room_price)
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
