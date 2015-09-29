<?php

require_once("header.php");
if ((isset($_GET['page_id']) and $_GET['page_id'] != null)) { ?>
<div id="wrap">
    <div id="content">
        <?php include_once("banner.php"); ?>
        <div id="left_content">
            <div id="sec2" class="sections">
                <div class="title">
                    <?php echo $page_content['title']; ?>
                </div>
                <div class="content">
                    <?php echo $page_content['content']; ?>
                </div>
            </div>
            <!--/sections-->
        </div>
        <!--/left-->
        <div id="right_content">
            <?php include_once("sidebar.php"); ?>
        </div>
    </div>
    <!--/content-->
    <?php require_once("footer.php");
}
