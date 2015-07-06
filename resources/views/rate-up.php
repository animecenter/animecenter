<?php
require_once("admin/conf/config.php");
require_once("admin/includes/functions.php");

if (isset($_POST['eid'])) {
    $eid = (int) $_POST['eid'];
    $sql1 = "select e_rating , e_votes from an_episodes where e_id='$eid'";
    $ip = $_SERVER['REMOTE_ADDR'];
    $check = mysql_fetch_assoc($ob->get_table("an_rate_ip", "r_target=$eid and r_ip='$ip' and r_type='e'"));

    $res = mysql_query($sql1);
    $votes = 0;
    $rate = 0;
    while ($row = mysql_fetch_array($res)) {
        $votes = $row['e_votes'];
        $rate = $row['e_rating'];
    }
    $new_votes = $votes + 1;
    $new_rate = sprintf("%.2f", ($rate * $votes + $_POST['rate']) / $new_votes);
    if (isset($check) and $check['r_id'] != null) {
        echo "Average: " . $rate . " ( " . $votes . " votes)";
    }//end if
    else {
        $sql = "update an_episodes set e_rating='$new_rate',e_votes='$new_votes' where e_id='$eid'";
        //add ip tp list
        $ob->insert_data("an_rate_ip(r_target,r_ip)", "$eid,'$ip'");
        $dum = mysql_query($sql);
        echo "Average: " . $new_rate . " ( " . $new_votes . " votes)";
    }//end else
}

if (isset($_POST['sid'])) {
    $sid = (int) $_POST['sid'];
    $sql1 = "select a_rating , a_votes from an_series where a_id='$sid'";
    $ip = $_SERVER['REMOTE_ADDR'];
    $check = mysql_fetch_assoc($ob->get_table("an_rate_ip", "r_target=$sid and r_ip='$ip' and r_type='s'"));

    $res = mysql_query($sql1);
    $votes = 0;
    $rate = 0;
    while ($row = mysql_fetch_array($res)) {
        $votes = $row['votes'];
        $rate = $row['rating'];
    }
    $new_votes = $votes + 1;
    $new_rate = sprintf("%.2f", ($rate * $votes + $_POST['rate']) / $new_votes);
    if (isset($check) and $check['r_id'] != null) {
        echo "Average: " . $rate . " ( " . $votes . " votes)";
    }//end if
    else {
        $sql = "update an_series set a_rating='$new_rate',a_votes='$new_votes' where a_id='$sid'";
        //add ip tp list
        $ob->insert_data("an_rate_ip(r_target,r_ip,r_type)", "$sid,'$ip','s'");
        $dum = mysql_query($sql);
        echo "Average: " . $new_rate . " ( " . $new_votes . " votes)";
    }//end else
}
