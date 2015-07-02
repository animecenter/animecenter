@include("layouts.head")
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="left_content">
            <div id="sec3" class="sections">
                <div class="title">Latest Anime Series added to site</div>
                @foreach ($animes as $anime)
                    <a href="{{ url(($anime['type2'] == "dubbed") ?
                    $options[3]['value'] . $anime['slug'] :
                    $options[2]['value'] . $anime['slug']) }}">
                        <div class="block">
                            <div class="img">
                                <img src="{{ asset('images/' . $anime['image']) }}">
                            </div>
                            <div class="main_title">
                                {{ (strlen($anime['title']) < 13) ?
                                $anime['title'] : substr($anime['title'],
                                0, 13) . "..." }}
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
        @include('layouts.footer')