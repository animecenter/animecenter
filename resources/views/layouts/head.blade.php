<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo(isset($meta_title)) ? $meta_title : "Watch Anime Online Free | Anime Shows, Movies and OVAs in English Subbed and Dubbed"; ?>
        </title>
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
        <?php if (isset($episode['title']) and $episode['not_yeird'] == null) { ?>
            <meta name="medium" content="video"/>
            <meta name="video_type" content="application/x-shockwave-flash"/>
            <meta name="video_height" content="370"/>
            <meta name="video_width" content="650"/>
            <meta name="language" content="en-us"/>
        <?php } ?>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.bxslider.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui-1.10.3.custom.css') }}"/>
        <script type="text/javascript"> window.suggestmeyes_loaded = true; </script>
        <script type="text/javascript" src="{{ asset('css/js/jquery-1.9.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('css/js/core2.js') }}"></script>
        <script type="text/javascript" defer="defer" src="{{ asset('css/js/jquery-ui.js') }}"></script>
        <script defer="defer" type="text/javascript" src="{{ asset('css/js/jquery.raty.min.js') }}"></script>
        <script defer="defer" type="text/javascript" src="{{ asset('css/js/jquery.raty.js') }}"></script>
        <script defer="defer" type="text/javascript" src="{{ asset('css/js/core.js') }}"></script>
        <script defer="defer" type="text/javascript" data-cfasync='true'>var switchTo5x = true;</script>

        <!-- <script type="text/javascript"   defer="defer" data-cfasync='true'>
        stLight.options({publisher: "0ee3fa60-2817-4ade-b387-244cb1d5d4dd",
        doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> -->
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
                    <a href="{{ url('/') }}">
                        <img alt='logo' src="{{ asset('css/imgs/animecenter_logo.png') }}">
                    </a>
                    <div class="text">Watch Anime in <span> English Subbed-Dubbed </span> Online for Free</div>
                </div>
                <div id="nav">
                    <ul>
                        <li>
                            <a href="{{ url('/') }}">Home</a></li>
                        <?php
                        foreach ($topPagesList as $topPage) {
                            if (isset($topPage['link']) and $topPage['link'] != null) {
                                $link = $topPage['link'];
                            } else {
                                $link = $url . "page.php?page_id=" . $topPage['id'];
                            }
                            if ($topPage['title'] == "Anime list") {
                                $yes = 1;
                            } else {
                                $yes = 0;
                            }
                            ?>
                            <li <?php if ($yes == 1) { echo 'class="has_list"'; } ?>>
                                <a href="{{ url($link) }}">
                                    <?php echo $topPage['title']; ?>
                                </a>
                                <?php if ($yes == 1) { ?>
                                    <ul>
                                        <li><a href="{{ url("anime-list") }}">Subbed Anime List</a></li>
                                        <li><a href="{{ url("anime-list-dubbed") }}">Dubbed Anime List</a></li>
                                        <li><a href="{{ url("browse_a-z-subbed") }}">Subbed Browse A-Z</a></li>
                                        <li><a href="{{ url("browse_a-z-dubbed") }}">Dubbed Browse A-Z</a></li>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!--/nav-->
                <div id="search">
                    <form method="get" action="{{ url('search') }}">
                        <input type="submit" class="submit" value="s"/>
                        <input type="text" class="s" name="title"/>
                    </form>
                </div>
                <!--search-->
            </div>
            <!--/header_cont-->
        </div>
        <!--/header-->