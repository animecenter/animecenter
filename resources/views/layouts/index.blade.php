<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
    <div id="wrapper">
        @include('layouts.navbar')
        <div class="container-fluid">
            <div class="row">
                @include('layouts.sidebar')
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </div>
    @include('layouts.scripts')
</body>
</html>
