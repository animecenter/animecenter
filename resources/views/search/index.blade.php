@include("layouts.head")
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="left_content">
            <div class="green_info">
                {{ $animes->count() . " series found for " . $query }}
            </div>
            <?php 
            foreach ($animes as $anime) {
                //Get Age Color
                switch ($anime['age']) {
                    case "Anyone":
                        $color = "#EE82EE";
                        break;
                    case "Teen +17":
                        $color = "#CC0033";
                        break;
                    case "Teen +18":
                        $color = "#FF0000";
                        break;
                    default:
                        $color = "#C86464";
                }
            ?>
            <div class="sections" id="series">
                <div class="series">
                    <a href="{{ url(($anime['type2'] == "dubbed") ?
                    $options[3]['value'] . $anime['slug'] :
                    $options[2]['value'] . $anime['slug']) }}">
                        <div class="main_title">
                            {{ $anime['title'] }}
                        </div>
                    </a>
                    <div class="content">
                        <div class="categories">
                            <a href="#" class="{{ $anime['type2'] }}">
                                English {{ $anime['type2'] }}
                            </a>
                        </div>
                        <a href="{{ url(($anime['type2'] == "dubbed") ?
                        $options[3]['value'] . $anime['slug'] :
                        $options[2]['value'] . $anime['slug']) }}">
                            <div class="img">
                                <img src="{{ asset('images/' . $anime['image']) }}">
                            </div>
                        </a>
                        <div class="texts">
                            @if (isset($anime['content']) and $anime['content'] != null)
                                {!! $anime['content'] !!}
                            @else
                                <div class="text">
                                    <span>Genres:</span>
                                    {{ $anime['genres'] }}
                                </div>
                                <div class="text">
                                    <span>Episodes:</span>
                                    {{ $anime['episodes'] }}
                                </div>
                                <div class="text">
                                    <span>Type:</span>
                                    {{ $anime['type'] }}
                                </div>
                                @if($anime['prequel'])
                                    <div class="text">
                                        <span>Prequel: </span>
                                        <a href="{{ url($anime['prequel']['type2'] . "-anime/" .
                                        $anime['prequel']['slug']) }}">
                                            {{ $anime['prequel']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if($anime['sequel'])
                                    <div class="text">
                                        <span>Sequel: </span>
                                        <a href="{{ url(($anime['sequel']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $anime['sequel']['slug']) }}">
                                            {{ $anime['sequel']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if($anime['story'])
                                    <div class="text">
                                        <span>Parent Story: </span>
                                        <a href="{{ url(($anime['story']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $anime['story']['slug']) }}">
                                            {{ $anime['story']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if ($anime['side_story'])
                                    <div class="text">
                                        <span>Side Story: </span>
                                        <a href="{{ url(($anime['side_story']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $anime['side_story']['slug']) }}">
                                            {{ $anime['side_story']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if ($anime['spin_off'])
                                    <div class="text">
                                        <span>Spin Off: </span>
                                        <a href="{{ url(($anime['spin_off']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $anime['spin_off']['slug']) }}">
                                            {{ $anime['spin_off']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if ($anime['alternative'])
                                    <div class="text">
                                        <span>Alternative: </span>
                                        <a href="{{ url(($anime['alternative']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $anime['alternative']['slug']) }}">
                                            {{ $anime['alternative']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if($anime['other'])
                                    <div class="text">
                                        <span>Other: </span>
                                        <a href="{{ url(($anime['other']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $anime['other']['slug']) }}">
                                            {{ $anime['other']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                <div class="text age">
                                    <span>Age Permission: </span>
                                    <span class="age" style="background: {{ $color }}">
                                        {{ $anime['age'] }}
                                    </span>
                                </div>
                                <div class="text">
                                    <span>Plot Summary:</span>
                                    {!! $anime['description'] !!}
                                </div>
                                <div class="text alternative">
                                    <span>Alternative Titles:</span>
                                    {!! $anime['alternative_title'] !!}
                                </div>
                            @endif
                            </div>
                            <!--/texts-->
                        </div>
                        <!--/content-->
                    </div>
                    <!--/series-->
                </div>
            <!--/sections-->
            <?php } ?>
        </div>
        <!--/left_content-->
        <div id="right_content">
            @include("layouts.sidebar")
        </div>
        @include("layouts.footer")
    </div>
    <!--/content-->
</div>