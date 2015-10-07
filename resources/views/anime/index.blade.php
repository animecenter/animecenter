@extends('layouts.index')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="btn-toolbar" role="toolbar">

                    <li>
                        <a href="#">
                            <i class="fa fa-star fa-fw text-yellow"></i>
                            Favorites
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-heart fa-fw text-danger"></i>
                            Recommendations
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-check fa-fw text-success"></i> New
                            Episodes
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-edit fa-fw text-pink"></i>
                            Reviews
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('anime/top') }}">
                            <i class="fa fa-fire text-orange"></i> Top Anime
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('anime/random') }}">
                            <i class="fa fa-random fa-fw text-dark-pink"></i> Random Anime
                        </a>
                    </li>
                    <div class="btn-group" role="group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Classification <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($classifications as $classification)
                                    <li>
                                        <a href="{{ url('anime/classifications/' . $classification->id) }}">
                                            {{ $classification->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="fa fa-tags fa-fw text-light-blue"></span>Genre <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($genres as $genre)
                                    <li>
                                        <a href="{{ url('anime/genres/' . $genre->id) }}">
                                            {{ $genre->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Producer <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($producers as $producer)
                                    <li>
                                        <a href="{{ url('anime/producers/' . $producer->id) }}">
                                            {{ $producer->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="fa fa-list-ul fa-fw text-purple"></span> Season <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($seasons as $season)
                                    <li>
                                        <a href="{{ url('anime/seasons/' . $season->id) }}">
                                            {{ $season->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Language <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('anime/subbed') }}">Subbed</a></li>
                                <li><a href="{{ url('anime/dubbed') }}">Dubbed</a></li>
                            </ul>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Type <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($types as $type)
                                    <li><a href="{{ url('anime/types/' . $type->id) }}">{{ $type->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <div class="pull-right">
                    <script type="text/javascript" src="http://www.evolvenation.com/delivery.js?id=15&size=728x90"></script>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="page-header">
            <h2 class="pull-left no-margin"><i class="fa fa-video-camera fa-fw text-success"></i> Anime List</h2>
        </div>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ url($currentURL . '/a') }}" class="btn btn-default">A</a>
                <a href="{{ url($currentURL . '/b') }}" class="btn btn-default">B</a>
                <a href="{{ url($currentURL . '/c') }}" class="btn btn-default">C</a>
                <a href="{{ url($currentURL . '/d') }}" class="btn btn-default">D</a>
                <a href="{{ url($currentURL . '/e') }}" class="btn btn-default">E</a>
                <a href="{{ url($currentURL . '/f') }}" class="btn btn-default">F</a>
                <a href="{{ url($currentURL . '/g') }}" class="btn btn-default">G</a>
                <a href="{{ url($currentURL . '/h') }}" class="btn btn-default">H</a>
                <a href="{{ url($currentURL . '/i') }}" class="btn btn-default">I</a>
                <a href="{{ url($currentURL . '/j') }}" class="btn btn-default">J</a>
                <a href="{{ url($currentURL . '/k') }}" class="btn btn-default">K</a>
                <a href="{{ url($currentURL . '/l') }}" class="btn btn-default">L</a>
                <a href="{{ url($currentURL . '/m') }}" class="btn btn-default">M</a>
                <a href="{{ url($currentURL . '/n') }}" class="btn btn-default">N</a>
                <a href="{{ url($currentURL . '/o') }}" class="btn btn-default">O</a>
                <a href="{{ url($currentURL . '/p') }}" class="btn btn-default">P</a>
                <a href="{{ url($currentURL . '/q') }}" class="btn btn-default">Q</a>
                <a href="{{ url($currentURL . '/r') }}" class="btn btn-default">R</a>
                <a href="{{ url($currentURL . '/s') }}" class="btn btn-default">S</a>
                <a href="{{ url($currentURL . '/t') }}" class="btn btn-default">T</a>
                <a href="{{ url($currentURL . '/u') }}" class="btn btn-default">U</a>
                <a href="{{ url($currentURL . '/v') }}" class="btn btn-default">V</a>
                <a href="{{ url($currentURL . '/w') }}" class="btn btn-default">W</a>
                <a href="{{ url($currentURL . '/x') }}" class="btn btn-default">X</a>
                <a href="{{ url($currentURL . '/y') }}" class="btn btn-default">Y</a>
                <a href="{{ url($currentURL . '/z') }}" class="btn btn-default">Z</a>
                <a href="{{ url($currentURL . '/0-9') }}" class="btn btn-default">0-9</a>
            </div>
        </div>
        <div class="row">
            @foreach ($animes as $anime)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a class="thumbnail" href="{{ url('watch/' . $anime->slug) }}">
                        <img src="{{ $anime->photo ? asset($anime->photo) : 'https://placehold.it/150x250' }}"
                             alt="{{ $anime->title }}">
                        <h3 class="episode-title">{{ (strlen($anime->title) > 12) ?
                            mb_substr($anime->title, 0, 9) . '...' : $anime->title }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-xs-12">
                {!! $animes !!}
            </div>
        </div>
    </div>
</div>
@endsection