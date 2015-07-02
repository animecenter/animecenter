<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="css/style-login.css" rel="stylesheet" type="text/css"/>
        <title>Admin Login</title>
    </head>
    <body>
        <div class="wrap">
            <h1>eAnime 1.0 Beta</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label>Username</label>
                <br/>
                <input type="text" value="" class="login_field" name="user_name"/>
                <br/>
                <label>Password</label>
                <br/>
                <input type="password" value="" name="user_pass" class="login_field"/>
                <br/>
                <input type="submit" value="Login" name="submit" class="login_btn"/>
            </form>
            <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') { ?>
                <div class="res">Success</div>
            <?php } elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') { ?>
                <div class="res">Error, check username or password</div>
            <?php } ?>
        </div>
        <!--End Wrap-->
        <h3>Powered by eAnime 1.0 Beta</h3>
    </body>
</html>
