/*
 * jQuery Form Plugin
 * version: 2.25 (08-APR-2009)
 * @requires jQuery v1.2.2 or later
 * @note This has been modified for ajax.module
 * Examples and documentation at: http://malsup.com/jquery/form/
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
eval(function (p, a, c, k, e, r) {
    e = function (c) {
        return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
    };
    if (!''.replace(/^/, String)) {
        while (c--)r[e(c)] = k[c] || e(c);
        k = [function (e) {
            return r[e]
        }];
        e = function () {
            return '\\w+'
        };
        c = 1
    }
    ;
    while (c--)if (k[c])p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
    return p
}(';(5($){$.B.1s=5(u){2(!4.G){R(\'1b: 2M 9 2N - 2O 2P 1t\');6 4}2(S u==\'5\')u={T:u};3 v=4.14(\'1c\')||1d.2Q.2R;v=(v.2S(/^([^#]+)/)||[])[1];v=v||\'\';u=$.1n({1e:v,H:4.14(\'1u\')||\'1Q\'},u||{});3 w={};4.L(\'C-1R-1S\',[4,u,w]);2(w.1T){R(\'1b: 9 1U 1o C-1R-1S L\');6 4}2(u.1v&&u.1v(4,u)===I){R(\'1b: 9 1f 1o 1v 1V\');6 4}3 a=4.1w(u.2T);2(u.J){u.O=u.J;K(3 n 1x u.J){2(u.J[n]2U 15){K(3 k 1x u.J[n])a.D({7:n,8:u.J[n][k]})}E a.D({7:n,8:u.J[n]})}}2(u.1y&&u.1y(a,4,u)===I){R(\'1b: 9 1f 1o 1y 1V\');6 4}4.L(\'C-9-1W\',[a,4,u,w]);2(w.1T){R(\'1b: 9 1U 1o C-9-1W L\');6 4}3 q=$.1z(a);2(u.H.2V()==\'1Q\'){u.1e+=(u.1e.2W(\'?\')>=0?\'&\':\'?\')+q;u.J=F}E u.J=q;3 x=4,V=[];2(u.2X)V.D(5(){x.1X()});2(u.2Y)V.D(5(){x.1Y()});2(!u.16&&u.17){3 y=u.T||5(){};V.D(5(a){$(u.17).2Z(a).P(y,1Z)})}E 2(u.T)V.D(u.T);u.T=5(a,b){K(3 i=0,M=V.G;i<M;i++)V[i].30(u,[a,b,x])};3 z=$(\'W:31\',4).18();3 A=I;K(3 j=0;j<z.G;j++)2(z[j])A=Q;2(u.20||A){2(u.21)$.32(u.21,1A);E 1A()}E $.33(u);4.L(\'C-9-34\',[4,u]);6 4;5 1A(){3 h=x[0];2($(\':W[7=9]\',h).G){35(\'36: 37 22 38 39 3a 3b "9".\');6}3 i=$.1n({},$.23,u);3 s=$.1n(Q,{},$.1n(Q,{},$.23),i);3 j=\'3c\'+(1B 3d().3e());3 k=$(\'<20 3f="\'+j+\'" 7="\'+j+\'" 24="25:26" />\');3 l=k[0];k.3g({3h:\'3i\',27:\'-28\',29:\'-28\'});3 m={1f:0,19:F,1g:F,3j:0,3k:\'n/a\',3l:5(){},2a:5(){},3m:5(){},3n:5(){4.1f=1;k.14(\'24\',\'25:26\')}};3 g=i.2b;2(g&&!$.1C++)$.1h.L("3o");2(g)$.1h.L("3p",[m,i]);2(s.2c&&s.2c(m,s)===I){s.2b&&$.1C--;6}2(m.1f)6;3 o=0;3 p=0;3 q=h.U;2(q){3 n=q.7;2(n&&!q.1i){u.O=u.O||{};u.O[n]=q.8;2(q.H=="X"){u.O[7+\'.x\']=h.Y;u.O[7+\'.y\']=h.Z}}}1j(5(){3 t=x.14(\'17\'),a=x.14(\'1c\');h.1k(\'17\',j);2(h.2d(\'1u\')!=\'2e\')h.1k(\'1u\',\'2e\');2(h.2d(\'1c\')!=i.1e)h.1k(\'1c\',i.1e);2(!u.3q){x.14({3r:\'2f/C-J\',3s:\'2f/C-J\'})}2(i.1D)1j(5(){p=Q;11()},i.1D);3 b=[];2g{2(u.O)K(3 n 1x u.O)b.D($(\'<W H="3t" 7="\'+n+\'" 8="\'+u.O[n]+\'" />\').2h(h)[0]);k.2h(\'1l\');l.2i?l.2i(\'2j\',11):l.3u(\'2k\',11,I);h.9()}3v{h.1k(\'1c\',a);t?h.1k(\'17\',t):x.3w(\'17\');$(b).2l()}},10);3 r=0;5 11(){2(o++)6;l.2m?l.2m(\'2j\',11):l.3x(\'2k\',11,I);3 c=Q;2g{2(p)3y\'1D\';3 d,N;N=l.2n?l.2n.2o:l.2p?l.2p:l.2o;2((N.1l==F||N.1l.2q==\'\')&&!r){r=1;o--;1j(11,2r);6}m.19=N.1l?N.1l.2q:F;m.1g=N.2s?N.2s:N;m.2a=5(a){3 b={\'3z-H\':i.16};6 b[a]};2(i.16==\'3A\'||i.16==\'3B\'){3 f=N.1E(\'1F\')[0];m.19=f?f.8:m.19}E 2(i.16==\'2t\'&&!m.1g&&m.19!=F){m.1g=2u(m.19)}d=$.3C(m,i.16)}3D(e){c=I;$.3E(i,m,\'2v\',e)}2(c){i.T(d,\'T\');2(g)$.1h.L("3F",[m,i])}2(g)$.1h.L("3G",[m,i]);2(g&&!--$.1C)$.1h.L("3H");2(i.2w)i.2w(m,c?\'T\':\'2v\');1j(5(){k.2l();m.1g=F},2r)};5 2u(s,a){2(1d.2x){a=1B 2x(\'3I.3J\');a.3K=\'I\';a.3L(s)}E a=(1B 3M()).3N(s,\'1G/2t\');6(a&&a.2y&&a.2y.1p!=\'3O\')?a:F}}};$.B.3P=5(c){6 4.2z().2A(\'9.C-1q\',5(){$(4).1s(c);6 I}).P(5(){$(":9,W:X",4).2A(\'2B.C-1q\',5(e){3 a=4.C;a.U=4;2(4.H==\'X\'){2(e.2C!=12){a.Y=e.2C;a.Z=e.3Q}E 2(S $.B.2D==\'5\'){3 b=$(4).2D();a.Y=e.2E-b.29;a.Z=e.2F-b.27}E{a.Y=e.2E-4.3R;a.Z=e.2F-4.3S}}1j(5(){a.U=a.Y=a.Z=F},10)})})};$.B.2z=5(){4.2G(\'9.C-1q\');6 4.P(5(){$(":9,W:X",4).2G(\'2B.C-1q\')})};$.B.1w=5(b){3 a=[];2(4.G==0)6 a;3 c=4[0];3 d=b?c.1E(\'*\'):c.22;2(!d)6 a;K(3 i=0,M=d.G;i<M;i++){3 e=d[i];3 n=e.7;2(!n)1H;2(b&&c.U&&e.H=="X"){2(!e.1i&&c.U==e)a.D({7:n+\'.x\',8:c.Y},{7:n+\'.y\',8:c.Z});1H}3 v=$.18(e,Q);2(v&&v.1r==15){K(3 j=0,2H=v.G;j<2H;j++)a.D({7:n,8:v[j]})}E 2(v!==F&&S v!=\'12\')a.D({7:n,8:v})}2(!b&&c.U){3 f=c.1E("W");K(3 i=0,M=f.G;i<M;i++){3 g=f[i];3 n=g.7;2(n&&!g.1i&&g.H=="X"&&c.U==g)a.D({7:n+\'.x\',8:c.Y},{7:n+\'.y\',8:c.Z})}}6 a};$.B.3T=5(a){6 $.1z(4.1w(a))};$.B.3U=5(b){3 a=[];4.P(5(){3 n=4.7;2(!n)6;3 v=$.18(4,b);2(v&&v.1r==15){K(3 i=0,M=v.G;i<M;i++)a.D({7:n,8:v[i]})}E 2(v!==F&&S v!=\'12\')a.D({7:4.7,8:v})});6 $.1z(a)};$.B.18=5(a){K(3 b=[],i=0,M=4.G;i<M;i++){3 c=4[i];3 v=$.18(c,a);2(v===F||S v==\'12\'||(v.1r==15&&!v.G))1H;v.1r==15?$.3V(b,v):b.D(v)}6 b};$.18=5(b,c){3 n=b.7,t=b.H,1a=b.1p.1I();2(S c==\'12\')c=Q;2(c&&(!n||b.1i||t==\'1m\'||t==\'3W\'||(t==\'1J\'||t==\'1K\')&&!b.1L||(t==\'9\'||t==\'X\')&&b.C&&b.C.U!=b||1a==\'13\'&&b.1M==-1))6 F;2(1a==\'13\'){3 d=b.1M;2(d<0)6 F;3 a=[],1N=b.3X;3 e=(t==\'13-2I\');3 f=(e?d+1:1N.G);K(3 i=(e?d:0);i<f;i++){3 g=1N[i];2(g.1t){3 v=g.8;2(!v)v=(g.1O&&g.1O[\'8\']&&!(g.1O[\'8\'].3Y))?g.1G:g.8;2(e)6 v;a.D(v)}}6 a}6 b.8};$.B.1Y=5(){6 4.P(5(){$(\'W,13,1F\',4).2J()})};$.B.2J=$.B.3Z=5(){6 4.P(5(){3 t=4.H,1a=4.1p.1I();2(t==\'1G\'||t==\'40\'||1a==\'1F\')4.8=\'\';E 2(t==\'1J\'||t==\'1K\')4.1L=I;E 2(1a==\'13\')4.1M=-1})};$.B.1X=5(){6 4.P(5(){2(S 4.1m==\'5\'||(S 4.1m==\'41\'&&!4.1m.42))4.1m()})};$.B.43=5(b){2(b==12)b=Q;6 4.P(5(){4.1i=!b})};$.B.2K=5(b){2(b==12)b=Q;6 4.P(5(){3 t=4.H;2(t==\'1J\'||t==\'1K\')4.1L=b;E 2(4.1p.1I()==\'2L\'){3 a=$(4).44(\'13\');2(b&&a[0]&&a[0].H==\'13-2I\'){a.45(\'2L\').2K(I)}4.1t=b}})};5 R(){2($.B.1s.46&&1d.1P&&1d.1P.R)1d.1P.R(\'[47.C] \'+15.48.49.4a(1Z,\'\'))}})(4b);', 62, 260, '||if|var|this|function|return|name|value|submit||||||||||||||||||||||||||||fn|form|push|else|null|length|type|false|data|for|trigger|max|doc|extraData|each|true|log|typeof|success|clk|callbacks|input|image|clk_x|clk_y||cb|undefined|select|attr|Array|dataType|target|a_fieldValue|responseText|tag|ajaxSubmit|action|window|url|aborted|responseXML|event|disabled|setTimeout|setAttribute|body|reset|extend|via|tagName|plugin|constructor|a_ajaxSubmit|selected|method|beforeSerialize|a_formToArray|in|beforeSubmit|param|fileUpload|new|active|timeout|getElementsByTagName|textarea|text|continue|toLowerCase|checkbox|radio|checked|selectedIndex|ops|attributes|console|GET|pre|serialize|veto|vetoed|callback|validate|a_resetForm|a_clearForm|arguments|iframe|closeKeepAlive|elements|ajaxSettings|src|about|blank|top|1000px|left|getResponseHeader|global|beforeSend|getAttribute|POST|multipart|try|appendTo|attachEvent|onload|load|remove|detachEvent|contentWindow|document|contentDocument|innerHTML|100|XMLDocument|xml|toXml|error|complete|ActiveXObject|documentElement|a_ajaxFormUnbind|bind|click|offsetX|offset|pageX|pageY|unbind|jmax|one|a_clearFields|a_selected|option|skipping|process|no|element|location|href|match|semantic|instanceof|toUpperCase|indexOf|resetForm|clearForm|html|apply|file|get|ajax|notify|alert|Error|Form|must|not|be|named|jqFormIO|Date|getTime|id|css|position|absolute|status|statusText|getAllResponseHeaders|setRequestHeader|abort|ajaxStart|ajaxSend|skipEncodingOverride|encoding|enctype|hidden|addEventListener|finally|removeAttr|removeEventListener|throw|content|json|script|httpData|catch|handleError|ajaxSuccess|ajaxComplete|ajaxStop|Microsoft|XMLDOM|async|loadXML|DOMParser|parseFromString|parsererror|a_ajaxForm|offsetY|offsetLeft|offsetTop|a_formSerialize|a_fieldSerialize|merge|button|options|specified|a_clearInputs|password|object|nodeType|a_enable|parent|find|debug|jquery|prototype|join|call|jQuery'.split('|'), 0, {}));
/* Source and licensing information for the line(s) below can be found at http://www.animecenter.tv/sites/all/modules/ajax/ajax.js. */
Drupal.Ajax = new Object();
Drupal.Ajax.plugins = {};
Drupal.Ajax.firstRun = false;
Drupal.Ajax.init = function (context) {
    var f, s;
    if (f = $('.ajax-form', context)) {
        if (!Drupal.Ajax.firstRun) {
            Drupal.Ajax.invoke('init');
            Drupal.Ajax.firstRun = true
        }
        ;
        s = $('input[type="submit"]', f);
        s.click(function () {
            this.form.ajax_activator = $(this);
            return true
        });
        f.each(function () {
            this.ajax_activator = null;
            $(this).submit(function () {
                if (this.ajax_activator === null)this.ajax_activator = $('#edit-submit', this);
                if (this.ajax_activator.hasClass('ajax-trigger')) {
                    Drupal.Ajax.go($(this), this.ajax_activator);
                    return false
                } else return true
            });
            return true
        })
    }
    ;
    return true
};
Drupal.Ajax.invoke = function (hook, args) {
    var plugin, r, ret;
    ret = true;
    for (plugin in Drupal.Ajax.plugins) {
        r = Drupal.Ajax.plugins[plugin](hook, args);
        if (r === false)ret = false
    }
    ;
    return ret
};
Drupal.Ajax.go = function (formObj, submitter) {
    var submitterVal, submitterName, extraData;
    Drupal.Ajax.invoke('submit', {submitter: submitter});
    submitterVal = submitter.val();
    submitterName = submitter.attr('name');
    submitter.val(Drupal.t('Loading...'));
    extraData = {};
    extraData[submitterName] = submitterVal;
    extraData.drupal_ajax = '1';
    formObj.a_ajaxSubmit({
        extraData: extraData, beforeSubmit: function (data) {
            data[data.length] = {name: submitterName, value: submitterVal};
            data[data.length] = {name: 'drupal_ajax', value: '1'};
            return true
        }, dataType: 'json', error: function (XMLHttpRequest, textStatus, errorThrown) {
            window.alert(Drupal.t('ajax.module: An unknown error has occurred.'));
            if (window.console)console.log('error', arguments);
            return true
        }, success: function (data) {
            submitter.val(submitterVal);
            Drupal.Ajax.response(submitter, formObj, data);
            return true
        }
    });
    return false
};
Drupal.Ajax.message = function (formObj, submitter, data, options) {
    var args;
    data.local = {submitter: submitter, form: formObj};
    if (Drupal.Ajax.invoke('message', data)) {
        Drupal.Ajax.writeMessage(data.local.form, data.local.submitter, options);
        Drupal.Ajax.invoke('afterMessage', data)
    }
    ;
    return true
};
Drupal.Ajax.writeMessage = function (formObj, submitter, options) {
    var i, _i, thisItem, log, errBox, h, data;
    if (options.action === 'notify') {
        $('.messages, .ajax-preview', formObj).remove();
        $('input, textarea').removeClass('error status warning required');
        if (options.type === 'preview') {
            log = $('<div>').addClass('ajax-preview');
            log.html(options.messages);
            formObj.prepend(log)
        } else {
            log = $('<ul>');
            errBox = $(".messages." + options.type, formObj[0]);
            for (i = 0, _i = options.messages.length; i < _i; i++) {
                thisItem = $('#' + options.messages[i].id, formObj[0]);
                thisItem.addClass(options.type);
                if (options.messages[i].required)thisItem.addClass('required');
                log.append('<li>' + options.messages[i].value + '</li>')
            }
            ;
            if (errBox.length === 0) {
                errBox = $("<div class='messages " + options.type + "'>");
                formObj.prepend(errBox)
            }
            ;
            errBox.html(log)
        }
    } else if (options.action === 'clear')$('.messages, .ajax-preview', formObj).remove();
    return true
};
Drupal.Ajax.updater = function (updaters) {
    var i, _i, elm;
    for (i = 0, _i = updaters.length; i < _i; i++) {
        elm = $(updaters[i].selector);
        if (updaters[i].type === 'html_in') {
            elm.html(updaters[i].value)
        } else if (updaters[i].type === 'html_out') {
            elm.replaceWith(updaters[i].value)
        } else if (updaters[i].type === 'field') {
            elm.val(updaters[i].value)
        } else if (updaters[i].type === 'remove')elm.remove()
    }
    ;
    return true
};
Drupal.Ajax.response = function (submitter, formObj, data) {
    var newSubmitter;
    data.local = {submitter: submitter, form: formObj};
    if (data.status === false) {
        Drupal.Ajax.updater(data.updaters);
        Drupal.Ajax.message(formObj, submitter, data, {action: 'notify', messages: data.messages_error, type: 'error'})
    } else if (data.preview !== null) {
        Drupal.Ajax.updater(data.updaters);
        Drupal.Ajax.message(formObj, submitter, data, {
            action: 'notify',
            messages: decodeURIComponent(data.preview),
            type: 'preview'
        })
    } else if (data.redirect === null) {
        if (data.messages_status.length > 0)Drupal.Ajax.message(formObj, submitter, data, {
            action: 'notify',
            messages: data.messages_status,
            type: 'status'
        });
        if (data.messages_warning.length > 0)Drupal.Ajax.message(formObj, submitter, data, {
            action: 'notify',
            messages: data.messages_warning,
            type: 'warning'
        });
        if (data.messages_status.length === 0 && data.messages_warning.length === 0)Drupal.Ajax.message(formObj, submitter, data, {action: 'clear'})
    } else if (Drupal.Ajax.invoke('redirect', data)) {
        Drupal.Ajax.redirect(data.redirect)
    } else {
        Drupal.Ajax.updater(data.updaters);
        if (data.messages_status.length === 0 && data.messages_warning.length === 0) {
            Drupal.Ajax.message(formObj, submitter, data, {action: 'clear'})
        } else Drupal.Ajax.message(formObj, submitter, data, {
            action: 'notify',
            messages: data.messages_status,
            type: 'status'
        })
    }
    ;
    return true
};
Drupal.Ajax.redirect = function (url) {
    window.location.href = url
};
Drupal.behaviors.Ajax = Drupal.Ajax.init;
/* Source and licensing information for the above line(s) can be found at http://www.animecenter.tv/sites/all/modules/ajax/ajax.js. */
