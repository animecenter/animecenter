@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-lg-8">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">New Anime Episodes</h2>
                </div>
                <div class="col-xs-12">
                    <div class="grid-episode">
                        <div class="grid-sizer"></div>
                        @foreach ($episodes as $episode)
                            <div class="grid-item">
                                <a href="{{ url($episode->anime->slug . '/' . $episode->slug . '/' . $episode->mirror->translation) }}" class="thumbnail">
                                    <img src="{{ asset($episode->photo ? $episode->photo : 'http://placehold.it/300x150') }}" alt="{{ $episode->title }}">
                                    <div class="caption">
                                        <h3 class="episode-title">{{ ((strlen($episode->anime->title) > 15)  ?
                                        mb_substr($episode->anime->title, 0, 12) . '...' : $episode->anime->title) . ' ' . $episode->number }}</h3>
                                        <p class="time-release">20 minutes ago</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12">
                    <h2 class="page-header">Anime This Season</h2>
                </div>
                <div class="col-xs-12">
                    <div class="grid grid-anime">
                        @foreach ($animes as $anime)
                            <div class="grid-item">
                                <a href="{{ url($anime->slug) }}" class="thumbnail">
                                    <img src="http://placehold.it/150x225" alt="">
                                    <div class="caption">
                                        <h3 class="episode-title">{{ (strlen($anime->title) > 18) ?
                                            mb_substr($anime->title, 0, 15) . '...' : $anime->title }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-4">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">Upcoming Anime Episodes</h2>
                </div>
                <div class="col-xs-12">
                    @foreach ($upcomingEpisodes as $episode)
                        <a href="{{ url($episode->anime->slug . '/' . $episode->slug) }}" class="media">
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
                <div class="col-xs-12">
                    <h2 class="page-header">Watch Anime Online</h2>
                </div>
            </div>
        </div>
    </div>
@endsection