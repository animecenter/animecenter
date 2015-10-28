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
                    <h1 class="pull-left">@yield('title')</h1>
                    <a href="{{ url('dashboard/' . request()->segment(2) . '/create') }}" class="btn btn-success">
                        Add New
                    </a>
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