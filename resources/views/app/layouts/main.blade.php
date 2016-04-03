<!DOCTYPE html>
<html lang="en">
<head>
    @include('app.layouts.head')
</head>
<body>
    @include('app.layouts.sidebar')
    <main class="main">
        <div class="container">
            @yield('content')
        </div>
    </main>
    @include('app.layouts.footer')
    @include('app.layouts.scripts')
</body>
</html>
