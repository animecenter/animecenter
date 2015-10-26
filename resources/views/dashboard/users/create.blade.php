@extends('dashboard.layouts.main')

@section('title')
    Create a user
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
                    <form role="form" method="post" action="{{ url('dashboard/users/create') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password Confirmation">
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="active" value="1" {{ old('active') === '1' ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/users') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection