<?php include 'header.php' ?>

<div class="container" style="max-width: 800px">
    <form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="contact-form">
        <div class="row">
            <div class="col-sm-12">
                <input type="text" name="login" placeholder="Email/Phone" value="">
            </div>
            <div class="col-sm-12">
                <input type="password" name="password" placeholder="Password" value="">
            </div>
            <div class="col-sm-12">
                <button class="banner-btn" type="submit" name="send" data-text="send"><span>send</span></button>
                <p class="form-messege">
                    <?php if (isset($_POST['send'])) {
                        $loginClient = loginClient($_POST['login'], $_POST['password'], true);
                        if ($loginClient) {
                            header('Location: index.php');
                        } else {
                            echo "credentials not found";
                        }
                    } ?>
                </A>
            </div>
        </div>
    </form>
</div>
<a href="register.php">
    <button class="banner-btn" data-text="send"><span>Register</span></button>
</a>

<?php include 'footer.php' ?>
