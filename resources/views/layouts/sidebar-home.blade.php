<!--/welcome-->
<div style="width: 100%; height: auto; float: left; margin-top: 10px; margin-bottom:10px">
    <iframe src="http://adconscious.com/site/100040" width="300" height="250" frameborder="0" scrolling="no"></iframe>
</div>
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
        $link = $url . $options[4]['value'] . str_replace(" ", "-", strtolower($episode['title']));
        ?>

        <div class="block">
            <a href="<?php echo $link; ?>">
                <img alt='image' class='eimg' src="<?php echo get_thumbnail('images/' . $ser['image'], 50, 75); ?>"
                     width="50"
                     height="75">
                <div class="sub_title" style="width:225px;font-family:helvetica;">
                    <?php echo(strlen($ser['title']) < 30) ? $ser['title'] : substr($ser['title'], 0, 30) . "..."; ?>
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
                        time: <?php echo $total_s; ?>, // 86400 seconds = 1 day
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
<div style="width: 100%; height: auto; float: left; margin-bottom: 5px;">
    <script id="sid0020000072032835441">(function () {
            function async_load() {
                s.id = "cid0020000072032835441";
                s.src = 'http://st.chatango.com/js/gz/emb.js';
                s.style.cssText = "width:300px;height:433px;";
                s.async = true;
                s.text = '{"handle":"animebyte","styles":{"a":"01AF45","b":100,"c":"FFFFFF","d":"FFFFFF","k":"01AF45","l":"01AF45","m":"01AF45","n":"FFFFFF","q":"01AF45","r":100,"t":0}}';
                var ss = document.getElementsByTagName('script');
                for (var i = 0, l = ss.length; i < l; i++) {
                    if (ss[i].id == 'sid0020000072032835441') {
                        ss[i].id += '_';
                        ss[i].parentNode.insertBefore(s, ss[i]);
                        break;
                    }
                }
            }
            var s = document.createElement('script');
            if (s.async == undefined) {
                if (window.addEventListener) {
                    addEventListener('load', async_load, false);
                } else if (window.attachEvent) {
                    attachEvent('onload', async_load);
                }
            } else {
                async_load();
            }
        })();</script>
</div>
<div style="width: 100%; height: auto; float: left; margin-bottom: 5px;" class="">
    <script id="sid0020000071992215045">(function () {
            function async_load() {
                s.id = "cid0020000071992215045";
                s.src = (window.location.href.indexOf('file:///') > -1 ? 'http:' : '') + '//st.chatango.com/js/gz/emb.js';
                s.style.cssText = "width:336px;height:502px;";
                s.async = true;
                s.text = '{"handle":"animebyte","arch":"js","styles":{"a":"00ae45","b":100,"c":"FFFFFF","d":"FFFFFF","k":"00ae45","l":"00ae45","m":"00ae45","n":"FFFFFF","q":"00ae45","r":100,"t":0,"pos":"br","cv":1,"cvbg":"00ae45","cvw":390,"cvh":63,"ticker":1}}';
                var ss = document.getElementsByTagName('script');
                for (var i = 0, l = ss.length; i < l; i++) {
                    if (ss[i].id == 'sid0020000071992215045') {
                        ss[i].id += '_';
                        ss[i].parentNode.insertBefore(s, ss[i]);
                        break;
                    }
                }
            }
            var s = document.createElement('script');
            if (s.async == undefined) {
                if (window.addEventListener) {
                    addEventListener('load', async_load, false);
                } else if (window.attachEvent) {
                    attachEvent('onload', async_load);
                }
            } else {
                async_load();
            }
        })();</script>
</div>
<div style="width: 100%; height: auto; float: left; margin-top: 10px; margin-bottom:10px">
    <iframe src="http://adconscious.com/site/100055" width="300" height="250" frameborder="0" scrolling="no"></iframe>
</div>
