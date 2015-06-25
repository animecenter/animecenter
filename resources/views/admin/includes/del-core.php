<?php
require_once("../conf/config.php");
require_once("../conf/session.php");
require_once("functions.php");
mysql_select_db($database_config, $config);
if (isset($_GET['name']) and isset($_GET['id'])) {
    $n = $_GET['name'];
    //delelte series
    if ($n == 'series') {
        $id = GetSQLValueString($_GET['id'], "int");
        $get = mysql_fetch_assoc($ob->get_table("an_series", "a_id=" . $id));
        $image = $get['a_image'];
        $in = $ob->del_data("an_series", "a_id=" . $id);
        if ($in) {
            $in = $ob->del_data("an_episodes", "e_series=" . $id);
            if (file_exists("../../images/" . $image)) {
                unlink("../../images/" . $image);
            }
            header('location:../index.php?page=series&msg=ok');
        }
    }//end delelte series

//delelte episode
    elseif ($n == 'episode') {
        $id = GetSQLValueString($_GET['id'], "int");
        $in = $ob->del_data("an_episodes", "e_id=" . $id);
        if ($in) {
            header('location:../index.php?page=episodes&msg=ok');
        }
    }//end episode

    //delelte page
    elseif ($n == 'page') {
        $id = GetSQLValueString($_GET['id'], "int");
        $in = $ob->del_data("an_pages", "p_id=" . $id);
        if ($in) {
            header('location:../index.php?page=pages&msg=ok');
        }
    }//end page

    elseif ($n == 'image') {
        $id = GetSQLValueString($_GET['id'], "int");
        $get = mysql_fetch_assoc($ob->get_table("an_images", "i_id=" . $id));
        $image = $get['i_file'];
        $in = $ob->del_data("an_images", "i_id=" . $id);
        if ($in) {
            if (file_exists("../../images/" . $image)) {
                unlink("../../images/" . $image);
            }
            header('location:../index.php?page=images&msg=ok');
        }
    }//end page
}//end $_GET['name']

