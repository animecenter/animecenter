<?php

$meta_title = "Latest Anime Series added to site | Watch Anime Online Free";
$meta_desc = "Watch Latest Anime Series added to site!,Watch Latest Anime Series added to site! English Subbed/Dubbed,Watch Latest Anime Series added to site English Sub/Dub, Download Latest Anime Series added to site for free,Watch Latest Anime Series added to site! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key = "Download Latest Anime Series added to site,Watch Latest Anime Series added to site on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

require_once("header.php");
if (isset($_GET['offset']) and $_GET['offset'] != null) {
    $off = GetSQLValueString($_GET['offset'], "int");
    if ($off == 1) {
        $start = 0;
    } else {
        $start = ($off - 1) * 16;
    }
} else {
    $start = 0;
}

$series = $ob->get_table("an_series", "1 order by a_id DESC");
$count = mysql_num_rows($series);
$num_pages = ceil($count / 16);

$seriess = $ob->get_table("an_series", "1 order by a_id DESC limit " . $start . ",16");
?>
<div id="wrap">
    <div id="content">
        <?php include_once("banner.php"); ?>
        <div id="left_content">
            <div id="sec3" class="sections">
                <div class="title">Latest Anime Series added to site</div>
                <?php
                while ($series = mysql_fetch_assoc($seriess)) {
                    $sublink = ($series['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                    $link = $url . $sublink . str_replace(" ", "-", strtolower($series['a_title']));
                    ?>
                    <a href="<?php echo $link; ?>">
                        <div class="block">
                            <div class="img"><img src="images/<?php echo $series['a_image']; ?>"/></div>
                            <div
                                class="main_title"><?php echo (strlen($series['a_title']) < 13) ? $series['a_title'] : substr($series['a_title'],
                                        0, 13) . "..."; ?></div>
                        </div>
                        <!--/block-->
                    </a>
                <?php } ?>
                <div class="pagination" <?php if ($num_pages <= 1) {
                    echo "style='display:none'";
                } ?>>
                    <?php
                    if (isset($_GET['offset'])) {
                        if ($_GET['offset'] == 1) {
                            $next = 2;
                            $prev = 1;
                        } elseif ($_GET['offset'] > 1 and $_GET['offset'] < $num_pages) {
                            $next = $_GET['offset'] + 1;
                            $prev = $_GET['offset'] - 1;
                        } elseif ($_GET['offset'] >= $num_pages) {
                            $next = $num_pages;
                            $prev = $num_pages - 1;
                        }
                    } else {
                        $next = 2;
                        $prev = 1;
                    }
                    if (isset($_GET['position']) and $_GET['position'] != null) {
                        $position = $_GET['position'];
                    } else {
                        $position = null;
                    }
                    ?>
                    <?php if (isset($_GET['offset']) and $_GET['offset'] > 1) { ?><a
                        href="<?php echo $url; ?>latest-anime" title="First Page">&laquo; First</a><?php } ?>
                    <?php if (isset($_GET['offset']) and $_GET['offset'] > 1) { ?><a href="?offset=<?php echo $prev; ?>"
                                                                                     title="Previous Page">&laquo;
                            Previous</a><?php } ?>
                    <?php
                    if ($num_pages <= 12) {
                        for ($i = 1; $i <= $num_pages; $i++) { ?>
                            <a href="?offset=<?php echo $i; ?>" class="number" title="1"><?php echo $i;?></a>
                        <?php }
                    }//end if number page
                    else {
                        $i = isset($_GET['offset']) ? $_GET['offset'] : 1;
                        $targ = (($i + 11) <= $num_pages) ? $i + 11 : $num_pages;
                        $i = (($i + 11) <= $num_pages) ? $i : $num_pages - 11;
                        for ($i; $i <= $targ; $i++) {
                            ?>
                            <a href="?offset=<?php echo $i; ?>" class="number" title="1"><?php echo $i;?></a>
                        <?php
                        }
                    }//end else number page
                    ?>
                    <?php if ( ! isset($_GET['offset']) or $_GET['offset'] < $num_pages) { ?><a
                        href="?offset=<?php echo $next; ?>" title="Next Page">Next &raquo;</a><?php } ?>
                    <?php if ( ! isset($_GET['offset']) or $_GET['offset'] < $num_pages) { ?><a
                        href="?offset=<?php echo $num_pages; ?>" title="Last Page">Last &raquo;</a><?php } ?>
                </div>
                <!-- End .pagination -->
            </div>
            <!--/sections-->
        </div>
        <!--/left_content-->
        <div id="right_content"><?php include_once("sidebar.php"); ?></div>
    </div>
    <!--/content-->
    <?php require_once("footer.php");
    ?>
