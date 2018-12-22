<?php
require_once '../private/config.php';
require '../private/functions.php';

header('content-type: application/json');

if (is_post()) {
    $table = $_POST['table'];
    $id = $_POST['id'];

    $delete_record = mysqli_query($con, "DELETE FROM `". secure($table) ."` WHERE id = '". secure($id) ."'");

    if ($delete_record)
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
