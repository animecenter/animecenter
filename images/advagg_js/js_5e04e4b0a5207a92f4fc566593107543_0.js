/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/vertical_tabs/core/node.js. */
Drupal.verticalTabs=Drupal.verticalTabs||{};Drupal.verticalTabs.revision_information=function(){if($('#edit-revision').length){if($('#edit-revision').attr('checked')){return Drupal.t('New revision')}else return Drupal.t('No revision')}else return''};Drupal.verticalTabs.author=function(){var author=$('#edit-name').val()||Drupal.t('Anonymous'),date=$('#edit-date').val();if(date){return Drupal.t('By @name on @date',{'@name':author,'@date':date})}else return Drupal.t('By @name',{'@name':author})};Drupal.verticalTabs.options=function(){var vals=[];$('fieldset.vertical-tabs-options input:checked').parent().each(function(){vals.push(Drupal.checkPlain($.trim($(this).text())))});if(!$('#edit-status').is(':checked'))vals.unshift(Drupal.t('Not published'));return vals.join(', ')};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/vertical_tabs/core/node.js. */

Drupal.verticalTabs = Drupal.verticalTabs || {};

Drupal.verticalTabs.comment_settings = function() {
  return $('.vertical-tabs-comment_settings input:checked').parent().text();
}

Drupal.verticalTabs.comment = function() {
  var vals = [];
  vals.push($(".vertical-tabs-comment input[name='comment']:checked").parent().text());
  vals.push($(".vertical-tabs-comment input[name='comment_default_mode']:checked").parent().text());
  vals.push(Drupal.t('@number comments per page', {'@number': $(".vertical-tabs-comment select[name='comment_default_per_page'] option:selected").val()}));
  return vals.join(', ');
}
;
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/vertical_tabs/core/taxonomy.js. */
Drupal.verticalTabs=Drupal.verticalTabs||{};Drupal.verticalTabs.taxonomy=function(){var terms={},termCount=0;$('fieldset.vertical-tabs-taxonomy').find('select, input.form-text').each(function(){if(this.value){var vocabulary=$(this).siblings('label').html();terms[vocabulary]=terms[vocabulary]||[];if($(this).is('input.form-text')){terms[vocabulary].push(Drupal.checkPlain(this.value));termCount++}else if($(this).is('select'))$(this).find('option[selected]').each(function(){var term=$(this).text().replace(/^\-+/,'');terms[vocabulary].push(Drupal.checkPlain(term));termCount++})}});if(termCount){var output='';$.each(terms,function(vocab,vocab_terms){if(output)output+='<br />';output+=vocab;output+=vocab_terms.join(', ')});return output}else return Drupal.t('No terms')};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/vertical_tabs/core/taxonomy.js. */
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/vertical_tabs/core/upload.js. */
Drupal.verticalTabs=Drupal.verticalTabs||{};Drupal.verticalTabs.attachments=function(){var size=$('#upload-attachments tbody tr').size();if(size){return Drupal.formatPlural(size,'1 attachment','@count attachments')}else return Drupal.t('No attachments')};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/vertical_tabs/core/upload.js. */
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/vertical_tabs/core/book.js. */
Drupal.verticalTabs=Drupal.verticalTabs||{};Drupal.verticalTabs.book=function(){var text=$('#edit-book-bid option[selected]').text();if(text==Drupal.t('<none>')){return Drupal.t('Not in book')}else if(text==Drupal.t('<create a new book>'))return Drupal.t('New book');return text};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/vertical_tabs/core/book.js. */
