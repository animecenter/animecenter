@extends('dashboard.layouts.main')

@section('title')
    Create a anime
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" method="post" action="{{ url('dashboard/animes/create') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>MAL ID</label>
                            <input type="number" class="form-control" name="mal_id" value="{{ old('mal_id') }}" placeholder="MAL ID">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label>Synopsis</label>
                            <textarea name="synopsis" cols="30" rows="10" placeholder="Synopsis">{{ old('synopsis') }}</textarea>
                        </div>
                        <div class="form-group">
                            <select name="type_id" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id === old('type_id') ?
                                        'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Number of Episodes</label>
                            <input type="number" class="form-control" name="number_of_episodes" value="{{ old('number_of_episodes') }}" placeholder="Number of Episodes">
                        </div>
                        <div class="form-group">
                            <select name="status_id" class="form-control">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $status->id === old('status_id') ?
                                        'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="release_date">Release Date</label>
                            <input type="date" class="form-control" name="release_date" value="{{ old('release_date') }}" placeholder="Release Date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" placeholder="End Date">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="time" class="form-control" name="duration" value="{{ old('duration') }}" placeholder="Duration">
                        </div>
                        <div class="form-group">
                            <select name="calendar_season_id" class="form-control">
                                @foreach ($calendarSeasons as $calendarSeason)
                                    <option value="{{ $calendarSeason->id }}" {{
                                        $calendarSeason->id === old('calendar_season_id') ?
                                        'selected' : '' }}>{{ $calendarSeason->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="classification_id" class="form-control">
                                @foreach ($classifications as $classification)
                                    <option value="{{ $classification->id }}" {{
                                        $classification->id === old('classification_id') ?
                                        'selected' : '' }}>{{ $classification->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="active" value="1" {{ old('active') === '1' ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/animes') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection