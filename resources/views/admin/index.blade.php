<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}" type="text/css"/>
        <link href="http://fonts.googleapis.com/css?family=Condiment" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Port+Lligat+Sans" rel="stylesheet" type="text/css">
        <!--This Include all Javascript Core Functions-->
        <title>Watch Anime Online Free | Anime Shows, Movies and OVAs in English Subbed & Dubbed</title>
    </head>
    <body>
        <div id="wrap">
            <div id="header">
                <div id="info_login">
                    <div id="info_u">
                        Welcome {{ $user['username'] }}
                        <a href="{{ url('logout') }}">log out</a>
                    </div>
                </div>
                <!--/info_login-->
            </div>
            <!--/header-->

            <div id="content">
                <div id="leftContent">
                    <div id="navBarR">
                        <ul>
                            <li class="parent">
                                <a href="{{ url('admin') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="parent">
                                <a href="{{ url('admin/anime') }}">Anime</a>
                                <ul>
                                    <li class="child">
                                        <a href="{{ url('admin/anime/create') }}">
                                            Add Anime
                                        </a>
                                    </li>
                                    <li class="child">
                                        <a href="{{ url('admin/anime') }}">
                                            All Anime
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="parent">
                                <a href="{{ url('admin/episodes') }}" onclick="return false">
                                    Episodes
                                </a>
                                <ul>
                                    <li class="child">
                                        <a href="{{ url('admin/episodes/create') }}">
                                            Add Episode
                                        </a>
                                    </li>
                                    <li class="child">
                                        <a href="{{ url('admin/episodes') }}">
                                            All Episodes
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="parent">
                                <a href="{{ url('admin/pages') }}" onclick="return false">
                                    Pages
                                </a>
                                <ul>
                                    <li class="child">
                                        <a href="{{ url('admin/pages/create') }}">
                                            Add Page
                                        </a>
                                    </li>
                                    <li class="child">
                                        <a href="{{ url('admin/pages') }}">
                                            All Pages
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="parent">
                                <a href="{{ url('admin/images') }}" onclick="return false">
                                    Gallery
                                </a>
                                <ul>
                                    <li class="child">
                                        <a href="{{ url('admin/images/create') }}">
                                            Add Image
                                        </a>
                                    </li>
                                    <li class="child">
                                        <a href="{{ url('admin/images') }}">
                                            All Images
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="parent">
                                <a href="{{ url('admin/options/edit') }}">
                                    Options
                                </a>
                            </li>
                            <li class="parent">
                                <a href="{{ url('admin/purge-cache') }}">
                                    Purge Cache
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/navBarR-->
                </div>
                <!--/leftContent-->

                <div id="rightContent">
                    @yield('content')
                </div>
                <!--/rightContent-->
            </div>
            <!--/content-->

            <div id="footer">
                <div id="copy">ACTV V2</div>
            </div>
            <!--/footer-->
        </div>
        <!--/wrap-->

        <script src="{{ asset('js/jquery-1.9.1.js') }}"></script>

        <script>
            $(document).ready(function () {
                $("select.select").change(function () {
                    var vv = $(this).find("option:selected").text();
                    $(this).parent("div").children("input").val(vv);
                });
                $(".inputSelectarea input.textInput2").each(function () {
                    if ($(this).val() == '') {
                        var vv = $(this).parent("div").children("select").find("option:selected").text();
                        $(this).val(vv);
                    }
                });

                $(".inputCheck").each(function (index, element) {
                    var v = $(this).children("input").prop("checked");
                    if (v) {
                        $(this).children("span").css({
                            'background': "url({{ asset('css/img/checked.jpg') }})"
                        });
                    }
                    else {
                        $(this).children("span").css({
                            'background': "url({{ asset('css/img/check.jpg') }})"
                        });
                    }
                });

                $(".inputCheck span").click(function () {
                    if (!$(this).parent('div').children('input').prop('checked')) {
                        $(this).css({
                            'background': "url({{ asset('css/img/checked.jpg') }})"
                        });
                        $(this).parent('div').children('input').prop("checked", true);
                    }
                    else {
                        $(this).css({
                            'background': "url({{ asset('css/img/check.jpg') }})"
                        });
                        $(this).parent('div').children('input').removeAttr('checked');
                    }
                });
                $(".set_date").click(function () {
                    $(this).parent("div").parent("div").find("input[type='text']").val($(this).attr("val"));
                });
            });
        </script>
        @yield('scripts')
    </body>
</html>
