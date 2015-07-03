<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css"/>
        <title>Admin Login</title>
    </head>
    <body>
        <div class="wrap">
            <h1>ACTV - V2</h1>
            <form action="{{ url('login') }}" method="post">
                {!! csrf_field() !!}
                <label>Username</label>
                <input type="text" name="username" value="" class="login_field"/>
                <label>Password</label>
                <input type="password" name="password" value="" class="login_field"/>
                <input type="submit" value="Login" class="login_btn"/>
            </form>
            @if($errors->has())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {!! $errors->first() !!}
                </div>
            @endif
        </div>
        <!--End Wrap-->
    </body>
</html>
