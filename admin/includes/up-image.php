<?php
if(isset($_GET['id']) and $_GET['id']!=NULL){
$id=GetSQLValueString($_GET['id'],"int");
$resss=$ob->get_table('an_images','i_id='.$id);
$resss_row=mysql_fetch_assoc($resss);
include_once("up-core.php");
?>
<div class="bigTitle">Add New - Do NOT include domain in the Link URL</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<div class="inputNOption">
<div class="smallTitle">Big Title: </div>
            <input name="bigtitle" value="<?php echo $resss_row['i_bigtitle']; ?>" type="text" class="textInput" />
</div><!--/inputNoption-->
<div class="inputNOption">
<div class="smallTitle">Small Title: </div>
            <input name="smalltitle" value="<?php echo $resss_row['i_smalltitle']; ?>" type="text" class="textInput" />
</div><!--/inputNoption-->
<div class="inputNOption">
<div class="smallTitle">Link: <br/></div>
            <input name="link" value="<?php echo $resss_row['i_link']; ?>" type="text" class="textInput" />
</div><!--/inputNoption-->
<div class="inputUpload">
<div class="smallTitle">Image File   (640 * 360): </div>
			<img src="<?php echo "../images/".$resss_row['i_file']; ?>" width="80" height="80" />
            <input name="img_file" value="" type="file" class="file" />
            <input name="c_image" value="<?php echo $resss_row['i_file']; ?>" type="hidden" class="file" />
</div><!--/inputUpload-->

<div class="inputTextarea">
            <div class="smallTitle">Description: </div>
            <textarea class="textarea" name="desc" rows="30"><?php echo $resss_row['i_desc']; ?></textarea>
</div><!--/inputTextarea-->


<input type="submit" name="up_image" id="submit" value="Update" />
</form>
<div class="res">
<?php if(isset($_GET['msg']) and $_GET['msg']=='ok'){echo "Added Successfully";}elseif(isset($_GET['msg']) and $_GET['msg']=='f'){echo 'Try Again ... error';}?>
</div>
<?php } ?>
