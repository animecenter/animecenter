@extends('app.layouts.main')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <section class="anime" style="background: url( {{ asset($anime->photo ? $anime->photo : 'https://placehold.it/225x350') }} ) no-repeat no-repeat 30% 20%; background-size: cover;">
                <article class="anime__item">
                    <img src="{{ asset($anime->photo ? $anime->photo : 'https://placehold.it/225x350') }}" alt="" class="img-responsive anime__img">
                    <ul class="ul anime__hold">
                        <li class="anime__info"><h1 class="anime__title h1">{{ $anime->title }}</h1></li>
                        <li class="anime__info">Type: @if ($anime->type)<a href="{{ url('anime?type=' . $anime->type->id) }}">{{ $anime->type->name }}</a>@else Unknown @endif</li>
                        <li class="anime__info">Episodes: {{ $anime->number_of_episodes }}</li>
                        <li class="anime__info">Status: <a href="{{ url('anime?status=' . $anime->status->id) }}">{{ $anime->status->name }}</a></li>
                        <li class="anime__info">Aired: {{ ($anime->release_date) ? ($anime->release_date . ' to ' . ($anime->end_date ? $anime->end_date : '?')) : 'Unknown' }}</li>
                        <li class="anime__info">Genres: @foreach ($anime->genres as $key => $genre)<a href="{{ url('anime?genres=' . $genre->id) }}">{{ $genre->name . ($key < $genresCount ? ',' : '') }}</a>@endforeach</li>
                        <li class="anime__info">Producers: @foreach ($anime->producers as $key => $producer)<a href="{{ url('anime?producer=' . $producer->id) }}">{{ $producer->name . ($key < $producersCount ? ',' : '') }}</a>@endforeach</li>
                        <li class="anime__info">Duration: {{ $anime->duration }}</li>
                        <li class="anime__info">Rating: @if ($anime->classification) <a href="{{ url('anime?classification=' . $anime->classification->id) }}">{{ $anime->classification->name }}</a>@else Unknown @endif</li>
                        <li class="anime__info">Synopsis: {{ $anime->synopsis }}</li>
                    </ul>
                </article>
            <section>
        </div>
        <div class="col-xs-12">
            <div class="anime-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <a href="#">
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-white"></i>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 ">
                        <i class="fa fa-facebook text-purple"></i>
                        <i class="fa fa-twitter text-purple"></i>
                        <i class="fa fa-google-plus text-purple"></i>
                        <i class="fa fa-reddit text-purple"></i>
                        <i class="fa fa-pinterest text-purple"></i>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <span class="text-white"><i class="fa fa-eye fa-fw text-purple"></i> {{ $anime->views }} </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-8">
            <h2 class="heading color-dark-purple h4">All Episodes</h2>
            <ul class="episode-list">
            @foreach ($anime['episodes'] as $episode)
            @if (!$episode->mirrors->isEmpty())
                <li class="episode-list-holder"><a class="episode-list-item text-purple" href="{{ url($anime->slug . '/episode/' . $episode->number . '/subbed/' . $episode->mirrors->first()->id) }}">{{ $anime->title }} Episode {{ $episode->number }}</a></li>
            @endif
            @endforeach
            </ul>
        </div>
    </div>
@endsection
