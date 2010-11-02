//2008/3/17  curtiss
function doIframe(){
	o = document.getElementsByTagName('iframe');
	for(i=0;i<o.length;i++){
		if (/\bautoHeight\b/.test(o[i].className)){
			setHeight(o[i]);
			addEvent(o[i],'load', doIframe);
			addEvent(o[i].contentWindow,'load',doIframe);
		}
	}
}

function setHeight(e){
	//alert(e.contentWindow.document.body.scrollHeight);
	if(e.contentDocument){ //FireFox
		childHeight = e.contentDocument.body.offsetHeight + 28;
	} else { //IE
		childHeight = e.contentWindow.document.body.scrollHeight + 30;
	}
	viewHeight=document.body.clientHeight;
	viewTop=160; //CMS後台的高度


	if(window.innerWidth){ //FireFox 
		viewBody=viewHeight-viewTop-19; //fx
	} else {
		viewBody=viewHeight-viewTop-15; //ie
	}
	
	if(childHeight<viewBody){
		newHeight = viewBody;	
	} else {
		newHeight = childHeight;	
	}
	
	e.height = newHeight;
}

function addEvent(obj, evType, fn){
	if(obj.addEventListener)
	{
	obj.addEventListener(evType, fn,false);
	return true;
	} else if (obj.attachEvent){
	var r = obj.attachEvent("on"+evType, fn);
	return r;
	} else {
	return false;
	}
}

if (document.getElementById && document.createTextNode){
 addEvent(window,'load', doIframe);	
}
