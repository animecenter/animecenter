<?php
$res=$ob->get_table('an_series','1 order by a_id DESC');
?>
<div class="bigTitle">Series List</div>
<ul class="list_ob">
<?php while($res_row=mysql_fetch_assoc($res)){?>
<li><?php echo $res_row['a_title']; ?><a href="index.php?page=series_up&id=<?php echo $res_row['a_id']; ?>" class="prevBT update">update</a>
<a href="includes/del-core.php?name=series&id=<?php echo $res_row['a_id']; ?>" class="prevBT del">delete</a></li>


<?php }?>

</ul>
<a href="index.php?page=series_add" class="prevBT add">Add</a>

<div class="res">
<?php if(isset($_GET['msg']) and $_GET['msg']=='ok'){echo "Successfully";}elseif(isset($_GET['msg']) and $_GET['msg']=='f'){echo 'Try Again ... error';}?>
</div>