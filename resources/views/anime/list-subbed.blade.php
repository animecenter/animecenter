@include("layouts.head")
<div id="wrap">
    <div id="content">
        @include("layouts.banner")
        <div id="left_content">
            <div id="sec4" class="sections">
                <div class="title">Watch Anime Online / Subbed Anime List</div>
                <div class="filtering">
                    <a href="{{ url('anime-list/0-9') }}">0-9</a>
                    <a href="{{ url('anime-list/a') }}">A</a>
                    <a href="{{ url('anime-list/b') }}">B</a>
                    <a href="{{ url('anime-list/c') }}">C</a>
                    <a href="{{ url('anime-list/d') }}">D</a>
                    <a href="{{ url('anime-list/e') }}">E</a>
                    <a href="{{ url('anime-list/f') }}">F</a>
                    <a href="{{ url('anime-list/g') }}">G</a>
                    <a href="{{ url('anime-list/h') }}">H</a>
                    <a href="{{ url('anime-list/i') }}">I</a>
                    <a href="{{ url('anime-list/j') }}">J</a>
                    <a href="{{ url('anime-list/k') }}">K</a>
                    <a href="{{ url('anime-list/l') }}">L</a>
                    <a href="{{ url('anime-list/m') }}">M</a>
                    <a href="{{ url('anime-list/n') }}">N</a>
                    <a href="{{ url('anime-list/o') }}">O</a>
                    <a href="{{ url('anime-list/p') }}">P</a>
                    <a href="{{ url('anime-list/q') }}">Q</a>
                    <a href="{{ url('anime-list/r') }}">R</a>
                    <a href="{{ url('anime-list/s') }}">S</a>
                    <a href="{{ url('anime-list/t') }}">T</a>
                    <a href="{{ url('anime-list/u') }}">U</a>
                    <a href="{{ url('anime-list/v') }}">V</a>
                    <a href="{{ url('anime-list/w') }}">W</a>
                    <a href="{{ url('anime-list/x') }}">X</a>
                    <a href="{{ url('anime-list/y') }}">Y</a>
                    <a href="{{ url('anime-list/z') }}">Z</a>
                </div>
                @foreach($animes as $anime)
                    <div class="block">
                        <a href="{{ url($options[2]['value'] . $anime['slug']) }}">
                            <img class="eimg" src="{{ asset('images/' . $anime['image']) }}">
                            <div class="sub_title">
                                <?php echo(strlen($anime['title']) < 20) ? $anime['title'] :
                                        substr($anime['title'], 0, 20) . "..."; ?>
                            </div>
                        </a>
                        <div class="rateContainor" style="width: 220px; margin-top: 5px; float: left">
                            <div style="float: left;" value="{{ $anime['rating'] }}"
                                 id="{{ $anime['id'] }}" class="rateDiv"></div>
                            <div style="float: left; font-size: 8pt; width: 100%; display: none"
                                 id="hint{{ $anime['id'] }}"></div>
                            <div id="hint2{{ $anime['id'] }}"
                                style="width: 100%; font-size: 8pt; float: left">
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
                            $.post("{{ url('rate-up') }}", {
                                sid: $(this).attr("id"),
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