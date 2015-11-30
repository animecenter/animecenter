@extends('app.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <h2>{{ $animes->count() . " series found for " . $query }}</h2>
        </div>
        
        <div class="col-xs-12 col-sm-8">
            @foreach ($animes as $anime)
                <div class="col-xs-12 anime-search">

                    <div class="media-search">
                        <img src="{{ asset($anime->photo ? $anime->photo : 'https://placehold.it/225x350') }}">
                    </div>
                    <div class="title-search">
                        <a href="{{ url($anime->slug) }}">{{ $anime->title }}</a>
                    </div>
                    <div>
                        @foreach ($anime->genres as $genre)
                            {{ $genre->name }}
                        @endforeach
                    </div>
                    <div class="description-search">
                        {{ $anime->synopsis }}
                    </div>

                </div>
            @endforeach
        </div>
       
        <div class="col-xs-12 col-sm-4">
            <div class="widget" id="facebook">
                <div class="fb-page" data-href="https://www.facebook.com/Animecentertv" data-width="100%"
                    data-height="258" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/Animecentertv">
                            <a href="https://www.facebook.com/Animecentertv">Animecenter.TV Network</a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!--/facebook-->
            <div>
                <script src="http://www.evolvenation.com/delivery.js?id=15&size=300x250"></script>
            </div>
            <div class="chat">
                <script id="cid0020000097531107619" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js">
                    {
                        "handle": "animecenterco", "arch": "js", "styles": {
                            "a": "00AE45", "b": 100, "c": "FFFFFF", "d": "FFFFFF", "k": "00AE45", "l": "00AE45",
                            "m": "00AE45", "n": "FFFFFF", "p": "10.35", "q": "00AE45", "r": 100, "t": 0, "surl": 0,
                            "allowpm": 0, "fwtickm": 1
                        }
                    }
                </script>
            </div>
        </div>
    </div>
@endsection