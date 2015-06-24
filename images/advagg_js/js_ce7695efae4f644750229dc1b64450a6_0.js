/* Source and licensing information for the line(s) below can be found at http://beta.animecenter.tv/modules/views/js/ajax_view.js. */
Drupal.Views.Ajax = Drupal.Views.Ajax || {};
Drupal.Views.Ajax.ajaxViewResponse = function (target, response) {
    if (response.debug)alert(response.debug);
    var $view = $(target);
    if (response.status && response.display) {
        var $newView = $(response.display);
        $view.replaceWith($newView);
        $view = $newView;
        Drupal.attachBehaviors($view.parent())
    }
    ;
    if (response.messages)$view.find('.views-messages').remove().end().prepend(response.messages)
};
Drupal.behaviors.ViewsAjaxView = function () {
    if (Drupal.settings && Drupal.settings.views && Drupal.settings.views.ajaxViews) {
        var ajax_path = Drupal.settings.views.ajax_path;
        if (ajax_path.constructor.toString().indexOf("Array") != -1)ajax_path = ajax_path[0];
        $.each(Drupal.settings.views.ajaxViews, function (i, settings) {
            if (settings.view_dom_id) {
                var view = '.view-dom-id-' + settings.view_dom_id;
                if (!$(view).size())view = '.view-id-' + settings.view_name + '.view-display-id-' + settings.view_display_id
            }
            ;
            $('form#views-exposed-form-' + settings.view_name.replace(/_/g, '-') + '-' + settings.view_display_id.replace(/_/g, '-')).filter(':not(.views-processed)').each(function () {
                $('input[name=q]', this).remove();
                var form = this;
                $.each(settings, function (key, setting) {
                    $(form).append('<input type="hidden" name="' + key + '" value="' + setting + '"/>')
                })
            }).addClass('views-processed').submit(function () {
                $('input[type=submit], button', this).after('<span class="views-throbbing">&nbsp</span>');
                var object = this;
                $(this).ajaxSubmit({
                    url: ajax_path, type: 'GET', success: function (response) {
                        if (response.__callbacks) {
                            $.each(response.__callbacks, function (i, callback) {
                                eval(callback)(view, response)
                            });
                            $('.views-throbbing', object).remove()
                        }
                    }, error: function (xhr) {
                        Drupal.Views.Ajax.handleErrors(xhr, ajax_path);
                        $('.views-throbbing', object).remove()
                    }, dataType: 'json'
                });
                return false
            });
            $(view).filter(':not(.views-processed)').filter(function () {
                return !$(this).parents('.view').size()
            }).each(function () {
                var target = this;
                $(this).addClass('views-processed').find('ul.pager > li > a, th.views-field a, .attachment .views-summary a').each(function () {
                    var viewData = {js: 1};
                    $.extend(viewData, Drupal.Views.parseQueryString($(this).attr('href')), Drupal.Views.parseViewArgs($(this).attr('href'), settings.view_base_path), settings);
                    $(this).click(function () {
                        $.extend(viewData, Drupal.Views.parseViewArgs($(this).attr('href'), settings.view_base_path));
                        $(this).addClass('views-throbbing');
                        $.ajax({
                            url: ajax_path, type: 'GET', data: viewData, success: function (response) {
                                $(this).removeClass('views-throbbing');
                                var offset = $(target).offset(), scrollTarget = target;
                                while ($(scrollTarget).scrollTop() == 0 && $(scrollTarget).parent())scrollTarget = $(scrollTarget).parent();
                                if (offset.top - 10 < $(scrollTarget).scrollTop())$(scrollTarget).animate({scrollTop: (offset.top - 10)}, 500);
                                if (response.__callbacks)$.each(response.__callbacks, function (i, callback) {
                                    eval(callback)(target, response)
                                })
                            }, error: function (xhr) {
                                $(this).removeClass('views-throbbing');
                                Drupal.Views.Ajax.handleErrors(xhr, ajax_path)
                            }, dataType: 'json'
                        });
                        return false
                    })
                })
            })
        })
    }
};
/* Source and licensing information for the above line(s) can be found at http://beta.animecenter.tv/modules/views/js/ajax_view.js. */
