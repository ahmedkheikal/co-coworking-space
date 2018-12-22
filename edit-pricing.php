<?php include 'header.php'; ?>
<?php include 'sidenav.php'; ?>
<?php
    $individual_pricing_q = mysqli_query($con, "SELECT * FROM pricing WHERE room_id = '". secure($_GET['room_id']) ."' AND type = 'individual'");
    $room_pricing_q = mysqli_query($con, "SELECT * FROM pricing WHERE room_id = '". secure($_GET['room_id']) ."' AND type = 'group'");
    if (mysqli_num_rows($individual_pricing_q) && mysqli_num_rows($room_pricing_q)) {
        $room_pricing = mysqli_fetch_assoc($room_pricing_q);
        $individual_pricing = mysqli_fetch_assoc($individual_pricing_q);
    }
    else
    header('location: 404');
 ?>
<div class="container">
    <div class="row">
        <form class="col s12" action="/api/add-pricing">
            <?php $room = mysqli_fetch_assoc(
                mysqli_query($con, "SELECT * FROM rooms WHERE  id = '". secure($_GET['room_id']) ."'")
            ); ?>
            <input type="hidden" name="room_id" value="<?php echo $room['id'] ?>">
            <h2>
                Edit pricing
                <small style="font-size: 13px">Room: <?php echo $room['name'] ?></small>
            </h2>
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="individual_price" type="number" name="individual_price" class="validate" required="" aria-required="true" value="<?php echo $individual_pricing['amount'] ?>">
                        <label for="individual_price">Individual Price</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="pricing_price" type="number" name="room_price" class="validate" required="" aria-required="true" value="<?php echo $room_pricing['amount'] ?>">
                        <label for="pricing_price">pricing Price</label>
                    </div>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="add_pricing">
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
            url: 'api/edit-pricing',
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                console.log(data);
                if (data.code == '200') {
                    M.toast({html: 'Success!'})
                    location.href = 'Pricing';
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
