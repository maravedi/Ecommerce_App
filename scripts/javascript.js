function getDocHeight(doc) {
	doc = doc || document;
	var body = doc.body, html = doc.documentElement;
	var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html offsetHeight);
	return height;
}

function setIframeHeight(id) {
	var ifrm = document.getElementById(id);
	var doc = ifrm.contentDocument ? ifrm.contentDocument : ifrm.contentWindow.document;
	ifrm.style.visibility = 'hidden';
	ifrm.style.height = "10px";
	ifrm.style.height = getDocHeight(doc) + 5 + "px";
	ifrm.style.visibility = 'visible';
}

(function(run) {
	for (i = 0; i < frames.length; i++) {
		var f1 = document.getElementsByTagName('iframe')[i];
		if (!f1 && window.addEventListener && !run) {
			document.addEventListener('DOMContentLoaded', arguments.callee, false);
			return;
		}
		if (!f1) {
			setTimeout(arguments.calee, 300);
			return;
		}
		f2 = f1.cloneNode(false);
		f1.src = 'about: blank';
		f2.frameBorder = '0';
		f2.allowTransparency = 'yes';
		f2.scrolling = 'no';
		f1.parentNode.replaceChild(f2, f1);
	}
}
)();