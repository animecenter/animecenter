<!DOCTYPE html>
<html>
    <head>
        <title>{{ isset($pageTitle) ? $pageTitle :
            "Watch Anime Online Free | Anime Shows, Movies and OVAs in English Subbed and Dubbed" }}</title>
        @if ($metaTitle)<meta name="title" content="{{ $metaTitle }}"> @endif
        @if ($metaDesc)<meta name="description" content="{{ $metaDesc }}"/> @endif
        @if ($metaKey)<meta name="keywords" content="{{ $metaKey }}"/> @endif
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="sth-site-verification" content="bf6527dae5e1867e7d5b65f8c47eb99c"/>
        <meta name="google-site-verification" content="5cikZ3O5_LPFgVIEN_S0EHXxFbnjG62VdpcYQZ1c3hk"/>
        @if (isset($meta_og_title) && $meta_og_title != '')
            <meta property="og:title" content="{{ $meta_og_title }}"/>
            <meta property="og:description" content="{{ $meta_og_desc }}"/>
            <meta property="og:image" content="{{ $meta_og_image }}"/>
            <meta property="og:url" content="{{ $meta_og_url }}"/>
            <meta property="og:site_name" content="Watch Anime Online AnimeCenter.TV"/>
        @endif
        @if (isset($episode['title']) && $episode['not_yet_aired'] == '')
            <meta name="medium" content="video"/>
            <meta name="video_type" content="application/x-shockwave-flash"/>
            <meta name="video_height" content="370"/>
            <meta name="video_width" content="650"/>
            <meta name="language" content="en-us"/>
        @endif
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"/>
    </head>

    <body>
        <div id="header">
            <div id="header_cont">
                <div id="logo">
                    <a href="{{ url('/') }}">
                        <img alt='logo' src="{{ asset('imgs/animecenter_logo.png') }}">
                    </a>
                    @if ((strpos($_SERVER['REQUEST_URI'], $options[2]['value']) or
                            strpos($_SERVER['REQUEST_URI'], $options[3]['value'])) && $anime)
                        <div class="text">Watch <span>{{ $anime['title'] }}</span> in
                            English Subbed-Dubbed Online for Free</div>
                    @elseif (strpos($_SERVER['REQUEST_URI'], $options[4]['value']) && isset($episode) && $episode)
                        <div class="text">Watch <span>{{ $episode['title'] }}</span>
                            in English Subbed-Dubbed Online for Free</div>
                    @else
                        <div class="text">Watch Anime in <span> English Subbed-Dubbed </span> Online for Free</div>
                    @endif
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
                            <li {{ $yes === 1 ? "class=has_list" : '' }}>
                                <a href="{{ url($link) }}">{{ $topPage['title'] }}</a>
                                @if ($yes == 1)
                                    <ul>
                                        <li><a href="{{ url("anime-list") }}">Subbed Anime List</a></li>
                                        <li><a href="{{ url("anime-list-dubbed") }}">Dubbed Anime List</a></li>
                                        <li><a href="{{ url("browse_a-z-subbed") }}">Subbed Browse A-Z</a></li>
                                        <li><a href="{{ url("browse_a-z-dubbed") }}">Dubbed Browse A-Z</a></li>
                                    </ul>
                                @endif
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