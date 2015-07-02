<div class="bigTitle">Add New</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

    <div class="inputNOption">
        <div class="smallTitle">Title:</div>
        <input name="title" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputNOption">
        <div class="smallTitle">Order:</div>
        <input name="order" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputSelectarea">
        <div class="smallTitle">Position:</div>
        <select class="select" name="position">
            <option value="top">Top</option>
            <option value="bottom1">Bottom 1</option>
            <option value="bottom2">Bottom 2</option>
            <option value="bottom3">Bottom 3</option>
        </select>
        <input value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Content:</div>
        <textarea class="textarea" name="content" rows="30"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputNOption">
        <div class="smallTitle">Link:</div>
        <input name="link" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <input type="submit" name="add_page" id="submit" value="Add"/>

</form>
<div class="res">
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
        echo "Added Successfully";
    } elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
        echo 'Try Again ... error';
    } ?>
</div>