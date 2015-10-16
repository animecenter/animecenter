@extends('app.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                {{ $animes->count() . " series found for " . $query }}
            </h2>
        </div>
        <div class="col-xs-12">
            <ul>
                @foreach ($animes as $anime)
                    <li>
                        <a href="{{ url($anime->slug) }}">{{ $anime->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection