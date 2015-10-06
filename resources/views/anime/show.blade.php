@extends('layouts.index')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="row">
            <div class="media anime-background-2">
                <div class="media-left">
                    <img src="{{ asset($anime->photo ? $anime->photo : 'https://placehold.it/225x350') }}">
                </div>
                <div class="media-body">
                    <h1>{{ $anime->title }}</h1>
                    @if ($anime->type)
                    <div class="text-success">
                        Type:<span class="text-white"> {{ $anime->type->name }}</span>
                    </div>
                    @endif
                    <div class="text-success">
                        Episodes:<span class="text-white"> {{ $anime->episodes ? $anime->episodes : 'Unknown' }}</span>
                    </div>
                    <div class="text-success">
                        Status:<span class="text-white"> {{ $anime->status }}</span>
                    </div>
                    <div class="text-success">
                        Aired:<span class="text-white"> {{ ($anime->release_date) ?
                            ($anime->release_date . ' to ' . ($anime->end_date ? $anime->end_date : '?')) :
                        'Unknown' }}</span>
                    </div>
                    <div class="text-success">
                        Producers:
                        <span class="text-white">
                            @foreach ($anime->producers as $key => $producer)
                                <a href="{{ url('anime/producers/' . $producer->id) }}">
                                    {{ $producer->name . ($key < $producersCount ? ',' : '') }}
                                </a>
                            @endforeach
                        </span>
                    </div>
                    <div class="text-success">
                        Genres:
                        <span class="text-white">
                            @foreach ($anime->genres as $genre)
                                {{ $genre->name }}
                            @endforeach
                        </span>
                    </div>
                    <div class="text-success">
                        Duration:<span class="text-white"> {{ $anime->duration }}</span>
                    </div>
                    <div class="text-success">
                        Rating:<span class="text-white"> {{ $anime->classification->name }}</span>
                    </div>
                </div>
                <div class="text-success">
                    Synopsis:
                    <p class="text-white"> {{ $anime->synopsis }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 anime-footer">
                <div class="col-xs-12 col-md-3">
                    <a href="#">
                        <i class="fa fa-star fa-fw text-yellow"></i>
                        <i class="fa fa-star fa-fw text-yellow"></i>
                        <i class="fa fa-star fa-fw text-yellow"></i>
                        <i class="fa fa-star fa-fw text-yellow"></i>
                        <i class="fa fa-star fa-fw text-white"></i>
                    </a>
                </div>
                <div class="col-xs-12 col-md-3">
                    <i class="fa fa-facebook fa-fw text-success"></i>
                    <i class="fa fa-twitter fa-fw text-success"></i>
                    <i class="fa fa-google-plus fa-fw text-success"></i>
                    <i class="fa fa-reddit fa-fw text-success"></i>
                    <i class="fa fa-pinterest fa-fw text-success"></i>
                </div>
                <div class="col-xs-12 col-md-3"></div>
                <div class="col-xs-12 col-md-3">
                    <i class="fa fa-eye-open fa-fw text-success"></i>
                    <span class="text-white"> Views 13,345 </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="row">
            <div class="col-xs-12 col-md-8 episode-list">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <i class="fa fa-video-camera fa-fw text-success"></i> All Episodes
                        </th>
                        <th>
                            Subbed or Dubbed<i class="fa fa-question fa-fw text-success"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="active">
                        <td>
                            <i class="fa fa-video-camera fa-fw text-success"></i> Episode 1
                        </td>
                        <td>
                            <button class="label label-success" type="button">Subbed</button>
                            <button class="label label-purple" type="button">Dubbed</button>
                        </td>
                    </tr>
                    <tr class="success">
                        <td>
                            <i class="fa fa-video-camera fa-fw text-success"></i> Episode 2
                        </td>
                        <td>
                            <button class="label label-success" type="button">Subbed</button>
                            <button class="label label-purple" type="button">Dubbed</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-video-camera fa-fw text-success"></i> Episode 3
                        </td>
                        <td>
                            <button class="label label-success" type="button">Subbed</button>
                            <button class="label label-purple" type="button">Dubbed</button>
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>
                            <i class="fa fa-video-camera fa-fw text-success"></i> Episode 4
                        </td>
                        <td>
                            <button class="label label-success" type="button">Subbed</button>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-video-camera fa-fw text-success"></i> Episode 5
                        </td>
                        <td>
                            <button class="label label-success" type="button">Subbed</button>
                            <button class="label label-purple" type="button">Dubbed</button>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td>
                            <i class="fa fa-video-camera fa-fw text-success"></i> Episode 6
                        </td>
                        <td>
                            <button class="label label-success" type="button">Subbed</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection