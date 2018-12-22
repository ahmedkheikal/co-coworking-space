<?php include 'header.php'; ?>
    <style media="screen">
        @media (min-width: 480px) {
            .container {
                margin-top: 60px;
            }
        }
        .login-form {
            border-radius: 10px;
            padding-bottom: 20px !important
        }
        .login_submit, .login_submit * {
            color: white;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col s6 offset-s3 z-depth-2 login-form">
                <form style="display: block" action="api/login" method="post">
                    <h2 style="text-align: center; margin-top: 20px">Login</h2>
                    <div class="input-field">
                        <input id="login" type="text" class="validate" name="login">
                        <label for="login" class="">Email or Phone</label>
                    </div>
                    <div class="input-field">
                        <input id="password" type="password" class="validate" name="password">
                        <label for="password" class="">Password</label>
                    </div>
                    <div class="input-field">
                        <p style="text-align: center">
                            <label>
                                <input type="checkbox" name="remember"/>
                                <span>Remember Me</span>
                            </label>
                        </p>
                    </div>
                    <input class="col s4 offset-s4 waves-effect waves-light btn login_submit" type="submit" name="login_submit" value="login">
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

<script type="text/javascript">
    $('form').submit(function (e) {
        e.preventDefault();
        $('#mainLoader').fadeIn('fast');
        $.ajax({
            url: 'api/login',
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                console.log(data);
                if (data.code == '200') {
                    location.href = '<?php echo ROOT ?>';
                } else {
                    $('#mainLoader').fadeOut('fast');
                    alert(data.response);
                }

            }
        })
    })
</script>
