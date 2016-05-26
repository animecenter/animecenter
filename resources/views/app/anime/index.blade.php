@extends('app.layouts.main')

@section('content')
    <div class="row">
        {{--<div class="col-xs-12">
            <script src="http://www.evolvenation.com/delivery.js?id=15&size=728x90"></script>
        </div>--}}
        <div class="col-xs-12">
            <div class="anime-list-header">
                <h2 class="pull-xs-left"><i class="fa fa-video-camera fa-fw"></i> Anime</h2>
                <div class="btn-group sort-by pull-xs-right" role="group">
                    <button type="button" class="btn bg-dark-purple text-white bg-dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-sort-amount-asc text-white"></i> Sort By <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown" role="menu" data-id="sortBy">
                        <li><a href="#" data-value="upcoming">Upcoming</a></li>
                        <li><a href="#" data-value="latest">Latest</a></li>
                    </ul>
                </div>
            </div>
            <div class="anime-tabs" data-example-id="togglable-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item alphabetical">
                        <a href="#alphabetical" class="nav-link active" id="alphabetical-tab" role="tab" data-toggle="tab"
                           aria-controls="alphabetical" aria-expanded="true">
                            <i class="fa fa-sort-alpha-asc text-success"></i> Alphabetical <span class="caret"></span>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item genre">
                        <a href="#genre" class="nav-link" role="tab" id="genre-tab" data-toggle="tab"
                           aria-controls="genre" aria-expanded="false">
                            <i class="fa fa-tags fa-fw text-light-blue"></i> Genre <span class="caret"></span>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item language">
                        <a href="#language" class="nav-link" role="tab" id="language-tab" data-toggle="tab"
                           aria-controls="language" aria-expanded="false">
                            <i class="fa fa-language text-orange"></i> Language <span class="caret"></span>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item season">
                        <a href="#season" class="nav-link" role="tab" id="season-tab" data-toggle="tab"
                           aria-controls="language" aria-expanded="false">
                            <i class="fa fa-google-wallet text-primary"></i> Season <span class="caret"></span>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item type">
                        <a href="#type" class="nav-link" role="tab" id="type-tab" data-toggle="tab"
                           aria-controls="type" aria-expanded="false">
                            <i class="fa fa-exclamation text-purple"></i> Type <span class="caret"></span>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item year">
                        <a href="#year" class="nav-link" role="tab" id="year-tab" data-toggle="tab"
                           aria-controls="year" aria-expanded="false">
                            <i class="fa fa-calendar text-yellow"></i> Year <span class="caret"></span>
                        </a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="alphabetical" aria-labelledby="alphabetical-tab">
                        <ul class="filter-submenu alphabetical" data-id="alphabetical">
                            <li><a href="#" data-value="a">a</a></li>
                            <li><a href="#" data-value="b">b</a></li>
                            <li><a href="#" data-value="c">c</a></li>
                            <li><a href="#" data-value="d">d</a></li>
                            <li><a href="#" data-value="e">e</a></li>
                            <li><a href="#" data-value="f">f</a></li>
                            <li><a href="#" data-value="g">g</a></li>
                            <li><a href="#" data-value="h">h</a></li>
                            <li><a href="#" data-value="i">i</a></li>
                            <li><a href="#" data-value="j">j</a></li>
                            <li><a href="#" data-value="k">k</a></li>
                            <li><a href="#" data-value="l">l</a></li>
                            <li><a href="#" data-value="m">m</a></li>
                            <li><a href="#" data-value="n">n</a></li>
                            <li><a href="#" data-value="o">o</a></li>
                            <li><a href="#" data-value="p">p</a></li>
                            <li><a href="#" data-value="q">q</a></li>
                            <li><a href="#" data-value="r">r</a></li>
                            <li><a href="#" data-value="s">s</a></li>
                            <li><a href="#" data-value="t">t</a></li>
                            <li><a href="#" data-value="u">u</a></li>
                            <li><a href="#" data-value="v">v</a></li>
                            <li><a href="#" data-value="w">w</a></li>
                            <li><a href="#" data-value="x">x</a></li>
                            <li><a href="#" data-value="y">y</a></li>
                            <li><a href="#" data-value="z">z</a></li>
                            <li><a href="#" data-value="#">#</a></li>
                            <li><a href="#" data-value="all">View All</a></li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="genre" aria-labelledby="genre-tab">
                        <ul class="filter-submenu genres" data-id="genres">
                            @foreach ($genres as $genre)
                                <li><a href="#" data-value="{{ $genre->id }}">{{ $genre->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="language" aria-labelledby="language-tab">
                        <ul class="filter-submenu language" data-id="language">
                            <li><a href="#" data-value="subbed">Subbed</a></li>
                            <li><a href="#" data-value="dubbed">Dubbed</a></li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="season" aria-labelledby="season-tab">
                        <ul class="filter-submenu season" data-id="season">
                            <li>
                                <a href="#" data-value="Winter"><i class="fa fa-asterisk text-light-blue"></i> Winter</a>
                            </li>
                            <li>
                                <a href="#" data-value="Spring"><i class="fa fa-tree text-success"></i> Spring</a>
                            </li>
                            <li>
                                <a href="#" data-value="Summer"><i class="fa fa-sun-o text-orange"></i> Summer</a>
                            </li>
                            <li>
                                <a href="#" data-value="Fall"><i class="fa fa-leaf text-danger"></i> Fall</a>
                            </li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="type" aria-labelledby="type-tab">
                        <ul class="filter-submenu type" data-id="type">
                            <li><a href="#" data-value="8"><i class="fa fa-television text-purple"></i> TV</a></li>
                            <li><a href="#" data-value="5"><i class="fa fa-diamond text-purple"></i> OVA</a></li>
                            <li><a href="#" data-value="2"><i class="fa fa-film text-purple"></i> Movie</a></li>
                            <li><a href="#" data-value="1"><i class="fa fa-bookmark text-purple"></i> Special</a></li>
                            <li><a href="#" data-value="26"><i class="fa fa-gg-circle text-purple"></i> ONA</a></li>
                            <li><a href="#" data-value="125"><i class="fa fa-music text-purple"></i> Music</a></li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="year" aria-labelledby="year-tab">
                        <ul class="ul" data-id="year">
                            @foreach ($years as $year)
                                <li class="li">
                                    <a class="text-dark-purple" href="#" data-value="{{ $year['year'] }}">{{ $year['year'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="producer" aria-labelledby="producer-tab">
                        <ul data-id="producer">
                            @foreach ($producers as $producer)
                                <li><a href="#" data-value="{{ $producer->id }}">{{ $producer->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="classification" aria-labelledby="classification-tab">
                        <ul data-id="classification">
                            @foreach ($classifications as $classification)
                                <li><a href="#" data-value="{{ $classification->id }}">{{ $classification->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="anime">
                @foreach ($animes as $anime)
                    <div class="anime-item">
                        <a class="anime__holder thumbnail" href="{{ url($anime->slug) }}">
                            <img src="{{ $anime->photo }}" class="img-fluid" alt="{{ $anime->title }}" width="160" height="225">
                            <div class="caption">
                                <h3 class="anime__title">
                                    {{ (strlen($anime->title) > 17) ? mb_substr($anime->title, 0, 14) . '...' :
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
