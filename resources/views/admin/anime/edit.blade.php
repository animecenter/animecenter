<div class="bigTitle">Edit Series</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="inputNOption" style="width: 100%;">
        <div class="smallTitle">Title:</div>
        <input name="title" value="<?php echo $resss_row['title']; ?>"
               type="text" class="textInput" style="width: 80%;"/>
    </div>
    <!--/inputNOption-->

    <div class="inputNOption">
        <div class="smallTitle">Episodes:</div>
        <input name="episodes" value="<?php echo $resss_row['episodes']; ?>"
               type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputNOption">
        <div class="smallTitle">Type:</div>
        <input name="type" value="<?php echo $resss_row['type']; ?>"
               type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputSelectarea">
        <div class="smallTitle">Type2:</div>
        <select class="select" name="type2">
            <option value="subbed" <?php if ($resss_row['type2'] == "subbed") {
                echo "selected='selected'";
            }
            ?>>
                subbed
            </option>
            <option value="dubbed" <?php if ($resss_row['type2'] == "dubbed") {
                echo "selected='selected'";
            } ?>>
                dubbed
            </option>
        </select>
        <input value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputNOption">
        <div class="smallTitle">Age:</div>
        <input name="age" value="<?php echo $resss_row['age']; ?>"
               type="text" class="textInput"/>
    </div>
    <!--/inputNOption-->

    <div class="inputSelectarea">
        <div class="smallTitle">Status:</div>
        <select class="select" name="status">
            <option value="ongoing" <?php if ($resss_row['status'] == "ongoing") {
                echo "selected='selected'";
            } ?>>
                Ongoing
            </option>
            <option value="finished" <?php if ($resss_row['status'] == "finished") {
                echo "selected='selected'";
            } ?>>
                Finished
            </option>
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
                    <?php echo $ser['title']; ?>"
                    <?php if ($resss_row['prequel'] == $ser['id'] . "," . $ser['title']) {
                        echo "selected='selected'";
                    } ?>>
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
                    <?php echo $ser['title']; ?>"
                    <?php if ($resss_row['sequel'] == $ser['id'] . "," . $ser['title']) {
                        echo "selected='selected'";
                    } ?>>
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
                    <?php echo $ser['title']; ?>"
                    <?php if ($resss_row['story'] == $ser['id'] . "," . $ser['title']) {
                        echo "selected='selected'";
                    } ?>>
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
                    <?php echo $ser['title']; ?>"
                    <?php if ($resss_row['side_story'] == $ser['id'] . "," . $ser['title']) {
                        echo "selected='selected'";
                    } ?>>
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
                    <?php echo $ser['title']; ?>"
                    <?php if ($resss_row['spin_off'] == $ser['id'] . "," . $ser['title']) {
                        echo "selected='selected'";
                    } ?>>
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
                    <?php echo $ser['title']; ?>"
                    <?php if ($resss_row['alternative'] == $ser['id'] . "," . $ser['title']) {
                        echo "selected='selected'";
                    } ?>>
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
                    <?php echo $ser['title']; ?>"
                    <?php if ($resss_row['other'] == $ser['id'] . "," . $ser['title']) {
                        echo "selected='selected'";
                    } ?>>
                    <?php echo $ser['title']; ?>
                </option>
            <?php } ?>
        </select>
        <input name="" value="" type="text" class="textInput2"/>
    </div>
    <!--/inputSelectarea-->

    <div class="inputTextarea" style="height:auto;">
        <div class="smallTitle">Genres:</div>
        <div class="clear"></div>
        <?php while ($genres_row = mysql_fetch_assoc($genres)) { ?>
            <div class="inputCheck">
                <input type="checkbox" class="checkbox" name="genres[]"
                       value="<?php echo $genres_row['value']; ?>"
                    <?php if (in_array($genres_row['value'], $gen)) {
                        echo "checked='checked'";
                    }?>/>
                <span></span>
                <div class="smallTitle">
                    <?php echo $genres_row['value']; ?>
                </div>
            </div>
            <!--/inputCheck-->
        <?php } ?>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea" style="height:auto">
        <div class="smallTitle">Position:</div>
        <div class="clear"></div>
        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="position1" value="recently"
                <?php if ($resss_row['position'] == "recently" or $resss_row['position'] == "all") {
                    echo "checked='checked'";
                } ?>/>
            <span></span>
            <div class="smallTitle">
                Recently Added Series
            </div>
        </div>
        <!--/inputCheck-->

        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="position2" value="featured"
                <?php if ($resss_row['position'] == "featured" or $resss_row['position'] == "all") {
                    echo "checked='checked'";
                } ?>/>
            <span></span>
            <div class="smallTitle">
                Fetured Series
            </div>
        </div>
        <!--/inputCheck-->
    </div>
    <!--/inputTextarea-->

    <div class="inputUpload">
        <div class="smallTitle">Series Image:</div>
        <img src="../images/<?php echo $resss_row['image']; ?>" width="80" height="80"/>
        <input name="img_file" value="" type="file" class="file"/>
        <input name="h_image" value="<?php echo $resss_row['image']; ?>"
               type="hidden" class="file"/>
    </div>
    <!--/inputUpload-->

    <div class="inputTextarea">
        <div class="smallTitle">Plot Summary:</div>
        <textarea class="textarea" name="description">
            <?php echo $resss_row['description']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Alternative Titles:</div>
        <textarea class="textarea" name="alternative">
            <?php echo $resss_row['alternative_title']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <div class="inputTextarea">
        <div class="smallTitle">Content:</div>
        <textarea class="textarea" name="content">
            <?php echo $resss_row['content']; ?>
        </textarea>
    </div>
    <!--/inputTextarea-->

    <input type="submit" name="up_series" id="submit" value="Update"/>

</form>