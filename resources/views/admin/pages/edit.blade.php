@extends('admin.index')
@section('content')
    <div class="bigTitle">Edit Page</div>
    <form action="{{ url('admin/pages/edit/' . $page['id']) }}" method="post">

        {!! csrf_field() !!}
    
        <div class="inputNOption">
            <div class="smallTitle">Title:</div>
            <input name="title" value="{{ $page['title'] }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->
    
        <div class="inputNOption">
            <div class="smallTitle">Order:</div>
            <input name="order" value="{{ $page['order'] }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->
    
        <div class="inputSelectarea">
            <div class="smallTitle">Position:</div>
            <select class="select" name="position">
                <option value="top">Top</option>
                <option value="bottom1" {{ $page['position'] == "bottom1" ? "selected='selected'" : '' }}>Bottom 1</option>
                <option value="bottom2" {{ $page['position'] == "bottom2" ? "selected='selected'" : '' }}>Bottom 2</option>
                <option value="bottom3" {{ $page['position'] == "bottom3" ? "selected='selected'" : '' }}>Bottom 3</option>
            </select>
            <input value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->
    
        <div class="inputTextarea">
            <div class="smallTitle">Content:</div>
            <textarea class="textarea" name="content" rows="30">{{ $page['content'] }}</textarea>
        </div>
        <!--/inputTextarea-->
    
        <div class="inputNOption">
            <div class="smallTitle">Link:</div>
            <input name="link" value="{{ $page['link'] }}" type="text" class="textInput"/>
        </div>
        <!--/inputNOption-->
    
        <input type="submit" id="submit" value="Update"/>
    
    </form>
@endsection