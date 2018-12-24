<?php include 'header.php'; ?>
<?php include 'sidenav.php'; ?>
<div class="container">
    <div class="row">
        <form class="col s12" action="/api/edit-reservation">
            <h2>edit Reservation</h2>
            <?php $reservation = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM reservations WHERE id = '". secure($_GET['id']) ."'")) ?>
            <input type="hidden" name="id" value="<?php echo $reservation['id'] ?>">
            <div class="row">
                <div class="col s6">
                    <div class="row">
                        <?php $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT phone FROM customers WHERE id = '". secure($reservation['user_id']) ."'")); ?>
                        <div class="input-field col s12">
                            <input type="text" id="phone" class="autocomplete-phones" name="phone" autocomplete="off" value="<?php echo $user['phone'] ?>">
                            <label for="phone">Client Phone</label>
                        </div>
                    </div>
                </div>
                <div class="col s6">
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="room_id">
                                <option value="" disabled selected>Choose your option</option>
                                <?php $rooms = mysqli_query($con, "SELECT * FROM rooms") ?>
                                <?php while ($room = mysqli_fetch_assoc($rooms)) : ?>
                                    <option <?php echo $reservation['room_id'] == $room['id'] ? 'selected' : '' ?> value="<?php echo $room['id'] ?>"><?php echo $room['name'] ?></option>
                                <?php endwhile ?>
                            </select>
                            <label>Room</label>
                        </div>
                    </div>
                </div>

                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="type">
                                <option value="" disabled selected>Choose your option</option>
                                <option <?php echo $reservation['type'] == 'individual' ? 'selected' : '' ?> value="individual">Individual</option>
                                <option <?php echo $reservation['group'] == 'individual' ? 'selected' : '' ?> value="group">Group</option>
                            </select>
                            <label>Reservation Type</label>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12 seat_number_wrapper" style="display: none">
                    <input type="number" id="seat_number" name="seat_number" value="<?php echo $reservation['seat_number'] ?>">
                    <label for="seat_number">Seat Number</label>
                </div>
            </div>


            <div class="row">
                <h4>Start</h4>
                <div class="input-field col s6">
                    <input type="text" id="start_date" class="datepicker" name="start_date" value="<?php echo (new DateTime($reservation['start']))->format('M d, Y') ?>">
                    <label for="start_date">Date</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" id=start_time class="timepicker" name="start_time" value="<?php echo (new DateTime($reservation['start']))->format('h:i A') ?>">
                    <label for="start_time">Time</label>
                </div>
            </div>
            <div class="row">
                <h4>End</h4>
                <div class="input-field col s6">
                    <input type="text" id="end_date" class="datepicker" name="end_date" value="<?php echo (new DateTime($reservation['end']))->format('M d, Y') ?>">
                    <label for="end_date">Date</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" id="end_time" class="timepicker" name="end_time" value="<?php echo (new DateTime($reservation['end']))->format('h:i A') ?>">
                    <label for="end_time">Time</label>
                </div>
            </div>

            <div class="input-field col s12" style="">
                <input type="number" id="price" name="price" value="<?php echo $reservation['price'] ?>">
                <label for="price">Price</label>
            </div>

            <div class="input-field col s12">
                <textarea name="description" id="description" class="materialize-textarea validate" required="" aria-required="true"><?php echo $reservation['description'] ?></textarea>
                <label for="description">Reservation Description/notes</label>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="edit_room">
                Submit
            </button>
        </form>
    </div>

</div>
<?php include 'footer.php'; ?>

<script type="text/javascript">
$('form').submit(function (e) {
    e.preventDefault();
    $('#mainLoader').fadeIn('fast');
    $.ajax({
        url: 'api/edit-reservation',
        method: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        data: new FormData(this),
        success: function (data) {
            console.log(data);
            if (data.code == '200') {
                M.toast({html: 'Success!'})
                location.href = 'Reservations';
            } else {
                M.toast({html: data.response})
                $('#mainLoader').fadeOut('fast');
            }
        }
    })
})

$('input.autocomplete-phones').autocomplete({
    data: {
        <?php $phones = mysqli_query($con, "SELECT phone FROM customers") ?>
        <?php while ($phone = mysqli_fetch_assoc($phones)) : ?>
            "<?php echo $phone['phone'] ?>": null,
        <?php endwhile ?>
    },
});

$('select[name=type]').change(function () {
    if ($(this).val() == 'individual')
        $('.seat_number_wrapper').fadeIn();
    else {
        $('.seat_number_wrapper').fadeOut();
        $('input[name=seat_number]').val(null);
    }
})

$('select').formSelect();
$('.datepicker').datepicker({
    autoClose: true
});
$('.timepicker').timepicker({
    autoClose: true
});
M.textareaAutoResize($('#description'));

</script>
