@extends('app.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <h2>{{ $animes->count() . " series found for " . $query }}</h2>
            @foreach ($animes as $anime)
                <div class="media media-search">
                    <a href="{{ url($anime->slug) }}" class="media-left">
                        <img src="{{ asset($anime->photo ? $anime->photo : 'https://placehold.it/225x350') }}"
                             class="media-object" width="52" height="52">
                    </a>
                    <div class="media-body">
                        <h2 class="media-heading">
                            <a href="{{ url($anime->slug) }}">{{ $anime->title }}</a>
                        </h2>
                        <p>
                            @foreach ($anime->genres as $genre)
                                <a href="{{ url('anime?genres=' . $genre->id) }}">{{ $genre->name }}</a>
                            @endforeach
                        </p>
                        <p>{{ $anime->synopsis }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
