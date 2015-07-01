@include("layouts.head")
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="left_content">
            <div id="sec3" class="sections">
                <div class="title">Watch Anime Online / Dubbed Browse A-Z</div>
                <div class="filtering">
                    <a href="{{ url('browse_a-z-subbed/0-9') }}">0-9</a>
                    <a href="{{ url('browse_a-z-subbed/a') }}">A</a>
                    <a href="{{ url('browse_a-z-subbed/b') }}">B</a>
                    <a href="{{ url('browse_a-z-subbed/c') }}">C</a>
                    <a href="{{ url('browse_a-z-subbed/d') }}">D</a>
                    <a href="{{ url('browse_a-z-subbed/e') }}">E</a>
                    <a href="{{ url('browse_a-z-subbed/f') }}">F</a>
                    <a href="{{ url('browse_a-z-subbed/g') }}">G</a>
                    <a href="{{ url('browse_a-z-subbed/h') }}">H</a>
                    <a href="{{ url('browse_a-z-subbed/i') }}">I</a>
                    <a href="{{ url('browse_a-z-subbed/j') }}">J</a>
                    <a href="{{ url('browse_a-z-subbed/k') }}">K</a>
                    <a href="{{ url('browse_a-z-subbed/l') }}">L</a>
                    <a href="{{ url('browse_a-z-subbed/m') }}">M</a>
                    <a href="{{ url('browse_a-z-subbed/n') }}">N</a>
                    <a href="{{ url('browse_a-z-subbed/o') }}">O</a>
                    <a href="{{ url('browse_a-z-subbed/p') }}">P</a>
                    <a href="{{ url('browse_a-z-subbed/q') }}">Q</a>
                    <a href="{{ url('browse_a-z-subbed/r') }}">R</a>
                    <a href="{{ url('browse_a-z-subbed/s') }}">S</a>
                    <a href="{{ url('browse_a-z-subbed/t') }}">T</a>
                    <a href="{{ url('browse_a-z-subbed/u') }}">U</a>
                    <a href="{{ url('browse_a-z-subbed/v') }}">V</a>
                    <a href="{{ url('browse_a-z-subbed/w') }}">W</a>
                    <a href="{{ url('browse_a-z-subbed/x') }}">X</a>
                    <a href="{{ url('browse_a-z-subbed/y') }}">Y</a>
                    <a href="{{ url('browse_a-z-subbed/z') }}">Z</a>
                </div>
                @foreach($animes as $anime)
                    <a href="{{ url($options[2]['value'] . $anime['slug']) }}">
                        <div class="block">
                            <div class="img">
                                <img src="{{ asset('images/' . $anime['image']) }}">
                            </div>
                            <div class="main_title">
                                <?php echo(strlen($anime['title']) < 10) ? $anime['title'] :
                                        substr($anime['title'], 0, 10) . "..."; ?>
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