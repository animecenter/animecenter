<?php include_once("add-core.php"); ?>
<div class="bigTitle">Add New - Do NOT include domain in the Link URL</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <div class="inputNOption">
        <div class="smallTitle">Big Title:</div>
        <input name="bigtitle" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNoption-->
    <div class="inputNOption">
        <div class="smallTitle">Small Title:</div>
        <input name="smalltitle" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNoption-->
    <div class="inputNOption">
        <div class="smallTitle">Link:</div>
        <input name="link" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNoption-->
    <div class="inputUpload">
        <div class="smallTitle">Image File (640 * 360):</div>
        <input name="img_file" value="" type="file" class="file"/>
    </div>
    <!--/inputUpload-->

    <div class="inputTextarea">
        <div class="smallTitle">Description:</div>
        <textarea class="textarea" name="desc" rows="30"></textarea>
    </div>
    <!--/inputTextarea-->


    <input type="submit" name="add_image" id="submit" value="Add"/>
</form>
<div class="res">
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
        echo "Added Successfully";
    } elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
        echo 'Try Again ... error';
    } ?>
</div>
