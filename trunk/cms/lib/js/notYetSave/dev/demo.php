<script src="http://lib.mobius.tw/jquery/jquery.js"></script>
<script src="http://lib.mobius.tw/jquery/plugin/selectors/JQuery.moreSelectors.js"></script>

<script>
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
	
	$('form').change(function(){
		formModified=1;
	});

});
</script>

<form name="form1" method="post" action="">
	<p>
		<input type="text" name="textfield">
</p>
	<p>
		<input type="text" name="textfield2">
	</p>
	<p>
		<input type="text" name="textfield3">
	</p>
	<p>
		<label>
		<input type="radio" name="RadioGroup1" value="1">
1</label>
		<br>
		<label>
		<input type="radio" name="RadioGroup1" value="2">
2</label>
		<br>
		<label>
		<input type="radio" name="RadioGroup1" value="3">
3</label>
		<br>
		<label>
		<input type="radio" name="RadioGroup1" value="4">
4</label>
	</p>
	<p>
		<select name="select" size="1">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
		</select>
	</p>
	<p>
		<textarea name="textarea"></textarea>
	</p>
	<p>
		<input type="submit" name="Submit" value="送出">
	</p>
</form>
<p><a href="http://www.google.com.tw">link out to google</a></p>
<div id="output"></div>
