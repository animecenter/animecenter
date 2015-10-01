@extends('layouts.index')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h2 class="page-header">New Anime Episodes</h2>
            <div class="row">
                @foreach($episodes as $episode)
                    <div class="col-xs-12 col-md-3">
                        <a href="{{ url('anime/' . $episode->anime->slug . '/episode/' . $episode->number) }}"
                           class="thumbnail">
                            <img src="{{ asset($episode->photo ? $episode->photo : 'http://placehold.it/158x89') }}"
                                 alt="{{ $episode->title }}">
                            <h3 class="episode-title">{{ (strlen($episode->anime->title) > 20)  ?
                                substr($episode->anime->title, 0, 20) . '...' : $episode->anime->title }}</h3>
                            <br>{{ 'Episode ' . $episode->number }}<br>
                            <span class="time-release">20 minutes ago</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <h2 class="page-header">Upcoming Anime Episodes</h2>
            @foreach ($upcomingEpisodes as $episode)
                <div class="media">
                    <div class="media-left">
                        <img src="{{ $episode->photo ? asset($episode->photo) : 'http://placehold.it/50x85' }}"
                             alt="{{ $episode->title }}">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ (strlen($episode->anime->title) > 15) ?
                            substr($episode->anime->title, 0, 12) . '...' : $episode->anime->title }}</h4>
                        <span>{{ 'Episode ' . $episode->number }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h2 class="page-header">Anime This Season</h2>
            <div class="carousel slide media-carousel" id="media">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">Charlotte</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="thumbnail" href="#">
                                    <img src="http://placehold.it/157x68" alt="">
                                    <span class="anime-season-title">God Eater!</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" data-slide="prev" href="#media">‹</a>
                <a class="right carousel-control" data-slide="next" href="#media">›</a>
            </div>
        </div>
        <div class="col-md-4">
            <h2 class="page-header">Watch Anime Online</h2>
        </div>
    </div>
</div>
@endsection