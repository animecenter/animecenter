<?php
$page_title = "Sorry, the page you have requested cannot be found. | Watch Anime Online Free";
$meta_title = $page_title;
?>
@include('layouts.head')
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="sec2" class="sections">
            <div class="title">Sorry, the page you have requested cannot be found.</div>
            <div class="content">
                <div class="rtecenter">
                    <img src="{{ asset('css/imgs/404img.jpg') }}"/>
                </div>
                <div id="error404page">
                    Why? The URL for this Episode/Anime show has been changed. Go to our
                    <a href="{{ url('anime-list') }}">Subbed Animelist</a> or
                    <a href="{{ url('anime-list-dubbed') }}">Dubbed Animelist</a> depending on your preference
                    and look for your anime show new URL or go visit our
                    <a href="{{ url('/') }}">Homepage</a> to find the latest anime episodes.
                </div>
            </div>
        </div>
        <!--/sections-->
    </div>
    <!--/content-->
</div>
@include('layouts.footer')