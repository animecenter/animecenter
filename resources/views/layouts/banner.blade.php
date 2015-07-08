<div class="banner">
    <iframe src="http://adconscious.com/site/100045" width="728" height="90" frameborder="0" scrolling="no"></iframe>
</div>
<div id="featured" class="widget" style="width:245px; margin-left:3px;">
    <div class="block">
        <a href="<?php echo url(($animeBanner['type2'] == "dubbed") ? $options[3]['value'] :
                $options[2]['value'] . $animeBanner['slug']); ?>">
            <img class='eimg' src="<?php echo asset("images/" . $animeBanner['image']); ?>">
            <div class="sub_title" style="width:170px;">
                <?php
                    echo(strlen($animeBanner['title']) < 20) ? $animeBanner['title'] : substr($animeBanner['title'], 0, 20) . "...";
                ?>
            </div>
        </a>
        <div class='rateContainor' style='width:170px;;margin-top:5px;float:left'>
            <div style='float:left;' value="<?php echo $animeBanner['rating']; ?>" id="<?php echo $animeBanner['id']; ?>"
                 class='rateDiv'></div>
            <div style='float: left; font-size: 8pt;  width: 100%; display:none' id='hint<?php echo $animeBanner['id']; ?>'></div>
            <div id='hint2<?php echo $animeBanner['id']; ?>' style='width:100%;font-size:8pt;float:left'>
                <?php echo "Average: " . sprintf("%.2f", $animeBanner['rating']) . " ( " . $animeBanner['votes'] . " votes)" ?>
            </div>
        </div>
    </div>
    <!--/block-->
</div>
<!--/featured-->

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
                starHalf: "{{ asset('images/star-half.png') }}",
                starOff: "{{ asset('images/star-off.png') }}",
                starOn: "{{ asset('images/star-on.png') }}",
                starHover: "{{ asset('images/star-hover.png') }}",
                width: 120,
                target: $("#hint" + $(this).attr("id")),
                click: function (score, evt) {
                    $("#hint" + $(this).attr("id")).show().text("Saving your vote...");
                    $("#hint2" + $(this).attr("id")).hide();
                    $.post("{{ url('rate/anime') }}", {
                        id: $(this).attr("id"),
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