/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/token/jquery.treeTable.js. */
(function ($) {
    var options, defaultPaddingLeft;
    $.fn.treeTable = function (opts) {
        options = $.extend({}, $.fn.treeTable.defaults, opts);
        return this.each(function () {
            $(this).addClass("treeTable").find("tbody tr").each(function () {
                if (!options.expandable || $(this)[0].className.search(options.childPrefix) == -1) {
                    if (isNaN(defaultPaddingLeft))defaultPaddingLeft = parseInt($($(this).children("td")[options.treeColumn]).css('padding-left'), 10);
                    initialize($(this))
                } else if (options.initialState == "collapsed")this.style.display = "none"
            })
        })
    };
    $.fn.treeTable.defaults = {
        childPrefix: "child-of-",
        clickableNodeNames: false,
        expandable: true,
        indent: 19,
        initialState: "collapsed",
        treeColumn: 0
    };
    $.fn.collapse = function () {
        $(this).addClass("collapsed");
        childrenOf($(this)).each(function () {
            if (!$(this).hasClass("collapsed"))$(this).collapse();
            this.style.display = "none"
        });
        return this
    };
    $.fn.expand = function () {
        $(this).removeClass("collapsed").addClass("expanded");
        childrenOf($(this)).each(function () {
            initialize($(this));
            if ($(this).is(".expanded.parent"))$(this).expand();
            $(this).show()
        });
        return this
    };
    $.fn.reveal = function () {
        $(ancestorsOf($(this)).reverse()).each(function () {
            initialize($(this));
            $(this).expand().show()
        });
        return this
    };
    $.fn.appendBranchTo = function (destination) {
        var node = $(this), parent = parentOf(node), ancestorNames = $.map(ancestorsOf($(destination)), function (a) {
            return a.id
        });
        if ($.inArray(node[0].id, ancestorNames) == -1 && (!parent || (destination.id != parent[0].id)) && destination.id != node[0].id) {
            indent(node, ancestorsOf(node).length * options.indent * -1);
            if (parent)node.removeClass(options.childPrefix + parent[0].id);
            node.addClass(options.childPrefix + destination.id);
            move(node, destination);
            indent(node, ancestorsOf(node).length * options.indent)
        }
        ;
        return this
    };
    $.fn.reverse = function () {
        return this.pushStack(this.get().reverse(), arguments)
    };
    $.fn.toggleBranch = function () {
        if ($(this).hasClass("collapsed")) {
            $(this).expand()
        } else $(this).removeClass("expanded").collapse();
        return this
    }
    function ancestorsOf(node) {
        var ancestors = [];
        while (node = parentOf(node))ancestors[ancestors.length] = node[0];
        return ancestors
    }

    function childrenOf(node) {
        return $(node).siblings("tr." + options.childPrefix + node[0].id)
    }

    function getPaddingLeft(node) {
        var paddingLeft = parseInt(node[0].style.paddingLeft, 10);
        return (isNaN(paddingLeft)) ? defaultPaddingLeft : paddingLeft
    }

    function indent(node, value) {
        var cell = $(node.children("td")[options.treeColumn]);
        cell[0].style.paddingLeft = getPaddingLeft(cell) + value + "px";
        childrenOf(node).each(function () {
            indent($(this), value)
        })
    }

    function initialize(node) {
        if (!node.hasClass("initialized")) {
            node.addClass("initialized");
            var childNodes = childrenOf(node);
            if (!node.hasClass("parent") && childNodes.length > 0)node.addClass("parent");
            if (node.hasClass("parent")) {
                var cell = $(node.children("td")[options.treeColumn]), padding = getPaddingLeft(cell) + options.indent;
                childNodes.each(function () {
                    $(this).children("td")[options.treeColumn].style.paddingLeft = padding + "px"
                });
                if (options.expandable) {
                    cell.prepend('<span style="margin-left: -' + options.indent + 'px; padding-left: ' + options.indent + 'px" class="expander"></span>');
                    $(cell[0].firstChild).click(function () {
                        node.toggleBranch()
                    });
                    if (options.clickableNodeNames) {
                        cell[0].style.cursor = "pointer";
                        $(cell).click(function (e) {
                            if (e.target.className != 'expander')node.toggleBranch()
                        })
                    }
                    ;
                    if (!(node.hasClass("expanded") || node.hasClass("collapsed")))node.addClass(options.initialState);
                    if (node.hasClass("expanded"))node.expand()
                }
            }
        }
    }

    function move(node, destination) {
        node.insertAfter(destination);
        childrenOf(node).reverse().each(function () {
            move($(this), node[0])
        })
    }

    function parentOf(node) {
        var classNames = node[0].className.split(' ');
        for (key in classNames)if (classNames[key].match(options.childPrefix))return $(node).siblings("#" + classNames[key].substring(options.childPrefix.length))
    }
})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/token/jquery.treeTable.js. */
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/modules/token/token.js. */
(function ($) {
    Drupal.behaviors.tokenTree = function () {
        $('table.token-tree').each(function () {
            $(this).treeTable()
        })
    };
    Drupal.behaviors.tokenInsert = function () {
        $('textarea, input[type="text"]').focus(function () {
            Drupal.settings.tokenFocusedField = this
        });
        $('.token-click-insert .token-key').each(function () {
            var newThis = $('<a href="javascript:void(0);" title="' + Drupal.t('Insert this token into your form') + '">' + $(this).html() + '</a>').click(function () {
                if (typeof Drupal.settings.tokenFocusedField == 'undefined') {
                    alert(Drupal.t('First click a text field to insert your tokens into.'))
                } else {
                    var myField = Drupal.settings.tokenFocusedField, myValue = $(this).text();
                    if (document.selection) {
                        myField.focus();
                        sel = document.selection.createRange();
                        sel.text = myValue
                    } else if (myField.selectionStart || myField.selectionStart == '0') {
                        var startPos = myField.selectionStart, endPos = myField.selectionEnd;
                        myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length)
                    } else myField.value += myValue;
                    $('html,body').animate({scrollTop: $(myField).offset().top}, 500)
                }
                ;
                return false
            });
            $(this).html(newThis)
        })
    }
})(jQuery);
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/modules/token/token.js. */
