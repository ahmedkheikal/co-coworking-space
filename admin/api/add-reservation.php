<?php
require_once '../private/config.php';
require '../private/functions.php';

header('content-type: application/json');

if (is_post()) {
    $phone = $_POST['phone'];
    $start_date = new DateTime($_POST['start_date']);
    $start_time = new DateTime($_POST['start_time']);
    $end_date = new DateTime($_POST['end_date']);
    $end_time = new DateTime($_POST['end_time']);
    $seat_number = $_POST['seat_number'] !== '' ? $_POST['seat_number'] : 'null';
    $type = $_POST['type'];
    $room_id = $_POST['room_id'];
    $description = $_POST['description'];

    try {
        $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM customers WHERE phone = '". secure($phone) ."'"));
    } catch (\Exception $e) {
        die(json_encode([
            'code' => '500',
            'response' => $e->getMessage(),
        ]));
    }
    if ($seat_number == 'null')
    $seatnumberWhere = "AND seat_number IS NULL";
    else
    $seatnumberWhere = "AND seat_number = ". secure($seat_number) ."";
    $conflicting_reservation = mysqli_query($con, "SELECT * FROM reservations
        WHERE (
            `start` BETWEEN  '". secure($start_date->format('Y-m-d')) . ' '. secure($start_time->format('H:i:s')) ."' AND '". secure($end_date->format('Y-m-d')) . ' '. secure($end_time->format('H:i:s')) ."'
         OR `end` BETWEEN '". secure($start_date->format('Y-m-d')) . ' '. secure($start_time->format('H:i:s')) ."' AND '". secure($end_date->format('Y-m-d')) . ' '. secure($end_time->format('H:i:s')) ."'
        )
        AND type = '". secure($type) ."'
        ". $seatnumberWhere ."
        AND room_id = '". secure($room_id) ."'
    ");
    if (mysqli_num_rows($conflicting_reservation))
    die(json_encode([
        'code' => '500',
        'response' => 'Conflicting reservation',
    ]));

    $start = $start_date->format('Y-m-d') . ' '. $start_time->format('H:i:s');
    $end = $end_date->format('Y-m-d') . ' '. $end_time->format('H:i:s');
    $price = calculateReservationPrice($start, $end, $type, $room_id);

    $add_reservation = mysqli_query($con, "INSERT INTO `reservations`(
        `start`,
        `end`,
        `room_id`,
        `user_id`,
        `seat_number`,
        `description`,
        `type`,
        `price`
    ) VALUES (
        '". secure($start_date->format('Y-m-d')) . ' '. secure($start_time->format('H:i:s')) ."',
        '". secure($end_date->format('Y-m-d ')) . ' '. secure($end_time->format('H:i:s')) ."',
        '". secure($room_id) ."',
        '". secure($user['id']) ."',
        '". secure($seat_number) ."',
        '". secure($description) ."',
        '". secure($type) ."',
        '". secure($price) ."'
    )");

    if ($add_reservation)
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
