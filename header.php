<?php
require_once("top-cache.php");
require_once("index-core.php");
if (strpos($_SERVER['REQUEST_URI'], $options[2]['o_value']) or strpos($_SERVER['REQUEST_URI'], $options[3]['o_value'])
) {
    if ((isset($_GET['id']) and $_GET['id'] != null)) {
        $title = explode("/", $_GET['id']);
        $title = str_replace("-", " ", $title[1]);
        $title = GetSQLValueString($title, "text");
        $sss = $ob->get_table("an_series", "a_title=$title");
        if (mysql_num_rows($sss) <= 0) {
            header("location:" . $url . "404Page");
        }
        $series_contents = mysql_fetch_assoc($sss);
        $page_title = $series_contents['a_title'];
        $meta_title = "Watch " . $page_title . " Online for Free | Watch Anime Online Free";
        $meta_desc = "Watch " . $page_title . "!,Watch " . $page_title . "! English Subbed/Dubbed,Watch " . $page_title . " English Sub/Dub, Download " . $page_title . " for free,Watch " . $page_title . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $meta_key = "Download " . $page_title . ",Watch " . $page_title . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";
        $meta_og_title = $page_title;
        $meta_og_desc = "Genres:&nbsp;" . $series_contents['a_genres'] . "
				Episodes:&nbsp; " . $series_contents['a_episodes'] . "
				Prequel:&nbsp;" . $series_contents['a_prequel'] . "
				Type:&nbsp;" . $series_contents['a_type'] . "
				Age Permission:&nbsp;&nbsp;" . $series_contents['a_age'];
        $meta_og_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $meta_og_image = $url . "images/" . $series_contents['a_image'];
    }
} elseif (strpos($_SERVER['REQUEST_URI'], $options[4]['o_value'])) {
    if ((isset($_GET['id']) and $_GET['id'] != null)) {
        $title = explode("/", $_GET['id']);
        $title = str_replace("-", " ", $title[1]);
        $title = GetSQLValueString($title, "text");
        $episode = $ob->get_table("an_episodes", "e_title=$title");
        if (mysql_num_rows($episode) <= 0) {
            header("location:" . $url . "404Page");
        }
        $episode_content = mysql_fetch_assoc($episode);
        $page_title = $episode_content['e_title'];
        $meta_title = "Watch " . $page_title . " Online for Free | Watch Anime Online Free";
        $meta_desc = "Watch " . $page_title . "!,Watch " . $page_title . "! English Subbed/Dubbed,Watch " . $page_title . " English Sub/Dub, Download " . $page_title . " for free,Watch " . $page_title . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $meta_key = "Download " . $page_title . ",Watch " . $page_title . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";
        $meta_og_title = $page_title;
        $meta_og_desc = $page_title;
        $meta_og_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $meta_og_image = $url . "fb-img-logo.png";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo (isset($meta_title)) ? $meta_title : "Watch Anime Online Free | Anime Shows, Movies and OVAs in English Subbed and Dubbed"; ?></title>
    <meta name="sth-site-verification" content="bf6527dae5e1867e7d5b65f8c47eb99c"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="google-site-verification" content="5cikZ3O5_LPFgVIEN_S0EHXxFbnjG62VdpcYQZ1c3hk"/>
    <?php if (isset($meta_og_title) and $meta_og_title != null) { ?>
        <meta property="og:title" content="<?php echo $meta_og_title; ?>"/>
        <meta property="og:description" content="<?php echo $meta_og_desc; ?>"/>
        <meta property="og:image" content="<?php echo $meta_og_image; ?>"/>
        <meta property="og:url" content="<?php echo $meta_og_url; ?>"/>
        <meta property="og:site_name" content="Watch Anime Online AnimeCenter.TV"/>
    <?php } ?>
    <?php if (isset($episode_content['e_title']) and $episode_content['e_not_yeird'] == null) { ?>
        <meta name="medium" content="video"/>
        <meta name="video_type" content="application/x-shockwave-flash"/>
        <meta name="video_height" content="370"/>
        <meta name="video_width" content="650"/>
        <meta name="language" content="en-us"/>
    <?php } ?>
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/jquery.bxslider.css"/>
    <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/jquery-ui-1.10.3.custom.css"/>
    <script type="text/javascript"> window.suggestmeyes_loaded = true; </script>
    <script type="text/javascript" src="<?php echo $url; ?>css/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $url; ?>css/js/core2.js"></script>
    <script type="text/javascript" defer="defer" src="<?php echo $url; ?>css/js/jquery-ui.js"></script>
    <script defer="defer" type="text/javascript" src="<?php echo $url; ?>css/js/jquery.raty.min.js"></script>
    <script defer="defer" type="text/javascript" src="<?php echo $url; ?>css/js/jquery.raty.js"></script>
    <script defer="defer" type="text/javascript" src="<?php echo $url; ?>css/js/core.js"></script>
    <script defer="defer" type="text/javascript" data-cfasync='true'>var switchTo5x = true;</script>

    <!-- <script type="text/javascript"   defer="defer" data-cfasync='true'>
    stLight.options({publisher: "0ee3fa60-2817-4ade-b387-244cb1d5d4dd", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> -->
    <script defer="defer" type="text/javascript">(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&amp;appId=188877311299252";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        $(document).ready(function () {
//setTimeout(function(){$("iframe[width=0]").remove();},1000);
        });
    </script>
</head>

<body>
<div id="header">
    <div id="header_cont">
        <div id="logo">
            <a href="<?php echo $url; ?>"><img alt='logo' src="<?php echo $url . "css/imgs/animecenter_logo.png"; ?>"/></a>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], $options[2]['o_value']) or strpos($_SERVER['REQUEST_URI'],
                    $options[3]['o_value'])
            ) {
                if ((isset($_GET['id']) and $_GET['id'] != null)) {
                    $title = explode("/", $_GET['id']);
                    $title = str_replace("-", " ", $title[1]);
                    $title = GetSQLValueString($title, "text");
                    $series = $ob->get_table("an_series", "a_title=$title");
                    $series_content = mysql_fetch_assoc($series);
                    echo '<div class="text">Watch <span>' . $series_content['a_title'] . '</span> in English Subbed-Dubbed Online for Free</div>';
                    $page_title = $series_content['a_title'];
                }
            } elseif (strpos($_SERVER['REQUEST_URI'], $options[4]['o_value'])) {
                if ((isset($_GET['id']) and $_GET['id'] != null)) {
                    $title = explode("/", $_GET['id']);
                    $title = str_replace("-", " ", $title[1]);
                    $title = GetSQLValueString($title, "text");
                    $episode = $ob->get_table("an_episodes", "e_title=$title");
                    $episode_content = mysql_fetch_assoc($episode);
                    $page_title = $episode_content['e_title'];
                    echo '<div class="text">Watch <span>' . $episode_content['e_title'] . '</span> in English Subbed-Dubbed Online for Free</div>';
                }
            } else {
                echo '<div class="text">Watch Anime in <span> English Subbed-Dubbed </span> Online for Free</div>';
            }
            ?>
        </div>
        <div id="nav">
            <ul>
                <li>
                    <?php //var_dump($_SESSION['u_username']); ?>
                    <a href="<?php echo $url; ?>">Home</a></li>
                <?php
                $lists = '
            <ul>
            <li><a href="' . $url . 'anime-list">Subbed Anime List</a></li>
            <li><a href="' . $url . 'anime-list-dubbed">Dubbed Anime List</a></li>
            <li><a href="' . $url . 'browse_a-z-subbed">Subbed Browse A-Z</a></li>
            <li><a href="' . $url . 'browse_a-z-dubbed">Dubbed Browse A-Z</a></li>
            </ul>
            ';
                foreach ($top_pages_list as $top_page) {
                    if (isset($top_page['p_link']) and $top_page['p_link'] != null) {
                        $link = $top_page['p_link'];
                    } else {
                        $link = $url . "page.php?page_id=" . $top_page['p_id'];
                    }
                    if ($top_page['p_title'] == "Anime list") {
                        $yes = 1;
                    } else {
                        $yes = 0;
                    }
                    ?>
                    <li <?php if ($yes == 1) {
                        echo "class='has_list'";
                    }?>><a href="<?php echo $link;?>"><?php echo $top_page['p_title'];?></a><?php if ($yes == 1) {
                            echo $lists;
                        }?></li>
                <?php } ?>

            </ul>
        </div>
        <!--/nav-->
        <div id="search">
            <form method="get" action="<?php echo $url . 'search'; ?>">
                <input type="submit" class="submit" value="s"/>
                <input type="text" class="s" name="sword"/>
            </form>
        </div>
        <!--search-->
    </div>
    <!--/header_cont-->
</div>
<!--/header-->
