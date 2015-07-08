@include("layouts.head")
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="left_content">
            <div id="sec4" class="sections">
                <div class="title">Watch Anime Online / Subbed Anime List</div>
                <div class="filtering">
                    <a href="{{ url('anime-list-dubbed/0-9') }}">0-9</a>
                    <a href="{{ url('anime-list-dubbed/a') }}">A</a>
                    <a href="{{ url('anime-list-dubbed/b') }}">B</a>
                    <a href="{{ url('anime-list-dubbed/c') }}">C</a>
                    <a href="{{ url('anime-list-dubbed/d') }}">D</a>
                    <a href="{{ url('anime-list-dubbed/e') }}">E</a>
                    <a href="{{ url('anime-list-dubbed/f') }}">F</a>
                    <a href="{{ url('anime-list-dubbed/g') }}">G</a>
                    <a href="{{ url('anime-list-dubbed/h') }}">H</a>
                    <a href="{{ url('anime-list-dubbed/i') }}">I</a>
                    <a href="{{ url('anime-list-dubbed/j') }}">J</a>
                    <a href="{{ url('anime-list-dubbed/k') }}">K</a>
                    <a href="{{ url('anime-list-dubbed/l') }}">L</a>
                    <a href="{{ url('anime-list-dubbed/m') }}">M</a>
                    <a href="{{ url('anime-list-dubbed/n') }}">N</a>
                    <a href="{{ url('anime-list-dubbed/o') }}">O</a>
                    <a href="{{ url('anime-list-dubbed/p') }}">P</a>
                    <a href="{{ url('anime-list-dubbed/q') }}">Q</a>
                    <a href="{{ url('anime-list-dubbed/r') }}">R</a>
                    <a href="{{ url('anime-list-dubbed/s') }}">S</a>
                    <a href="{{ url('anime-list-dubbed/t') }}">T</a>
                    <a href="{{ url('anime-list-dubbed/u') }}">U</a>
                    <a href="{{ url('anime-list-dubbed/v') }}">V</a>
                    <a href="{{ url('anime-list-dubbed/w') }}">W</a>
                    <a href="{{ url('anime-list-dubbed/x') }}">X</a>
                    <a href="{{ url('anime-list-dubbed/y') }}">Y</a>
                    <a href="{{ url('anime-list-dubbed/z') }}">Z</a>
                </div>
                @foreach($animes as $anime)
                    <div class="block">
                        <a href="{{ url($options[3]['value'] . $anime['slug']) }}">
                            <img class="eimg" src="{{ asset('images/' . $anime['image']) }}">
                            <div class="sub_title">
                                {{
                                    (strlen($anime['title']) < 20) ?
                                    $anime['title'] :
                                    substr($anime['title'], 0, 20) . "..."
                                }}
                            </div>
                        </a>
                        <div class="rateContainor"
                             style="width: 220px; margin-top: 5px; float: left">
                            <div style="float: left;" value="{{ $anime['rating'] }}"
                                 id="{{ $anime['id'] }}" class="rateDiv"></div>
                            <div style="float: left; font-size: 8pt; width: 100%; display: none" id="hint{{ $anime['id'] }}"></div>
                            <div id="hint2{{ $anime['id'] }}" style="width: 100%; font-size: 8pt; float: left">
                                <?php echo "Average: " . sprintf("%.2f", $anime['rating']) .
                                        " ( " . $anime['votes'] . " votes)" ?>
                            </div>
                        </div>
                    </div>
                    <!--/block-->
                @endforeach
            </div>
            <!--/sections-->
        </div>
        <!--/left_content-->
        <div id="right_content">
            @include("layouts.sidebar")
        </div>
        @include("layouts.footer")
        <script>
            $(document).ready(function() {
                $(".rateDiv").hover(function () {
                    $("#hint" + $(this).attr("id")).show();
                    $("#hint2" + $(this).attr("id")).hide();
                });
                $(".rateDiv").mouseleave(function () {
                    $("#hint" + $(this).attr("id")).hide();
                    $("#hint2" + $(this).attr("id")).show();
                });
                $(".rateDiv").each(function (index, element) {
                    var thiss = $(element);
                    $(element).raty({
                        score: $(this).attr("value"),
                        starHalf: "{{ asset('images/star-half.png') }}",
                        starOff: "{{ asset('images/star-off.png') }}",
                        starOn: "{{ asset('images/star-on.png') }}",
                        starHover: "{{ asset('images/star-hover.png') }}",
                        width: 120,
                        target: $("#hint" + $(this).attr("id")),
                        click: function (score, evt) {
                            $("#hint" + $(this).attr("id")).show().text("Saving your vote...");
                            $("#hint2" + $(this).attr("id")).hide();
                            $.post("{{ url('rate/anime') }}", {
                                id: $(this).attr("id"),
                                rate: score
                            }, function (data) {
                                $("#hint" + thiss.attr("id")).show().text("your vote has been saved");
                                $("#hint2" + thiss.attr("id")).hide();
                                setTimeout(function () {
                                    $("#hint" + thiss.attr("id")).hide();
                                    $("#hint2" + thiss.attr("id")).show().text(data);
                                }, 1000);
                            });
                        },
                        targetKeep: true
                    });
                });
            });
        </script>