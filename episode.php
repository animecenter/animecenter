<?php
require_once("header.php");
if ((isset($_GET['id']) and $_GET['id'] != null)){
$id = $episode_content['e_id'];
$ser = mysql_fetch_assoc($ob->get_table("an_series", "a_id=" . $episode_content['e_series']));
$current_order = $episode_content['e_order'];
$next_episode = mysql_fetch_assoc($ob->get_table("an_episodes",
    "e_series=" . $episode_content['e_series'] . " and e_order >=" . $current_order . " and e_id!=" . $id . " order by e_order ASC"));
$prev_episode = mysql_fetch_assoc($ob->get_table("an_episodes",
    "e_series=" . $episode_content['e_series'] . " and e_order <=" . $current_order . " and e_id!=" . $id . " order by e_order desc"));
$type = explode("/", $_GET['id']);
$main_link = $url . $options[4]['o_value'] . str_replace(" ", "-", strtolower($episode_content['e_title']));
if (isset($type[2])) {
    switch ($type[2]) {
        case 'mirror1':
            $cont = $episode_content['e_mirror1'];
            break;
        case 'mirror2':
            $cont = $episode_content['e_mirror2'];
            break;
        case 'mirror3':
            $cont = $episode_content['e_mirror3'];
            break;
        case 'mirror4':
            $cont = $episode_content['e_mirror4'];
            break;
        case 'raw':
            $cont = $episode_content['e_raw'];
            break;
        case 'hd':
            $cont = $episode_content['e_hd'];
            break;
        default:
            $cont = ($episode_content['e_mirror1'] == null) ? $episode_content['e_raw'] : $episode_content['e_mirror1'];
    }//end switch
}//end if type
else {
    $cont = ($episode_content['e_mirror1'] == null) ? $episode_content['e_raw'] : $episode_content['e_mirror1'];
}
?>
<div id="wrap">
    <div id="content">
        <?php include_once("banner.php");?>
        <div id="left_content">
            <div class="sec_top_one">
                <?php if (isset($_SESSION['u_username'])) { ?>
                    <a href="<?php echo $url; ?>admin/index.php?page=episode_up&id=<?php echo $episode_content['e_id']; ?>"
                       class="edit_top">Edit</a>
                <?php } ?>
            </div>
            <div class="sections" id="video">
                <div class="video">
                    <div class="title"><?php echo $episode_content['e_title']; ?></div>
                    <?php if ($episode_content['e_not_yeird'] == null or $episode_content['e_not_yeird'] == '') { ?>
                        <div class="tabs">
                            <?php
                            if ($episode_content['e_mirror1'] == '' and $episode_content['e_mirror2'] == '' and $episode_content['e_mirror3'] == '' and $episode_content['e_mirror4'] == '' and $episode_content['e_hd'] == '') {
                                if ($episode_content['e_subdub'] != null or $episode_content['e_subdub'] != '') {
                                    $cont = ($episode_content['e_subdub'] == null) ? $episode_content['e_raw'] : $episode_content['e_subdub']; ?>
                                    <div class="block">
                                        <a href="<?php echo $main_link; ?>">
                                            <div class="tab <?php echo $ser['a_type2'];
                                            echo ( ! (isset($type[2])) or $type[2] == '') ? ' active' : '';?>">Mirror 1
                                            </div>
                                        </a>
                                    </div><!--/block-->
                                <?php }
                            } else {
                                ?>
                                <?php if ($episode_content['e_mirror1'] != null or $episode_content['e_mirror1'] != '') { ?>
                                    <div class="block">
                                        <a href="<?php echo $main_link; ?>">
                                            <div class="tab <?php echo $ser['a_type2'];
                                            echo ( ! (isset($type[2])) or $type[2] == '') ? ' active' : ''; ?>">Mirror 1
                                            </div>
                                        </a>
                                    </div><!--/block-->
                                <?php } ?>
                                <?php if ($episode_content['e_mirror2'] != null or $episode_content['e_mirror2'] != '') { ?>
                                    <div class="block">
                                        <a href="<?php echo $main_link; ?>/mirror2">
                                            <div class="tab <?php echo $ser['a_type2'];
                                            echo (isset($type[2]) and $type[2] == 'mirror2') ? ' active' : ''; ?>">
                                                Mirror 2
                                            </div>
                                        </a>
                                    </div><!--/block-->
                                <?php } ?>
                                <?php if ($episode_content['e_mirror3'] != null or $episode_content['e_mirror3'] != '') { ?>
                                    <div class="block">
                                        <a href="<?php echo $main_link; ?>/mirror3">
                                            <div class="tab <?php echo $ser['a_type2'];
                                            echo (isset($type[2]) and $type[2] == 'mirror3') ? ' active' : ''; ?>">
                                                Mirror 3
                                            </div>
                                        </a>
                                    </div><!--/block-->
                                <?php } ?>
                                <?php if ($episode_content['e_mirror4'] != null or $episode_content['e_mirror4'] != '') { ?>
                                    <div class="block">
                                        <a href="<?php echo $main_link; ?>/mirror4">
                                            <div class="tab <?php echo $ser['a_type2'];
                                            echo (isset($type[2]) and $type[2] == 'mirror4') ? ' active' : ''; ?>">
                                                Mirror 4
                                            </div>
                                        </a>
                                    </div><!--/block-->
                                <?php } ?>
                                <?php if ($episode_content['e_raw'] != null or $episode_content['e_raw'] != '') { ?>
                                    <div class="block">
                                        <a href="<?php echo $main_link; ?>/raw">
                                            <div class="tab <?php echo $ser['a_type2'];
                                            echo ((isset($type[2]) and $type[2] == 'raw')
                                                or $episode_content['e_subdub'] == null) ? ' active' : ''; ?> raw">RAW
                                            </div>
                                        </a>
                                    </div><!--/block-->
                                <?php } ?>
                                <?php if ($episode_content['e_hd'] != null or $episode_content['e_hd'] != '') { ?>
                                    <div class="block">
                                        <a href="<?php echo $main_link; ?>/hd">
                                            <div class="tab <?php echo $ser['a_type2'];
                                            echo (isset($type[2]) and $type[2] == 'hd') ? ' active' : ''; ?> mirror">
                                                Mirror HD
                                            </div>
                                        </a>
                                    </div><!--/block-->
                                <?php }
                            } ?>
                        </div><!--/tabs-->
                        <div class="embbed_content">
                            <?php echo $cont; ?></div>
                        <script type="text/javascript">
                            $(document).ready(function (e) {
                                $("#vid-close").click(function (e) {
                                    $("#popup-vid").remove();
                                });
                            });
                        </script>
                        <style>
                            #popup-vid {
                                background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);
                                height: 250px;
                                left: 175px;
                                position: absolute;
                                top: 100px;
                                width: 300px;
                                z-index: 9999;
                            }

                            #vid-close {
                                background: none repeat scroll 0 0 #23b95d;
                                border-radius: 5px;
                                clear: both;
                                color: #fff;
                                cursor: pointer;
                                float: left;
                                font-size: 15px;
                                font-weight: bold;
                                height: 30px;
                                line-height: 25px;
                                margin-left: 85px;
                                margin-top: -5px;
                                position: relative;
                                text-align: center;
                                width: 130px;
                            }
                        </style>
                        <div id="popup-vid">
                            <!--/* Ad4Game Javascript Tag */-->

                            <script type='text/javascript'><!--//<![CDATA[
                                var m3_u = (location.protocol == 'https:' ? 'https://ads.ad4game.com/www/delivery/ajs.php' : 'http://ads.ad4game.com/www/delivery/ajs.php');
                                var m3_r = Math.floor(Math.random() * 99999999999);
                                if (!document.MAX_used) document.MAX_used = ',';
                                document.write("<scr" + "ipt type='text/javascript' src='" + m3_u);
                                document.write("?zoneid=34472&amp;block=1&amp;blockcampaign=1");
                                document.write('&amp;cb=' + m3_r);
                                if (document.MAX_used != ',') document.write("&amp;exclude=" + document.MAX_used);
                                document.write(document.charset ? '&amp;charset=' + document.charset : (document.characterSet ? '&amp;charset=' + document.characterSet : ''));
                                document.write("&amp;loc=" + escape(window.location));
                                if (document.referrer) document.write("&amp;referer=" + escape(document.referrer));
                                if (document.context) document.write("&context=" + escape(document.context));
                                if (document.mmm_fo) document.write("&amp;mmm_fo=1");
                                document.write("'><\/scr" + "ipt>");
                                //]]>--></script>
                            <noscript><a
                                    href='http://ads.ad4game.com/www/delivery/dck.php?n=a9f13eb4&amp;cb=INSERT_RANDOM_NUMBER_HERE'
                                    target='_blank'><img
                                        src='http://ads.ad4game.com/www/delivery/avw.php?zoneid=34472&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a9f13eb4'
                                        border='0' alt=''/></a></noscript>

                            <div id="vid-close">Start Video</div>
                        </div>

                    <?php }//end if yeird
                    ?>
                    <?php if ($episode_content['e_not_yeird'] != null and $episode_content['e_coming_date'] != null) {
                        $comming = $episode_content['e_coming_date'];
                        $first = new DateTime("now");
                        $second = new DateTime($comming);
                        $diff = $first->diff($second);
                        $day = $diff->format('%d') + ($diff->format('%y') * 365);
                        $hr = $diff->format('%H');
                        $min = $diff->format('%i');
                        $second = $diff->format('%s');
                        $total_s = ($day * 86400) + ($hr * 3600) + ($min * 60) + $second;
                        ?>
                        <script src="<?php echo $url; ?>css/js/countdown.js"></script>
                        <div class="date_con">
                            <script>
                                var myCountdown1 = new Countdown({
                                    time: <?php echo $total_s; ?>, // 86400 seconds = 1 day
                                    width: 250,
                                    height: 60,
                                    rangeHi: "day",
                                    style: "flip"	// <- no comma on last item!
                                });
                            </script>
                        </div>
                        <div class="date_img"><img src="<?php echo $url . "/images/" . $ser['a_image']; ?>"/></div>
                        <h2 style="width: 300px; float: left; text-align: center; color: rgb(255, 255, 255); font-size: 16px; margin-left: 26%; margin-bottom: 5px;">
                            ETA</h2>
                    <?php }//end else if
                    if ($episode_content['e_not_yeird'] != null) {
                        echo $episode_content['e_not_yeird'];
                    }
                    ?>

                </div>


                <div class="rating_div">
                    <div class="views_value view_episode" id="<?=$episode_content['e_id'];?>"></div>
                    <div id='rateContainor' style='float: left; width: 200px; margin-left: 20px;'>
                        <div style='float:left;' class='rating' id='rateDiv'></div>
                        <div style='float: left; font-size: 8pt; clear: both; width: 100%; display:none'
                             id='hint'></div>
                        <div id="hint2" style='float:left;font-size:8pt'>   <?php echo "Average: " . sprintf("%.2f",
                                    $episode_content['e_rating']) . " ( " . $episode_content['e_votes'] . " votes)" ?> </div>
                    </div>
                </div>
                <div class="links_btns">
                    <div class="fb-like" style="margin-top:3px;"
                         data-href="<?php echo $url . "watch/" . str_replace(" ", "-",
                                 strtolower($episode_content['e_title'])); ?>" data-width="450" data-show-faces="false"
                         data-send="true"></div>
                    <div class="report_vid" val="<?php echo $url . 'episode.php?id=' . $episode_content['e_id']; ?>">
                        Report Broken Video
                    </div>
                </div>

                <div class="navigation">
                    <?php if (isset($prev_episode) and $prev_episode['e_id'] != null) {
                        $link = $url . $options[4]['o_value'] . str_replace(" ", "-",
                                strtolower($prev_episode['e_title']));
                        ?>
                        <a href="<?php echo $link; ?>" class="prev">Previous Episode</a>
                    <?php }
                    $ser_row = mysql_fetch_assoc($ob->get_table("an_series", "a_id=" . $episode_content['e_series']));
                    $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                    $link = $url . $sublink . str_replace(" ", "-", strtolower($ser_row['a_title']));
                    ?>
                    <a href="<?php echo $link;?>" class="all">All Episodes</a>
                    <?php if (isset($next_episode) and $next_episode['e_id'] != null) {
                        $link = $url . $options[4]['o_value'] . str_replace(" ", "-",
                                strtolower($next_episode['e_title']));
                        ?>
                        <a href="<?php echo $link; ?>" class="next">Next Episode</a>
                    <?php }?>
                </div>
                <!--/navigation-->
            </div>
            <!--/sections-->

            <div style="width:100%;float:left;margin-bottom:20px" class="">
                <div style="float: left;">
                    <!-- MarketGidComposite Start -->
                    <div id="MarketGidScriptRootC16203">
                        <div id="MarketGidPreloadC16203">
                            <a id="mg_add16203"
                               href="http://mgid.com/advertisers/?utm_source=widget&utm_medium=text&utm_campaign=add"
                               target="_blank">Place your ad here</a><br> <a href="http://mgid.com/" target="_blank">Loading...</a>
                        </div>
                        <script>
                            (function () {
                                var D = new Date(), d = document, b = 'body', ce = 'createElement', ac = 'appendChild', st = 'style', ds = 'display', n = 'none', gi = 'getElementById';
                                var i = d[ce]('iframe');
                                i[st][ds] = n;
                                d[gi]("MarketGidScriptRootC16203")[ac](i);
                                try {
                                    var iw = i.contentWindow.document;
                                    iw.open();
                                    iw.writeln("<ht" + "ml><bo" + "dy></bo" + "dy></ht" + "ml>");
                                    iw.close();
                                    var c = iw[b];
                                }
                                catch (e) {
                                    var iw = d;
                                    var c = d[gi]("MarketGidScriptRootC16203");
                                }
                                var dv = iw[ce]('div');
                                dv.id = "MG_ID";
                                dv[st][ds] = n;
                                dv.innerHTML = 16203;
                                c[ac](dv);
                                var s = iw[ce]('script');
                                s.async = 'async';
                                s.defer = 'defer';
                                s.charset = 'utf-8';
                                s.src = "//jsc.mgid.com/1/a/1animefushigi.com.16203.js?t=" + D.getYear() + D.getMonth() + D.getDate() + D.getHours();
                                c[ac](s);
                            })();
                        </script>
                    </div>
                    <!-- MarketGidComposite End -->
                </div>
            </div>

            <?
            // SETUP BY ULTRA AS PART OF ADCON REV OPTIMIZATION
            ?>
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
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments
                        powered by Disqus.</a></noscript>
                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span
                        class="logo-disqus">Disqus</span></a>
            </div>
            <div class="bottom_text">
                You are going to <b>Watch <?php echo $episode_content['e_title']; ?> </b> in <b> English
                    Subbed/Dubbed </b>from <b><?php echo $ser['a_title']; ?> </b> Anime. Watch
                <b><?php echo $episode_content['e_title']; ?> </b>online and the other episodes of
                <b><?php echo $ser['a_title']; ?> </b>with High Quality Streaming for <b>FREE</b>
            </div>

        </div>
        <!--/left_content-->
        <div id="right_content"><?php include_once("sidebar.php");?></div>
        <!--   </div><!--/content-->

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
                        score:<?php echo $episode_content['e_rating']; ?>,
                        starHalf: '<?php echo $url; ?>/images/star-half.png',
                        starOff: '<?php echo $url; ?>/images/star-off.png',
                        starOn: '<?php echo $url; ?>/images/star-on.png',
                        starHover: '<?php echo $url; ?>/images/star-hover.png',
                        target: ("#hint"),
                        click: function (score, evt) {
                            $("#hint").show().text("Saving your vote...");
                            $("#hint2").hide();
                            $.post("<?php echo $url; ?>rate-up.php", {
                                eid:<?php echo $episode_content['e_id']; ?>,
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
                        targetKeep: true,
                    }
                );
            });
        </script>
        <?php require_once("footer.php");
        }//end if
        ?>
