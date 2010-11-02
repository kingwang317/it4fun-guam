//submit 按鈕的 hover 效果
$(function(){
	//為 table 加上條紋
	$('.table tbody tr:odd').attr('class','odd');
	//去除 table 如果原本有設定的 border 屬性 (for IE7)
	$('table[@class="table"]').removeAttr('border'); 
});
