@include('layouts.index')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="title">Sorry, the page you have requested cannot be found.</div>
        <div class="content">
            <div>
                <img src="{{ asset('imgs/404img.jpg') }}">
                Why? The URL for this Episode/Anime/Page has been changed. Go to our
                <a href="{{ url('anime-list') }}">Subbed Anime list</a> or
                <a href="{{ url('anime-list-dubbed') }}">
                    Dubbed Anime list</a> depending on your preference and look for your anime show new URL or go
                visit our <a href="{{ url('/') }}">Homepage</a> to find the latest anime episodes.
            </div>
        </div>
    </div>
@endsection