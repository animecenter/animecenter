<!DOCTYPE html>
<html lang="en">
<head>
    @include('app.layouts.head')
</head>
<body>
    <div id="wrapper">
        @include('app.layouts.sidebar')
        <div class="main">
            <div class="container-fluid">
                @yield('content')
                @include('app.layouts.footer')
            </div>
        </div>
    </div>
    @include('app.layouts.scripts')
</body>
</html>
