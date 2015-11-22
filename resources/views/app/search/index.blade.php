@include("app.layouts.head")
<div id="wrap">
    <div id="content">
        @include("app.layouts.banner")
        <div id="left_content">
            <div class="sections" id="genres">
                <div class="title">
                    Category Browser
                </div>
                <div class="content">
                    Select Anime Genre(s) from the boxes, and click "Search" button. For Example: You like Action,
                    Adventure and Martial Arts Anime, select the genres and go! Thats all.
                </div>
                <form method="get" action="{{ url('search') }}">
                    <div class="input_search">
                        <label>Anime </label>
                        <input type="text" name="title" placeholder="Search Anime Name"/>
                    </div>
                    <div class="block">
                        <div class="click">Scope</div>
                        <div class="cont">
                            <div class="label">Items containing:</div>
                            <div class="radio_block">
                                <input type="radio" name="scope" value="all" checked="checked"/>
                                <span></span>
                                <label><strong>All</strong> Terms</label>
                            </div>
                            <div class="radio_block">
                                <input type="radio" name="scope" value="any"/>
                                <span></span>
                                <label><strong>Any</strong> Terms</label>
                            </div>
                        </div>
                        <!--/cont-->
                    </div>
                    <!--/block-->
                    <div class="block">
                        <div class="click">Categories</div>
                        <div class="cont">
                            <div class="label">Genre(s):</div>
                            @foreach ($genres as $genre)
                                <div class="box_block">
                                    <input type="checkbox" name="genres[]"
                                           value="{{ $genre['value'] }}"/>
                                    <span></span>
                                    <label>{{ $genre['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!--/cont-->
                    </div>
                    <!--/block-->
                    <input type="submit" value="Search"/>
                    <input type="reset" value="Reset"/>
                </form>
                @if (isset($_GET['msg']) and $_GET['msg'] == 'f')
                    <div class="error">Error, you must type name or select genres</div>
                @endif
            </div>
            <!--/sections-->
        </div>
        <!--/left_content-->
        <div id="right_content">
            @include('app.layouts.left-sidebar')
        </div>
        @include('app.layouts.footer')