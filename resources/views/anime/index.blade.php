@extends('layouts.index')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="page-header">
                <h2 class="pull-left no-margin"><i class="fa fa-video-camera fa-fw text-success"></i> Anime List</h2>
                <div class="btn-toolbar pull-right no-margin" role="toolbar">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-th"></i>
                        </button>
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-list"></i>
                        </button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Select Type <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Series</a></li>
                            <li><a href="#">Movies</a></li>
                            <li><a href="#">OVA</a></li>
                            <li><a href="#">Special</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ url('anime/list/a') }}" class="btn btn-default">A</a>
                    <a href="{{ url('anime/list/b') }}" class="btn btn-default">B</a>
                    <a href="{{ url('anime/list/c') }}" class="btn btn-default">C</a>
                    <a href="{{ url('anime/list/d') }}" class="btn btn-default">D</a>
                    <a href="{{ url('anime/list/e') }}" class="btn btn-default">E</a>
                    <a href="{{ url('anime/list/f') }}" class="btn btn-default">F</a>
                    <a href="{{ url('anime/list/g') }}" class="btn btn-default">G</a>
                    <a href="{{ url('anime/list/h') }}" class="btn btn-default">H</a>
                    <a href="{{ url('anime/list/i') }}" class="btn btn-default">I</a>
                    <a href="{{ url('anime/list/j') }}" class="btn btn-default">J</a>
                    <a href="{{ url('anime/list/k') }}" class="btn btn-default">K</a>
                    <a href="{{ url('anime/list/l') }}" class="btn btn-default">L</a>
                    <a href="{{ url('anime/list/m') }}" class="btn btn-default">M</a>
                    <a href="{{ url('anime/list/n') }}" class="btn btn-default">N</a>
                    <a href="{{ url('anime/list/o') }}" class="btn btn-default">O</a>
                    <a href="{{ url('anime/list/p') }}" class="btn btn-default">P</a>
                    <a href="{{ url('anime/list/q') }}" class="btn btn-default">Q</a>
                    <a href="{{ url('anime/list/r') }}" class="btn btn-default">R</a>
                    <a href="{{ url('anime/list/s') }}" class="btn btn-default">S</a>
                    <a href="{{ url('anime/list/t') }}" class="btn btn-default">T</a>
                    <a href="{{ url('anime/list/u') }}" class="btn btn-default">U</a>
                    <a href="{{ url('anime/list/v') }}" class="btn btn-default">V</a>
                    <a href="{{ url('anime/list/w') }}" class="btn btn-default">W</a>
                    <a href="{{ url('anime/list/x') }}" class="btn btn-default">X</a>
                    <a href="{{ url('anime/list/y') }}" class="btn btn-default">Y</a>
                    <a href="{{ url('anime/list/z') }}" class="btn btn-default">Z</a>
                </div>
            </div>
            <div class="row">
                @foreach ($animes as $anime)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <a class="thumbnail" href="{{ url('anime/' . $anime->slug) }}">
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

        <div class="col-xs-12 col-md-4">
            <h2 class="page-header">
                <i class="fa fa-thumbs-up fa-fw text-light-blue"></i> Like Us
            </h2>
            <div class="widget" id="facebook">
                <div class="fb-page" data-href="https://www.facebook.com/Animecentertv" data-width="300" data-height="258"
                     data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"
                     data-show-posts="false">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/Animecentertv">
                            <a href="https://www.facebook.com/Animecentertv">Animecenter.TV Network</a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <script src="http://www.evolvenation.com/delivery.js?id=15&size=300x250" type="text/javascript"></script>
        </div>
    </div>
</div>
@endsection