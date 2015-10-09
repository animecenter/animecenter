@include('layouts.index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">Sorry, the page you have requested cannot be found.</h2>
        </div>
        <div class="col-xs-12">
            <img src="{{ asset('img/404img.jpg') }}">
            <p>
                Why? The URL for this Episode/Anime/Page has been changed. You can go to our
                <a href="{{ url('anime/subbed') }}">Subbed Anime list</a> or
                <a href="{{ url('anime/dubbed') }}">Dubbed Anime list</a>
                depending on your preference and look for your anime show new URL or go
                visit our <a href="{{ url('/') }}">Homepage</a>.
            </p>
        </div>
    </div>
@endsection