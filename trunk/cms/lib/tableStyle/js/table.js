//submit ���s�� hover �ĪG
$(function(){
	//�� table �[�W����
	$('.table tbody tr:odd').attr('class','odd');
	//�h�� table �p�G�쥻���]�w�� border �ݩ� (for IE7)
	$('table[@class="table"]').removeAttr('border'); 
});
