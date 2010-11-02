$(window).load(function(){	
	$('iframe.autoHeight').each(function(){
		if(this.contentDocument){
			this.height = this.contentDocument.body.offsetHeight + 32;
		} else {
			this.height = this.contentWindow.document.body.scrollHeight;
		}
	});
})