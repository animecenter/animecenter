@extends('dashboard.layouts.main')
@section('content')
    <div class="bigTitle">Add New - Do NOT include domain in the Link URL</div>
    <form action="{{ url('admin/images/create') }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputNOption">
            <div class="smallTitle">Big Title:</div>
            <input name="bigtitle" value="{{ old('bigtitle') }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Small Title:</div>
            <input name="smalltitle" value="{{ old('smalltitle') }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Link:</div>
            <input name="link" value="{{ old('link') }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputUpload">
            <div class="smallTitle">Image File (640 * 360):</div>
            <input name="file" value="{{ old('file') }}" type="file" class="file"/>
        </div>
        <!--/inputUpload-->

        <div class="inputTextarea">
            <div class="smallTitle">Description:</div>
            <textarea class="textarea" name="desc" rows="30">{{ old('desc') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <input type="submit" id="submit" value="Add"/>

    </form>
@endsection