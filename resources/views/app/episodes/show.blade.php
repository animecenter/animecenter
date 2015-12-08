@extends('app.layouts.main')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-lg-8">
            <div class="row">
                @if ($user)
                    <div class="col-xs-12">
                        <a href="{{ url('admin/episodes/edit/' . $anime['episode']->id) }}">
                            Edit
                        </a>
                    </div>
                @endif
                <div class="col-xs-12">
                    <h2 class="page-header">
                        {{ $anime->title . ' Episode ' . $anime->episode->number }}
                    </h2>
                </div>
                <div class="col-xs-12">
                    @if ($anime->episode->mirrors)
                        <ul class="nav nav-tabs-episode">
                            @foreach ($anime->episode->mirrors as $key => $mirror)
                                @if (isset($mirrorSlug) && $mirrorSlug === $mirror->slug || $key === 0)
                                    <li role="presentation" class="active">
                                        <a href="#">{{ $mirror->mirrorSource->name . ' (' . $mirror->quality . ')' }}</a>
                                    </li>
                                @else
                                    <li role="presentation">
                                        <a href="{{ url($anime->slug . '/' . $anime->episode->slug . '/' . $mirror->slug) }}">
                                            {{ $mirror->mirrorSource->name . ' (' . $mirror->quality . ')' }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-4by3">
                            <iframe class="embed-responsive-item" SRC="http://www.mp4upload.com/embed-wi8mkqyrs6k0.html"
                                    allowfullscreen="true" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO
                                    width="100%"
                                    height="370"></iframe>
                            <!--- <iframe class="embed-responsive-item" src="{{ $anime->episode->mirrors[0]->url }}" width="100%"
                    height="370"></iframe> -->
                        </div>
                    @else
                        <?php
                        if ($anime['episode']['not_yet_aired'] && $anime['episode']['coming_date']) {
                        $coming = $anime['episode']['coming_date'];
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
                            <img src="{{ asset("images/" . $anime['episode']['image']) }}">
                        </div>
                        <?php } ?>
                        <p>ETA: {{ $anime->episode->aired_at }}</p>
                    @endif
                </div>
                <div class="container">
                    <div class="col-xs-12 social">
                        <div class="col-xs-12 col-sm-10">
                            <i class="fa fa-facebook fa-fw text-success"></i>
                            <i class="fa fa-twitter fa-fw text-success"></i>
                            <i class="fa fa-google-plus fa-fw text-success"></i>
                            <i class="fa fa-reddit fa-fw text-success"></i>
                            <i class="fa fa-pinterest fa-fw text-success"></i>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <button type="button" class="btn btn-md btn-danger pull-right">
                                Report Broken Video
                            </button>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="row star-views">
                            <div class="pull-left">
                                <p>{{ $anime->episode->votes }}<span> Votes</span></p>
                            </div>
                            <div class="pull-right">
                                <p>{{ $anime->episode->views }}<span> Views</span></p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 text-center">

                    @if ($prevEpisode)
                        <div class="col-xs-12 col-md-4">
                            <a href="{{ url($anime->slug . '/' . $prevEpisode->slug) }}" class="btn btn-md btn-success"><i
                                        class="fa fa-hand-o-left"></i> Prev Episode</a>
                        </div>
                    @else
                        <div class="col-xs-12 col-md-4">
                            <a href="#"></a>
                        </div>
                    @endif
                    <div class="col-xs-12 col-md-4">
                        <a href="{{ url($anime->slug) }}" class="btn btn-md btn-success"><i class="fa fa-list"></i>
                            Episode List</a>
                    </div>
                    @if ($nextEpisode)
                        <div class="col-xs-12 col-md-4">
                            <a href="{{ url($anime->slug . '/' . $nextEpisode->slug) }}" class="btn btn-md btn-success"><i
                                        class="fa fa-hand-o-right"></i> Next Episode</a>
                        </div>
                    @else
                        <div class="col-xs-12 col-md-4">
                            <a href="#"></a>
                        </div>
                    @endif

                </div>
                <div class="col-xs-12">
                    <div id="disqus_thread" class="comments"></div>
                    <script data-cfasync="true">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname = 'animecentertvnetwork';
                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function () {
                            var dsq = document.createElement('script');
                            dsq.type = 'text/javascript';
                            dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-4">
            <div class="widget" id="facebook">
                <div class="fb-page" data-href="https://www.facebook.com/Animecentertv" data-width="100%"
                     data-height="258" data-small-header="false" data-adapt-container-width="true"
                     data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/Animecentertv">
                            <a href="https://www.facebook.com/Animecentertv">Animecenter.TV Network</a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!--/facebook-->
            <div>
                <script src="http://www.evolvenation.com/delivery.js?id=15&size=300x250"></script>
            </div>
            <div class="chat">
                <script id="cid0020000097531107619" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js">
                    {
                        "handle": "animecenterco", "arch": "js", "styles": {
                            "a": "00AE45", "b": 100, "c": "FFFFFF", "d": "FFFFFF", "k":"00AE45", "l": "00AE45",
                            "m": "00AE45", "n": "FFFFFF", "p": "10.35", "q": "00AE45", "r": 100, "t": 0, "surl": 0,
                            "allowpm": 0, "fwtickm": 1
                        }
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (e) {
            $('#rateDiv').hover(function () {
                $('#hint').show();
                $('#hint2').hide();
            });
            $('#rateDiv').mouseleave(function () {
                $('#hint').hide();
                $('#hint2').show();
            });
            $("#rateDiv").raty({
                score: "{{ $anime['episode']['rating'] }}",
                starHalf: "{{ asset('images/star-half.png') }}",
                starOff: "{{ asset('images/star-off.png') }}",
                starOn: "{{ asset('images/star-on.png') }}",
                starHover: "{{ asset('images/star-hover.png') }}",
                target: ("#hint"),
                click: function (score, evt) {
                    $("#hint").show().text("Saving your vote...");
                    $("#hint2").hide();
                    $.post("{{ url('rate/episode') }}", {
                        id: "{{ $anime['episode']['id'] }}",
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
            });
        });
    </script>
@endsection
