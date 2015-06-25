<?php
//get single series
$ss_id = rand(0, 200);
$s_ser = mysql_fetch_assoc($ob->get_table("an_series", "1 order by a_id DESC limit " . $ss_id . ",1"));
$sublink = ($s_ser['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
$link = $url . $sublink . str_replace(" ", "-", strtolower($s_ser['a_title']));
$image = $url . "images/" . $s_ser['a_image'];
?>

<div class="banner">
    <iframe src="http://adconscious.com/site/100045" width="728" height="90" frameborder="0" scrolling="no"></iframe>
</div>

<div class="widget" id="featured" style="width:245px; margin-left:3px;">
    <div class="block">
        <a href="<?php echo $link; ?>">
            <img class='eimg' src="<?php echo $image; ?>"/>

            <div class="sub_title"
                 style="width:170px;"><?php echo(strlen($s_ser['a_title']) < 20) ? $s_ser['a_title'] : substr($s_ser['a_title'],
                        0, 20) . "..."; ?></div>
        </a>

        <div class='rateContainor' style='width:170px;;margin-top:5px;float:left'>
            <div style='float:left;' value="<?php echo $s_ser['a_rating']; ?>" id="<?php echo $s_ser['a_id']; ?>"
                 class='rateDiv'></div>
            <div style='float: left; font-size: 8pt;  width: 100%; display:none'
                 id='hint<?php echo $s_ser['a_id']; ?>'></div>
            <div
                id='hint2<?php echo $s_ser['a_id']; ?>'
                style='width:100%;font-size:8pt;float:left'>   <?php echo "Average: " . sprintf("%.2f",
                        $s_ser['a_rating']) . " ( " . $s_ser['a_votes'] . " votes)" ?> </div>
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
