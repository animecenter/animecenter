/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/misc/tableselect.js. */
Drupal.behaviors.tableSelect = function (context) {
    $('form table:has(th.select-all):not(.tableSelect-processed)', context).each(Drupal.tableSelect)
};
Drupal.tableSelect = function () {
    if ($('td input:checkbox', this).size() == 0)return;
    var table = this, checkboxes, lastChecked, strings = {
        selectAll: Drupal.t('Select all rows in this table'),
        selectNone: Drupal.t('Deselect all rows in this table')
    }, updateSelectAll = function (state) {
        $('th.select-all input:checkbox', table).each(function () {
            $(this).attr('title', state ? strings.selectNone : strings.selectAll);
            this.checked = state
        })
    };
    $('th.select-all', table).prepend($('<input type="checkbox" class="form-checkbox" />').attr('title', strings.selectAll)).click(function (event) {
        if ($(event.target).is('input:checkbox')) {
            checkboxes.each(function () {
                this.checked = event.target.checked;
                $(this).parents('tr:first')[this.checked ? 'addClass' : 'removeClass']('selected')
            });
            updateSelectAll(event.target.checked)
        }
    });
    checkboxes = $('td input:checkbox', table).click(function (e) {
        $(this).parents('tr:first')[this.checked ? 'addClass' : 'removeClass']('selected');
        if (e.shiftKey && lastChecked && lastChecked != e.target)Drupal.tableSelectRange($(e.target).parents('tr')[0], $(lastChecked).parents('tr')[0], e.target.checked);
        updateSelectAll((checkboxes.length == $(checkboxes).filter(':checked').length));
        lastChecked = e.target
    });
    $(this).addClass('tableSelect-processed')
};
Drupal.tableSelectRange = function (from, to, state) {
    var mode = from.rowIndex > to.rowIndex ? 'previousSibling' : 'nextSibling';
    for (var i = from[mode]; i; i = i[mode]) {
        if (i.nodeType != 1)continue;
        $(i)[state ? 'addClass' : 'removeClass']('selected');
        $('input:checkbox', i).each(function () {
            this.checked = state
        });
        if (to.nodeType) {
            if (i == to)break
        } else if (jQuery.filter(to, [i]).r.length)break
    }
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/misc/tableselect.js. */
