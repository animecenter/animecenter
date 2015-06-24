<?php
$page_title = "Category Browser";
$meta_title = $page_title . " | Watch Anime Online Free";
$meta_desc = "Watch " . $page_title . "!,Watch " . $page_title . "! English Subbed/Dubbed,Watch " . $page_title . " English Sub/Dub, Download " . $page_title . " for free,Watch " . $page_title . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key = "Download " . $page_title . ",Watch " . $page_title . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

require_once("header.php");
$genres = $ob->get_table("an_genres");
?>
<div id="wrap">
    <div id="content">
        <?php include_once("banner.php"); ?>
        <div id="left_content">
            <div class="sections" id="genres">
                <div class="title">Category Browser</div>
                <div class="content">
                    Select Anime Genre(s) from the boxes, and click "Search" button. For Example: You like Action,
                    Adventure and Martial Arts Anime, select the genres and go! Thats all.
                </div>
                <form method="get" action="<?php echo $url . 'search'; ?>">
                    <div class="input_search"><label>Anime </label><input type="text" name="sword" placeholder="Search Anime Name"/></div>
                    <div class="block">
                        <div class="click">Scope</div>
                        <div class="cont">
                            <div class="label">Items containing:</div>
                            <div class="radio_block">
                                <input type="radio" name="scope" value="all" checked="checked"/>
                                <span></span>
                                <label><strong>All</strong> Terms</label>
                            </div>
                            <div class="radio_block">
                                <input type="radio" name="scope" value="any"/>
                                <span></span>
                                <label><strong>Any</strong> Terms</label>
                            </div>
                        </div>
                        <!--/cont-->
                    </div>
                    <!--/block-->

                    <div class="block">
                        <div class="click">Categories</div>
                        <div class="cont">
                            <div class="label">Genre(s):</div>
                            <?php while ($gen = mysql_fetch_assoc($genres)) { ?>
                                <div class="box_block">
                                    <input type="checkbox" name="genres[]" value="<?php echo $gen['g_value']; ?>"/>
                                    <span></span>
                                    <label><?php echo $gen['g_value']; ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <!--/cont-->
                    </div>
                    <!--/block-->

                    <input type="submit" name="sub" value="Search"/>
                    <input type="reset" value="Reset"/>
                </form>
                <?php if (isset($_GET['msg']) and $_GET['msg'] == 'f') { ?>
                    <div class="error">Error, you must type name or select genres</div>
                <?php } ?>
            </div>
            <!--/sections-->
        </div>
        <!--/left_content-->
        <div id="right_content"><?php include_once("sidebar.php"); ?></div>
    </div>
    <!--/content-->
    <?php require_once("footer.php");
    ?>