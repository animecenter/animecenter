/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/misc/textarea.js. */
Drupal.behaviors.textarea = function (context) {
    $('textarea.resizable:not(.textarea-processed)', context).each(function () {
        if ($(this).is('textarea.teaser:not(.teaser-processed)'))return false;
        var textarea = $(this).addClass('textarea-processed'), staticOffset = null;
        $(this).wrap('<div class="resizable-textarea"><span></span></div>').parent().append($('<div class="grippie"></div>').mousedown(startDrag));
        var grippie = $('div.grippie', $(this).parent())[0];
        grippie.style.marginRight = (grippie.offsetWidth - $(this)[0].offsetWidth) + 'px'
        function startDrag(e) {
            staticOffset = textarea.height() - e.pageY;
            textarea.css('opacity', 0.25);
            $(document).mousemove(performDrag).mouseup(endDrag);
            return false
        }

        function performDrag(e) {
            textarea.height(Math.max(32, staticOffset + e.pageY) + 'px');
            return false
        }

        function endDrag(e) {
            $(document).unbind("mousemove", performDrag).unbind("mouseup", endDrag);
            textarea.css('opacity', 1)
        }
    })
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/misc/textarea.js. */
