<?php
//get single series
$ss_id = rand(0, 200);
$animeBanner = mysql_fetch_assoc($ob->get_table("an_series", "1 order by a_id DESC limit " . $ss_id . ",1"));
$sublink = ($animeBanner['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
$link = $url . $sublink . str_replace(" ", "-", strtolower($animeBanner['a_title']));
$image = $url . "images/" . $animeBanner['a_image'];
?>
<div class="banner"><!----Tagsrv----www.animecenter.tv ADCASH--banner--728x90---->
    <iframe id='aab15dd6' name='aab15dd6'
            src='http://www.postads24.com/afr.php?zoneid=6774&amp;cb=INSERT_RANDOM_NUMBER_HERE' frameborder='0'
            scrolling='no' width='728' height='90'><a
            href='http://www.postads24.com/ck.php?n=af9515e8&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img
                src='http://www.postads24.com/avw.php?zoneid=6774&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=af9515e8'
                border='0' alt=''/></a></iframe>
    <!----Tagsrv--------------------------------------------------></div>
<div class="widget" id="featured" style="width:245px; margin-left:3px;">
    <div class="block">
        <a href="<?php echo $link; ?>">
            <img class='eimg' src="<?php echo $image; ?>"/>

            <div class="sub_title"
                 style="width:170px;"><?php echo (strlen($animeBanner['a_title']) < 20) ? $animeBanner['a_title'] : substr($animeBanner['a_title'],
                        0, 20) . "..."; ?></div>
        </a>

        <div class='rateContainor' style='width:170px;;margin-top:5px;float:left'>
            <div style='float:left;' value="<?php echo $animeBanner['a_rating']; ?>" id="<?php echo $animeBanner['a_id']; ?>"
                 class='rateDiv'></div>
            <div style='float: left; font-size: 8pt;  width: 100%; display:none'
                 id='hint<?php echo $animeBanner['a_id']; ?>'></div>
            <div
                id='hint2<?php echo $animeBanner['a_id']; ?>'
                style='width:100%;font-size:8pt;float:left'>   <?php echo "Average: " . sprintf("%.2f",
                        $animeBanner['a_rating']) . " ( " . $animeBanner['a_votes'] . " votes)" ?> </div>
        </div>
    </div>
    <!--/block-->
</div><!--/featured-->
<script>
    $(document).ready(function (e) {
        $(".rateDiv").hover(function () {
            $("#hint" + $(this).attr("id")).show();
            $("#hint2" + $(this).attr("id")).hide();
        });
        $(".rateDiv").mouseleave(function () {
            $("#hint" + $(this).attr("id")).hide();
            $("#hint2" + $(this).attr("id")).show();
        });
        $(".rateDiv").each(function (index, element) {
            var thiss = $(element);
            $(element).raty({
                    score: $(this).attr("value"),
                    starHalf: '<?php echo $url; ?>/images/star-half.png',
                    starOff: '<?php echo $url; ?>/images/star-off.png',
                    starOn: '<?php echo $url; ?>/images/star-on.png',
                    starHover: '<?php echo $url; ?>/images/star-hover.png',
                    width: 120,
                    target: $("#hint" + $(this).attr("id")),
                    click: function (score, evt) {
                        $("#hint" + $(this).attr("id")).show().text("Saving your vote...");
                        $("#hint2" + $(this).attr("id")).hide();
                        $.post("<?php echo $url; ?>rate-up.php", {
                            sid: $(this).attr("id"),
                            rate: score
                        }, function (data) {
                            $("#hint" + thiss.attr("id")).show().text("your vote has been saved");
                            $("#hint2" + thiss.attr("id")).hide();
                            setTimeout(function () {
                                $("#hint" + thiss.attr("id")).hide();
                                $("#hint2" + thiss.attr("id")).show().text(data);
                            }, 1000);
                        });
                    },


                    targetKeep: true
                }
            );

        });

    });

</script>
