<?php
if (isset($_GET['w']) and $_GET['w'] != null) {
    require_once("../admin/conf/config.php");
    require_once("../admin/includes/functions.php");
    mysql_select_db($database_config, $config);
    $ob = new data();
    if ($_GET['w'] == "f") {
        $check = mysql_fetch_assoc($ob->get_table("an_f_data", "d_id=1"));
        if (isset($check) and $check['d_s_edit'] != '') {
            $series_arr = array();
            $series = $ob->get_table("an_series", "a_id in (" . substr($check['d_s_edit'], 0, -1) . ")");
            while ($s = mysql_fetch_assoc($series)) {
                $series_arr[] = $s;
            }

            $ob->up_data("an_f_data", "d_s_edit=''", "d_id=1");

            echo json_encode($series_arr);
            exit;
        }
    }//end if
    else {
        $check = mysql_fetch_assoc($ob->get_table("an_r_data", "d_id=1"));
        if (isset($check) and $check['d_s_edit'] != '') {
            $series_arr = array();
            $series = $ob->get_table("an_series", "a_id in (" . substr($check['d_s_edit'], 0, -1) . ")");
            while ($s = mysql_fetch_assoc($series)) {
                $series_arr[] = $s;
            }
            $ob->up_data("an_r_data", "d_s_edit=''", "d_id=1");

            echo json_encode($series_arr);
            exit;
        }
    }//end if
}
echo json_encode(array());
?>