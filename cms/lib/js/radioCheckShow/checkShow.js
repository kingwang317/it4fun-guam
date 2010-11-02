$(document).ready(function(){
	radioCheckShow();
	$('input.checkShow').click(function(){
		radioCheckShow();
	});
});

function radioCheckShow(){
	 $("input.checkShow[@type=radio][@checked]").parent().not('div').next('div').show();
	 $("input.checkShow[@type=radio][@checked]").parent().not('div').children('span').show();
	 $("input.checkShow[@type=radio][@checked]").parent('label').parent().not('div').next('div').show();
	 $("input.checkShow[@type=radio][@checked]").parent('label').parent().not('div').children('span').show();

	 $("input.checkShow[@type=radio]").not('[@checked]').parent().not('div').next('div').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent().not('div').children('span').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent('label').parent().not('div').next('div').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent('label').parent().not('div').children('span').hide();

/***** for Div Parent **********************************************************/
	 $("input.checkShow[@type=radio][@checked]").parent('div').children('div,span').show();
	 $("input.checkShow[@type=radio][@checked]").parent('label').parent('div').children('div,span').show();

	 $("input.checkShow[@type=radio]").not('[@checked]').parent('div').children('div,span').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent('label').parent('div').children('div,span').hide();
}

