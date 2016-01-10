<div class="sidebar">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="animecenter.co" height="auto" width="220">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    @if ($user)
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope fa-fw"></i>
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <a href="#">
                                        <div>
                                            <strong>John Smith</strong>
                                            <span class="pull-right text-muted"><em>Yesterday</em></span>
                                        </div>
                                        <div>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Pellentesque eleifend...
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div>
                                            <strong>John Smith</strong>
                                            <span class="pull-right text-muted"><em>Yesterday</em></span>
                                        </div>
                                        <div>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Pellentesque eleifend...
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="text-center" href="#">
                                        <strong>Read All Messages</strong> <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell fa-fw"></i>
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="#">
                                        <div>
                                            <i class="fa fa-comment fa-fw"></i> New Comment
                                            <span class="pull-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i>
                                            3 New Followers
                                            <span class="pull-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="text-center" href="#">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i>
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="{{ url('username') }}">
                                        <i class="fa fa-user fa-fw"></i> Username Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('username/settings') }}">
                                        <i class="fa fa-gear fa-fw"></i> Settings
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('logout') }}">
                                        <i class="fa fa-sign-out fa-fw"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="login">
                            <a href="{{ url('login') }}" class="btn btn-success">Login</a>
                        </li>
                        <li class="sign-up">
                            <a href="{{ url('sign-up') }}" class="btn btn-success">Sign up</a>
                        </li>
                    @endif
                    <li>
                        <form action="{{ url('search') }}" class="navbar-form search-form">
                            <div class="form-group">
                                <label class="sr-only" for="search">Search</label>
                                <div class="input-group">
                                    <input class="form-control" id="q" name="q" placeholder="search" type="text">
                                    <span class="fa fa-search form-control-feedback input-group-addon"></span>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>

                <ul id="side-menu" class="nav nav-sidebar">
                    <li>
                        <a href="{{ url('anime') }}">
                            <i class="fa fa-video-camera fa-fw text-success"></i>
                            Anime
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('episodes/latest') }}">
                            <i class="fa fa-check fa-fw text-success"></i>
                            New Episodes
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('anime/random') }}">
                            <i class="fa fa-random fa-fw text-success"></i> Random
                        </a>
                    </li>
                    <li>
                        <a href="https://mangacenter.co">
                            <i class="fa fa-book fa-fw text-success"></i>
                            Manga
                        </a>
                    </li>
                    <li class="text-center">
                        <i class="fa fa-money fa-fw text-success sidebar-money"></i><br>
                        <h3 class="text-dark center">Sponsorships</h3>
                        <div class="center">
                            <p class="text-success">Do you want to contribute?</p>
                            <button class="btn btn-success center" type="button">Learn more</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
