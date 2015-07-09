@extends('admin.index')
@section('content')
    <div class="bigTitle">Edit Episode</div>
    <form action="{{ url('admin/episodes/edit/' . $episode['id']) }}" method="post" enctype="multipart/form-data">

        {!! csrf_field() !!}

        <div class="inputNOption" style="width: 100%;">
            <div class="smallTitle">Title:</div>
            <input name="title" value="{{ old('title') ? old('title') : $episode['title'] }}" type="text"
                   class="textInput" style="width: 80%;"/>
        </div>
        <!--/inputNoption-->

        <div class="inputSelectarea">
            <div class="smallTitle">Anime:</div>
            <select class="select" name="anime_id">
                @foreach ($animes as $anime)
                    <option value="{{ $anime['id'] }}" {{ $episode['anime_id'] == $anime['id'] ?
                        'selected="selected"' : '' }}>{{ $anime['title'] }}</option>
                @endforeach
            </select>
            <input name="" value="" type="text" class="textInput2"/>
        </div>
        <!--/inputSelectarea-->

        <div class="inputNOption" style="">
            <div class="smallTitle">
                Coming Date: <a href="#" class="prevBT set_date" val="<?php echo
                    date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . "+7 day")); ?>">
                    Set Date
                </a>
            </div>
            <input name="coming_date" value="{{ old('coming_date') ? old('coming_date') : $episode['coming_date'] }}"
                   type="text" class="textInput"/>
        </div>
        <!--/inputNoption-->

        <div class="clear"></div>

        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="show" value="1" {{ ($episode['show'] == 1) or old('show') ?
                'checked="checked"' : '' }}/>
            <span></span>
            <div class="smallTitle">Show in home page</div>
        </div>
        <!--/inputCheck-->

        <div class="inputCheck">
            <input type="checkbox" class="checkbox" name="reset" value="1" {{ ($episode['reset'] == 1) or old('reset') ?
                'checked="checked"' : '' }}/>
            <span></span>
            <div class="smallTitle">Reset time</div>
        </div>
        <!--/inputCheck-->

        <div class="inputTextarea">
            <div class="smallTitle">Not Yet Aired Episode Info:</div>
            <textarea class="textarea" name="not_yet_aired">{{ old('not_yet_aired') ? old('not_yet_aired') :
                $episode['not_yet_aired'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 1:</div>
            <textarea class="textarea" name="mirror1">{{ old('mirror1') ?
                old('mirror1') : $episode['mirror1'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">HD:</div>
            <textarea class="textarea" name="hd">{{ old('hd') ?
            old('hd') : $episode['hd'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 2:</div>
            <textarea class="textarea" name="mirror2">{{ old('mirror2') ?
            old('mirror2') : $episode['mirror2'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 3:</div>
            <textarea class="textarea" name="mirror3">{{ old('mirror3') ?
            old('mirror3') : $episode['mirror3'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">Mirror 4:</div>
            <textarea class="textarea" name="mirror4">{{ old('mirror4') ?
            old('mirror4') : $episode['mirror4'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div class="smallTitle">RAW:</div>
            <textarea class="textarea" name="raw">{{ old('raw') ? old('raw') : $episode['raw'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="inputTextarea">
            <div>Backup - Use Mirror: 1 as primary.</div>
            <textarea class="textarea" name="subdub">{{ old('subdub') ? old('subdub') : $episode['subdub'] }}</textarea>
        </div>
        <!--/inputTextarea-->

        <div class="clear"></div>
        <input type="submit" id="submit" value="Update"/>

    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(".set_date").click(function () {
                $(this).parent("div").parent("div").find("input[type='text']").val($(this).attr("val"));
            });
        });
    </script>
@endsection