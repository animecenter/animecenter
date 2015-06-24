/* Source and licensing information for the line(s) below can be found at http://beta.animecenter.tv/modules/disqus/disqus.js. */
var disqus_shortname = '', disqus_developer = 0, disqus_url = '', disqus_title = '', disqus_identifier = '', disqus_config = null, disqus_def_name = null, disqus_def_email = null;
Drupal.behaviors.disqus = function (context) {
    if (Drupal.settings.disqusCommentDomain || false) {
        disqus_shortname = Drupal.settings.disqusCommentDomain;
        jQuery.ajax({
            type: 'GET',
            url: 'http://' + disqus_shortname + '.disqus.com/count.js',
            dataType: 'script',
            cache: true
        })
    }
    ;
    if (Drupal.settings.disqus || false)if (jQuery("#disqus_thread").length) {
        var disqus = Drupal.settings.disqus;
        disqus_shortname = disqus.shortname;
        disqus_developer = disqus.developer || 0;
        disqus_url = disqus.url;
        disqus_title = disqus.title;
        disqus_identifier = disqus.identifier;
        disqus_def_name = disqus.name || null;
        disqus_def_email = disqus.email || null;
        disqus_config = function () {
            if (disqus.language || false)this.language = disqus.language;
            if (disqus.remote_auth_s3 || false)this.page.remote_auth_s3 = disqus.remote_auth_s3;
            if (disqus.api_key || false)this.page.api_key = disqus.api_key;
            if (disqus.sso || false)this.sso = disqus.sso
        };
        jQuery.ajax({
            type: 'GET',
            url: 'http://' + disqus_shortname + '.disqus.com/embed.js',
            dataType: 'script',
            cache: true
        })
    }
};
/* Source and licensing information for the above line(s) can be found at http://beta.animecenter.tv/modules/disqus/disqus.js. */
