<div class="bigTitle">Images List</div>
<ul class="list_ob">
    <?php while ($res_row = mysql_fetch_assoc($res)) { ?>
        <li>
            <?php echo $res_row['bigtitle']; ?>
            <a href="index.php?page=image_up&id=<?php echo $res_row['id']; ?>"
               class="prevBT update">update</a>
            <a href="includes/del-core.php?name=image&id=<?php echo $res_row['id']; ?>"
               class="prevBT del">delete</a>
        </li>
    <?php } ?>
</ul>
<a href="index.php?page=image_add" class="prevBT add">Add</a>
<div class="res">
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
        echo "Successfully";
    } elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
        echo 'Try Again ... error';
    } ?>
</div>