<?php
if (isset($_GET['id']) and $_GET['id'] != null) {
    $res = $ob->get_table("an_series");
    while ($series[] = mysql_fetch_assoc($res)) {
        ;
    }
    array_pop($series);

    $id = GetSQLValueString($_GET['id'], "int");
    $resss = $ob->get_table('an_episodes', 'e_id=' . $id);
    $resss_row = mysql_fetch_assoc($resss);
    include_once("up-core.php");
    ?>
    <script>
        $(document).ready(function () {
            $(".set_date").click(function () {
                $(this).parent("div").parent("div").find("input[type='text']").val($(this).attr("val"));
            });
        });
    </script>
    <div class="bigTitle">Edit Episode</div>
    <form action="<?php $_SERVER['PHP_SELF'];
    ?>" method="post" enctype="multipart/form-data">
        <input name="c_date" value="<?php echo $resss_row['e_date'];
    ?>" type="hidden"/>

        <div class="inputNOption" style="width:100%;">
            <div class="smallTitle">Title:</div>
            <input name="title" value="<?php echo $resss_row['e_title'];
    ?>" type="text" class="textInput"
                   style="width:80%;"/>
        </div>
        <!--/inputNoption-->
        <div class="inputSelectarea">
            <div class="smallTitle">Series:</div>
            <select class="select" name="series">
                <?php foreach ($series as $ser) {
    ?>
                    <option value="<?php echo $ser['a_id'];
    ?>" <?php if ($resss_row['e_series'] == $ser['a_id']) {
    echo "selected='selected'";
}
    ?>><?php echo $ser['a_title'];
    ?></option>
                <?php

}
    ?>
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->
        <div class="inputNOption" style="">
            <div class="smallTitle">Coming Date: <a href="#" class="prevBT set_date" val="<?php echo date('Y-m-d H:i:s',
                    strtotime(date("Y-m-d H:i:s") . "+7 day"));
    ?>">Set Date</a></div>
            <input name="coming_date" value="<?php echo $resss_row['e_coming_date'];
    ?>" type="text" class="textInput"
                   style=""/>
        </div>
        <!--/inputNoption-->
        <div class="clear"></div>
        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="show" value="1" <?php if ($resss_row['e_show'] == 1) {
    echo "checked='checked'";
}
    ?> />
            <span></span>

            <div class="smallTitle">Show in home page</div>
        </div>
        <!--/inputCheck-->

        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="reset" value="1"/>
            <span></span>

            <div class="smallTitle">Rest time</div>
        </div>
        <!--/inputCheck-->
        <div class="inputTextarea">
            <div class="smallTitle">Not Yet Aried Episode Info:</div>
            <textarea class="textarea" name="not_yeird"><?php echo $resss_row['e_not_yeird'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="inputTextarea">
            <div class="smallTitle">Mirror 1:</div>
            <textarea class="textarea" name="mirror1"><?php echo $resss_row['e_mirror1'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="inputTextarea">
            <div class="smallTitle">HD:</div>
            <textarea class="textarea" name="hd"><?php echo $resss_row['e_hd'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="inputTextarea">
            <div class="smallTitle">Mirror 2:</div>
            <textarea class="textarea" name="mirror2"><?php echo $resss_row['e_mirror2'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="inputTextarea">
            <div class="smallTitle">Mirror 3:</div>
            <textarea class="textarea" name="mirror3"><?php echo $resss_row['e_mirror3'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="inputTextarea">
            <div class="smallTitle">Mirror 4:</div>
            <textarea class="textarea" name="mirror4"><?php echo $resss_row['e_mirror4'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="inputTextarea">
            <div class="smallTitle">RAW:</div>
            <textarea class="textarea" name="raw"><?php echo $resss_row['e_raw'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="inputTextarea">
            <div>Backup - Use Mirror: 1 as primary.</div>
            <textarea class="textarea" name="subdub"><?php echo $resss_row['e_subdub'];
    ?></textarea>
        </div>
        <!--/inputTextarea-->
        <div class="clear"></div>
        <input type="submit" name="up_episode" id="submit" value="Update"/>
    </form>
    <div class="res">
        <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
    echo "Added Successfully";
} elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
    echo 'Try Again ... error';
}
    ?>
    </div>
<?php

} ?>
