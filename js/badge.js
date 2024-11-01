var tfbSkipInit = typeof tfb === 'undefined';
var tfb = tfb || {};
tfb.allowedLabels = ["follow-me", "follow-us", "follow", "my-twitter"];
tfb.defaultTop = 78;
tfb.defaultColor = "#35ccff";
tfb.isInArray = function(str, ar) {
    if (ar.length < 1) return;
    for (var i = 0; i < ar.length; i++) {
        if (ar[i] == str) {
            return true;
            break;
        }
    }
    return false;
}
tfb.showbadge = function() {
    if (!window.XMLHttpRequest) {
        return;
    }
    if (document.getElementById('twitterFollowBadge')) {
        document.body.removeChild(document.getElementById('twitterFollowBadge'));
    }
    if (tfb.top < 0 || tfb.top > 1000 || isNaN(tfb.top)) {
        tfb.top = tfb.defaultTop;
    }
    if (!tfb.isInArray(tfb.label, tfb.allowedLabels)) {
        tfb.label = tfb.allowedLabels[0];
    }
    var validColorPattern = /^#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/;
    if (tfb.color != 'transparent' && (!validColorPattern.test(tfb.color) || (tfb.color.length != 4 && tfb.color.length != 7))) {
        tfb.color = tfb.defaultColor;
    };
    if (tfb.side != 'l') {
        tfb.side = 'r';
    }
    tfb.tabStyleCode = 'position:fixed;' + 'top:' + tfb.top + 'px;' + 'width:30px;' + 'height:119px;' + 'z-index:8765;' + 'cursor:pointer;' + 'background:' + tfb.color + ' url(' + tfb.path + tfb.label + '.png);' + 'background-repeat:no-repeat;';
    tfb.aboutStyleCode = 'position:fixed;' + 'top:' + (parseInt(tfb.top) + 107) + 'px;' + 'width:10px;' + 'height:11px;' + 'z-index:9876;' + 'cursor:pointer;' + 'background:url(' + tfb.path + 'icon-about.png);' + 'background-repeat:no-repeat;';
    if (tfb.side == 'l') {
        tfb.tabStyleCode += 'left:0; background-position:right top;';
        tfb.aboutStyleCode += 'left:0;';
    } else {
        tfb.tabStyleCode += 'right:0; background-position:left top;';
        tfb.aboutStyleCode += 'right:0;';
    }
    tfbMainDiv = document.createElement('div');
    tfbMainDiv.setAttribute('id', 'twitterFollowBadge');
    document.body.appendChild(tfbMainDiv);
    tfbMainDiv.innerHTML = '<div id="tfbTab" style="' + tfb.tabStyleCode + '"></div><div id="tfbAbout" style="' + tfb.aboutStyleCode + '"></div>' + '<style>#tfbAbout{visibility:hidden;} #twitterFollowBadge:hover #tfbAbout{visibility:visible;}</style>';
    document.getElementById('tfbTab').onclick = function() {
        window.open('http://twitter.com/' + tfb.account);
    }
    document.getElementById('tfbAbout').onclick = function() {
        window.open('https://www.kyleabaker.com/goodies/coding/wp-twitterbadge/');
    }
}
if (typeof document!=='undefined' && typeof document.body!=='undefined' && typeof document.body.style!=='undefined' && typeof document.body.style.msOverflowStyle!=='undefined') document.body.style.msOverflowStyle = 'scrollbar';
if (!tfbSkipInit) tfb.showbadge();