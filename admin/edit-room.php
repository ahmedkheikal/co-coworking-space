<?php include 'header.php'; ?>
<?php include 'sidenav.php'; ?>
<?php
    $room_q = mysqli_query($con, "SELECT rooms.*,
        roomPricing.amount AS roomPrice, individualPricing.amount AS individualPrice
        FROM rooms
        LEFT OUTER JOIN pricing as roomPricing ON roomPricing.room_id = rooms.id
                                              AND roomPricing.type = 'group'
        LEFT OUTER JOIN pricing as individualPricing ON individualPricing.room_id = rooms.id
                                              AND individualPricing.type = 'individual'
        WHERE id = '". secure($_GET['id']) ."'
    ");
    if (mysqli_num_rows($room_q))
    $room = mysqli_fetch_assoc($room_q);
    else
    header('location: 404');
 ?>
<div class="container">
    <div class="row">
        <form class="col s12" action="/api/add-room">
            <input type="hidden" name="id" value="<?php echo $room['id'] ?>">
            <h2>Add room</h2>
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" type="text" name="name" class="validate" required="" aria-required="true" value="<?php echo $room['name'] ?>">
                    <label for="name">Name</label>
                </div>
                <div class="input-field col s12">
                    <textarea name="description" id="description" class="materialize-textarea validate" required="" aria-required="true"><?php echo $room['description'] ?></textarea>
                    <label for="description">Room Description</label>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="capacity" type="number" name="capacity" class="validate" required="" aria-required="true" value="<?php echo $room['capacity'] ?>">
                        <label for="capacity">Capacity</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="type">
                            <option value="" disabled selected>Choose your option</option>
                            <option <?php echo $room['type'] == 'group' ? 'selected' : '' ?> value="group">Group</option>
                            <option <?php echo $room['type'] == 'individual' ? 'selected' : '' ?> value="individual">Individual</option>
                        </select>
                        <label>Type</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="individual_price" type="number" name="individual_price" class="validate" required="" aria-required="true" value="<?php echo $room['individualPrice'] ?>">
                        <label for="individual_price">Individual Price</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="room_price" type="number" name="room_price" class="validate" required="" aria-required="true" value="<?php echo $room['roomPrice'] ?>">
                        <label for="room_price">Room Price</label>
                    </div>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="add_room">
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
            url: 'api/edit-room',
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                console.log(data);
                if (data.code == '200') {
                    M.toast({html: 'Success!'})
                    location.href = 'Rooms';
                } else {
                    M.toast({html: data.response})
                    $('#mainLoader').fadeOut('fast');
                }
            }
        })
    })

    M.textareaAutoResize($('#description'));
    $('select').formSelect();
</script>
