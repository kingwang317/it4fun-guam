 var maxHeight=1;
 
 function setSameHeight(){
	var div = document.getElementsByTagName('div');
		for (i=0; i<div.length; i++){
			if (/\bsame_height\b/.test(div[i].className)){
				maxHeight = Math.max(div[i].offsetHeight,maxHeight);
			}
		}
		
		for (i=0; i<div.length; i++){
			if (/\bsame_height\b/.test(div[i].className)){
				div[i].style.cssText="height:"+maxHeight+"px";
			}
		}
	// alert (maxHeight);
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
  addEvent(window,'load', setSameHeight);
 }
