<?php
require_once("admin/conf/config.php");
require_once("admin/includes/functions.php");
mysql_select_db($database_config, $config);
$ob = new data();
session_save_path('/var/www/animecenter/sessions');
ini_set('session.gc_maxlifetime', 10 * 24 * 60 * 60); // 10 hours
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);
ini_set('session.cookie_secure', false);
ini_set('session.use_only_cookies', true);
if (! isset($_SESSION)) {
    session_start();
}
if (isset($_POST['id']) and $_POST['id'] != null and $_POST['num'] > 0 and isset($_SESSION['u_id'])) {
    $id = GetSQLValueString($_POST['id'], "int");
    $num = GetSQLValueString($_POST['num'], "int");

    $date = time();

    $last_episode = mysql_fetch_assoc($ob->get_table("an_episodes",
        "e_order=(select max(e_order) from an_episodes where e_series=" . $id . ")"));
    $ser_text = mysql_fetch_assoc($ob->get_table("an_series", "a_id=" . $id));
    if (isset($last_episode) and $last_episode['e_id'] != null) {
        //$arr=explode(" ",$last_episode['e_title']);
        $current_id = $last_episode['e_order'];
        $next_id = (int) $current_id + 1;
    } else {
        $next_id = 1;
    }
    for ($i = 0; $i < $num; $i++) {
        $title = GetSQLValueString($ser_text["a_title"] . ' Episode ' . $next_id, "text");
        $con = '
	<div id="yeird">
	<div class="text"><span>Anime Title:</span>' . $ser_text["a_title"] . '</div>
	<div class="text"><span>Episode Number:</span>' . $ser_text["a_title"] . ' Episode ' . $next_id . '</div>
	<div class="text"><span>Status:</span>Upcoming</div>
	<div class="text"><span>About ' . $ser_text["a_title"] . ':</span>' . $ser_text["a_description"] . '</div>
	<div class="text"><span class="big">We don\'t have a video available for <strong>' . $ser_text["a_title"] . ' Episode ' . $next_id . ' </strong>yet. Please check back later or visit our <strong><a href="' . $url . '">HOMEPAGE</a></strong> for the Latest Anime Episodes.</span></div>
	</div>
	';
        $con = GetSQLValueString($con, "text");
        $order = $next_id;
        $in = $ob->insert_data("an_episodes(e_title,e_not_yet_aired,e_series,e_date,e_date2,e_order)",
            "$title,$con,$id,$date,$date,$order");
        $insert_id = mysql_insert_id();
        $ob->up_data("an_f_data", "d_e_add=concat(d_e_add,'" . $insert_id . ",')", "d_id=1");
        $ob->up_data("an_r_data", "d_e_add=concat(d_e_add,'" . $insert_id . ",')", "d_id=1");

        $next_id++;
    }//end for
}
