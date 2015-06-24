/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/views/js/dependent.js. */
Drupal.Views = Drupal.Views || {};
Drupal.Views.dependent = {bindings: {}, activeBindings: {}, activeTriggers: []};
Drupal.Views.dependent.inArray = function (array, search_term) {
    var i = array.length;
    if (i > 0)do {
        if (array[i] == search_term)return true
    } while (i--);
    return false
};
Drupal.Views.dependent.autoAttach = function () {
    for (i in Drupal.Views.dependent.activeTriggers)jQuery(Drupal.Views.dependent.activeTriggers[i]).unbind('change');
    Drupal.Views.dependent.activeTriggers = [];
    Drupal.Views.dependent.activeBindings = {};
    Drupal.Views.dependent.bindings = {};
    if (!Drupal.settings.viewsAjax)return;
    for (id in Drupal.settings.viewsAjax.formRelationships) {
        Drupal.Views.dependent.activeBindings[id] = 0;
        for (bind_id in Drupal.settings.viewsAjax.formRelationships[id].values) {
            if (!Drupal.Views.dependent.bindings[bind_id])Drupal.Views.dependent.bindings[bind_id] = [];
            Drupal.Views.dependent.bindings[bind_id].push(id);
            if (bind_id.substring(0, 6) == 'radio:') {
                var trigger_id = "input[name='" + bind_id.substring(6) + "']"
            } else var trigger_id = '#' + bind_id;
            Drupal.Views.dependent.activeTriggers.push(trigger_id);
            if (jQuery(trigger_id).attr('type') == 'checkbox')$(trigger_id).parent().addClass('hidden-options');
            var getValue = function (item, trigger) {
                if (item.substring(0, 6) == 'radio:') {
                    var val = jQuery(trigger + ':checked').val()
                } else switch (jQuery(trigger).attr('type')) {
                    case'checkbox':
                        var val = jQuery(trigger).attr('checked') || 0;
                        if (val) {
                            $(trigger).parent().removeClass('hidden-options').addClass('expanded-options')
                        } else $(trigger).parent().removeClass('expanded-options').addClass('hidden-options');
                        break;
                    default:
                        var val = jQuery(trigger).val()
                }
                ;
                return val
            }, setChangeTrigger = function (trigger_id, bind_id) {
                var changeTrigger = function () {
                    var val = getValue(bind_id, trigger_id);
                    for (i in Drupal.Views.dependent.bindings[bind_id]) {
                        var id = Drupal.Views.dependent.bindings[bind_id][i];
                        if (typeof id != 'string')continue;
                        if (!Drupal.Views.dependent.activeBindings[id])Drupal.Views.dependent.activeBindings[id] = {};
                        if (Drupal.Views.dependent.inArray(Drupal.settings.viewsAjax.formRelationships[id].values[bind_id], val)) {
                            Drupal.Views.dependent.activeBindings[id][bind_id] = 'bind'
                        } else delete Drupal.Views.dependent.activeBindings[id][bind_id];
                        var len = 0;
                        for (i in Drupal.Views.dependent.activeBindings[id])len++;
                        var object = jQuery('#' + id + '-wrapper');
                        if (!object.size())object = jQuery('#' + id).parent();
                        var rel_num = Drupal.settings.viewsAjax.formRelationships[id].num;
                        if (typeof rel_num === 'object')rel_num = Drupal.settings.viewsAjax.formRelationships[id].num[0];
                        if (rel_num <= len) {
                            object.show(0);
                            object.addClass('dependent-options')
                        } else object.hide(0)
                    }
                };
                jQuery(trigger_id).change(function () {
                    changeTrigger(trigger_id, bind_id)
                });
                changeTrigger(trigger_id, bind_id)
            };
            setChangeTrigger(trigger_id, bind_id)
        }
    }
};
Drupal.behaviors.viewsDependent = function (context) {
    Drupal.Views.dependent.autoAttach();
    $("select.views-master-dependent:not(.views-processed)").addClass('views-processed').change(function () {
        var val = $(this).val();
        if (val == 'all') {
            $('.views-dependent-all').show(0)
        } else {
            $('.views-dependent-all').hide(0);
            $('.views-dependent-' + val).show(0)
        }
    }).trigger('change')
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/views/js/dependent.js. */
