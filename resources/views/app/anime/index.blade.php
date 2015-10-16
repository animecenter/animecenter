@extends('app.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <script src="http://www.evolvenation.com/delivery.js?id=15&size=728x90"></script>
        </div>
        <div class="col-xs-12">
            <div class="page-header">
                <h2 class="pull-left no-margin"><i class="fa fa-video-camera fa-fw text-success"></i> Anime List</h2>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group" role="group">
                    {{--<li><a href="#"><i class="fa fa-star fa-fw text-yellow"></i>Favorites</a></li>
                    <li><a href="#"><i class="fa fa-heart fa-fw text-danger"></i>Recommendations</a></li>
                    <li><a href="#"><i class="fa fa-check fa-fw text-success"></i> New Episodes</a></li>
                    <li><a href="#"><i class="fa fa-edit fa-fw text-pink"></i>Reviews</a></li>--}}
                    <div class="btn-group letter" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Letter <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" data-id="letter">
                            <li><a href="#" class="btn btn-default" data-value="a">a</a></li>
                            <li><a href="#" class="btn btn-default" data-value="b">b</a></li>
                            <li><a href="#" class="btn btn-default" data-value="c">c</a></li>
                            <li><a href="#" class="btn btn-default" data-value="d">d</a></li>
                            <li><a href="#" class="btn btn-default" data-value="e">e</a></li>
                            <li><a href="#" class="btn btn-default" data-value="f">f</a></li>
                            <li><a href="#" class="btn btn-default" data-value="g">g</a></li>
                            <li><a href="#" class="btn btn-default" data-value="h">h</a></li>
                            <li><a href="#" class="btn btn-default" data-value="i">i</a></li>
                            <li><a href="#" class="btn btn-default" data-value="j">j</a></li>
                            <li><a href="#" class="btn btn-default" data-value="k">k</a></li>
                            <li><a href="#" class="btn btn-default" data-value="l">l</a></li>
                            <li><a href="#" class="btn btn-default" data-value="m">m</a></li>
                            <li><a href="#" class="btn btn-default" data-value="n">n</a></li>
                            <li><a href="#" class="btn btn-default" data-value="o">o</a></li>
                            <li><a href="#" class="btn btn-default" data-value="p">p</a></li>
                            <li><a href="#" class="btn btn-default" data-value="q">q</a></li>
                            <li><a href="#" class="btn btn-default" data-value="r">r</a></li>
                            <li><a href="#" class="btn btn-default" data-value="s">s</a></li>
                            <li><a href="#" class="btn btn-default" data-value="t">t</a></li>
                            <li><a href="#" class="btn btn-default" data-value="u">u</a></li>
                            <li><a href="#" class="btn btn-default" data-value="v">v</a></li>
                            <li><a href="#" class="btn btn-default" data-value="w">w</a></li>
                            <li><a href="#" class="btn btn-default" data-value="x">x</a></li>
                            <li><a href="#" class="btn btn-default" data-value="y">y</a></li>
                            <li><a href="#" class="btn btn-default" data-value="z">z</a></li>
                            <li><a href="#" class="btn btn-default" data-value="0-9">0-9</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Language <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="language">
                            <li><a href="#" data-value="subbed">Subbed</a></li>
                            <li><a href="#" data-value="dubbed">Dubbed</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Type <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="type">
                            @foreach ($types as $type)
                                <li><a href="#" data-value="{{ $type->id }}">{{ $type->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-list-ul fa-fw text-purple"></span> Season <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="season">
                            @foreach ($seasons as $season)
                                <li><a href="#" data-value="{{ $season->id }}">{{ $season->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-list-ul fa-fw text-purple"></span> Year <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="year">
                            @foreach ($seasons as $season)
                                <li><a href="#" data-value="{{ $season->id }}">{{ $season->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-tags fa-fw text-light-blue"></span>Genre <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="genres">
                            @foreach ($genres as $genre)
                                <li><a href="#" data-value="{{ $genre->id }}">{{ $genre->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group sort-by" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Sort By <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="sortBy">
                            <li><a href="#" data-value="upcoming"><span class="fa fa-clock-o fa-fw text-light-blue"></span> Upcoming</a></li>
                            <li><a href="#" data-value="latest">Latest</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Producer <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="producer">
                            @foreach ($producers as $producer)
                                <li><a href="#" data-value="{{ $producer->id }}">{{ $producer->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Classification <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" data-id="classification">
                            @foreach ($classifications as $classification)
                                <li><a href="#" data-value="{{ $classification->id }}">{{ $classification->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ url('anime/random') }}" class="btn btn-default">
                        <i class="fa fa-random fa-fw text-dark-pink"></i> Random
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="grid grid-anime">
                @foreach ($animes as $anime)
                    <div class="grid-item">
                        <a class="thumbnail" href="{{ url($anime->slug) }}">
                            <img src="{{ $anime->photo }}" alt="{{ $anime->title }}" width="150" height="250">
                            <div class="caption">
                                <h3 class="episode-title">
                                    {{ (strlen($anime->title) > 18) ? mb_substr($anime->title, 0, 15) . '...' :
                                    $anime->title }}
                                </h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12">
            {!! $animes->appends($query)->render() !!}
        </div>
    </div>
@endsection