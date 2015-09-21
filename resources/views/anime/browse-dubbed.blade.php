@include("layouts.head")
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="left_content">
            <div id="sec3" class="sections">
                <div class="title">Watch Anime Online / Dubbed Browse A-Z</div>
                <div class="filtering">
                    <a href="{{ url('browse_a-z-dubbed/0-9') }}">0-9</a>
                    <a href="{{ url('browse_a-z-dubbed/a') }}">A</a>
                    <a href="{{ url('browse_a-z-dubbed/b') }}">B</a>
                    <a href="{{ url('browse_a-z-dubbed/c') }}">C</a>
                    <a href="{{ url('browse_a-z-dubbed/d') }}">D</a>
                    <a href="{{ url('browse_a-z-dubbed/e') }}">E</a>
                    <a href="{{ url('browse_a-z-dubbed/f') }}">F</a>
                    <a href="{{ url('browse_a-z-dubbed/g') }}">G</a>
                    <a href="{{ url('browse_a-z-dubbed/h') }}">H</a>
                    <a href="{{ url('browse_a-z-dubbed/i') }}">I</a>
                    <a href="{{ url('browse_a-z-dubbed/j') }}">J</a>
                    <a href="{{ url('browse_a-z-dubbed/k') }}">K</a>
                    <a href="{{ url('browse_a-z-dubbed/l') }}">L</a>
                    <a href="{{ url('browse_a-z-dubbed/m') }}">M</a>
                    <a href="{{ url('browse_a-z-dubbed/n') }}">N</a>
                    <a href="{{ url('browse_a-z-dubbed/o') }}">O</a>
                    <a href="{{ url('browse_a-z-dubbed/p') }}">P</a>
                    <a href="{{ url('browse_a-z-dubbed/q') }}">Q</a>
                    <a href="{{ url('browse_a-z-dubbed/r') }}">R</a>
                    <a href="{{ url('browse_a-z-dubbed/s') }}">S</a>
                    <a href="{{ url('browse_a-z-dubbed/t') }}">T</a>
                    <a href="{{ url('browse_a-z-dubbed/u') }}">U</a>
                    <a href="{{ url('browse_a-z-dubbed/v') }}">V</a>
                    <a href="{{ url('browse_a-z-dubbed/w') }}">W</a>
                    <a href="{{ url('browse_a-z-dubbed/x') }}">X</a>
                    <a href="{{ url('browse_a-z-dubbed/y') }}">Y</a>
                    <a href="{{ url('browse_a-z-dubbed/z') }}">Z</a>
                </div>
                @foreach($animes as $anime)
                    <a href="{{ url($options[3]['value'] . $anime['slug']) }}">
                        <div class="block">
                            <div class="img">
                                <img src="{{ asset('images/' . $anime['image']) }}">
                            </div>
                            <div class="main_title">
                                {{ (strlen($anime['title']) < 10) ? $anime['title'] :
                                    substr($anime['title'], 0, 10) . "..." }}
                            </div>
                        </div>
                        <!--/block-->
                    </a>
                @endforeach
                <div class="pagination">
                    {!! $animes->render() !!}
                </div>
                <!-- End .pagination -->
            </div>
            <!--/sections-->

        </div>
        <!--/left_content-->
        <div id="right_content">
            @include("layouts.sidebar")
        </div>
        @include("layouts.footer")