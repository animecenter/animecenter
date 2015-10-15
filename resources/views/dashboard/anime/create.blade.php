@extends('dashboard.layouts.index')
@section('content')
    <div class="bigTitle">Add New</div>
    <form action="{{ url('admin/anime/create') }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputNOption" style="width: 100%;">
            <div class="smallTitle">Title:</div>
            <input name="title" value="{{ old('title') }}" type="text" class="textInput" style="width: 80%;"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Episodes:</div>
            <input name="episodes" value="{{ old('episodes') }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Type:</div>
            <input name="type" value="{{ old('type') }}" type="text" class="textInput"/>
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
            <input name="age" value="{{ old('age') }}" type="text" class="textInput"/>
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
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}">{{ $anime['title'] }}</option>
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
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}">{{ $anime['title'] }}</option>
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
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}">{{ $anime['title'] }}</option>
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
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}">{{ $anime['title'] }}</option>
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
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}">{{ $anime['title'] }}</option>
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
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}">{{ $anime['title'] }}</option>
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
                    <option value="{{ $anime['id'] . ',' . $anime['title'] }}">{{ $anime['title'] }}</option>
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
                    <input type="checkbox" class="checkbox" name="genres[]" value="{{ $genre['value'] }}"/>
                    <span></span>
                    <div class="smallTitle">{{ $genre['value'] }}</div>
                </div><!--/inputCheck-->
            @endforeach
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea" style="height: auto;">
            <div class="smallTitle">Position:</div>
            <div class="clear"></div>
            <div class="inputCheck">
                <input type="checkbox" class="checkbox" name="position1" value="recently"/>
                <span></span>
                <div class="smallTitle">Recently Added Anime</div>
            </div>
            <!--/inputCheck-->
            <div class="inputCheck">
                <input type="checkbox" class="checkbox" name="position2" value="featured"/>
                <span></span>
                <div class="smallTitle">Featured Anime</div>
            </div>
            <!--/inputCheck-->
        </div>
        <!--/inputTextarea-->

        <div class="inputUpload">
            <div class="smallTitle">Anime Image:</div>
            <input name="image" value="{{ old('image') }}" type="file" class="file"/>
        </div>
        <!--/inputUpload-->

        <div class="inputTextarea">
            <div class="smallTitle">Plot Summary:</div>
            <textarea class="textarea" name="description">{{ old('description') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Alternative Titles:</div>
            <textarea class="textarea" name="alternative_title">{{ old('alternative') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Content:</div>
            <textarea class="textarea" name="content">{{ old('content') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <input type="submit" id="submit" value="Add"/>

    </form>
@endsection