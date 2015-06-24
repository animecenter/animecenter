/* Source and licensing information for the line(s) below can be found at http://beta.animecenter.tv/misc/autocomplete.js. */
Drupal.behaviors.autocomplete = function (context) {
    var acdb = [];
    $('input.autocomplete:not(.autocomplete-processed)', context).each(function () {
        var uri = this.value;
        if (!acdb[uri])acdb[uri] = new Drupal.ACDB(uri);
        var input = $('#' + this.id.substr(0, this.id.length - 13)).attr('autocomplete', 'OFF')[0];
        $(input.form).submit(Drupal.autocompleteSubmit);
        new Drupal.jsAC(input, acdb[uri]);
        $(this).addClass('autocomplete-processed')
    })
};
Drupal.autocompleteSubmit = function () {
    return $('#autocomplete').each(function () {
            this.owner.hidePopup()
        }).size() == 0
};
Drupal.jsAC = function (input, db) {
    var ac = this;
    this.input = input;
    this.db = db;
    $(this.input).keydown(function (event) {
        return ac.onkeydown(this, event)
    }).keyup(function (event) {
        ac.onkeyup(this, event)
    }).blur(function () {
        ac.hidePopup();
        ac.db.cancel()
    })
};
Drupal.jsAC.prototype.onkeydown = function (input, e) {
    if (!e)e = window.event;
    switch (e.keyCode) {
        case 40:
            this.selectDown();
            return false;
        case 38:
            this.selectUp();
            return false;
        default:
            return true
    }
};
Drupal.jsAC.prototype.onkeyup = function (input, e) {
    if (!e)e = window.event;
    switch (e.keyCode) {
        case 16:
        case 17:
        case 18:
        case 20:
        case 33:
        case 34:
        case 35:
        case 36:
        case 37:
        case 38:
        case 39:
        case 40:
            return true;
        case 9:
        case 13:
        case 27:
            this.hidePopup(e.keyCode);
            return true;
        default:
            if (input.value.length > 0) {
                this.populatePopup()
            } else this.hidePopup(e.keyCode);
            return true
    }
};
Drupal.jsAC.prototype.select = function (node) {
    this.input.value = node.autocompleteValue
};
Drupal.jsAC.prototype.selectDown = function () {
    if (this.selected && this.selected.nextSibling) {
        this.highlight(this.selected.nextSibling)
    } else {
        var lis = $('li', this.popup);
        if (lis.size() > 0)this.highlight(lis.get(0))
    }
};
Drupal.jsAC.prototype.selectUp = function () {
    if (this.selected && this.selected.previousSibling)this.highlight(this.selected.previousSibling)
};
Drupal.jsAC.prototype.highlight = function (node) {
    if (this.selected)$(this.selected).removeClass('selected');
    $(node).addClass('selected');
    this.selected = node
};
Drupal.jsAC.prototype.unhighlight = function (node) {
    $(node).removeClass('selected');
    this.selected = false
};
Drupal.jsAC.prototype.hidePopup = function (keycode) {
    if (this.selected && ((keycode && keycode != 46 && keycode != 8 && keycode != 27) || !keycode))this.input.value = this.selected.autocompleteValue;
    var popup = this.popup;
    if (popup) {
        this.popup = null;
        $(popup).fadeOut('fast', function () {
            $(popup).remove()
        })
    }
    ;
    this.selected = false
};
Drupal.jsAC.prototype.populatePopup = function () {
    if (this.popup)$(this.popup).remove();
    this.selected = false;
    this.popup = document.createElement('div');
    this.popup.id = 'autocomplete';
    this.popup.owner = this;
    $(this.popup).css({
        marginTop: this.input.offsetHeight + 'px',
        width: (this.input.offsetWidth - 4) + 'px',
        display: 'none'
    });
    $(this.input).before(this.popup);
    this.db.owner = this;
    this.db.search(this.input.value)
};
Drupal.jsAC.prototype.found = function (matches) {
    if (!this.input.value.length)return false;
    var ul = document.createElement('ul'), ac = this;
    for (key in matches) {
        var li = document.createElement('li');
        $(li).html('<div>' + matches[key] + '</div>').mousedown(function () {
            ac.select(this)
        }).mouseover(function () {
            ac.highlight(this)
        }).mouseout(function () {
            ac.unhighlight(this)
        });
        li.autocompleteValue = key;
        $(ul).append(li)
    }
    ;
    if (this.popup)if (ul.childNodes.length > 0) {
        $(this.popup).empty().append(ul).show()
    } else {
        $(this.popup).css({visibility: 'hidden'});
        this.hidePopup()
    }
};
Drupal.jsAC.prototype.setStatus = function (status) {
    switch (status) {
        case'begin':
            $(this.input).addClass('throbbing');
            break;
        case'cancel':
        case'error':
        case'found':
            $(this.input).removeClass('throbbing');
            break
    }
};
Drupal.ACDB = function (uri) {
    this.uri = uri;
    this.delay = 300;
    this.cache = {}
};
Drupal.ACDB.prototype.search = function (searchString) {
    var db = this;
    this.searchString = searchString;
    if (this.cache[searchString])return this.owner.found(this.cache[searchString]);
    if (this.timer)clearTimeout(this.timer);
    this.timer = setTimeout(function () {
        db.owner.setStatus('begin');
        $.ajax({
            type: "GET",
            url: db.uri + '/' + Drupal.encodeURIComponent(searchString),
            dataType: 'json',
            success: function (matches) {
                if (typeof matches.status == 'undefined' || matches.status != 0) {
                    db.cache[searchString] = matches;
                    if (db.searchString == searchString)db.owner.found(matches);
                    db.owner.setStatus('found')
                }
            },
            error: function (xmlhttp) {
                alert(Drupal.ahahError(xmlhttp, db.uri))
            }
        })
    }, this.delay)
};
Drupal.ACDB.prototype.cancel = function () {
    if (this.owner)this.owner.setStatus('cancel');
    if (this.timer)clearTimeout(this.timer);
    this.searchString = ''
};
/* Source and licensing information for the above line(s) can be found at http://beta.animecenter.tv/misc/autocomplete.js. */
