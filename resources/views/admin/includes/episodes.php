<?php
$res = $ob->get_table('an_episodes', "1 order by e_id DESC");
?>
<div class="bigTitle">Episodes List</div>
<ul class="list_ob">
    <?php while ($res_row = mysql_fetch_assoc($res)) {
    ?>
        <li><?php echo $res_row['e_title'];
    ?><a href="index.php?page=episode_up&id=<?php echo $res_row['e_id'];
    ?>"
                                                 class="prevBT update">update</a>
            <a href="includes/del-core.php?name=episode&id=<?php echo $res_row['e_id'];
    ?>"
               class="prevBT del">delete</a></li>


    <?php

} ?>

</ul>
<a href="index.php?page=episode_add" class="prevBT add">Add</a>

<div class="res">
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
    echo "Successfully";
} elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
    echo 'Try Again ... error';
} ?>
</div>