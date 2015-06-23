<?php
if (!isset($_SESSION)) {
  session_start();
}
$ses="sess_".session_id();
$logoutGoTo = "login.php";
$_SESSION['u_username'] = NULL;
$_SESSION['u_id'] = NULL;
unset($_SESSION['u_username']);
unset($_SESSION['u_id']);
session_destroy();
setcookie ("u_username", "", time() - 3600, "/");
system("rm /home/daiky/sessions/$ses");
if ($logoutGoTo != "") {@header("Location: $logoutGoTo");
exit;
}
?>
