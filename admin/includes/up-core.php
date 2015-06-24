<?php
if ( ! isset($url)) {
    die("Error");
    exit();
}
//update series
if (isset($_POST['up_series'])) {
    $title = GetSQLValueString($_POST['title'], "text");
    $genres = implode(",", $_POST['genres']);
    $genres = GetSQLValueString($genres, "text");
    $episodes = GetSQLValueString($_POST['episodes'], "text");
    $type = GetSQLValueString($_POST['type'], "text");
    $type2 = GetSQLValueString($_POST['type2'], "text");
    $status = GetSQLValueString($_POST['status'], "text");
    $prequel = GetSQLValueString($_POST['prequel'], "text");
    $sequel = GetSQLValueString($_POST['sequel'], "text");
    $story = GetSQLValueString($_POST['story'], "text");
    $s_story = GetSQLValueString($_POST['s_story'], "text");
    $spin_off = GetSQLValueString($_POST['spin_off'], "text");
    $alternative_2 = GetSQLValueString($_POST['alternative_2'], "text");
    $other = GetSQLValueString($_POST['other'], "text");
    $age = GetSQLValueString($_POST['age'], "text");
    $content = GetSQLValueString($_POST['content'], "text");
    $date2 = time();

    $description = GetSQLValueString($_POST['description'], "text");
    $alternative = GetSQLValueString($_POST['alternative'], "text");

    if (isset($_POST['position1']) and isset($_POST['position2'])) {
        $position = "all";
    } elseif (isset($_POST['position1']) and ! isset($_POST['position2'])) {
        $position = "recently";
    } elseif ( ! isset($_POST['position1']) and isset($_POST['position2'])) {
        $position = "featured";
    } else {
        $position = "none";
    }

    if (isset($_FILES['img_file']) and $_FILES['img_file']['name'] != null) {
        $filename = rand(00000000, 99999999) . '_' . $_FILES['img_file']['name'];
        move_uploaded_file($_FILES['img_file']['tmp_name'], "/var/www/animecenter/htdocs/images/" . $filename);
        @chmod("/var/www/animecenter/htdocs/images/" . $filename, 0644);
        $filename = GetSQLValueString($filename, "text");
        if (file_exists("../images/" . $_POST['h_image'])) {
            unlink("/var/www/animecenter/htdocs/images/" . $_POST['h_image']);
        }
    } else {
        $filename = GetSQLValueString($_POST['h_image'], "text");
    }

    $in = $ob->up_data("an_series",
        "a_title=$title,a_content=$content,a_genres=$genres,a_episodes=$episodes,a_type=$type,a_age=$age,a_type2=$type2,a_status=$status,a_prequel=$prequel,a_sequel=$sequel,a_story=$story,a_position='$position',a_description=$description,a_alternative_title=$alternative,a_image=$filename,a_side_story=$s_story,a_spin_off=$spin_off,a_alternative=$alternative_2,a_other=$other,a_date2=$date2",
        "a_id=" . $resss_row['a_id']);
    $ob->up_data("an_f_data", "d_s_edit=concat(d_s_edit,'" . $resss_row['a_id'] . ",')", "d_id=1");
    $ob->up_data("an_r_data", "d_s_edit=concat(d_s_edit,'" . $resss_row['a_id'] . ",')", "d_id=1");
    if ($in) {
        header('location:' . $url . $resss_row['a_type2'] . "-anime/" . str_replace(" ", "-",
                strtolower($_POST['title'])));
    }
}
//end update series

