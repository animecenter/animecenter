<?php
if (isset($_POST['type']) and $_POST['type'] != null) {
    require_once("admin/conf/config.php");
    require_once("admin/includes/functions.php");
    mysql_select_db($database_config, $config);
    $ob = new data();
    $type = ($_POST['type'] == 's') ? 's' : 'e';
    $tid = (int) $_POST['tid'];
    if (($_POST['type'] == 's')) {
        $ob->up_data("an_series", "a_visits=a_visits+1", "a_id=$tid");
        $series = $ob->get_table("an_series", "a_id=$tid");
        $series_content = mysql_fetch_assoc($series);
        $new_views = $series_content['a_visits'];
    } else {
        $ob->up_data("an_episodes", "e_visits=e_visits+1", "e_id=$tid");
        $episode = $ob->get_table("an_episodes", "e_id=$tid");
        $episode = mysql_fetch_assoc($episode);
        $new_views = $episode['e_visits'];
    }
    echo $new_views;
}//end check if
else {
    echo 0;
}
