@extends('layouts.index')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h1 class="page-header">
                <i class="fa fa-fire text-orange"></i> Hot Anime
                <button style="float:right;margin-left:5px;"type="button" class="btn btn-warning btn-circle">
                    <i class="fa fa-th"></i>
                </button>
                <button style="margin-left:5px;float:right;" type="button" class="btn btn-warning btn-circle">
                    <i class="fa fa-list"></i>
                </button>
            </h1>
            <div class="row">

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