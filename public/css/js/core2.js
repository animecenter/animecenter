$(document).ready(function (e) {
    if (location.hostname === 'localhost') {
        var URL = 'http://localhost/animecenter/';
    } else {
        var URL = 'http://' + location.hostname + '/';
    }
    $("#vid-close").click(function (e) {
        $("#popup-vid").remove();
    });
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

    $("#slider .next,#slider .prev,#slider .cir").click(function (e) {
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
        }//end else hasClass
    });
    /* ---------------- Slider code -------------------------   */

});
/*setTimeout(function(){$('.embbed_content .loading').hide();$('.embbed_content .conn').show();},10000);*/
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
}//end function
