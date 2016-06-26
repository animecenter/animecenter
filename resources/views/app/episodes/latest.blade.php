@extends('app.layouts.main')

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-9">
        <h2 class="heading h4 text-dark-purple">New Anime Episodes</h2>
        <div class="episodes">
              @foreach ($episodes as $episode)
              <article class="episode-item container-shadow">
                        <a class="episodes__holder" href="{{ url($episode->anime->slug . '/' . $episode->slug . '/' . $episode->mirror->slug) }}" class="thumbnail">
                            <img class="img-fluid" src="{{ asset($episode->photo) }}" alt="{{ $episode->title }}" width="300" height="150">
                            <h1 class="episodes__title h5">{{ $episode->shortTitle }}</h1>
                            <span class="episode__number h6">Episode {{ $episode->number }}</span>
                            <span class="episode__details bg-purple h6">subbed</span>
                            <span class="episode__details bg-orange h6">HD</span>
                            <span class="episode__time h6">20 minutes ago</span>
                        </a>
                    </article>
                @endforeach
                {!! $episodes->render() !!}
            </div>
        </div>
@endsection
