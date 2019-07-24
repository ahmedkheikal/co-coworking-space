<?php include 'header.php' ?>

<div class="container" style="max-width: 800px">
    <h2 style="font-size: 25px">Register</h2>
    <br>
    <form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="contact-form">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6" style="padding-left: 0">
                    <input type="text" name="first_name" placeholder="First Name" value="">
                </div>
                <div class="col-sm-6" style="padding-right: 0">
                    <input type="text" name="last_name" placeholder="Last Name" value="">
                </div>
                <input type="email" name="email" placeholder="Email" value="">
                <input type="tel" name="phone" placeholder="Phone" value="">
                <input type="password" name="password" placeholder="password" value="">
                <input type="password" name="repassword" placeholder="re-type password" value="">
                <button class="banner-btn" type="submit" name="send" data-text="send"><span>send</span></button>
                <p class="form-messege">
                    <?php
                    if (isset($_POST['send'])) {
                        if ($_POST['password'] != $_POST['repassword']) {
                            echo "Password mismatch";
                        }
                        if (!$_POST['email'] || !$_POST['phone'] || !$_POST['first_name'] || !$_POST['last_name'] || !$_POST['password']) {
                            echo "all fields required";
                        } else {
                            mysqli_query($con, "INSERT INTO `customers`(
                                `auth_token`,
                                `first_name`,
                                `last_name`,
                                `phone`,
                                `email`,
                                `password`
                            ) VALUES (
                                '". secure(sha1(rand(999, 9999))) ."',
                                '". secure($_POST['first_name']) ."',
                                '". secure($_POST['last_name']) ."',
                                '". secure($_POST['phone']) ."',
                                '". secure($_POST['email']) ."',
                                '". secure( sha1($_POST['password']) ) ."'
                            )");
                            loginClient($_POST['phone'], $_POST['password'], true);
                            header('location: reserve.php');
                        }
                    } ?>
                </p>
            </div>
        </div>
        <br>
    </form>
    <a href="login.php">login</a>
</div>

<?php include 'footer.php' ?>
