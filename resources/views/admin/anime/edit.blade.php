@extends('admin.index')
@section('content')
    <div class="bigTitle">Edit Anime</div>
    <form action="{{ url('admin/anime/edit/' . $currentAnime['id']) }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputNOption" style="width: 100%;">
            <div class="smallTitle">Title:</div>
            <input name="title" value="{{ $currentAnime['title'] }}" type="text" class="textInput" style="width: 80%;"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Episodes:</div>
            <input name="episodes" value="{{ $currentAnime['episodes'] }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Type:</div>
            <input name="type" value="{{ $currentAnime['type'] }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputSelectarea">
            <div class="smallTitle">Type2:</div>
            <select class="select" name="type2">
                <option value="subbed" {{ ($currentAnime['type2'] == "subbed") ?
                'selected=selected' : '' }}>subbed</option>
                <option value="dubbed" {{ ($currentAnime['type2'] == "dubbed") ?
                'selected=selected' : '' }}>dubbed</option>
            </select>
            <input value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputNOption">
            <div class="smallTitle">Age:</div>
            <input name="age" value="{{ $currentAnime['age'] }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputSelectarea">
            <div class="smallTitle">Status:</div>
            <select class="select" name="status">
                <option value="ongoing" {{ ($currentAnime['status'] == "ongoing") ?
                'selected=selected' : '' }}>Ongoing</option>
                <option value="finished" {{ ($currentAnime['status'] == "finished") ?
                'selected=selected' : '' }}>Finished</option>
            </select>
            <input value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputSelectarea">
            <div class="smallTitle">Prequel:</div>
            <select class="select" name="prequel">
                <option value="">Not Selected</option>
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}" {{
                        $currentAnime['prequel'] === $anime['id'] . "," . $anime['title'] ? 'selected=selected' : ''
                        }}>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputSelectarea">
            <div class="smallTitle">Sequel:</div>
            <select class="select" name="sequel">
                <option value="">Not Selected</option>
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}" <?php
                        if ($currentAnime['sequel'] == $anime['id'] . "," . $anime['title']) {
                            echo 'selected=selected';
                        } ?>>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputSelectarea">
            <div class="smallTitle">Parent Story:</div>
            <select class="select" name="story">
                <option value="">Not Selected</option>
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}" <?php
                        if ($currentAnime['story'] == $anime['id'] . "," . $anime['title']) {
                            echo 'selected=selected';
                        } ?>>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputSelectarea">
            <div class="smallTitle">Side Story:</div>
            <select class="select" name="side_story">
                <option value="">Not Selected</option>
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}" <?php
                        if ($currentAnime['side_story'] == $anime['id'] . "," . $anime['title']) {
                            echo 'selected=selected';
                        } ?>>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputSelectarea">
            <div class="smallTitle">Spin - Off:</div>
            <select class="select" name="spin_off">
                <option value="">Not Selected</option>
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}" <?php
                        if ($currentAnime['spin_off'] == $anime['id'] . "," . $anime['title']) {
                            echo 'selected=selected';
                        } ?>>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputSelectarea">
            <div class="smallTitle">Alternative:</div>
            <select class="select" name="alternative">
                <option value="">Not Selected</option>
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}" <?php
                        if ($currentAnime['alternative'] == $anime['id'] . "," . $anime['title']) {
                            echo 'selected=selected';
                        } ?>>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputSelectarea">
            <div class="smallTitle">Other:</div>
            <select class="select" name="other">
                <option value="">Not Selected</option>
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}" <?php
                        if ($currentAnime['other'] == $anime['id'] . "," . $anime['title']) {
                            echo 'selected=selected';
                        } ?>>{{ $anime['title'] }}
                    </option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputTextarea" style="height: auto;">
            <div class="smallTitle">Genres:</div>
            <div class="clear"></div>
            @foreach ($genres as $genre)
                <div class="inputCheck">
                    <input type="checkbox" class="checkbox" name="genres[]" value="{{ $genre['value'] }}" <?php
                        if (strpos($currentAnime['genres'], $genre['value']) !== false) {
                            echo "checked='checked'";
                        }?>/>
                    <span></span>
                    <div class="smallTitle">
                        {{ $genre['value'] }}
                    </div>
                </div>
                <!--/inputCheck-->
            @endforeach
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea" style="height: auto;">
            <div class="smallTitle">Position:</div>
            <div class="clear"></div>
            <div class="inputCheck">
                <input type="checkbox" class="checkbox" name="position1" value="recently" <?php
                    if ($currentAnime['position'] == "recently" or $currentAnime['position'] == "all") {
                        echo "checked='checked'";
                    } ?>/>
                <span></span>
                <div class="smallTitle">
                    Recently Added Anime
                </div>
            </div>
            <!--/inputCheck-->

            <div class="inputCheck">
                <input type="checkbox" class="checkbox" name="position2" value="featured" <?php
                    if ($currentAnime['position'] == "featured" or $currentAnime['position'] == "all") {
                        echo "checked='checked'";
                    } ?>/>
                <span></span>
                <div class="smallTitle">
                    Featured Anime
                </div>
            </div>
            <!--/inputCheck-->
        </div>
        <!--/inputTextarea-->

        <div class="inputUpload">
            <div class="smallTitle">Image:</div>
            <img src="{{ asset('images/' . $currentAnime['image']) }}" width="80" height="80"/>
            <input name="new_image" value="" type="file" class="file"/>
            <input name="image" value="{{ $currentAnime['image'] }}" type="hidden" class="file"/>
        </div>
        <!--/inputUpload-->

        <div class="inputTextarea">
            <div class="smallTitle">Plot Summary:</div>
            <textarea class="textarea" name="description">{{ $currentAnime['description'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Alternative Titles:</div>
            <textarea class="textarea" name="alternative_title">{{ $currentAnime['alternative_title'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Content:</div>
            <textarea class="textarea" name="content">{{ $currentAnime['content'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <input type="submit" id="submit" value="Update"/>

    </form>
@endsection