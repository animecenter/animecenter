<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$page_title = "Watch Upcoming Episodes";
$meta_title = $page_title . " | Watch Anime Online Free";
$meta_desc = "Watch " . $page_title . "!,Watch " . $page_title . "! English Subbed/Dubbed,Watch " . $page_title . " English Sub/Dub, Download " . $page_title . " for free,Watch " . $page_title . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key = "Download " . $page_title . ",Watch " . $page_title . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

?>
@include("layouts.head")
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="left_content">
            <div id="sec4" class="sections">
                <div class="title">Watch Upcoming Subbed Episodes</div>
                <script src="<?php echo $url; ?>css/js/countdown.js"></script>
                <?php
                $episodess = $ob->get_table("an_episodes",
                    "e_coming_date!='' and e_not_yet_aired!='' order by e_coming_date ASC");
                /*
                print_r($episodes);
                while($episode=mysql_fetch_assoc($episodes)){
                           $ser=mysql_fetch_assoc($ob->get_table("an_series","a_id=".$episode['series']));
                           $coming=$episode['coming_date'];
                                      $first  = new DateTime("now");
                                      $second = new DateTime($coming);
                                      $diff = $first->diff( $second );
                                      $day=$diff->format( '%d')+($diff->format( '%y')*365);
                                         $hr=$diff->format( '%H');
                                      $min=$diff->format( '%i');
                                      $second=$diff->format( '%s')
                                      $total_s=($day*86400)+($hr*3600)+($min*60)+$second;
                            $link=$url.$options[4]['value'].str_replace(" ","-",strtolower($episode['title']));
                 echo $episode;
                }
                /*?>
                    <div class="block">
                    <a href="<?= $link;?>">
                    <img alt='image' class='eimg' src="<?php get_thumbnail('images/'.$ser['image'], 50, 75);?>" width="50" height="75" />
                    </a>
                     <style>
                     div[id^="Box_jbeeb_"]{
                     display:none;
                     }
                     </style>
                     <div class="date_con2" style="float: left;width: 180px; position: absolute;right: 10px;bottom: 10px;">
                            <script>
                            var myCountdown1 = new Countdown({
                        time: <?php echo $total_s; ?>, // 86400 seconds = 1 day
                        width:180,
                        height:30,
                        rangeHi:"day",
                        numbers:{
                            font 	: "Arial",
                            color	: "#FFFFFF",
                            bkgd	: "#00ae45",
                            rounded	: 0.0001,				// percentage of size
                        } // <- no comma on last item!
                        });
                            </script>
                            </div>
                    </div><!--/block-->
                <?php }*/ ?>
            </div>
            <!--/sections-->
        </div>
        <!--/left_content-->
        <div id="right_content">
            @include("layouts.sidebar")
        </div>
    </div>
    <!--/content-->
    @include("layouts.footer")
