<!DOCTYPE html>
<html lang="en">
    <head>
        @include('dashboard.layouts.head')
    </head>
    <body class="sidebar-mini skin-green fixed">
        <div class="wrapper">
            @include('dashboard.layouts.header')
            @include('dashboard.layouts.sidebar')
            <main class="content-wrapper">
                <section class="content-header">
                    <h1>@yield('title')</h1>
                </section>
                <section class="content">
                    @yield('content')
                </section>
            </main>
            @include('dashboard.layouts.footer')
        </div>
        @include('dashboard.layouts.scripts')
    </body>
</html>