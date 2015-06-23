/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/misc/form.js. */
Drupal.behaviors.multiselectSelector=function(){$('.multiselect select:not(.multiselectSelector-processed)').addClass('multiselectSelector-processed').change(function(){$('.multiselect input:radio[value="'+this.id.substr(5)+'"]').attr('checked',true)})};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/misc/form.js. */
