@include('layouts.head')
<div id="wrap">
    <div id="content">
        @include('layouts.banner')
        <div id="left_content">
            <div class="sec_top_one">
                @if(Auth::user())
                    <a href="{{ url('admin/episodes/edit/' . $episode['id']) }}" class="edit_top">
                        Edit
                    </a>
                @endif
            </div>
            <div class="sections" id="video">
                <div class="video">
                    <div class="title">
                        {{ $episode['title'] }}
                    </div>
                    @if (!$episode['not_yet_aired'])
                        <div class="tabs">
                            @if ($episode['mirror1'] == '' && $episode['mirror2'] == '' && $episode['mirror3'] == ''
                                && $episode['mirror4'] == '' && $episode['hd'] == '')
                                @if ($episode['subdub'] != null or $episode['subdub'] != '')
                                    <?php $cont = ($episode['subdub'] == null) ? $episode['raw'] : $episode['subdub']; ?>
                                    <div class="block">
                                        <a href="{{ url($mainLink) }}">
                                            <div class="tab <?php echo $episode['anime']['type2'];
                                                echo($episode['anime']['type2']) ?
                                                    ' active' : ''; ?>">
                                                Mirror 1
                                            </div>
                                        </a>
                                    </div>
                                    <!--/block-->
                                @else
                                    @if ($episode['raw'])
                                        <div class="block">
                                            <a href="{{ url($mainLink) }}/raw">
                                                <div class="tab <?php echo $episode['anime']['type2'];
                                                echo($currentMirror === 'raw') ? ' active' : ''; ?> raw">
                                                    RAW
                                                </div>
                                            </a>
                                        </div>
                                        <!--/block-->
                                    @endif
                                @endif
                            @else
                                @if ($episode['mirror1'])
                                    <div class="block">
                                        <a href="{{ url($mainLink) }}">
                                            <div class="tab <?php echo $episode['anime']['type2'];
                                                echo(!$currentMirror) ? ' active' : ''; ?>">
                                                Mirror 1
                                            </div>
                                        </a>
                                    </div>
                                    <!--/block-->
                                @endif
                                @if ($episode['mirror2'])
                                    <div class="block">
                                        <a href="{{ url($mainLink) }}/mirror2">
                                            <div class="tab <?php echo $episode['anime']['type2'];
                                                echo($currentMirror === 'mirror2') ? ' active' : ''; ?>">
                                                Mirror 2
                                            </div>
                                        </a>
                                    </div>
                                    <!--/block-->
                                @endif
                                @if ($episode['mirror3'])
                                    <div class="block">
                                        <a href="{{ url($mainLink) }}/mirror3">
                                            <div class="tab <?php echo $episode['anime']['type2'];
                                                echo($currentMirror === 'mirror3') ? ' active' : ''; ?>">
                                                Mirror 3
                                            </div>
                                        </a>
                                    </div>
                                    <!--/block-->
                                @endif
                                @if ($episode['mirror4'])
                                    <div class="block">
                                        <a href="{{ url($mainLink) }}/mirror4">
                                            <div class="tab <?php echo $episode['anime']['type2'];
                                                echo($currentMirror === 'mirror4') ? ' active' : ''; ?>">
                                                Mirror 4
                                            </div>
                                        </a>
                                    </div>
                                    <!--/block-->
                                @endif
                                @if ($episode['hd'])
                                    <div class="block">
                                        <a href="{{ url($mainLink) }}/hd">
                                            <div class="tab <?php echo $episode['anime']['type2'];
                                                echo($currentMirror === 'hd') ?
                                                ' active' : ''; ?> mirror">
                                                Mirror HD
                                            </div>
                                        </a>
                                    </div>
                                    <!--/block-->
                                @endif
                            @endif
                        </div>
                        <!--/tabs-->
                        <div class="embbed_content">
                            {!! $cont !!}
                        </div>
                    @endif
                    <?php
                    if ($episode['not_yet_aired'] && $episode['coming_date']) {
                        $coming = $episode['coming_date'];
                        $first = new DateTime("now");
                        $second = new DateTime($coming);
                        $diff = $first->diff($second);
                        $day = $diff->format('%d') + ($diff->format('%y') * 365);
                        $hr = $diff->format('%H');
                        $min = $diff->format('%i');
                        $second = $diff->format('%s');
                        $total_s = ($day * 86400) + ($hr * 3600) + ($min * 60) + $second; ?>
                        <script src="{{ asset('js/countdown.js') }}"></script>
                        <div class="date_con">
                            <script>
                                var myCountdown1 = new Countdown({
                                    time: "{{ $total_s }}", // 86400 seconds = 1 day
                                    width: 250,
                                    height: 60,
                                    rangeHi: "day",
                                    style: "flip"
                                });
                            </script>
                        </div>
                        <div class="date_img">
                            <img src="{{ asset("images/" . $episode['anime']['image']) }}">
                        </div>
                        <h2 style="width: 300px; float: left; text-align: center; color: rgb(255, 255, 255); font-size: 16px; margin-left: 26%; margin-bottom: 5px;">ETA</h2>
                    <?php }
                    if ($episode['not_yet_aired']) {
                        echo $episode['not_yet_aired'];
                    } ?>
                </div>
                <div class="rating_div">
                    <div class="views_value view_episode" id="<?php echo $episode['id']; ?>">{{ $episode['visits'] }}<span> Views</span></div>
                    <div id='rateContainor' style="float: left; width: 200px; margin-left: 20px;">
                        <div style='float:left;' class='rating' id='rateDiv'></div>
                        <div style='float: left; font-size: 8pt; clear: both; width: 100%; display:none' id='hint'></div>
                        <div id="hint2" style='float:left;font-size:8pt'>
                            <?php echo "Average: " . sprintf("%.2f", $episode['rating']) .
                                    " ( " . $episode['votes'] . " votes)" ?>
                        </div>
                    </div>
                </div>
                <div class="links_btns">
                    <div class="fb-like" style="margin-top: 3px;" data-href="{{ url("watch/" . $episode['slug']) }}"
                         data-width="450" data-show-faces="false" data-send="true"></div>
                    <div class="report_vid" val="{{ url('episode.php?id=' . $episode['id']) }}">
                        Report Broken Video
                    </div>
                </div>
                <div class="navigation">
                    @if ($prevEpisode)
                        <a href="{{ url($options[4]['value'] . $prevEpisode['slug']) }}" class="prev">Previous Episode</a>
                    @endif
                        <a href="{{ url($episode['anime']['type2'] === "dubbed" ?
                            $options[3]['value'] . $episode['anime']['slug'] :
                            $options[2]['value'] . $episode['anime']['slug']) }}" class="all">All Episodes</a>
                    @if ($nextEpisode)
                        <a href="{{ url($options[4]['value'] . $nextEpisode['slug']) }}" class="next">Next Episode</a>
                    @endif
                </div>
                <!--/navigation-->
            </div>
            <!--/sections-->

            <div style="width: 100%; float: left; margin-bottom: 20px;" class="">
                <div style="float: left;">
                </div>
            </div>

            <div style="width: 100%; float: left; margin-bottom: 10px;" class="">
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
                    <a href="http://disqus.com/?ref_noscript">
                        comments powered by Disqus.
                    </a>
                </noscript>
            </div>
        </div>
        <!--/left_content-->

        <div id="right_content">
            @include('layouts.sidebar')
        </div>
        @include('layouts.footer')
        @section('scripts')
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
                            score: "{{ $episode['rating'] }}",
                            starHalf: "{{ asset('images/star-half.png') }}",
                            starOff: "{{ asset('images/star-off.png') }}",
                            starOn: "{{ asset('images/star-on.png') }}",
                            starHover: "{{ asset('images/star-hover.png') }}",
                            target: ("#hint"),
                            click: function (score, evt) {
                                $("#hint").show().text("Saving your vote...");
                                $("#hint2").hide();
                                $.post("{{ url('rate/episode') }}", {
                                    id: "{{ $episode['id'] }}",
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
                            width: 120,
                            targetKeep: true
                        }
                );
            });
        </script>
        @endsection