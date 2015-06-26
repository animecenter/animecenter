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
                                <a href="<?php echo $link; ?>">
                                    <?php echo $bottomPage['title']; ?>
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
                                <a href="<?php echo $link; ?>">
                                    <?php echo $bottomPage['title']; ?>
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
                                <a href="<?php echo $link; ?>">
                                    <?php echo $bottomPage['title']; ?>
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
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-47886553-1', 'animecenter.tv');
            ga('send', 'pageview');
        </script>

    </body>
</html>