@extends('admin.index')
@section('content')
    <div class="bigTitle">Add New</div>
    <form action="{{ url('admin/episodes/create') }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputNOption" style="width: 100%;">
            <div class="smallTitle">Title:</div>
            <input name="title" value="" type="text" class="textInput" style="width: 80%;"/>
        </div>
        <!--/inputNOption-->

        <div class="inputSelectarea">
            <div class="smallTitle">Series:</div>
            <select class="select" name="anime">
                @foreach ($animes as $anime)
                    <option value="<?php echo $anime['id']; ?>" <?php
                            if (isset($id) and $id == $anime['id']) {
                                echo " selected='selected'";
                            } ?>>
                        <?php echo $anime['title']; ?>
                    </option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputNOption">
            <div class="smallTitle">Coming Date (Y-m-d H:i:s):</div>
            <input name="coming_date" value="" type="text" class="textInput" style=""/>
        </div>
        <!--/inputNOption-->

        <div class="clear"></div>
        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="show" value="1"/>
            <span></span>
            <div class="smallTitle">Show in home page</div>
        </div>
        <!--/inputCheck-->

        <div class="inputTextarea">
            <div class="smallTitle">Not Yet Aired:</div>
            <textarea class="textarea" name="not_yet_aired"></textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 1:</div>
            <textarea class="textarea" name="mirror1"></textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">HD:</div>
            <textarea class="textarea" name="hd"></textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 2:</div>
            <textarea class="textarea" name="mirror2"></textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 3:</div>
            <textarea class="textarea" name="mirror3"></textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 4:</div>
            <textarea class="textarea" name="mirror4"></textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">RAW:</div>
            <textarea class="textarea" name="raw"></textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div>Backup: Use Mirror: 1 as primary.</div>
            <textarea class="textarea" name="subdub"></textarea>
        </div>
        <!--/inputTextarea-->

        <input type="submit" id="submit" value="Add"/>

    </form>
@endsection