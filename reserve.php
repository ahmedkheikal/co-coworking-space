<?php include 'header.php' ?>
<?php include 'authenticatable.php'; ?>

<div class="container" style="max-width: 800px">
    <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="form-inline">Date &nbsp;
                    <div class="form-group">
                        <input type="radio" name="oneday_multiple" value="1 day" id="oneday">
                        <label for="oneday">1 day</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="oneday_multiple" value="multiple days" id="multipledays">
                        <label for="multipledays">multiple days</label>
                    </div>
                </h4>
            </div>
            <div class="multiple-days touch" id="contact-form">
                <div class="col-md-6">
                    <label for="start">Start</label>
                    <input type="date" name="start" id="start" placeholder="Start*">
                </div>
                <div class="col-md-6">
                    <label for="end">End</label>
                    <input type="date" name="end" id="end" placeholder="End*">
                </div>
            </div>
            <div class="one-day touch" id="contact-form">
                <div class="col-md-6">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" placeholder="Date*">
                </div>
                <div class="col-md-6">
                    <label for="time_start">Time start</label>
                    <input type="time" name="time_start" id="time_start" placeholder="Time Start*">
                    <label for="time_end">Time End</label>
                    <input type="time" name="time_end" id="time_end" placeholder="Time End*">
                </div>
            </div>
            <div id="contact-form">
                <div class="col-md-12">
                    <label for="type">Type</label>
                    <select name="type" id="type">
                        <option selected disabled value="">-- type --</option>
                        <option value="individual">Seat</option>
                        <option value="group">Room</option>
                    </select>
                    <div class="rooms" style="display: none">
                        <?php $rooms_q = mysqli_query($con, "SELECT * FROM `rooms`"); ?>
                        <select name="room_id">
                            <option selected disabled value="">-- room --</option>
                            <?php while ($room = mysqli_fetch_assoc($rooms_q)): ?>
                                <option value="<?= $room['id'] ?>">
                                    <?= $room['name'] ?>,
                                    Capacity: <?= $room['capacity'] ?> people,
                                    <?= $room['type'] == 'group' ? 'private' : 'shared' ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <textarea name="message" id="message" cols="15" rows="4" placeholder="Description / Details"></textarea>
                </div>
                <button class="banner-btn" type="submit" name="submit" data-text="send"><span>send</span></button>
                <p class="form-messege">
                    <?php if (isset($_POST['submit'])) {
                        $seat_number = null;
                        $seat_number;
                        if ($_POST['type'] == 'individual')
                        $seat_number = rand(1, 50);

                        if ($seat_number == null)
                        $seatnumberWhere = "AND seat_number IS NULL";
                        else
                        $seatnumberWhere = "AND seat_number = '". secure($seat_number) ."'";

                        if (!isset($_POST['room_id']))
                        $roomIdWhere = "AND room_id IS NULL";
                        else
                        $roomIdWhere = "AND room_id = '". secure($_POST['room_id']) ."'";

                        if ($_POST['oneday_multiple'] == '1 day') {
                            $start_date = new DateTime($_POST['date']);
                            $start_time = new DateTime($_POST['date']);
                            $end_date = new DateTime($_POST['time_start']);
                            $end_time =  new DateTime($_POST['time_end']);
                            $conflicting_reservation = mysqli_query($con, "SELECT * FROM reservations
                                WHERE (
                                    `start` BETWEEN  '". secure($start_date->format('Y-m-d')) . ' '. secure($start_time->format('H:i:s')) ."' AND '". secure($end_date->format('Y-m-d')) . ' '. secure($end_time->format('H:i:s')) ."'
                                 OR `end` BETWEEN '". secure($start_date->format('Y-m-d')) . ' '. secure($start_time->format('H:i:s')) ."' AND '". secure($end_date->format('Y-m-d')) . ' '. secure($end_time->format('H:i:s')) ."'
                                )
                                AND type = '". secure($_POST['type']) ."    '
                                ". $roomIdWhere ."
                                ". $seatnumberWhere ."
                            ");

                            if (!mysqli_num_rows($conflicting_reservation)) {
                                mysqli_query($con, "INSERT INTO `reservations`(
                                    `start`,
                                    `end`,
                                    `room_id`,
                                    `user_id`,
                                    `seat_number`,
                                    `description`,
                                    `type`,
                                    `price`
                                ) VALUES (
                                    '". secure($_POST['date'] . ' ' . $_POST['time_start']) ."',
                                    '". secure($_POST['date'] . ' ' . $_POST['time_end']) ."',
                                    '". secure($_POST['room_id']) ."',
                                    '". secure($_SESSION['auth_user']['id']) ."',
                                    '". secure($seat_number) ."',
                                    '". secure($_POST['description']) ."',
                                    '". secure($_POST['type']) ."',
                                    '". secure($_POST['price']) ."'
                                )");
                                header('Location: reservation-successful.php');
                            }

                            else
                            echo "there's a confliciting reservation";
                        } else {
                            $start_date = new DateTime($_POST['start_date']);
                            $start_time = new DateTime($_POST['end_date']);
                            $end_date = new DateTime('00:00:00');
                            $end_time = new DateTime('00:00:00');
                            $conflicting_reservation = mysqli_query($con, "SELECT * FROM reservations
                                WHERE (
                                    `start` BETWEEN  '". secure($start_date->format('Y-m-d')) . ' '. secure($start_time->format('H:i:s')) ."' AND '". secure($end_date->format('Y-m-d')) . ' '. secure($end_time->format('H:i:s')) ."'
                                 OR `end` BETWEEN '". secure($start_date->format('Y-m-d')) . ' '. secure($start_time->format('H:i:s')) ."' AND '". secure($end_date->format('Y-m-d')) . ' '. secure($end_time->format('H:i:s')) ."'
                                )
                                AND type = '". secure($type) ."'
                                AND room_id = '". secure($room_id) ."'
                                ". $seatnumberWhere ."
                            ");

                            if (!mysqli_num_rows($conflicting_reservation)) {
                                mysqli_query($con, "INSERT INTO `reservations`(
                                    `start`,
                                    `end`,
                                    `room_id`,
                                    `user_id`,
                                    `seat_number`,
                                    `description`,
                                    `type`,
                                    `price`
                                ) VALUES (
                                    '". secure($_POST['start_date'] . ' 00:00:00') ."',
                                    '". secure($_POST['end_date'] . ' 00:00:00') ."',
                                    '". secure($_POST['room_id']) ."',
                                    '". secure($_SESSION['auth_user']['id']) ."',
                                    '". secure($seat_number) ."',
                                    '". secure($_POST['description']) ."',
                                    '". secure($_POST['type']) ."',
                                    '". secure($_POST['price']) ."'
                                )");
                                header('Location: reservation-successful.php');
                            }
                            else
                            echo "there's a confliciting reservation";
                        }
                    } ?>
                </p>
                <br>
            </div>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>

<script type="text/javascript">
    $('input[name=oneday_multiple]').change(function () {
        if ($(this).val() == '1 day') {
            $('.one-day').show();
            $('.multiple-days').hide();
        } else {
            $('.multiple-days').show();
            $('.one-day').hide();
        }
    })
    $('select[name=type]').change(function () {
        if ($(this).val() == 'room') {
            $('.rooms').show();
        } else {
            $('.rooms').hide();
        }
    })
</script>
