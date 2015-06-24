/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/misc/progress.js. */
Drupal.progressBar = function (id, updateCallback, method, errorCallback) {
    var pb = this;
    this.id = id;
    this.method = method || "GET";
    this.updateCallback = updateCallback;
    this.errorCallback = errorCallback;
    this.element = document.createElement('div');
    this.element.id = id;
    this.element.className = 'progress';
    $(this.element).html('<div class="bar"><div class="filled"></div></div><div class="percentage"></div><div class="message">&nbsp;</div>')
};
Drupal.progressBar.prototype.setProgress = function (percentage, message) {
    if (percentage >= 0 && percentage <= 100) {
        $('div.filled', this.element).css('width', percentage + '%');
        $('div.percentage', this.element).html(percentage + '%')
    }
    ;
    $('div.message', this.element).html(message);
    if (this.updateCallback)this.updateCallback(percentage, message, this)
};
Drupal.progressBar.prototype.startMonitoring = function (uri, delay) {
    this.delay = delay;
    this.uri = uri;
    this.sendPing()
};
Drupal.progressBar.prototype.stopMonitoring = function () {
    clearTimeout(this.timer);
    this.uri = null
};
Drupal.progressBar.prototype.sendPing = function () {
    if (this.timer)clearTimeout(this.timer);
    if (this.uri) {
        var pb = this;
        $.ajax({
            type: this.method, url: this.uri, data: '', dataType: 'json', success: function (progress) {
                if (progress.status == 0) {
                    pb.displayError(progress.data);
                    return
                }
                ;
                pb.setProgress(progress.percentage, progress.message);
                pb.timer = setTimeout(function () {
                    pb.sendPing()
                }, pb.delay)
            }, error: function (xmlhttp) {
                pb.displayError(Drupal.ahahError(xmlhttp, pb.uri))
            }
        })
    }
};
Drupal.progressBar.prototype.displayError = function (string) {
    var error = document.createElement('div');
    error.className = 'error';
    error.innerHTML = string;
    $(this.element).before(error).hide();
    if (this.errorCallback)this.errorCallback(this)
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/misc/progress.js. */
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/vertical_tabs/core/node.js. */
Drupal.verticalTabs = Drupal.verticalTabs || {};
Drupal.verticalTabs.revision_information = function () {
    if ($('#edit-revision').length) {
        if ($('#edit-revision').attr('checked')) {
            return Drupal.t('New revision')
        } else return Drupal.t('No revision')
    } else return ''
};
Drupal.verticalTabs.author = function () {
    var author = $('#edit-name').val() || Drupal.t('Anonymous'), date = $('#edit-date').val();
    if (date) {
        return Drupal.t('By @name on @date', {'@name': author, '@date': date})
    } else return Drupal.t('By @name', {'@name': author})
};
Drupal.verticalTabs.options = function () {
    var vals = [];
    $('fieldset.vertical-tabs-options input:checked').parent().each(function () {
        vals.push(Drupal.checkPlain($.trim($(this).text())))
    });
    if (!$('#edit-status').is(':checked'))vals.unshift(Drupal.t('Not published'));
    return vals.join(', ')
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/vertical_tabs/core/node.js. */

Drupal.verticalTabs = Drupal.verticalTabs || {};

Drupal.verticalTabs.comment_settings = function () {
    return $('.vertical-tabs-comment_settings input:checked').parent().text();
}

Drupal.verticalTabs.comment = function () {
    var vals = [];
    vals.push($(".vertical-tabs-comment input[name='comment']:checked").parent().text());
    vals.push($(".vertical-tabs-comment input[name='comment_default_mode']:checked").parent().text());
    vals.push(Drupal.t('@number comments per page', {'@number': $(".vertical-tabs-comment select[name='comment_default_per_page'] option:selected").val()}));
    return vals.join(', ');
}
;
