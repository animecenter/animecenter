<div class="bigTitle">Theme Options</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="inputTextarea">
        <div class="smallTitle">Title Right:</div>
        <textarea class="textarea" name="title">
            <?php echo $options[0]['value']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Text Right:</div>
        <textarea class="textarea" name="text">
            <?php echo $options[1]['value']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Subbed Link:</div>
        <textarea class="textarea" name="subbed">
            <?php echo $options[2]['value']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Dubbed Link:</div>
        <textarea class="textarea" name="dubbed">
            <?php echo $options[3]['value']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Episode Link:</div>
        <textarea class="textarea" name="episode">
            <?php echo $options[4]['value']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <div class="clear"></div>
    <input type="submit" name="up_options" id="submit" value="Update"/>

</form>
<div class="res">
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
        echo "Added Successfully";
    } elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
        echo 'Try Again ... error';
    } ?>
</div>