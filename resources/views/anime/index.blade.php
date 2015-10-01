@extends('layouts.index')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h1 class="page-header">
                <i class="fa fa-video-camera fa-fw text-success"></i> Anime List
                <button type="button" class="btn btn-success btn-circle menu-filter">
                    <i class="fa fa-th"></i>
                </button>
                <button type="button" class="btn btn-success btn-circle menu-filter">
                    <i class="fa fa-list"></i>
                </button>
                <div class="btn-group menu-filter">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        All Types <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Series</a></li>
                        <li><a href="#">Movies</a></li>
                        <li><a href="#">OVA</a></li>
                        <li><a href="#">Special</a></li>
                    </ul>
                </div>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-default">A</a>
                            <a class="btn btn-default">B</a>
                            <a class="btn btn-default">C</a>
                            <a class="btn btn-default">D</a>
                            <a class="btn btn-default">E</a>
                            <a class="btn btn-default">F</a>
                            <a class="btn btn-default">G</a>
                            <a class="btn btn-default">H</a>
                            <a class="btn btn-default">I</a>
                            <a class="btn btn-default">J</a>
                            <a class="btn btn-default">K</a>
                            <a class="btn btn-default">L</a>
                            <a class="btn btn-default">M</a>
                            <a class="btn btn-default">N</a>
                            <a class="btn btn-default">O</a>
                            <a class="btn btn-default">P</a>
                            <a class="btn btn-default">Q</a>
                            <a class="btn btn-default">R</a>
                            <a class="btn btn-default">S</a>
                            <a class="btn btn-default">T</a>
                            <a class="btn btn-default">U</a>
                            <a class="btn btn-default">V</a>
                            <a class="btn btn-default">W</a>
                            <a class="btn btn-default">X</a>
                            <a class="btn btn-default">Y</a>
                            <a class="btn btn-default">Z</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/73852.jpg">
                        <span class="anime-season-title">Gatchaman Crowds Insight</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/74683.jpg">
                        <span class="anime-season-title">
                            Charlotte cczxczxc xvxcvxcvxcvxcvcvxv dv dsvsvvxcvxcvxcvxcvxc
                        </span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/75104.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/75764.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/74415.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/74929.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/75106.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/72943.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/69455.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/72775.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/73588.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="thumbnail" href="#">
                        <img alt="" src="public/img/anime/75082.jpg">
                        <span class="anime-season-title">God Eater!</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <ul class="pagination">
                        <li class="disabled"><a href="#">«</a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <h1 class="page-header">
                <i class="fa fa-thumbs-up fa-fw text-light-blue"></i> Like Us
            </h1>
            <img alt="Flower" src="public/img/facebookinner.png" style="width:315px;">
            <script src="http://www.evolvenation.com/delivery.js?id=15&size=300x250" type="text/javascript"></script>
        </div>
    </div>
</div>
@endsection