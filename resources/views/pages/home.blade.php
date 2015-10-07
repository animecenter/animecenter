@extends('layouts.index')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h2 class="page-header">New Anime Episodes</h2>
            <div class="center-block">
                <div class="row">
                    @foreach($episodes as $episode)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ url('anime/' . $episode->anime->slug . '/episode/' . $episode->number) }}"
                               class="thumbnail">
                                <img src="{{ asset($episode->photo ? $episode->photo : 'http://placehold.it/300x150') }}"
                                     alt="{{ $episode->title }}">
                                <div class="caption">
                                    <h3 class="episode-title">{{ (strlen($episode->anime->title) > 17)  ?
                                        mb_substr($episode->anime->title, 0, 14) . '...' : $episode->anime->title }}</h3>
                                    <p class="text-center">{{ 'Episode ' . $episode->number }}</p>
                                    <p class="time-release">20 minutes ago</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <h2 class="page-header">Upcoming Anime Episodes</h2>
            <div class="row">
                <div class="col-xs-12">
                    @foreach ($upcomingEpisodes as $episode)
                        <a href="{{ url('anime/' . $episode->anime->slug . '/episode/' . $episode->number) }}" class="media">
                            <div class="media-left">
                                <img src="{{ $episode->photo ? asset($episode->photo) : 'http://placehold.it/50x85' }}"
                                     alt="{{ $episode->title }}">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">{{ (strlen($episode->anime->title) > 21) ?
                            mb_substr($episode->anime->title, 0, 18) . '...' : $episode->anime->title }}</h3>
                                <p>{{ 'Episode ' . $episode->number }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h2 class="page-header">Anime This Season</h2>
            <div class="carousel slide media-carousel" id="media">
                <div class="carousel-inner">
                    @foreach ($animes->chunk(4) as $key => $items)
                    <div class="item {{ $key === 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($items as $anime)
                                <div class="col-xs-6 col-md-3">
                                    <a href="{{ url('anime/' . $anime->slug) }}" class="thumbnail">
                                        <img src="http://placehold.it/150x225" alt="">
                                        <div class="caption">
                                            <h3 class="episode-title">{{ (strlen($anime->title) > 12) ?
                                                mb_substr($anime->title, 0, 9) . '...' : $anime->title }}</h3>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="left carousel-control" data-slide="prev" href="#media">&rsaquo;</a>
                <a class="right carousel-control" data-slide="next" href="#media">&rsaquo;</a>
            </div>
        </div>
        <div class="col-md-4">
            <h2 class="page-header">Watch Anime Online</h2>
        </div>
    </div>
</div>
@endsection