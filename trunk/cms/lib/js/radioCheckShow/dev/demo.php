<script src="http://lib.mobius.tw/jquery/jquery.js"></script>
<script>
$(document).ready(function(){
	 $("input.checkShow[@type=radio][@checked]").parent().next('div').show();
	 $("input.checkShow[@type=radio][@checked]").parent().children('span').show();
	 $("input.checkShow[@type=radio][@checked]").parent('label').parent().next('div').show();
	 $("input.checkShow[@type=radio][@checked]").parent('label').parent().children('span').show();

	 $("input.checkShow[@type=radio]").not('[@checked]').parent().next('div').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent().children('span').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent('label').parent().next('div').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent('label').parent().children('span').hide();

	 $('input.checkShow').click(function(){
	 
	 $("input.checkShow[@type=radio][@checked]").parent().next('div').show('normal');
	 $("input.checkShow[@type=radio][@checked]").parent().children('span').show();
	 $("input.checkShow[@type=radio][@checked]").parent('label').parent().next('div').show('normal');
	 $("input.checkShow[@type=radio][@checked]").parent('label').parent().children('span').show();

	 $("input.checkShow[@type=radio]").not('[@checked]').parent().next('div').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent().children('span').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent('label').parent().next('div').hide();
	 $("input.checkShow[@type=radio]").not('[@checked]').parent('label').parent().children('span').hide();
	 
/*	 	$(this).parent().next('div').css('background-color','red');
	 	$(this).parent().children('span').css('background-color','red');
	 	$(this).parent('label').parent().next('div').css('background-color','red');
	 	$("input[@type=radio]").not('[@checked]').css('margin','0px');
*/	 });
});
</script>

<style>
.checkShow {

}

.level2 {
	border:1px solid green;
}

input {
border:1px solid blue;
}
</style>

<form name="form1" method="post" action="">
	<p>
		<input name="RadioGroup1" id="r1" type="radio" class="checkShow" value="v1">
		<label for="r1">radio1</label>
		<div class="level2">屬於radio1的 Div </div>
	</p>
	
	
	<p>
			<input name="RadioGroup1" type="radio" class="checkShow" value="v2">
			radio2		
		
		<a href="#">dummy link</a> 
		<span>新增 Div 標籤的內容放在這裡</span>
	<div class="level2">屬於radio2的 Div </div>
	</p>
	
	<p>
			<input name="RadioGroup1" type="radio" class="checkShow" value="v3">
			radio3
		<span class="level2">屬於radio3的
		<input type="text" name="textfield">
		</span>	</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
		<p>
		
			<input name="RadioGroup2" type="radio" class="checkShow" value="v1">
			radio1
	<div class="level2">屬於radio1的 Div </div>

	</p>
	
	
	<p>
		<label>
			<input name="RadioGroup2" type="radio" class="checkShow" value="v2">
			22radio2		</label>
		
		<a href="#">dummy link</a> 
		<span>新增 Div 標籤的內容放在這裡</span>
	<div class="level2">22屬於radio2的 Div </div>
	</p>
	
	<p>
			<input name="RadioGroup2" type="radio" class="checkShow" id="RadioGroup2" value="v3">
			radio3
		<span class="level2">屬於radio3的
		<input type="text" name="textfield">
		</span>	</p>
</form>
