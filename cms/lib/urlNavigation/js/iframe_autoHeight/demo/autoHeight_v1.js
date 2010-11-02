$(function(){	
	$('iframe.autoHeight').each(function(){
	h = this.contentWindow.document.body.scrollHeight;
	this.height= h;

		if (h<1){
			$(this).load(function(){
				h = this.contentWindow.document.body.offsetHeight;	
				this.height= h + 32;
			});
		} 
	
	});
});