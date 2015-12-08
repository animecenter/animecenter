<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>AC</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>AnimeCenter</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ $user['username'] }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <ul class="user-footer">
                            <a href="{{ url('/') }}" class="btn btn-default btn-flat">Home</a>
                            <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                        </ul>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
