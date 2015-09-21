            <div id="footer">
                <div class="menu">
                    <div class="title">AnimeCenter</div>
                    <ul>
                        <?php
                        foreach ($bottomPagesList as $bottomPage) {
                            if (isset($bottomPage['link']) and $bottomPage['link'] != null) {
                                $link = $bottomPage['link'];
                            } else {
                                $link = $url . "page.php?page_id=" . $bottomPage['id'];
                            } ?>
                            <li>
                                <a href="{{ url($link) }}">
                                    {{ $bottomPage['title'] }}
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!--/menu-->

                <div class="menu">
                    <div class="title">Popular Anime Series</div>
                    <ul>
                        <?php
                        foreach ($bottomPagesList2 as $bottomPage) {
                            if (isset($bottomPage['link']) and $bottomPage['link'] != null) {
                                $link = $bottomPage['link'];
                            } else {
                                $link = $url . "page.php?page_id=" . $bottomPage['id'];
                            }
                        ?>
                            <li>
                                <a href="{{ url($link) }}">
                                    {{ $bottomPage['title'] }}
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!--/menu-->

                <div class="menu">
                    <div class="title">Affiliates</div>
                    <ul>
                        <?php
                        foreach ($bottomPagesList3 as $bottomPage) {
                            if (isset($bottomPage['link']) and $bottomPage['link'] != null) {
                                $link = $bottomPage['link'];
                            } else {
                                $link = $url . "page.php?page_id=" . $bottomPage['id'];
                            } ?>
                            <li>
                                <a href="{{ url($link) }}">
                                    {{ $bottomPage['title'] }}
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!--/menu-->
            </div>
            <!--/footer-->
        </div>
        <!--wrap-->

        <script type="text/javascript">
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-47886553-1', 'auto');
            ga('send', 'pageview');
        </script>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script type="text/javascript" src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.raty.min.js') }}"></script>
        @yield('scripts')

    </body>
</html>