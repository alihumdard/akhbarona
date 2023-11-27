//+or- font
var tgs = new Array( 'div','td','tr','a');
var szs = new Array( '7pt','8pt','9pt','10pt','11pt','12pt','13pt' );
var startSz = 1;

// +/-
function ts( trgt,inc ) {
	if (!document.getElementById) return
	var d = document,cEl = null,sz = startSz,i,j,cTags;
	
	sz += inc;
	if ( sz < 0 ) sz = 0;
	if ( sz > 6 ) sz = 6;
	startSz = sz;
		
	if ( !( cEl = d.getElementById( trgt ) ) ) cEl = d.getElementsByTagName( trgt )[ 0 ];

	cEl.style.fontSize = szs[ sz ];

	for ( i = 0 ; i < tgs.length ; i++ ) {
		cTags = cEl.getElementsByTagName( tgs[ i ] );
		for ( j = 0 ; j < cTags.length ; j++ ) cTags[ j ].style.fontSize = szs[ sz ];
	}
}
// size
function tsz( trgt,sz ) {
	if (!document.getElementById) return
	var d = document,cEl = null,i,j,cTags;
	
	if ( !( cEl = d.getElementById( trgt ) ) ) cEl = d.getElementsByTagName( trgt )[ 0 ];

	cEl.style.fontSize = sz;

	for ( i = 0 ; i < tgs.length ; i++ ) {
		cTags = cEl.getElementsByTagName( tgs[ i ] );
		for ( j = 0 ; j < cTags.length ; j++ ) cTags[ j ].style.fontSize = sz; //szs[ sz ];
	}
}

function resizeShort(short, summary){
	short.setStyle({overflow:'hidden'});
	
	if (summary){
		var i = 0;
		var text = summary.innerHTML.stripTags();
		summary.update(text);
		
		while (short.scrollHeight > short.offsetHeight) {
			i++;
			if (i > 100) break;
			var text = summary.innerHTML;
			summary.update(text.replace(/\W*\w+\W*$/, ''));
		}
	}
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function loadAjax(url, cFunction) {
    var browser_name = getCookie('browser_name');
    if(browser_name != '') {
        set_menu(browser_name);
        return browser_name;
    }
    var xhttp;
    xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cFunction(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
function resultAjax(xhttp) {
    setCookie('browser_name',xhttp.responseText,90);
    set_menu(xhttp.responseText);

}
function set_menu(_browser) {
    if(_browser == 'Chrome')
    {
        var child_menus = document.getElementById("menu_main").children;
        for (i = 0; i < child_menus.length; i++) {
            child_menus[i].style.marginTop = "5px";
        }

    }
}
