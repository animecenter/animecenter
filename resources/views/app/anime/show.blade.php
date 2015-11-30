@extends('app.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="media anime-media">
                <div class="anime-background" style="background:
                    url({{ asset($anime->photo ? $anime->photo : 'https://placehold.it/225x350') }}) no-repeat no-repeat 50% 35%;
                    background-size: cover;">
                </div>
                <div class="media-left">
                    <img src="{{ asset($anime->photo ? $anime->photo : 'https://placehold.it/225x350') }}">
                </div>
                <div class="media-body">
                    <h1>{{ $anime->title }}</h1>
                    <p class="text-white">
                        <span class="text-success">Type: </span>
                        @if ($anime->type)
                            <a href="{{ url('anime?type=' . $anime->type->id) }}">{{ $anime->type->name }}</a>
                        @else
                            Unknown
                        @endif
                    </p>
                    <p class="text-white">
                        <span class="text-success">Episodes: </span>
                        {{ $anime->number_of_episodes }}
                    </p>
                    <p class="text-white">
                        <span class="text-success">Status: </span>{{ $anime->status }}
                    </p>
                    <p class="text-white">
                        <span class="text-success">Aired: </span>
                        {{ ($anime->release_date) ? ($anime->release_date . ' to ' .
                        ($anime->end_date ? $anime->end_date : '?')) : 'Unknown' }}
                    </p>
                    <p class="text-white">
                        <span class="text-success">Producers: </span>
                        @foreach ($anime->producers as $key => $producer)
                            <a href="{{ url('anime?producer=' . $producer->id) }}">
                            {{ $producer->name . ($key < $producersCount ? ',' : '') }}
                            </a>
                        @endforeach
                    </p>
                    <p class="text-white">
                        <span class="text-success">Genres: </span>
                        @foreach ($anime->genres as $genre)
                            {{ $genre->name }}
                        @endforeach
                    </p>
                    <p class="text-white">
                        <span class="text-success">Duration: </span>{{ $anime->duration }}
                    </p>
                    <p class="text-white">
                        <span class="text-success">Rating: </span>
                        @if ($anime->classification)
                            <a href="{{ url('anime?classification=' . $anime->classification->id) }}">
                                {{ $anime->classification->name }}
                            </a>
                        @else
                            Unknown
                        @endif
                    </p>
                </div>
                <p class="text-white">
                    <span class="text-success">Synopsis: </span>{{ $anime->synopsis }}
                </p>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="anime-footer">
                <div class="row">
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
                    <div class="col-xs-12 col-md-3 col-md-offset-3">
                        <i class="fa fa-eye-open fa-fw text-success"></i>
                        <span class="text-white"> Views 13,345 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 episode-list">
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
                    @foreach ($anime['episodes'] as $episode)
                        <tr>
                            <td>
                                Episode {{ $episode->number }}
                            </td>
                            <td>
                                @if (!$episode->mirrors->isEmpty())
                                    <a href="{{ url($anime->slug . '/episode/' . $episode->number . '/subbed/' . $episode->mirrors->first()->id) }}" class="label label-success">Subbed</a>
                                @if (empty($episode->mirrors->where('translation', 'subbed')))
                                <button class="label label-purple" type="button">Dubbed</button>
                                @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection