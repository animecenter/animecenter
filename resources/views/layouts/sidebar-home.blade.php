<div class="widget" id="featured">
    <div class="title">Upcoming Subbed Episodes</div>
    <script src="{{ asset('css/js/countdown.js') }}"></script>
    <?php
    foreach ($upcomingEpisodes as $episode) {
    $coming = $episode['coming_date'];
    $first = new DateTime("now");
    $second = new DateTime($coming);
    $diff = $first->diff($second);
    $day = $diff->format('%d') + ($diff->format('%y') * 365);
    $hr = $diff->format('%H');
    $min = $diff->format('%i');
    $second = $diff->format('%s');
    $total_s = ($day * 86400) + ($hr * 3600) + ($min * 60) + $second;
    $link = url($options[4]['value'] . $episode['slug']);
    ?>

    <div class="block">
        <a href="<?php echo $link; ?>">
            <img alt='image' class='eimg' src="<?php echo get_thumbnail('images/' . $episode['anime']['image'], 50, 75); ?>"
                 width="50" height="75">
            <div class="sub_title" style="width: 225px; font-family: helvetica;">
                <?php echo(strlen($episode['anime']['title']) < 30) ? $episode['anime']['title'] :
                        substr($episode['anime']['title'], 0, 30) . "..."; ?>
                <br>
                    <span style="font-weight:normal;margin-top:5px;float:left">
                        <?php $tit = explode(" ", $episode['title']); echo "Episode " . end($tit); ?>
                    </span>
            </div>
        </a>
        <style>
            div[id^="Box_jbeeb_"] {
                display: none;
            }
        </style>
        <div class="date_con2" style="float: left;width: 180px; position: absolute;right: 10px;bottom: 10px;">
            <script>
                var myCountdown1 = new Countdown({
                    time: {{ $total_s }}, // 86400 seconds = 1 day
                    width: 180,
                    height: 30,
                    rangeHi: "day",
                    numbers: {
                        font: "Arial",
                        color: "#ffffff",
                        bkgd: "#00ae45",
                        rounded: 0.0001 // percentage of size
                    }
                });
            </script>
        </div>
    </div>
    <!--/block-->
    <?php } ?>
</div><!--/featured-->
<!--/welcome-->
<div style="width: 100%; height: auto; float: left; margin-top: 10px; margin-bottom:10px"></div>
<div style="width: 100%; height: auto; float: left; margin-bottom: 5px;">
    <script id="cid0020000097531107619" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js"
            style="width: 300px;height: 450px;">
        {"handle":"animecenterco","arch":"js","styles":{"a":"00AE45","b":100,"c":"FFFFFF","d":"FFFFFF","k":"00AE45","l":"00AE45","m":"00AE45","n":"FFFFFF","p":"10.35","q":"00AE45","r":100,"t":0,"surl":0,"allowpm":0,"fwtickm":1}}
    </script>
</div>
<div style="width: 100%; height: auto; float: left; margin-top: 10px; margin-bottom:10px"></div>
