@extends('admin.index')
@section('content')
    <div class="bigTitle">Add New</div>
    <form action="{{ url('admin/pages/create') }}" method="post">

        {!! csrf_field() !!}

        <div class="inputNOption">
            <div class="smallTitle">Title:</div>
            <input name="title" value="{{ old('title') }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputNOption">
            <div class="smallTitle">Order:</div>
            <input name="order" value="{{ old('order') }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <div class="inputSelectarea">
            <div class="smallTitle">Position:</div>
            <select class="select" name="position">
                <option value="top">Top</option>
                <option value="bottom1">Bottom 1</option>
                <option value="bottom2">Bottom 2</option>
                <option value="bottom3">Bottom 3</option>
            </select>
            <input value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Content:</div>
            <textarea class="textarea" name="content" rows="30">{{ old('content') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputNOption">
            <div class="smallTitle">Link:</div>
            <input name="link" value="{{ old('link') }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->

        <input type="submit" id="submit" value="Add"/>

    </form>
@endsection