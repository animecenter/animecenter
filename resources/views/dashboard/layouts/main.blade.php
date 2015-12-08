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
                    <h1 {{ request()->segment(2) && request()->segment(2) !== 'mirror-reports' ?
                        'class=pull-left' : '' }}>
                        @yield('title')
                    </h1>
                    @if (request()->segment(2) && request()->segment(2) !== 'mirror-reports')
                        <a href="{{ url('dashboard/' . request()->segment(2) . '/create') }}" class="btn btn-success">
                            Add New
                        </a>
                    @endif
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
