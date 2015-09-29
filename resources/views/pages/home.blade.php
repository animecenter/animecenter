@extends('layouts.index')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-lg-8 slider">
            <div class="carousel slide" data-ride="carousel" id="myCarousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#myCarousel">
                    </li>
                    <li data-slide-to="1" data-target="#myCarousel"></li>
                    <li data-slide-to="2" data-target="#myCarousel"></li>
                    <li data-slide-to="3" data-target="#myCarousel"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img alt="Chania" src="http://www.animecenter.tv/images/64818209_overlord9.jpg">
                    </div>
                    <div class="item">
                        <img alt="Chania" src="http://www.animecenter.tv/images/26444711_op707.jpg">
                    </div>
                    <div class="item">
                        <img alt="Flower" src="http://www.animecenter.tv/images/75074375_ft73.jpg">
                    </div>
                    <div class="item">
                        <img alt="Flower" src="http://www.animecenter.tv/images/88603739_gate9.jpg">
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" data-slide="prev" href="#myCarousel" role="button">
                    <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" data-slide="next" href="#myCarousel" role="button">
                    <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-lg-4 adhomepage">
            <img alt="Flower" src="public/img/facebook.png" style="width:300px;">
            <br>
            <!--<script src="http://www.evolvenation.com/delivery.js?id=15&size=300x250" type="text/javascript"></script>-->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h1 class="page-header">
                New Anime Episodes
            </h1>
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/overlord-thumb.jpg">
                        <span class="episodetile">Overlord is the best Anime</span>
                        <br>
                        Episode 9 <span class="timerealase">20 minutes ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/akagami-no-shirayuki-hime-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">50 minutes ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/himouto!-umaru-chan-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">1 hour ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/jitsu-wa-watashi-wa-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">3 hours ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/monster-musume-no-iru-nichijou-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">1 day ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/non-non-biyori-repeat-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">3 days ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/sore-ga-seiyuu!-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">1 week ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/teekyuu-5-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">2 weeks ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/diamond-no-ace-second-season-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">3 weeks ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/baby-steps-2nd-season-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">1 month ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/gangsta.-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">2 months ago</span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="thumbnail">
                        <img alt="" src="public/img/episode/god-eater-thumb.jpg">
                        <span class="episodetile">Overlord</span>
                        <br>
                        Episode 9 <span class="timerealase">1 year ago</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <h1 class="page-header">
                Upcoming Anime Episodes
            </h1>
            <div class="notice notice-lg">
                <div class="imgcounter">
                    <img alt="" src="public/img/counter/narutoshippuden_0.jpg">
                </div>
                <div class="counter">
                    Naruto Shippuden
                </div>
                Episode 427
            </div>
            <div class="notice notice-lg">
                <div class="imgcounter">
                    <img alt="" src="public/img/counter/69012436_72232l.jpg">
                </div>
                <div class="counter">
                    Gakkou Gurashi!
                </div>
                Episode 9
            </div>
            <div class="notice notice-lg">
                <div class="imgcounter">
                    <img alt="" src="public/img/counter/58958233_73692l.jpg">
                </div>
                <div class="counter">
                    Ushio to Tora TV
                </div>
                Episode 10
            </div>
            <div class="notice notice-lg">
                <div class="imgcounter">
                    <img alt="" src="public/img/counter/58126333_gintama2015.jpg">
                </div>
                <div class="counter">
                    Gintama' 2015
                </div>
                Episode 22
            </div>
            <div class="notice notice-lg">
                <div class="imgcounter">
                    <img alt="" src="public/img/counter/9110338_oremonogatari.jpg">
                </div>
                <div class="counter">
                    Ore Monogatari!!
                </div>
                Episode 22
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-header">
                Anime This Season
            </h1>
            <div class="carousel slide media-carousel" id="media">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/73852.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74683.jpg">
                                    <span class="titleanimeseason">Charlotte</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/75104.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/75764.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img alt="" src="public/img/anime/74415.jpg">
                                    <span class="titleanimeseason">God Eater!</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" data-slide="prev" href="#media">‹</a>
                <a class="right carousel-control" data-slide="next" href="#media">›</a>
            </div>
        </div>
        <div class="col-lg-4">
            <h1 class="page-header">
                Watch Anime Online
            </h1>
        </div>
    </div>
</div>
@endsection