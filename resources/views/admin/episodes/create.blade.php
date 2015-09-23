@extends('admin.index')
@section('content')
    <div class="bigTitle">Add New</div>
    <form action="{{ url('admin/episodes/create') }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputNOption" style="width: 100%;">
            <div class="smallTitle">Title:</div>
            <input name="title" value="{{ old('title') }}" type="text" class="textInput" style="width: 80%;"/>
        </div>
        <!--/inputNOption-->

        <div class="inputSelectarea">
            <div class="smallTitle">Anime:</div>
            <select class="select" name="anime_id">
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] }}" {{ ($currentAnime && $currentAnime['id'] === $anime['id']) ?
                        'selected=selected' : ((old('anime_id')) ? 'selected=selected' : '')
                        }}>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputNOption">
            <div class="smallTitle">Coming Date (Y-m-d H:i:s):</div>
            <input name="coming_date" value="{{ old('coming_date') }}" type="text" class="textInput" style=""/>
        </div>
        <!--/inputNOption-->

        <div class="clear"></div>
        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="show" value="1" {{ old('show') ? old('show') : '' }}/>
            <span></span>
            <div class="smallTitle">Show in home page</div>
        </div>
        <!--/inputCheck-->

        <div class="inputTextarea">
            <div class="smallTitle">Not Yet Aired:</div>
            <textarea class="textarea" name="not_yet_aired">{{ old('not_yet_aired') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 1:</div>
            <textarea class="textarea" name="mirror1">{{ old('mirror1') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">HD:</div>
            <textarea class="textarea" name="hd">{{ old('hd') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 2:</div>
            <textarea class="textarea" name="mirror2">{{ old('mirror2') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 3:</div>
            <textarea class="textarea" name="mirror3">{{ old('mirror3') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 4:</div>
            <textarea class="textarea" name="mirror4">{{ old('mirror4') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">RAW:</div>
            <textarea class="textarea" name="raw">{{ old('raw') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div>Backup: Use Mirror: 1 as primary.</div>
            <textarea class="textarea" name="subdub">{{ old('subdub') }}</textarea>
        </div>
        <!--/inputTextarea-->

        <input type="submit" id="submit" value="Add"/>

    </form>
@endsection