<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
    <div id="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            <div class="container-fluid">
                @yield('content')
            </div>
        @include('layouts.footer')
    </div>
    @include('layouts.scripts')
</body>
</html>
