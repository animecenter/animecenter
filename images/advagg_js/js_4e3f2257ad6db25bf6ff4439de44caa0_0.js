/* Source and licensing information for the line(s) below can be found at http://beta.animecenter.tv/modules/block/block.js. */
Drupal.behaviors.blockDrag = function (context) {
    var table = $('table#blocks'), tableDrag = Drupal.tableDrag.blocks;
    tableDrag.row.prototype.onSwap = function (swappedRow) {
        checkEmptyRegions(table, this)
    };
    Drupal.theme.tableDragChangedWarning = function () {
        return '<div class="warning">' + Drupal.theme('tableDragChangedMarker') + ' ' + Drupal.t("The changes to these blocks will not be saved until the <em>Save blocks</em> button is clicked.") + '</div>'
    };
    tableDrag.onDrop = function () {
        dragObject = this;
        if ($(dragObject.rowObject.element).prev('tr').is('.region-message')) {
            var regionRow = $(dragObject.rowObject.element).prev('tr').get(0), regionName = regionRow.className.replace(/([^ ]+[ ]+)*region-([^ ]+)-message([ ]+[^ ]+)*/, '$2'), regionField = $('select.block-region-select', dragObject.rowObject.element), weightField = $('select.block-weight', dragObject.rowObject.element), oldRegionName = weightField[0].className.replace(/([^ ]+[ ]+)*block-weight-([^ ]+)([ ]+[^ ]+)*/, '$2');
            if (!regionField.is('.block-region-' + regionName)) {
                regionField.removeClass('block-region-' + oldRegionName).addClass('block-region-' + regionName);
                weightField.removeClass('block-weight-' + oldRegionName).addClass('block-weight-' + regionName);
                regionField.val(regionName)
            }
        }
    };
    $('select.block-region-select:not(.blockregionselect-processed)', context).each(function () {
        $(this).change(function (event) {
            var row = $(this).parents('tr:first'), select = $(this);
            tableDrag.rowObject = new tableDrag.row(row);
            $('tr.region-message', table).each(function () {
                if ($(this).is('.region-' + select[0].value + '-message')) {
                    $(this).after(row);
                    tableDrag.updateFields(row.get(0));
                    tableDrag.rowObject.changed = true;
                    if (tableDrag.oldRowElement)$(tableDrag.oldRowElement).removeClass('drag-previous');
                    tableDrag.oldRowElement = row.get(0);
                    tableDrag.restripeTable();
                    tableDrag.rowObject.markChanged();
                    tableDrag.oldRowElement = row;
                    $(row).addClass('drag-previous')
                }
            });
            checkEmptyRegions(table, row);
            select.get(0).blur()
        });
        $(this).addClass('blockregionselect-processed')
    });
    var checkEmptyRegions = function (table, rowObject) {
        $('tr.region-message', table).each(function () {
            if ($(this).prev('tr').get(0) == rowObject.element)if ((rowObject.method != 'keyboard' || rowObject.direction == 'down'))rowObject.swap('after', this);
            if ($(this).next('tr').is(':not(.draggable)') || $(this).next('tr').size() == 0) {
                $(this).removeClass('region-populated').addClass('region-empty')
            } else if ($(this).is('.region-empty'))$(this).removeClass('region-empty').addClass('region-populated')
        })
    }
};
/* Source and licensing information for the above line(s) can be found at http://beta.animecenter.tv/modules/block/block.js. */
