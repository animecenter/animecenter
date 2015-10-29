@extends('dashboard.layouts.main')

@section('title')
    Edit mirror reports
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
                    <form role="form" method="post" action="{{ url('dashboard/mirror-reports/edit/' . $mirrorReport->id) }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <p><strong>Username: </strong>{{ $mirrorReport->username }}</p>
                        </div>
                        <div class="form-group">
                            <p>
                                <strong>URL: </strong>
                                <a href="{{ url($mirrorReport->url) }}" target="_blank">{{ $mirrorReport->url }}</a>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Verified:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="verified" value="1" {{
                                    old('verified') === '1' || $mirrorReport->verified === 1 ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Broken:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="broken" value="1" {{
                                    old('broken') === '1' || $mirrorReport->broken === 1 ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="active" value="1" {{
                                    old('active') === '1' || $mirrorReport->active === 1 ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/mirror-reports') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection