@extends('app.layouts.main')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-lg-8">
                @if (!empty($user))
                    <div class="col-xs-12">
                        <a href="{{ url('admin/episodes/edit/' . $anime['episode']->id) }}">
                            Edit
                        </a>
                    </div>
                @endif
                <h1 class="heading">{{ $anime->title . ' Episode ' . $anime->episode->number }}</h1>
                    @if ($anime->episode->mirrors)
                        <ul class="nav nav-tabs-episode">
                            @foreach ($anime->episode->mirrors as $key => $mirror)
                                @if ((!empty($currentMirror) && $currentMirror->id === $mirror->id) || empty($currentMirror) && $key === 0)
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
                            <!--  <iframe class="embed-responsive-item" src="{{ !empty($currentMirror) ? $currentMirror->url : $anime->episode->mirrors[0]->url }}" width="100%" height="370"></iframe>-->
                            <iframe class="embed-responsive-item" SRC="http://www.mp4upload.com/embed-ll2lnx3co409.html" width="100%" height="370" allowfullscreen></iframe>
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
                            $total_s = ($day * 86400) + ($hr * 3600) + ($min * 60) + $second;
                            ?>
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
                       <div class="social">
                           <i class="fa fa-facebook fa-fw text-purple"></i>
                           <i class="fa fa-twitter fa-fw text-purple"></i>
                           <i class="fa fa-google-plus fa-fw text-purple"></i>
                           <i class="fa fa-reddit fa-fw text-purple"></i>
                           <i class="fa fa-pinterest fa-fw text-purple"></i>
                           <button type="button" class="btn btn-md bg-purple text-white pull-xs-right">Report Broken Video</button>
                       </div>
                       <div class="star-views bg-dark-purple text-white">
                           <p class="pull-xs-left">{{ $anime->episode->votes }} Votes</p>
                           <p class="pull-xs-right">{{ $anime->episode->views }} Views</p>
                       </div>

                    @if ($prevEpisode)
                       <a href="{{ url($anime->slug . '/' . $prevEpisode->slug) }}" class="btn bg-purple text-white"><i class="fa fa-hand-o-left"></i> Prev Episode</a>
                   @endif
                       <a href="{{ url($anime->slug) }}" class="btn bg-purple text-white"><i class="fa fa-list"></i> Episode List</a>
                   @if ($nextEpisode)
                      <a href="{{ url($anime->slug . '/' . $nextEpisode->slug) }}" class="btn bg-purple text-white"><i class="fa fa-hand-o-right"></i> Next Episode</a>
                   @endif
                  <div id="disqus_thread" class="comments"></div>
             </div>
            <div class="col-xs-12 col-lg-4">
            <div class="chat">
                <script id="cid0020000097531107619" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style=" width:100%; height:600px ">
                    {"handle": "animecenterco",
                        "arch": "js",
                        "styles": {
                            "a": "7d71ce",
                            "b": 100,
                            "c": "FFFFFF",
                            "d": "FFFFFF",
                            "k":"7d71ce",
                            "l": "7d71ce",
                            "m": "7d71ce",
                            "n": "FFFFFF",
                            "p": "10.35",
                            "q": "7d71ce",
                            "r": 100,
                            "t": 0,
                            "surl": 0,
                            "allowpm": 0,
                            "fwtickm": 1}
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
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
@endsection
