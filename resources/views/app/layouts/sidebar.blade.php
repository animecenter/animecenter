<header class="sidebar">
    <nav class="navbar" role="navigation">
        <button type="button" class="navbar-toggler hidden-lg-up" data-toggle="collapse" data-target="#navbar">
            &#9776;
        </button>
        <a class="nav-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="animecenter.co" height="auto" width="220">
        </a>
        <div id="navbar" class="collapse navbar-toggleable-md pull-lg-left">
            <ul class="nav navbar-nav nav-sidebar">
                <li class="nav-item">
                    <form action="{{ url('search') }}">
                        <div class="search input-group">
                            <input class="form-control leaf" id="q" name="q" placeholder="search" type="text">
                            <span class="input-group-btn">
                                <button class="btn bg-dark-purple text-light-purple search-btn" type="button">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a href="{{ url('anime') }}" class="nav-link">
                        <i class="fa fa-video-camera fa-fw"></i>
                        Anime
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('episodes/latest') }}" class="nav-link">
                        <i class="fa fa-check fa-fw"></i>
                        New Episodes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('anime/random') }}" class="nav-link">
                        <i class="fa fa-random fa-fw"></i> Random
                    </a>
                </li>
                <li class="nav-item hidden">
                    <a href="https://mangacenter.co" class="nav-link">
                        <i class="fa fa-book fa-fw"></i>
                        Manga
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
