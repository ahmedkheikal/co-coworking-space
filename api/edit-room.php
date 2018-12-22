<?php
require_once '../private/config.php';
require '../private/functions.php';

header('content-type: application/json');

if (is_post()) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $capacity = $_POST['capacity'];
    $type = $_POST['type'];
    $individual_price = $_POST['individual_price'];
    $room_price = $_POST['room_price'];

    $edit_room = mysqli_query($con, "UPDATE `rooms` SET
        `name`='". secure($name) ."',
        `description`='". secure($description) ."',
        `capacity`='". secure($capacity) ."',
        `type`='". secure($type) ."'
        WHERE id = '". secure($id) ."'
    ");
    if (!$edit_room)
    die(json_encode([
        'code' => '500',
        'response' => mysqli_error($con),
    ]));

    $edit_individual_price = mysqli_query($con, "UPDATE `pricing` SET
        `amount`='". secure($individual_price) ."'
        WHERE `type`='individual'
        AND `room_id`='". secure($id) ."'
    ");
    if (!$edit_room)
    die(json_encode([
        'code' => '500',
        'response' => mysqli_error($con),
    ]));

    $edit_room_price = mysqli_query($con, "UPDATE `pricing` SET
        `amount`='". secure($room_price) ."'
        WHERE `type`='group'
        AND `room_id`='". secure($id) ."'
    ");
    if (!$edit_room)
    die(json_encode([
        'code' => '500',
        'response' => mysqli_error($con),
    ]));

    echo json_encode([
        'code' => '200',
        'response' => 'Success',
    ]);
} else {
    http_response_code(405);
    echo json_encode([
        'code' => '405',
        'response' => 'method not allowed'
    ]);
}
