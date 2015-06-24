<?php
//this page about main page core php
require_once("admin/conf/config.php");
require_once("admin/includes/functions.php");
mysql_select_db($database_config, $config);
$ob = new data();


if (isset($_GET['offset']) and $_GET['offset'] != null) {
    $off = GetSQLValueString($_GET['offset'], "int");
    if ($off == 1) {
        $start = 0;
    } else {
        $start = ($off - 1) * 12;
    }
} else {
    $start = 0;
}


$res = $ob->get_table("an_options");
while ($options[] = mysql_fetch_assoc($res)) {
    ;
}
array_pop($options);

$images = $ob->get_table("an_images", "1 order by i_date DESC limit 0,10");
while ($images_list[] = mysql_fetch_assoc($images)) {
    ;
}
array_pop($images_list);

$top_pages = $ob->get_table("an_pages", "p_position='top' order by p_order");
while ($top_pages_list[] = mysql_fetch_assoc($top_pages)) {
    ;
}
array_pop($top_pages_list);

$bottom_pages = $ob->get_table("an_pages", "p_position='bottom1' order by p_order");
while ($bottom_pages_list[] = mysql_fetch_assoc($bottom_pages)) {
    ;
}
array_pop($bottom_pages_list);

$bottom2_pages = $ob->get_table("an_pages", "p_position='bottom2' order by p_order");
while ($bottom2_pages_list[] = mysql_fetch_assoc($bottom2_pages)) {
    ;
}
array_pop($bottom2_pages_list);

$bottom3_pages = $ob->get_table("an_pages", "p_position='bottom3' order by p_order");
while ($bottom3_pages_list[] = mysql_fetch_assoc($bottom3_pages)) {
    ;
}
array_pop($bottom3_pages_list);

$episodes = $ob->get_table("an_episodes", "e_show=1 order by e_date DESC limit 0,12");
while ($episodes_list[] = mysql_fetch_assoc($episodes)) {
    ;
}
array_pop($episodes_list);

$series_c = $ob->get_table("an_series", "a_position ='recently' or a_position ='all'");
$count = mysql_num_rows($series_c);
$num_pages = ceil($count / 4);

$series_re = $ob->get_table("an_series",
    "a_position ='recently' or a_position ='all' order by a_id DESC limit " . $start . ",4");
while ($series_re_list[] = mysql_fetch_assoc($series_re)) {
    ;
}
array_pop($series_re_list);

$series_fe = $ob->get_table("an_series", "a_position ='featured' or a_position ='all'  order by a_id DESC limit 0,12");
while ($series_fe_list[] = mysql_fetch_assoc($series_fe)) {
    ;
}
array_pop($series_fe_list);


//this core about include page to main page
if (isset($_GET['page_title'])) {
    $page_title = $_GET['page_title'];
    switch ($page_title) {
        default:
            header("location:" . $url);
            break;
    }
} else {
    if ((isset($_GET['page_id']) and $_GET['page_id'] != null)) {
        $id = GetSQLValueString($_GET['page_id'], "int");
        $page = $ob->get_table("an_pages", "p_id=" . $id);
        $page_content = mysql_fetch_assoc($page);
    } elseif ((isset($_GET['page_id']) and $_GET['page_id'] == null)) {
        header("location:" . $url);
    }
}