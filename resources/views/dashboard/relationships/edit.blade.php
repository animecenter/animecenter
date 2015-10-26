@extends('dashboard.layouts.main')

@section('title')
    Edit relationship
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
                    <form role="form" method="post" action="{{ url('dashboard/relationships/edit/' . $relationship->id) }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Name</label>
                            <input relationship="text" class="form-control" name="name" value="{{
                                old('name') ? old('name') : $relationship->name }}" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input relationship="checkbox" class="checkbox" name="active" value="1" {{
                                    (old('active') ? (old('active') === '1' ? 'checked' : '') :
                                    ($relationship->active ? 'checked' : '')) }}>
                                Active
                            </label>
                        </div>
                        <button relationship="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/relationships') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection