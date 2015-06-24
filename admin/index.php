<?php include_once("index-core.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Condiment' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Port+Lligat+Sans' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="css/js/jquery-1.9.1.js"></script>
    <script src="css/js/ckeditor/ckeditor.js"></script>
    <script>
        window.onload = function () {
            CKEDITOR.replace('textarea',
                {
                    filebrowserUploadUrl: 'includes/ckupload.php'
                });
        };
    </script>
    <script type="text/javascript" src="css/js/core.js"></script>
    <!--This Include all Javascript Core Functions-->
    <title>Watch Anime Online Free | Anime Shows, Movies and OVAs in English Subbed & Dubbed</title>
</head>
<body>
<div id="wrap">
    <div id="header">
        <div id="info_login">
            <div id="info_u">Welcome <?php echo $_SESSION['u_username']; ?> <a
                    href="<?php echo $url; ?>admin/logout.php">log out</a></div>
        </div>
        <!--/info_login-->
    </div>
    <!--/header-->

    <div id="content">
        <div id="leftContent">

            <div id="navBarR">
                <ul>
                    <li class="parent"><a href="index.php">Dashbord</a></li>
                    <li class="parent"><a href="index.php?page=series">Series</a>
                        <ul>
                            <li class="child"><a href="index.php?page=series_add">Add Series</a></li>
                            <li class="child"><a href="index.php?page=series">All Series</a></li>

                        </ul>
                    </li>

                    <li class="parent"><a href="index.php?page=episodes" onclick="return false">Episodes</a>
                        <ul>
                            <li class="child"><a href="index.php?page=episode_add">Add Episode</a></li>
                            <li class="child"><a href="index.php?page=episodes">All Episodes</a></li>

                        </ul>
                    </li>

                    <li class="parent"><a href="index.php?page=pages" onclick="return false">Pages</a>
                        <ul>
                            <li class="child"><a href="index.php?page=page_add">Add Page</a></li>
                            <li class="child"><a href="index.php?page=pages">All Pages</a></li>

                        </ul>
                    </li>
                    <li class="parent"><a href="index.php?page=image" onclick="return false">Gallery</a>
                        <ul>
                            <li class="child"><a href="index.php?page=image_add">Add Image</a></li>
                            <li class="child"><a href="index.php?page=images">All Images</a></li>

                        </ul>
                    </li>
                    <li class="parent"><a href="index.php?page=options">Options</a></li>

                    <li class="parent"><a href="index.php?page=cache-purge">Cache Purge</a></li>
                </ul>
            </div>
            <!--/navBarR-->
        </div>
        <!--/leftContent-->

        <div id="rightContent">
            <?php
            require_once("includes/" . $pages);
            ?>
        </div>
        <!--/rightContent-->
    </div>
    <!--/content-->

    <div id="footer">
        <div id="copy">eAnime 1.0 Beta</div>
    </div>
    <!--/footer-->
</div>
<!--/wrap-->
</body>
</html>
