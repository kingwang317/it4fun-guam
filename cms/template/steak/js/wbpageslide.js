/*
blog: http://web-breaker.blogspot.com
author: FX from web-breaker blog
*/

function wbPageSlide (targetBox, animateSpeed){
	$(document).ready(function(){
		var _this = $(targetBox);
		var itemNum = $('.wbPageItem>div', _this).length;
		var itemWidth = $(".wbPageItem>div", _this).outerWidth(true);
		var slideWidth = itemNum * itemWidth;
		var showAtOnce = 1;
		var maxId = showAtOnce - itemNum;
		$('.wbPageItem', _this).css({width : slideWidth + "px"});
		var cId = 0;
		$('.wbPagePage>b:first', _this).css({color:'black'});
		$('.wbPagePage>b', _this).click(function () {
			var cThis = $(this);
			$('.wbPagePage>b', _this).css({color:'#a5a2a2'});
			$(this).css({color:'black'});
			var parentThis = $('.wbPagePage>b', _this);
			cId = -($(parentThis).index(cThis));
			sliding (cId);
		});
		function sliding (cId){
			var marginNum = itemWidth * cId;
			var newMargin = marginNum + 'px';
			var blockDistance = Math.abs(($('.wbPagePage>b', _this).outerWidth(true)) * (cId));
			$(".wbPageItem", _this).animate( { marginLeft: marginNum + "px" }, {  duration:animateSpeed } );
			$('.wbPageBlock', _this).animate( { left: blockDistance + "px" }, {  duration:animateSpeed } );
		};

		$.extend($.fn.disableTextSelect = function() {
			return this.each(function(){
				if($.browser.mozilla){//Firefox
					$(this).css('MozUserSelect','none');
				}else if($.browser.msie){//IE
					$(this).bind('selectstart',function(){return false;});
				}else{//Opera, etc.
					$(this).mousedown(function(){return false;});
				}
			});
		});
		$('.wbPagePage>b', _this).disableTextSelect();	
	});
};
$(document).ready(function(){ 
	$('.naviDiv>a').mouseover(function(){
		$(this).stop().fadeTo(0, 0);
		$(this).stop().fadeTo(400, 1);
	});
	$('.menuBox>a').mouseover(function(){
		$(this).stop().fadeTo(0, 0.3);
		$(this).stop().fadeTo(500, 1);
	});
})(jQuery);
