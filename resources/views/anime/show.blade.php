@include('layouts.head')
<div id="wrap">
    <div id="content">
        @include('layouts.banner')
        <div id="left_content">
            <div class="sec_top_one">
                <div class="fb-like" style="height: 30px;" data-href="{{
                    url($anime['type2'] . "-anime/" . $anime['slug']) }}"
                     data-width="450" data-show-faces="false" data-send="true"></div>
                @if(Auth::user())
                    <a href="{{ url('admin/anime/edit/' . $anime['id']) }}" class="edit_top">
                        Edit
                    </a>
                @endif
            </div>
            <div class="sections" id="series">
                <div class="series">
                    <div class="main_title">
                        {{ $anime['title'] }}
                        @if(Auth::user())
                            <div class="login">
                                <select class="member-select episodes">
                                    <option selected="selected" value="0">Add Episode</option>
                                    <option value="{{ url('admin/episodes/create/' . $anime['id']) }}">
                                        Add Episode Manually
                                    </option>
                                    <option value="{{ url('admin/episodes/create/automatically') }}" val="{{ $anime['id'] }}">
                                        Add Episode Automatically
                                    </option>
                                </select>
                            </div>
                            <!--/login-->
                        @endif
                    </div>

                    <div class="content">
                        <div class="categories">
                            <a href="#" class="{{ $anime['type2'] }}">
                                English {{ $anime['type2'] }}
                            </a>
                        </div>
                        <div class="img">
                            <img src="{{ asset('images/' . $anime['image']) }}">
                        </div>

                        <div class="texts">
                            @if($anime['content'])
                                {!! $anime['content'] !!}
                            @else
                                <div class="text">
                                    <span>Genres:</span>
                                    {{ str_replace(",", ", ", $anime['genres']) }}
                                </div>
                                <div class="text">
                                    <span>Episodes:</span> {{ $anime['episodes'] }}
                                </div>
                                <div class="text">
                                    <span>Type:</span> {{ $anime['type'] }}
                                </div>
                                @if($anime['prequel'])
                                    <div class="text">
                                        <span>Prequel: </span>
                                        <a href="{{ url($relations['prequel']['type2'] . "-anime/" .
                                        $relations['prequel']['slug']) }}">
                                            {{ $relations['prequel']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if($anime['sequel'])
                                    <div class="text">
                                        <span>Sequel: </span>
                                        <a href="{{ url(($relations['sequel']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $relations['sequel']['slug']) }}">
                                            {{ $relations['sequel']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if($anime['story'])
                                    <div class="text">
                                        <span>Parent Story: </span>
                                        <a href="{{ url(($relations['story']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $relations['story']['slug']) }}">
                                            {{ $relations['story']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if ($anime['side_story'])
                                    <div class="text">
                                        <span>Side Story: </span>
                                        <a href="{{ url(($relations['side_story']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $relations['side_story']['slug']) }}">
                                            {{ $relations['side_story']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if ($anime['spin_off'])
                                    <div class="text">
                                        <span>Spin Off: </span>
                                        <a href="{{ url(($relations['spin_off']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $relations['spin_off']['slug']) }}">
                                            {{ $relations['spin_off']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if ($anime['alternative'])
                                    <div class="text">
                                        <span>Alternative: </span>
                                        <a href="{{ url(($relations['alternative']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $relations['alternative']['slug']) }}">
                                            {{ $relations['alternative']['title'] }}
                                        </a>
                                    </div>
                                @endif
                                @if($anime['other'])
                                    <div class="text">
                                        <span>Other: </span>
                                        <a href="{{ url(($relations['other']['type2'] == "dubbed") ?
                                        $options[3]['value'] : $options[2]['value'] . $relations['other']['slug']) }}">
                                            {{ $relations['other']['title'] }}
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
                        @if ($lastEpisode)
                            <div class="latest-episode">
                                <a href="{{ url($options[4]['value'] . $lastEpisode['slug']) }}">
                                    <div class="row main">Latest Episode</div>
                                    <div class="row sec">
                                        {{ str_replace($anime['title'], "", $lastEpisode['title']) }}
                                    </div>
                                    <div class="row la">Watch now</div>
                                </a>
                            </div>
                            <!--/latest-episode-->
                        @endif
                    </div>
                    <!--/content-->
                </div>
                <!--/series-->
                <div class="rating_div">
                    <div class="views_value view_series" id="{{ $anime['id'] }}">{{ $anime['visits'] }}<span> Views</span></div>
                    <div id="rateContainor" style="float: left; width: 200px; margin-left: 20px;">
                        <div style="float:left;" value="{{ $anime['rating'] }}" id="rateDiv" class="rating"></div>
                        <div style="float: left; font-size: 8pt; clear: both; width: 100%; display:none" id="hint"></div>
                        <div id="hint2" style="float: left; font-size: 8pt">
                            <?php
                            echo "Average: " . (($anime['rating']) ?
                                sprintf("%.2f", $anime['rating']) : 0) . " ( " .
                                    (($anime['votes']) ? $anime['votes'] : 0) . " votes)" ?>
                        </div>
                    </div>
                </div>
                <div class="title" style="margin-bottom:5px;">
                    {{ $anime['title'] }} Episodes
                </div>
                <div class="episodes">
                    <ul>
                        @foreach($anime['relations']['episodes'] as $episode)
                            <li class="leaf">
                                <a href="{{ url($options[4]['value'] . $episode['slug']) }}">
                                    {{ $episode['title'] }}
                                </a>
                                @if($episode['not_yet_aired'] != null)
                                    <span>Not Yet Aired</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!--/episodes-->
            </div>
            <!--/sections-->
            <div style="width:100%;float:left;margin-bottom:10px" class="">
                <div id="disqus_thread"></div>
                <script type="text/javascript" data-cfasync='true'>
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'animecentertvnetwork'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function () {
                        var dsq = document.createElement('script');
                        dsq.type = 'text/javascript';
                        dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>
                    Please enable JavaScript to view the
                    <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
                </noscript>
            </div>
            <div style="width: 100%; float: left; margin-bottom: 10px;" class=""></div>
        </div>
        <!--/left_content-->
        <div id="right_content">
            @include('layouts.sidebar')
        </div>
        <!--/content-->
        <script>
            $(document).ready(function (e) {
                $("#rateDiv").hover(function () {
                    $("#hint").show();
                    $("#hint2").hide();
                });
                $("#rateDiv").mouseleave(function () {
                    $("#hint").hide();
                    $("#hint2").show();
                });
                $("#rateDiv").raty({
                    score: "{{ $anime['rating'] }}",
                    starHalf: "{{ asset('images/star-half.png') }}",
                    starOff: "{{ asset('images/star-off.png') }}",
                    starOn: "{{ asset('images/star-on.png') }}",
                    starHover: "{{ asset('images/star-hover.png') }}",
                    target: ("#hint"),
                    click: function (score, evt) {
                        $("#hint").show().text("Saving your vote...");
                        $("#hint2").hide();
                        $.post("{{ url('rate/anime') }}", {
                            id: {{ $anime['id'] }},
                            rate: score
                        }, function (data) {
                            $("#hint").show().text("your vote has been saved");
                            $("#hint2").hide();
                            setTimeout(function () {
                                $("#hint").hide();
                                $("#hint2").show().text(data);
                            }, 1000);
                        });
                    },
                    width: 110,
                    targetKeep: true
                });
            });
        </script>
        @include('layouts.footer')