<script src="http://lib.mobius.tw/jquery/jquery.js"></script>
<script src="http://lib.mobius.tw/jquery/myplugin/notYetSave/notYetSave.js"></script>
<!--<script src="../../jquery.js"></script>
<script src="notYetSave.js"></script>
-->
<p>作用：離開頁面前，如果表單已經修改，顯示確認對話</p>
<p>用法：直接外掛 notYetSave.js 即可</p>
<p>特殊用法：</p>
<p>AJAX 中，如果表單以儲存，將 formModified 歸零 (formModified=0) </p>
<p>範例表單：</p>
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
