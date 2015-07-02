<div class="bigTitle">Add New</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="inputNOption" style="width: 100%;">
        <div class="smallTitle">Title:</div>
        <input name="title" value="" type="text" class="textInput" style="width: 80%;"/>
    </div>
    <!--/inputNOption-->

    <div class="inputSelectarea">
        <div class="smallTitle">Series:</div>
        <select class="select" name="series">
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>"
                    <?php if (isset($id) and $id == $ser['id']) {
                        echo " selected='selected'";
                    } ?>>
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputNOption">
        <div class="smallTitle">Coming Date (Y-m-d H:i:s):</div>
        <input name="coming_date" value="" type="text" class="textInput" style=""/>
    </div>
    <!--/inputNOption-->

    <div class="clear"></div>
    <div class="inputCheck">
        <input type="checkbox" class="checkbox" name="show" value="1"/>
        <span></span>
        <div class="smallTitle">Show in home page</div>
    </div>
    <!--/inputCheck-->

    <div class="inputTextarea">
        <div class="smallTitle">Not Yet Aired Episode Info:</div>
        <textarea class="textarea" name="not_yet_aired"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Mirror 1:</div>
        <textarea class="textarea" name="mirror1"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">HD:</div>
        <textarea class="textarea" name="hd"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Mirror 2:</div>
        <textarea class="textarea" name="mirror2"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Mirror 3:</div>
        <textarea class="textarea" name="mirror3"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Mirror 4:</div>
        <textarea class="textarea" name="mirror4"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">RAW:</div>
        <textarea class="textarea" name="raw"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div>Backup: Use Mirror: 1 as primary.</div>
        <textarea class="textarea" name="subdub"></textarea>
    </div>
    <!--/inputTextarea-->

    <input type="submit" name="add_episode" id="submit" value="Add"/>

</form>
<div class="res">
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
        echo "Added Successfully";
    } elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
        echo 'Try Again ... error';
    } ?>
</div>