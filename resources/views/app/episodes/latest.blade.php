@extends('app.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h2>New Anime Episodes</h2>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="grid-episode">
                <div class="grid-sizer"></div>
                @foreach ($episodes as $episode)
                    <div class="grid-item">
                        <a href="{{ url($episode->anime->slug . '/' . $episode->slug . '/' . $episode->mirror->translation) }}" class="thumbnail">
                            <img src="{{ asset($episode->photo) }}" alt="{{ $episode->title }}" width="300" height="150">
                            <div class="caption">
                                <h3 class="episode-title">
                                    {{ $episode->shortTitle . ' ' . $episode->number }}
                                </h3>
                                <p class="time-release">20 minutes ago</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {!! $episodes->render() !!}
        </div>
    </div>
@endsection