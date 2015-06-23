<?php
//this page about main page core php
require_once("conf/config.php");
require_once("conf/session.php");
require_once("includes/functions.php");
mysql_select_db($database_config,$config);
//this core about include page to main page
setcookie("u_username", @$_SESSION['u_username'], time()+(10*24*60*60), "/");
if(isset($_GET['page']) and $_GET['page']!=NULL ){
$page=$_GET['page'];
switch($page){
	case 'series_add':$pages="add-series.php";break;
	case 'series_up':$pages="up-series.php";break;
	case 'series':$pages="series.php";break;
	case 'episode_add':$pages="add-episode.php";break;
	case 'episode_up':$pages="up-episode.php";break;
	case 'episodes':$pages="episodes.php";break;
	case 'page_add':$pages="add-page.php";break;
	case 'page_up':$pages="up-page.php";break;
	case 'pages':$pages="pages.php";break;
	case 'image_add':$pages="add-image.php";break;
	case 'image_up':$pages="up-image.php";break;
	case 'images':$pages="images.php";break;
	case 'options':$pages="options.php";break;
	case 'cache-purge':$pages="cache-purge.php";break;
	default:$pages="main.php";break;	
}
}
else{
$pages="main.php";	
}
?>
