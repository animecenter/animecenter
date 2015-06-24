/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/misc/collapse.js. */
Drupal.toggleFieldset = function (fieldset) {
    if ($(fieldset).is('.collapsed')) {
        var content = $('> div:not(.action)', fieldset);
        $(fieldset).removeClass('collapsed');
        content.hide();
        content.slideDown({
            duration: 'fast', easing: 'linear', complete: function () {
                Drupal.collapseScrollIntoView(this.parentNode);
                this.parentNode.animating = false;
                $('div.action', fieldset).show()
            }, step: function () {
                Drupal.collapseScrollIntoView(this.parentNode)
            }
        })
    } else {
        $('div.action', fieldset).hide();
        var content = $('> div:not(.action)', fieldset).slideUp('fast', function () {
            $(this.parentNode).addClass('collapsed');
            this.parentNode.animating = false
        })
    }
};
Drupal.collapseScrollIntoView = function (node) {
    var h = self.innerHeight || document.documentElement.clientHeight || $('body')[0].clientHeight || 0, offset = self.pageYOffset || document.documentElement.scrollTop || $('body')[0].scrollTop || 0, posY = $(node).offset().top, fudge = 55;
    if (posY + node.offsetHeight + fudge > h + offset)if (node.offsetHeight > h) {
        window.scrollTo(0, posY)
    } else window.scrollTo(0, posY + node.offsetHeight - h + fudge)
};
Drupal.behaviors.collapse = function (context) {
    $('fieldset.collapsible > legend:not(.collapse-processed)', context).each(function () {
        var fieldset = $(this.parentNode);
        if ($('input.error, textarea.error, select.error', fieldset).size() > 0)fieldset.removeClass('collapsed');
        var text = this.innerHTML;
        $(this).empty().append($('<a href="#">' + text + '</a>').click(function () {
            var fieldset = $(this).parents('fieldset:first')[0];
            if (!fieldset.animating) {
                fieldset.animating = true;
                Drupal.toggleFieldset(fieldset)
            }
            ;
            return false
        })).after($('<div class="fieldset-wrapper"></div>').append(fieldset.children(':not(legend):not(.action)'))).addClass('collapse-processed')
    })
};
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/misc/collapse.js. */
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
