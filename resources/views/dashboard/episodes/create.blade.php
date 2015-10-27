@extends('dashboard.layouts.main')

@section('title')
    Create a episode
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
                    <form role="form" method="post" action="{{ url('dashboard/episodes/create') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <select name="anime_id">
                                @foreach ($animes as $anime)
                                    <option value="{{ $anime->id }}" {{ $anime->id === old('anime_id') ? 'checked' : ''
                                     }}>{{ $anime->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Episode Number</label>
                            <input type="number" class="form-control" name="number" value="{{ old('number') }}" placeholder="Episode Number">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Synopsis</label>
                            <textarea name="synopsis" cols="30" rows="10" placeholder="Synopsis">{{ old('slug') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="active" value="1" {{ old('active') === '1' ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/episodes') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection