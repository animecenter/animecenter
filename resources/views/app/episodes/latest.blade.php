@include('app.layouts.head')
<div id="wrap">
    <div id="content">
        @include('app.layouts.banner')
        <div id="left_content">
            <div id="sec2" class="sections">
                <div class="title">Latest Episodes</div>
                @foreach ($episodes as $key => $episode)
                    <a href="{{ url($options[4]['value'] . $episode['slug']) }}">
                        <div class="block {{ $key }}">
                            <div class="main_title">
                                {{ (strlen($episode['anime']['title']) < 20) ?
                                $episode['anime']['title'] : substr($episode['anime']['title'],
                                        0, 20) . "..." }}
                            </div>
                            <?php
                            $sn = str_replace(':', '', str_replace(' ', '-', $episode['anime']['title']));
                            $snf = strtolower('thumb/' . $sn . '-thumb.jpg');
                            if (file_exists(base_path('public/' . $snf))) {
                                $image = $snf;
                            } else {
                                $image = thumbcreate($episode['subdub']);
                            }
                            ?>
                            <div class="img">
                                <img src="{{ $image ? asset($image) : asset('images/default-thumbnail.JPG') }}">
                                <div class="type <?php echo $episode['anime']['type2'];
                                if ($episode['raw'] !== null && $episode['subdub'] === null) {
                                    echo " raw";
                                }
                                ?>">
                                <?php
                                if ($episode['raw'] !== null && $episode['subdub'] === null) {
                                    echo "RAW";
                                } else {
                                    echo $episode['anime']['type2'];
                                }
                                ?>
                            </div>
                            @if ($episode['hd'] !== null)
                                    <div class="type mirror">HD</div>
                            @endif
                            </div>
                            <div class="play"></div>
                            <div class="sub_title">
                                <?php $tit = explode(" ", $episode['title']);
                                echo "Episode " . end($tit); ?>
                            </div>
                            <div class="times">
                                <?php
                                $first = new DateTime(date("Y-m-d H:i:s"));
                                $second = new DateTime(date("Y-m-d H:i:s", $episode['date']));
                                $diff = $first->diff($second);
                                $day = $diff->format('%d');
                                $hr = $diff->format('%h');
                                $months = $diff->format('%m');
                                if ($months <= 0) {
                                    if ($day <= 0) {
                                        if ($hr <= 0) {
                                            echo $diff->format('%i min') . " ago";
                                        } else {
                                            echo $diff->format('%h hours %i min') . " ago";
                                        }
                                    } else {
                                        echo $diff->format('%d day %h hours') . " ago";
                                    }
                                } else {
                                    if ($day <= 0) {
                                        if ($hr <= 0) {
                                            echo $diff->format('%m month %i min') . " ago";
                                        } else {
                                            echo $diff->format('%m month %h hours %i min') . " ago";
                                        }
                                    } else {
                                        if ($hr <= 0) {
                                            echo $diff->format('%m month %d day %i min') . " ago";
                                        } else {
                                            echo $diff->format('%m month %d day %h hours') . " ago";
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!--/block-->
                    </a>
                @endforeach

                <div class="pagination">
                    {!! $episodes->render() !!}
                </div>
                <!-- End .pagination -->
            </div>
            <!--/sections-->

        </div>
        <!--/left_content-->
        <div id="right_content">
            @include('app.layouts.sidebar')
        </div>
        @include('app.layouts.footer')
