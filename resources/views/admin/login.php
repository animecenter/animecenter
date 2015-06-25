<?php

$name = '26253c50741faa9c2e2b836773c69fe6';
$pass = 'b48ae4455c3013064aa6d62aa39d912b';
$name = $pass = md5('letmeintoactv');
/******************************************************************************************************/

if (1) {
    if (!isset($_SERVER['PHP_AUTH_USER']) /*|| md5($_SERVER['PHP_AUTH_USER'])!==$name || md5($_SERVER['PHP_AUTH_PW'])!==$pass */) {
        header('WWW-Authenticate: Basic realm="Secure Area"');
        header('HTTP/1.0 401 Unauthorized');
        exit("<b><a href='http://beta.animecenter.tv'>AnimeCenter TV Team</a></b>");
    }
}
session_save_path('/var/www/animecenter/sessions');
ini_set('session.gc_maxlifetime', 10 * 24 * 60 * 60); // 10 hours
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);
ini_set('session.cookie_secure', false);
ini_set('session.use_only_cookies', true);
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['u_id']) and $_SESSION['u_id'] != null) {
    @header("Location:index.php");
}
require_once('conf/config.php');
mysql_select_db($database_config, $config);
if (isset($_POST['submit'])) {
    $loginUsername = $_POST['user_name'];
    $password = md5($_POST['user_pass']);
    $LoginRS__query = sprintf("SELECT * FROM an_users WHERE u_username=%s AND u_password=%s",
        GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));
    $LoginRS = mysql_query($LoginRS__query, $config) or die(mysql_error());
    $row_res = mysql_fetch_assoc($LoginRS);
    $loginFoundUser = mysql_num_rows($LoginRS);
    if ($loginFoundUser) {
        //declare two session variables and assign them
        $_SESSION['u_id'] = $row_res['u_id'];
        $_SESSION['u_username'] = $loginUsername;
        #setcookie("u_username", $loginUsername, time()+3600);
        @header("Location:index.php");
    } else {
        @header("Location:login.php?msg=f");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="css/style-login.css" rel="stylesheet" type="text/css"/>
        <title>Admin Login</title>
    </head>
    <body>
        <div class="wrap">
            <h1>eAnime 1.0 Beta</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label>Username</label><br/><input type="text" value="" class="login_field" name="user_name"/><br/>
                <label>Password</label><br/><input type="password" value="" name="user_pass" class="login_field"/><br/>
                <input type="submit" value="Login" name="submit" class="login_btn"/>
            </form>
            <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
    ?>
                <div class="res">Success</div>
            <?php

} elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
    ?>
                <div class="res">Error, check username or password</div>
            <?php

} ?>
        </div>
        <!--End Wrap-->
        <h3>Powered by eAnime 1.0 Beta</h3>
    </body>
</html>
