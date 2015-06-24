<?php

$page_title = 'Animecenter.tv';

if ((isset($_GET["sword"]) and $_GET["sword"] != null)) {

    $page_title = htmlspecialchars((string) $_GET["sword"], ENT_COMPAT, 'UTF-8', true);

} elseif (isset($_GET['genres'])) {

    $genres_arr = $_GET['genres'];
    $page_title = htmlspecialchars(implode(",", $genres_arr));

}

$meta_title = $page_title . " | Watch Anime Online Free";
$meta_desc = "Watch " . $page_title . "!,Watch " . $page_title . "! English Subbed/Dubbed,Watch " . $page_title . " English Sub/Dub, Download " . $page_title . " for free,Watch " . $page_title . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
$meta_key = "Download " . $page_title . ",Watch " . $page_title . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

require_once("header.php");

if ((isset($_GET["sword"]) and $_GET["sword"] != null)) {

    $title = mysql_real_escape_string(htmlspecialchars((string) $_GET["sword"], ENT_COMPAT, 'UTF-8', true));
    $search_series = $ob->get_table("an_series", "a_title like '%" . $title . "%'");
    $count = mysql_num_rows($search_series);

} elseif (isset($_GET['genres'])) {

    $scope = $_GET['scope'];
    $genres_arr = $_GET['genres'];
    $title2 = '';

    foreach ($genres_arr as $gen) {

        if ($gen == end($genres_arr)) {

            $gen = mysql_real_escape_string(htmlspecialchars((string) $gen, ENT_COMPAT, 'UTF-8', true));
            $title2 .= "a_genres LIKE '%" . $gen . "%'";

        } else {

            $gen = mysql_real_escape_string(htmlspecialchars((string) $gen, ENT_COMPAT, 'UTF-8', true));
            $title2 .= "a_genres LIKE '%" . $gen . "%' AND ";

        }
    }

    //$title.=']';*/
    $title = htmlspecialchars(implode(",", $genres_arr));
    $genres_str = implode("|", $genres_arr);
    $genres_str = mysql_real_escape_string(htmlspecialchars((string) $genres_str, ENT_COMPAT, 'UTF-8', true));

    if ($scope == "all") {

        $search_series = $ob->get_table("an_series", $title2);
        $count = mysql_num_rows($search_series);

    } elseif ($scope == "any") {

        $search_series = $ob->get_table("an_series", "a_genres REGEXP '" . $genres_str . "'");
        $count = mysql_num_rows($search_series);

    }

} else {
    header("location:" . $url . "taxonomy_browser/?msg=f");
}
?>
<div id="wrap">
    <div id="content">
        <?php include_once("banner.php"); ?>
        <div id="left_content">
            <div class="green_info">
                <?php echo $count . " series found for " . $title; ?>
            </div>

            <?php while ($series_content = mysql_fetch_assoc($search_series)) {
                $genres = explode(",", $series_content['a_genres']);
                $type = explode(",", $series_content['a_type']);
                $sublink = ($series_content['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                $link = $url . $sublink . str_replace(" ", "-", strtolower($series_content['a_title']));
                //Get Age Color
                switch ($series_content['a_age']) {
                    case "Anyone":
                        $color = "#EE82EE";
                        break;
                    case "Teen +17":
                        $color = "#CC0033";
                        break;
                    case "Teen +18":
                        $color = "#FF0000";
                        break;
                    default:
                        $color = "#C86464";
                }
                ?>

                <div class="sections" id="series">

                    <div class="series">
                        <a href="<?php echo $link; ?>">
                            <div class="main_title">
                                <?php echo $series_content['a_title']; ?>
                            </div>
                        </a>

                        <div class="content">
                            <div class="categories">
                                <a href="#" class="<?php echo $series_content['a_type2']; ?>">
                                    English <?php echo $series_content['a_type2']; ?>
                                </a>
                            </div>

                            <a href="<?php echo $link; ?>">
                                <div class="img">
                                    <img src="images/<?php echo $series_content['a_image']; ?>"/>
                                </div>
                            </a>

                            <div class="texts">

                                <?php if (isset($series_content['a_content']) and $series_content['a_content'] != null) {
                                    echo $series_content['a_content'];
                                } else { ?>

                                    <div class="text"><span>Genres:</span>
                                        <?php echo $series_content['a_genres']; ?>
                                    </div>

                                    <div class="text"><span>Episodes:</span>
                                        <?php echo $series_content['a_episodes']; ?>
                                    </div>

                                    <div class="text"><span>Type:</span>
                                        <?php echo $series_content['a_type']; ?>
                                    </div>

                                    <?php
                                    if ($series_content['a_prequel'] != null) {
                                        $ser_ser = explode(",", $series_content['a_prequel']);
                                        $ser_row = mysql_fetch_assoc($ob->get_table("an_series",
                                            "a_id=" . $ser_ser[0]));
                                        $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                                        $link = $url . $sublink . str_replace(" ", "-",
                                                strtolower($ser_row['a_title']));
                                        ?>

                                        <div class="text"><span>Prequel: </span>
                                            <a href="<?php echo $link; ?>">
                                                <?php echo $ser_ser[1]; ?></a>
                                        </div>
                                    <?php }

                                    if ($series_content['a_sequel'] != null) {
                                        $ser_ser = explode(",", $series_content['a_sequel']);
                                        $ser_row = mysql_fetch_assoc($ob->get_table("an_series",
                                            "a_id=" . $ser_ser[0]));
                                        $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                                        $link = $url . $sublink . str_replace(" ", "-",
                                                strtolower($ser_row['a_title']));
                                        ?>

                                        <div class="text"><span>Sequel: </span>
                                            <a href="<?php echo $link; ?>">
                                                <?php echo $ser_ser[1]; ?>
                                            </a>
                                        </div>
                                    <?php }

                                    if ($series_content['a_story'] != null) {
                                        $ser_ser = explode(",", $series_content['a_story']);
                                        $ser_row = mysql_fetch_assoc($ob->get_table("an_series",
                                            "a_id=" . $ser_ser[0]));
                                        $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                                        $link = $url . $sublink . str_replace(" ", "-",
                                                strtolower($ser_row['a_title']));
                                        ?>

                                        <div class="text"><span>Parent Story: </span>
                                            <a href="<?php echo $link; ?>">
                                                <?php echo $ser_ser[1]; ?>
                                            </a>
                                        </div>
                                    <?php }

                                    if ($series_content['a_side_story'] != null) {
                                        $ser_ser = explode(",", $series_content['a_side_story']);
                                        $ser_row = mysql_fetch_assoc($ob->get_table("an_series",
                                            "a_id=" . $ser_ser[0]));
                                        $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                                        $link = $url . $sublink . str_replace(" ", "-",
                                                strtolower($ser_row['a_title']));
                                        ?>

                                        <div class="text"><span>Side Story: </span>
                                            <a href="<?php echo $link; ?>">
                                                <?php echo $ser_ser[1]; ?>
                                            </a>
                                        </div>
                                    <?php }

                                    if ($series_content['a_spin_off'] != null) {
                                        $ser_ser = explode(",", $series_content['a_spin_off']);
                                        $ser_row = mysql_fetch_assoc($ob->get_table("an_series",
                                            "a_id=" . $ser_ser[0]));
                                        $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                                        $link = $url . $sublink . str_replace(" ", "-",
                                                strtolower($ser_row['a_title']));
                                        ?>

                                        <div class="text"><span>Spin Off: </span>
                                            <a href="<?php echo $link; ?>">
                                                <?php echo $ser_ser[1]; ?>
                                            </a>
                                        </div>
                                    <?php }

                                    if ($series_content['a_alternative'] != null) {
                                        $ser_ser = explode(",", $series_content['a_alternative']);
                                        $ser_row = mysql_fetch_assoc($ob->get_table("an_series",
                                            "a_id=" . $ser_ser[0]));
                                        $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                                        $link = $url . $sublink . str_replace(" ", "-",
                                                strtolower($ser_row['a_title']));
                                        ?>

                                        <div class="text"><span>Alternative: </span>
                                            <a href="<?php echo $link; ?>"><?php echo $ser_ser[1]; ?></a>
                                        </div>
                                    <?php }

                                    if ($series_content['a_other'] != null) {
                                        $ser_ser = explode(",", $series_content['a_other']);
                                        $ser_row = mysql_fetch_assoc($ob->get_table("an_series",
                                            "a_id=" . $ser_ser[0]));
                                        $sublink = ($ser_row['a_type2'] == "dubbed") ? $options[3]['o_value'] : $options[2]['o_value'];
                                        $link = $url . $sublink . str_replace(" ", "-",
                                                strtolower($ser_row['a_title']));
                                        ?>

                                        <div class="text"><span>Other: </span>
                                            <a href="<?php echo $link; ?>"><?php echo $ser_ser[1]; ?></a>
                                        </div>
                                    <?php } ?>

                                    <div class="text age"><span>Age Permission: </span>
                                        <span class="age" style="background:<?php echo $color; ?>">
                                            <?php echo $series_content['a_age']; ?>
                                        </span>
                                    </div>

                                    <div class="text"><span>Plot Summary:</span>
                                        <?php echo $series_content['a_description']; ?>
                                    </div>

                                    <div class="text alternative"><span>Alternative Titles:</span>
                                        <?php echo $series_content['a_alternative_title']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!--/texts-->
                        </div>
                        <!--/content-->
                    </div>
                    <!--/series-->
                </div><!--/sections-->
            <?php } ?>
        </div>
        <!--/left_content-->
        <div id="right_content">
            <?php include_once("sidebar.php"); ?>
            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <!--/content-->
</div>