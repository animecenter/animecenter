<?php
if (isset($_GET['w']) and $_GET['w'] != null) {
    require_once("../admin/conf/config.php");
    require_once("../admin/includes/functions.php");
    mysql_select_db($database_config, $config);
    $ob = new data();
    if ($_GET['w'] == "f") {
        $check = mysql_fetch_assoc($ob->get_table("an_f_data", "d_id=1"));
        if (isset($check) and $check['d_e_edit'] != '') {
            $episodes_arr = array();
            $episodes = mysql_query("SELECT *,DATE_FORMAT(FROM_UNIXTIME(`e_date`), '%Y-%m-%d %H:%i:%s') as d1,
  DATE_FORMAT(FROM_UNIXTIME(`e_date2`), '%Y-%m-%d %H:%i:%s') as d2 FROM `an_episodes` where e_id IN (" . substr($check['d_e_edit'],
                    0, -1) . ")", $config);
            while ($e = mysql_fetch_assoc($episodes)) {
                $episodes_arr[] = $e;
            }

            $ob->up_data("an_f_data", "d_e_edit=''", "d_id=1");

            echo json_encode($episodes_arr);
            exit;
        }
    }//end if
    else {
        $check = mysql_fetch_assoc($ob->get_table("an_r_data", "d_id=1"));
        if (isset($check) and $check['d_e_edit'] != '') {
            $episodes_arr = array();
            $episodes = mysql_query("SELECT *,DATE_FORMAT(FROM_UNIXTIME(`e_date`), '%Y-%m-%d %H:%i:%s') as d1,
  DATE_FORMAT(FROM_UNIXTIME(`e_date2`), '%Y-%m-%d %H:%i:%s') as d2 FROM `an_episodes` where e_id IN (" . substr($check['d_e_edit'],
                    0, -1) . ")", $config);
            while ($e = mysql_fetch_assoc($episodes)) {
                $episodes_arr[] = $e;
            }

            $ob->up_data("an_r_data", "d_e_edit=''", "d_id=1");
            echo json_encode($episodes_arr);
            exit;
        }
    }//end if
}
echo json_encode(array());
?>