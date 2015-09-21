$(document).ready(function (e) {
    if (location.hostname === 'localhost') {
        var URL = 'http://localhost/animecenter/';
    } else {
        var URL = 'http://' + location.hostname + '/';
    }
    $("#nav li").hover(function (e) {
        $(this).find("ul").show();
    });
    $("#nav li").mouseleave(function (e) {
        $(this).find("ul").hide();
    });

    $("#sec2 .block").hover(function (e) {
        $(this).find(".play").show();
    });
    $("#sec2 .block").mouseleave(function (e) {
        $(this).find(".play").hide();
    });
    $("#genres .radio_block input:checked").parent("div").find("span").addClass("active");
    $("#genres .radio_block span").click(function () {
        $("#genres .radio_block span").removeClass("active");
        $(this).addClass("active");
        $(this).parent("div").find("input").prop("checked", true);
    });
    $("#genres .box_block input:checked").parent("div").find("span").addClass("active");
    $("#genres .box_block span").click(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active").addClass("deactive");
            $(this).parent("div").find("input").prop("checked", false);
        }
        else if ($(this).hasClass("deactive")) {
            $(this).removeClass("deactive");
        }
        else {
            $(this).addClass("active");
            $(this).parent("div").find("input").prop("checked", true);
        }
    });


    /*Slider Code*/
    $("#slider").hover(function () {
        $(this).find(".next,.prev").show();
    });
    $("#slider").mouseleave(function () {
        $(this).find(".next,.prev").hide();
    });

    $("#slider .next, #slider .prev,#slider .cir").click(function (e) {
        if ($(this).hasClass("active")) {
        }
        else {
            clearInterval(interval);
            if ($(this).hasClass("next")) {
                if ($("#slider .images img.active").index() == $("#slider .images img:last").index()) {
                    var target = $("#slider .images img:first");
                }
                else {
                    var target = $("#slider .images img.active").next();
                }
            }//end class next
            else if ($(this).hasClass("prev")) {
                if ($("#slider .images img.active").index() == $("#slider .images img:first").index()) {
                    var target = $("#slider .images img:last");
                }
                else {
                    var target = $("#slider .images img.active").prev();
                }
            }//end class prev
            else if ($(this).hasClass("cir")) {
                var target = $("#slider .images img:eq(" + $(this).index() + ")");
            }//end class cir
            var bigtitle = target.attr("big-title");
            var smalltitle = target.attr("small-title");
            var img = target.attr("src");
            var desc = target.attr("desc");
            var links = target.attr("link");
            $("#slider .images img").removeClass("active");
            target.addClass("active");
            $("#slider .circle .cir").removeClass("active");
            $("#slider .circle .cir:eq(" + target.index() + ")").addClass("active");
            $("#slider .slide").css("background-image", "url(" + img + ")");
            $("#slider .slide .content").fadeOut(500);
            $("#slider .slide img").fadeOut(500, function () {
                $("#slider .slide img").attr("src", img).show();
                $("#slider .slide .bigtitle").text(bigtitle);
                $("#slider .slide .smalltitle").text(smalltitle);
                $("#slider .slide .desc").text(desc);
                $("#slider .slide a.watch").attr("href", links);
                $("#slider .slide .content").fadeIn();
                interval = setInterval("auto_slide()", 10000);
            });
        }
    });

    var url = "http://www.animecenter.tv/";
    $(".date").datepicker({
        changeMonth: true,
        changeYear: true
    });
    var current = new Date().getFullYear();
    var start = current - 80;
    $(".date").datepicker("option", "yearRange", start + ":" + current);
    $(".date").datepicker("option", "dateFormat", "yy-mm-d");
    var vvalue = $(".date").attr("vvalue");
    if (typeof vvalue == "undefined") {
        vvalue = '';
    }
    if (vvalue.length > 0) {
        $(".date").datepicker("setDate", vvalue);
    }

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $("#header").css("padding", '5px 0');
            $("#logo img").css({"height": "30px", "width": "180px", "margin-top": '5px'});
            $("#logo .text").hide();
            $("#search,#nav").css({"margin-top": '5px'});
        }
        else if ($(this).scrollTop() <= 50) {
            $("#header").css("padding", '10px 0 20px');
            $("#logo img").css({"height": "38px", "width": "260px", "margin-top": 'auto'});
            $("#logo .text").show();
            $("#search,#nav").css({"margin-top": '15px'});
        }
    });

    $("#genres .clicks").click(function (e) {
        var cont = $(this).parent("div").find(".cont");
        var thiss = $(this);
        if (cont.is(":visible")) {
            cont.slideUp();
            thiss.parent("div").css({'border-width': '1px 0 0 0'});
            thiss.addClass("deactive");
        }
        else {
            cont.slideDown();
            thiss.parent("div").css({'border-width': '1px 1px 1px 1px'});
            thiss.removeClass("deactive");
        }
    });
    $("#genres input[type='reset']").click(function () {
        $("#genres .box_block span").removeClass("active").removeClass("deactive");
        $("#genres .radio_block span").removeClass("active");
        $("#genres .radio_block:first span").addClass("active");
    });

    $("select.member-select").click(function (e) {
        event.preventDefault();
        if ($(this).hasClass("episodes")) {
            var value = $(this).val();
            if (value !== 0) {
                if (value.indexOf("automatically") >= 0) {
                    var num = prompt("Type numbers of Episodes to be added");
                    var id = $(this).find("option:selected").attr("val");
                    $.post(value, { id: id, num: num }, function (data) {
                        location.reload();
                    });
                } else if (value.indexOf("create") >= 0) {
                    window.location.href = value;
                }
            }
        } else {
            var value = $(this).val();
            if (value !== 0) {
                window.location.href = value;
            }
        }
    });

    $(".report_vid").click(function (e) {
        var id = $(this).attr("val");
        $.post(url + "report", {id: id}, function (data) {
            alert("Thanks");
            location.reload();
        });
    });

});
var interval = setInterval("auto_slide()", 10000);

function auto_slide() {
    if ($("#slider .images img.active").index() == $("#slider .images img:last").index()) {
        var target = $("#slider .images img:first");
    }
    else {
        var target = $("#slider .images img.active").next();
    }
    var bigtitle = target.attr("big-title");
    var smalltitle = target.attr("small-title");
    var img = target.attr("src");
    var desc = target.attr("desc");
    var links = target.attr("link");
    $("#slider .images img").removeClass("active");
    target.addClass("active");
    $("#slider .circle .cir").removeClass("active");
    $("#slider .circle .cir:eq(" + target.index() + ")").addClass("active");
    $("#slider .slide").css("background-image", "url(" + img + ")");
    $("#slider .slide .content").fadeOut(500);
    $("#slider .slide img").fadeOut(500, function () {
        $("#slider .slide img").attr("src", img).show();
        $("#slider .slide .bigtitle").text(bigtitle);
        $("#slider .slide .smalltitle").text(smalltitle);
        $("#slider .slide .desc").text(desc);
        $("#slider .slide a.watch").attr("href", links);
        $("#slider .slide .content").fadeIn();
    });
}