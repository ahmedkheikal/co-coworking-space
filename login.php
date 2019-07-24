<?php include 'header.php' ?>

<div class="container" style="max-width: 800px">
    <form class="" action="index.html" method="post">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="form-inline">Date &nbsp;
                    <div class="form-group">
                        <input type="radio" name="oneday_multiple" value="1 day" id="oneday">
                        <label for="oneday">1 day</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="oneday_multiple" value="1 day" id="multipledays">
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
                <div class="col-md-12">
                    <label for="type">Type</label>
                    <select class="" name="type" id="type">
                        <option selected disabled value="">-- type --</option>
                        <option value="room">Seat</option>
                        <option value="individual">Room</option>
                    </select>
                    <textarea name="message" id="message" cols="15" rows="4" placeholder="Description / Details"></textarea>
                </div>
                <button class="banner-btn" data-text="send"><span>send</span></button>
                <p class="form-messege">
                    <?php if (isset($_POST[''])) {
                    } ?>
                </p>
            </div>
        </div>
    </form>
</div>
<a href="register.php">
    <button class="banner-btn" data-text="send"><span>Register</span></button>
</a>

<?php include 'footer.php' ?>
