<?php
session_save_path('/home/daiky/sessions/');
ini_set('session.gc_maxlifetime', 10*24*60*60); // 3 hours
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);
ini_set('session.cookie_secure', FALSE);
ini_set('session.use_only_cookies', TRUE);
if (!isset($_SESSION)) {
  session_start();
}
if(empty($_SESSION['u_username']))
{
	header("location:login.php");
	}

//$currentTimeoutInSecs = ini_get('session.gc_maxlifetime');
//var_dump($currentTimeoutInSecs);
?>
