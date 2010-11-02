// jquery Document

msg = '    資料尚未儲存!!!';
window.onbeforeunload = function(){
	
	if ( bySubmit==0 && formModified ==1){
		return msg;
	}
}

$(document).ready(function(){
	bySubmit=0;
	formModified=0;

	$('form').submit(function(){
		bySubmit=1;
	});
	
	$('form, input, textarea, select').change(function(){
		formModified=1;
	});

});
