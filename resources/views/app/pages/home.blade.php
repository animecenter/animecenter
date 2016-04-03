@extends('app.layouts.main')

@section('content')
    <div class="row home">
        <div class="col-xs-12">
            <h2>New Anime Episodes</h2>
        </div>
        <div class="col-xs-12">
            <div class="episodes">
                @foreach ($episodes as $episode)
                    <article class="card episode-item">
                        <a href="{{ url($episode->anime->slug.'/'.$episode->slug.'/'.$episode->mirror->translation) }}">
                            <img src="{{ asset($episode->photo) }}" class="card-img-top img-fluid"
                                 alt="{{ $episode->title }}" height="150" width="auto">
                            <div class="card-block">
                                <h3 class="card-title h6">{{ $episode->shortTitle . ' ' . $episode->number }}</h3>
                                <p class="card-text">20 minutes ago</p>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12">
            <h2>Anime This Season</h2>
        </div>
        <div class="col-xs-12">
            <div class="grid grid-anime grid-home">
                @foreach ($animes as $anime)
                    <div class="grid-item">
                        <a href="{{ url($anime->slug) }}" class="thumbnail">
                            <img src="{{ asset($anime->photo) }}" alt="{{ $anime->title }}" width="125" height="185">
                            <div class="caption">
                                <h3 class="episode-title">
                                    {{ $anime->shortTitle }}
                                </h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
