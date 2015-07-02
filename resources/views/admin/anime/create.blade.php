<div class="bigTitle">Add New</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="inputNOption" style="width: 100%;">
        <div class="smallTitle">Title:</div>
        <input name="title" value="" type="text" class="textInput" style="width: 80%;"/>
    </div>
    <!--/inputNOption-->

    <div class="inputNOption">
        <div class="smallTitle">Episodes:</div>
        <input name="episodes" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputNOption">
        <div class="smallTitle">Type:</div>
        <input name="type" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputSelectarea">
        <div class="smallTitle">Type2:</div>
        <select class="select" name="type2">
            <option value="subbed">subbed</option>
            <option value="dubbed">dubbed</option>
        </select>
        <input value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputNOption">
        <div class="smallTitle">Age:</div>
        <input name="age" value="" type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputSelectarea">
        <div class="smallTitle">Status:</div>
        <select class="select" name="status">
            <option value="ongoing">Ongoing</option>
            <option value="finished">Finished</option>
        </select>
        <input value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputSelectarea">
        <div class="smallTitle">Prequel:</div>
        <select class="select" name="prequel">
            <option value="">Not Selected</option>
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>,
                    <?php echo $ser['title']; ?>">
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputSelectarea">
        <div class="smallTitle">Sequel:</div>
        <select class="select" name="sequel">
            <option value="">Not Selected</option>
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>,
                    <?php echo $ser['title']; ?>">
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputSelectarea">
        <div class="smallTitle">Parent Story:</div>
        <select class="select" name="story">
            <option value="">Not Selected</option>
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>,
                    <?php echo $ser['title']; ?>">
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputSelectarea">
        <div class="smallTitle">Side Story:</div>
        <select class="select" name="s_story">
            <option value="">Not Selected</option>
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>,
                    <?php echo $ser['title']; ?>">
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputSelectarea">
        <div class="smallTitle">Spin - Off:</div>
        <select class="select" name="spin_off">
            <option value="">Not Selected</option>
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>,
                    <?php echo $ser['title']; ?>">
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputSelectarea">
        <div class="smallTitle">Alternative:</div>
        <select class="select" name="alternative_2">
            <option value="">Not Selected</option>
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>,
                    <?php echo $ser['title']; ?>">
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputSelectarea">
        <div class="smallTitle">Other:</div>
        <select class="select" name="other">
            <option value="">Not Selected</option>
            <?php foreach ($series as $ser) { ?>
                <option value="<?php echo $ser['id']; ?>,
                    <?php echo $ser['title']; ?>">
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputTextarea" style="height: auto;">
        <div class="smallTitle">Genres:</div>
        <div class="clear"></div>
        <?php while ($genres_row = mysql_fetch_assoc($genres)) { ?>
            <div class="inputCheck">
                <input type="checkbox" class="checkbox" name="genres[]"
                       value="<?php echo $genres_row['value']; ?>"/>
                <span></span>
                <div class="smallTitle">
                    <?php echo $genres_row['value']; ?>
                </div>
            </div><!--/inputCheck-->
        <?php } ?>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea" style="height: auto;">
        <div class="smallTitle">Position:</div>
        <div class="clear"></div>
        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="position1" value="recently"/>
            <span></span>
            <div class="smallTitle">Recently Added Series</div>
        </div>
        <!--/inputCheck-->
        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="position2" value="featured"/>
            <span></span>
            <div class="smallTitle">Fetured Series</div>
        </div>
        <!--/inputCheck-->
    </div>
    <!--/inputTextarea-->

    <div class="inputUpload">
        <div class="smallTitle">Series Image:</div>
        <input name="img_file" value="" type="file" class="file"/>
    </div>
    <!--/inputUpload-->

    <div class="inputTextarea">
        <div class="smallTitle">Plot Summary:</div>
        <textarea class="textarea" name="description"></textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Alternative Titles:</div>
        <textarea class="textarea" name="alternative"></textarea>
    </div>
    <!--/inputTextarea-->

    <input type="submit" name="add_series" id="submit" value="Add"/>

</form>
<div class="res">
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 'ok') {
        echo "Added Successfully";
    } elseif (isset($_GET['msg']) and $_GET['msg'] == 'f') {
        echo 'Try Again ... error';
    } ?>
</div>