<header class="sidebar">
    <nav class="navbar navbar-light" role="navigation">
        <button type="button" class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#navbar">
            &#9776;
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="animecenter.co" height="auto" width="220">
        </a>
        <div id="navbar" class="collapse navbar-toggleable-xs pull-sm-left">
            <ul class="nav navbar-nav nav-sidebar">
                <li class="nav-item">
                    <form action="{{ url('search') }}">
                        <div class="input-group">
                            <input class="form-control" id="q" name="q" placeholder="search" type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a href="{{ url('anime') }}" class="nav-link">
                        <i class="fa fa-video-camera fa-fw text-success"></i>
                        Anime
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('episodes/latest') }}" class="nav-link">
                        <i class="fa fa-check fa-fw text-success"></i>
                        New Episodes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('anime/random') }}" class="nav-link">
                        <i class="fa fa-random fa-fw text-success"></i> Random
                    </a>
                </li>
                <li class="nav-item hidden">
                    <a href="https://mangacenter.co" class="nav-link">
                        <i class="fa fa-book fa-fw text-success"></i>
                        Manga
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
