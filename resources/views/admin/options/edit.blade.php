@extends('admin.index')
@section('content')
    <div class="bigTitle">Theme Options</div>
    <form action="{{ url('admin/options/edit') }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputTextarea">
            <div class="smallTitle">Title Right:</div>
            <textarea class="textarea" name="title">{{ $options[0]['value'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Text Right:</div>
            <textarea class="textarea" name="text">{{ $options[1]['value'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Subbed Link:</div>
            <textarea class="textarea" name="subbed">{{ $options[2]['value'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Dubbed Link:</div>
            <textarea class="textarea" name="dubbed">{{ $options[3]['value'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Episode Link:</div>
            <textarea class="textarea" name="episode">{{ $options[4]['value'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="clear"></div>
        <input type="submit" id="submit" value="Update"/>

    </form>
@endsection