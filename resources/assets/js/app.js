$(document).ready(function () {

    var url = 'http://www.animecenter.tv/';

    $('#sec2').find('.block').on('mouseenter mouseleave', function (event) {
        if (event.name == 'mouseenter') {
            $(this).find('.play').show();
        } else {
            $(this).find('.play').hide();
        }
    });

    var genres = $('#genres');
    genres.find('.radio_block input:checked').parent('div').find('span').addClass('active');

    genres.find('.radio_block span').click(function () {
        genres.find('.radio_block span').removeClass('active');
        $(this).addClass('active');
        $(this).parent('div').find('input').prop('checked', true);
    });

    genres.find('.box_block input:checked').parent('div').find('span').addClass('active');

    genres.find('.box_block span').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active').addClass('deactive');
            $(this).parent('div').find('input').prop('checked', false);
        }
        else if ($(this).hasClass('deactive')) {
            $(this).removeClass('deactive');
        }
        else {
            $(this).addClass('active');
            $(this).parent('div').find('input').prop('checked', true);
        }
    });
    genres.find('.clicks').click(function () {
        var cont = $(this).parent('div').find('.cont');
        var $this = $(this);
        if (cont.is(':visible')) {
            cont.slideUp();
            $this.parent('div').css({'border-width': '1px 0 0 0'});
            $this.addClass('deactive');
        }
        else {
            cont.slideDown();
            $this.parent('div').css({'border-width': '1px 1px 1px 1px'});
            $this.removeClass('deactive');
        }
    });
    genres.find('input[type="reset"]').click(function () {
        genres.find('.box_block span').removeClass('active').removeClass('deactive');
        genres.find('.radio_block span').removeClass('active');
        genres.find('.radio_block:first span').addClass('active');
    });

    $('select.member-select').click(function () {
        event.preventDefault();
        var value = $(this).val();
        if ($(this).hasClass('episodes')) {
            if (value !== 0) {
                if (value.indexOf('automatically') >= 0) {
                    var num = prompt('Type numbers of Episodes to be added');
                    var id = $(this).find('option:selected').attr('val');
                    $.post(value, { id: id, num: num }, function () {
                        location.reload();
                    });
                } else if (value.indexOf('create') >= 0) {
                    window.location.href = value;
                }
            }
        } else {
            if (value !== 0) {
                window.location.href = value;
            }
        }
    });

    $('.report_vid').click(function () {
        var id = $(this).attr('val');
        $.post(url + 'report', {id: id}, function () {
            alert('Thanks');
            location.reload();
        });
    });

});