/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/path_redirect/path_redirect.js. */
Drupal.verticalTabs = Drupal.verticalTabs || {};
Drupal.verticalTabs.path_redirect = function () {
    if ($('fieldset.vertical-tabs-path_redirect table tbody td.empty').size()) {
        return Drupal.t('No redirects')
    } else {
        var redirects = $('fieldset.vertical-tabs-path_redirect table tbody tr').size();
        return Drupal.formatPlural(redirects, '1 redirect', '@count redirects')
    }
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/path_redirect/path_redirect.js. */
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/vertical_tabs/core/upload.js. */
Drupal.verticalTabs = Drupal.verticalTabs || {};
Drupal.verticalTabs.attachments = function () {
    var size = $('#upload-attachments tbody tr').size();
    if (size) {
        return Drupal.formatPlural(size, '1 attachment', '@count attachments')
    } else return Drupal.t('No attachments')
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/vertical_tabs/core/upload.js. */
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/vertical_tabs/core/book.js. */
Drupal.verticalTabs = Drupal.verticalTabs || {};
Drupal.verticalTabs.book = function () {
    var text = $('#edit-book-bid option[selected]').text();
    if (text == Drupal.t('<none>')) {
        return Drupal.t('Not in book')
    } else if (text == Drupal.t('<create a new book>'))return Drupal.t('New book');
    return text
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/vertical_tabs/core/book.js. */
