<?php
if(isset($_GET['id']) and $_GET['id']!=NULL){
$id=GetSQLValueString($_GET['id'],"int");
$resss=$ob->get_table('an_pages','p_id='.$id);
$resss_row=mysql_fetch_assoc($resss);
include_once("up-core.php");
?>
<div class="bigTitle">Edit Page</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<div class="inputNOption">
<div class="smallTitle">Title: </div>
            <input name="title" value="<?php echo $resss_row['p_title']; ?>" type="text" class="textInput" />
</div><!--/inputNoption-->
 <div class="inputNOption">
<div class="smallTitle">Order: </div>
            <input name="order" value="<?php echo $resss_row['p_order']; ?>" type="text" class="textInput" />
</div><!--/inputNoption-->

<div class="inputSelectarea">
        <div class="smallTitle">Position: </div>
        <select class="select" name="position">
        <option value="top">Top</option>
        <option value="bottom1" <?php if($resss_row['p_position']=="bottom1") echo "selected='selected'";?>>Bottom 1</option>
        <option value="bottom2" <?php if($resss_row['p_position']=="bottom2") echo "selected='selected'";?>>Bottom 2</option>
        <option value="bottom3" <?php if($resss_row['p_position']=="bottom3") echo "selected='selected'";?>>Bottom 3</option>
        </select>
        <input value="" type="text" class="textInput2" />         
        </div> <!--/inputSelectarea--> 
<div class="inputTextarea">
            <div class="smallTitle">Content: </div>
            <textarea class="textarea" name="content" rows="30"><?php echo $resss_row['p_content']; ?></textarea>
</div><!--/inputTextarea-->
<div class="inputNOption">
<div class="smallTitle">Link: </div>
            <input name="link" value="<?php echo $resss_row['p_link']; ?>" type="text" class="textInput" />
</div><!--/inputNoption-->

<input type="submit" name="up_page" id="submit" value="Update" />
</form>
<?php } ?>