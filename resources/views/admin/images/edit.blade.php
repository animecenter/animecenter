@extends('admin.index')
@section('content')
    <div class="bigTitle">Add New - Do NOT include domain in the Link URL</div>
    <form action="{{ url('admin/images/edit/' . $image['id']) }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputNOption">
            <div class="smallTitle">Big Title:</div>
            <input name="bigtitle" value="{{ old('bigtitle') ? old('bigtitle') : $image['bigtitle'] }}"
                   type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Small Title:</div>
            <input name="smalltitle" value="{{ old('smalltitle') ? old('smalltitle') : $image['smalltitle'] }}"
                   type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Link: <br/></div>
            <input name="link" value="{{ old('link') ? old('link') : $image['link'] }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputUpload">
            <div class="smallTitle">Image File (640 * 360):</div>
            <img src="{{ asset("images/" . $image['file']) }}" width="80" height="80"/>
            <input name="new_file" value="{{ old('new_file') }}" type="file" class="file"/>
            <input name="file" value="{{ $image['file'] }}" type="hidden" class="file"/>
        </div>
        <!--/inputUpload-->

        <div class="inputTextarea">
            <div class="smallTitle">Description:</div>
            <textarea class="textarea" name="desc" rows="30">{{ old('desc') ? old('desc') : $image['desc'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <input type="submit" id="submit" value="Update"/>

    </form>
@endsection