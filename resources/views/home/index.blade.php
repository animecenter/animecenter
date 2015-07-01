@include('layouts.head')
@include('layouts.image-thumb')
<div id="wrap">
    <div id="content">
        <div id="left_content">
            <div id="slider" class="sections">
                @if($imagesList->count() > 0)
                    <div class="next"></div>
                    <div class="prev"></div>
                    <div class="slide">
                        <img alt='image' src="{{ asset("images/" . $imagesList[0]['file']) }}" width="650" height="360">
                        <div class="pagination">
                            <div class="content">
                                <div class="bigtitle">
                                    <?php echo $imagesList[0]['bigtitle']; ?>
                                </div>
                                <div class="smalltitle">
                                    <?php echo $imagesList[0]['smalltitle']; ?>
                                </div>
                                <div class="desc">
                                    <?php echo $imagesList[0]['desc']; ?>
                                </div>
                                <a href="<?php echo $imagesList[0]['link']; ?>" class="watch">Watch Now</a>
                            </div>
                            <!--/content-->
                            <div class="circle">
                                <?php for ($i = 0; $i < count($imagesList); $i++) { ?>
                                    <div class="cir <?php if ($i == 0) { echo 'active'; } ?>"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <!--/pagination-->
                    </div>
                    <!--/slide-->
                    <div class="images">
                        <?php $i = 0;
                        foreach ($imagesList as $image) { ?>
                            <img alt='image' class="<?php if ($i == 0) { echo 'active'; $i++; } ?>"
                                 src="{{ asset("images/" . $image['file']) }}"
                                 big-title="<?php echo $image['bigtitle']; ?>"
                                 small-title="<?php echo $image['smalltitle']; ?>"
                                 desc="<?php echo $image['desc']; ?>"
                                 link="<?php echo $image['link']; ?>">
                        <?php } ?>
                    </div>
                    <!--images-->
                @endif
            </div>
            <!--/sections-->
            <div id="sec2" class="sections">
                <div class="title">
                    New Episodes
                    <a style="float: right; color: #fff; background: #23B95D; padding: 2px 5px; border-radius: 3px; font-size: 14px; font-weight: bold;"
                       href="{{ url('latest-episodes') }}">
                        More
                    </a>
                </div>
                <?php
                $day1 = date("Y-m-d");
                $hr1 = date("H:i:s");
                $cp = 0;
                foreach ($episodesList as $episode) {
                    $cp = $cp + 1;
                    if ($cp == 4 or $cp == 8 or $cp == 12) {
                        $pad = 'end';
                    } else {
                        $pad = '';
                    }
                    $day2 = date("Y-m-d H:i:s");
                    $hr2 = date("Y-m-d H:i:s", strtotime($episode['date']));

                    $first = new DateTime("now");
                    $second = new DateTime(date("Y-m-d H:i:s", $episode['date']));

                    $diff = $first->diff($second);
                    $link = url($options[4]['value'] . $episode['slug']);
                    $image = thumbcreate($episode['subdub']);
                ?>
                <a href="<?php echo $link; ?>">
                    <div class="block <?php echo $pad ?>">
                        <div class="main_title">
                            <?php echo(strlen($episode->anime['title']) < 20) ? $episode->anime['title'] :
                                    substr($episode->anime['title'], 0, 20) . "..."; ?>
                        </div>
                        <?php
                        $sn = $episode->anime['title'];
                        $sn = str_replace(' ', '-', $sn);
                        $sn = strtolower(str_replace(':', '', $sn));
                        $snf = strtolower('public/thumb/' . $sn . '-thumb.jpg');
                        $path = base_path();
                        $check = base_path($snf);
                        if (file_exists($check)) {
                            $image = $snf;
                        }
                        ?>
                        <div class="img">
                            <img alt="image" src="{{ asset('thumb/' . $sn . '-thumb.jpg') }}" width="150" height="75">
                            <div class="type <?php echo $episode->anime['type2'];
                            if ($episode['raw'] != null and $episode['subdub'] == null) { echo " raw"; } ?>">
                                <?php if ($episode['raw'] != null and $episode['subdub'] == null) {
                                    echo "RAW";
                                } else {
                                    echo $episode->anime['type2'];
                                }
                                ?>
                            </div>
                            <?php if ($episode['hd'] != null) { ?>
                                <div class="type mirror">HD</div>
                            <?php } ?>
                        </div>
                        <div class="play"></div>
                        <div class="sub_title">
                            <?php $tit = explode(" ", $episode['title']); echo "Episode " . end($tit); ?>
                        </div>
                        <div class="times">
                            <?php
                            $day = $diff->format('%d') + ($diff->format('%y') * 365);
                            $hr = $diff->format('%H');
                            if ($day <= 0) {
                                if ($hr <= 0) {
                                    echo $diff->format('%i min') . " ago";
                                } else {
                                    echo $diff->format('%H hours %i min') . " ago";
                                }
                            } else {
                                echo $diff->format('%d day %H hours') . " ago";
                            }
                            ?>
                        </div>
                    </div>
                    <!--/block-->
                </a>
                <?php } ?>
            </div>
            <!--/sections-->

            <div id="sec3" class="sections">
                <div class="title">Recently Added Series
                    <a href="{{ url('latest-anime') }}"
                       style="float:right; color:#fff;background:#23B95D;padding:2px 5px;border-radius:3px;font-size:14px; font-weight:bold;">
                        More
                    </a>
                </div>
                <?php
                foreach ($animeList as $anime) {
                    $sublink = ($anime['type2'] == "dubbed") ? $options[3]['value'] : $options[2]['value'];
                    $link = url($sublink . $anime['slug']); ?>
                    <a href="<?php echo $link; ?>">
                        <div class="block">
                            <div class="img">
                                <img alt="image" src="<?php echo asset(get_thumbnail('images/'.$anime['image'], 127, 189)); ?>"
                                 width="127" height="189">
                            </div>
                            <div class="main_title">
                                <?php echo(strlen($anime['title']) < 10) ? $anime['title'] :
                                    substr($anime['title'], 0, 10) . "..."; ?>
                            </div>
                        </div>
                        <!--/block-->
                    </a>
                <?php } ?>
                <div class="pagination">
                    {!! $animeList->render() !!}
                </div>
                <!-- End .pagination -->
            </div>
            <!--sections-->
        </div>
        <!--/left_content-->
        <div id="right_content">
            @include("layouts.sidebar-home")
        </div>
    </div>
    <!--/content-->
    @include('layouts.footer')