//up episode
if (isset($_POST['up_episode'])) {
    $title = GetSQLValueString($_POST['title'], "text");
    $subdub = GetSQLValueString($_POST['subdub'], "text");
    $yeird = GetSQLValueString($_POST['not_yeird'], "text");
    $raw = GetSQLValueString($_POST['raw'], "text");
    $hd = GetSQLValueString($_POST['hd'], "text");
    $mirror1 = GetSQLValueString($_POST['mirror1'], "text");
    $mirror2 = GetSQLValueString($_POST['mirror2'], "text");
    $mirror3 = GetSQLValueString($_POST['mirror3'], "text");
    $mirror4 = GetSQLValueString($_POST['mirror4'], "text");
    $series = GetSQLValueString($_POST['series'], "int");
    $date2 = time();
    $coming_date = GetSQLValueString($_POST['coming_date'], "date");
    if (isset($_POST['show'])) {
        $show = 1;
        /*$cache_key = md5("www.animecenter.tv/");
        $cachefile = 'cached/cached-'.$cache_key.'.html';
        unlink("../".$cachefile);*/
    } else {
        $show = 0;
    }

    if (isset($_POST['reset'])) {
        $date = time();
    } else {
        $date = GetSQLValueString($_POST['c_date'], "int");
    }

    $in = $ob->up_data("an_episodes",
        "e_title=$title,e_subdub=$subdub,e_show=$show,e_not_yeird=$yeird,e_raw=$raw,e_hd=$hd,e_mirror1=$mirror1,e_mirror2=$mirror2,e_mirror3=$mirror3,e_mirror4=$mirror4,e_series=$series,e_date=$date,e_date2=$date2,e_coming_date=$coming_date",
        "e_id=" . $resss_row['e_id']);

    $ob->up_data("an_f_data", "d_e_edit=concat(d_e_edit,'" . $resss_row['e_id'] . ",')", "d_id=1");
    $ob->up_data("an_r_data", "d_e_edit=concat(d_e_edit,'" . $resss_row['e_id'] . ",')", "d_id=1");
    if ($in) {
        $cache_path = '/home/nginx-cache/animecenter/';
        $link = $url . "watch/" . str_replace(" ", "-", strtolower($_POST['title']));
        $ur = parse_url($link);
        $scheme = $ur['scheme'];
        $host = $ur['host'];
        $requesturi = $ur['path'];
        $hash = md5($scheme . 'GET' . $host . $requesturi);
        $cache_path . substr($hash, -1) . '/' . substr($hash, -3, 2) . '/' . $hash;
        #$cache_file = exec("grep -lr '$requesturi' $cache_path | xargs rm");
        unlink($cache_path . substr($hash, -1) . '/' . substr($hash, -3, 2) . '/' . $hash);
        $ur = parse_url("http://www.animecenter.tv/");
        $scheme = $ur['scheme'];
        $host = $ur['host'];
        $requesturi = $ur['path'];
        $hash = md5($scheme . 'GET' . $host . $requesturi);
        $cache_path . substr($hash, -1) . '/' . substr($hash, -3, 2) . '/' . $hash;
        #$cache_file = exec("grep -lr '$requesturi' $cache_path | xargs rm");
        unlink($cache_path . substr($hash, -1) . '/' . substr($hash, -3, 2) . '/' . $hash);
        header('location:' . $link);
    } else {
        header('location:index.php?page=episodes&msg=f');
    }
}
//end up_episode

//up page
if (isset($_POST['up_page'])) {
    $title = GetSQLValueString($_POST['title'], "text");
    $content = GetSQLValueString($_POST['content'], "text");
    $order = GetSQLValueString($_POST['order'], "int");
    $position = GetSQLValueString($_POST['position'], "text");
    $link = GetSQLValueString($_POST['link'], "text");

    $in = $ob->up_data("an_pages", "p_title=$title,p_content=$content,p_link=$link,p_order=$order,p_position=$position",
        "p_id=" . $resss_row['p_id']);
    if ($in) {
        header('location:index.php?page=pages&msg=ok');
    } else {
        header('location:index.php?page=pages&msg=f');
    }
}
//end page

//up page
if (isset($_POST['up_options'])) {
    $title = GetSQLValueString($_POST['title'], "text");
    $content = GetSQLValueString($_POST['text'], "text");
    $subbed = GetSQLValueString($_POST['subbed'], "text");
    $dubbed = GetSQLValueString($_POST['dubbed'], "text");
    $episode = GetSQLValueString($_POST['episode'], "text");

    $in = $ob->up_data("an_options", "o_value=$title", "o_id=1");
    $in = $ob->up_data("an_options", "o_value=$content", "o_id=2");
    $in = $ob->up_data("an_options", "o_value=$subbed", "o_id=3");
    $in = $ob->up_data("an_options", "o_value=$dubbed", "o_id=4");
    $in = $ob->up_data("an_options", "o_value=$episode", "o_id=5");
    if ($in) {
        header('location:index.php?page=options&msg=ok');
    } else {
        header('location:index.php?page=options&msg=f');
    }
}
//end options

//up image
if (isset($_POST['up_image'])) {
    $bigtitle = GetSQLValueString($_POST['bigtitle'], "text");
    $smalltitle = GetSQLValueString($_POST['smalltitle'], "text");
    $desc = GetSQLValueString($_POST['desc'], "text");
    $link = GetSQLValueString($_POST['link'], "text");
    $date = date("Y-m-d H:i:s");
    if (isset($_FILES['img_file']) and $_FILES['img_file']['name'] != null) {
        $filename = rand(00000000, 99999999) . '_' . $_FILES['img_file']['name'];
        move_uploaded_file($_FILES['img_file']['tmp_name'], "/var/www/animecenter/htdocs/images/" . $filename);
        @chmod("/var/www/animecenter/htdocs/images/" . $filename, 0644);
        $filename = GetSQLValueString($filename, "text");
        if (file_exists("/var/www/animecenter/htdocs/images/" . $_POST['c_image'])) {
            unlink("../images/" . $_POST['c_image']);
        }
    } else {
        $filename = GetSQLValueString($_POST['c_image'], "text");
    }

    $in = $ob->up_data("an_images",
        "i_bigtitle=$bigtitle,i_smalltitle=$smalltitle,i_link=$link,i_desc=$desc,i_file=$filename,i_date='$date'",
        "i_id=" . $id);
    if ($in) {
        header('location:index.php?page=images&msg=ok');
    } else {
        header('location:index.php?page=images&msg=f');
    }
}
//end up image