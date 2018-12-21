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
            text-align: center;
            margin: auto;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col s6 offset-s3 z-depth-2 login-form">
                <form style="display: block" action="index.html" method="post">
                    <h2 style="text-align: center; margin-top: 20px">Login</h2>
                    <div class="input-field">
                        <input id="login" type="text" class="validate">
                        <label for="login" class="">Email or Phone</label>
                    </div>
                    <div class="input-field">
                        <input id="password" type="password" class="validate">
                        <label for="password" class="">Password</label>
                    </div>
                    <input class="waves-effect waves-light btn login_submit" type="submit" name="login_submit" value="login">
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
