<style>
.checkShow {}

.level2 {
	border:1px solid green;
}
</style>
	
<p><strong>功能</strong>：自動將 radio button 後面的 div 或 span 區域隱藏， 點選此 radio button 顯現</p>
<p><strong>用法</strong>：</p>
<ol>
	<li>外掛 checkShow.js (需含 jquery.js) </li>
	<li> radio button 上加上 class=&quot;<span class="level2">checkShow</span>&quot; </li>
</ol>
<p><strong>範例</strong>：
	<script src="http://lib.mobius.tw/jquery/jquery.js"></script>
	<script src="http://lib.mobius.tw/jquery/myplugin/radioCheckShow/checkShow.js"></script>
</p>
<form name="form1" method="post" action="">
1. 以 &lt;p&gt;區隔Radio區塊：
	<p>
		<input name="RadioGroup1" id="r1" type="radio" class="checkShow" value="v1">
		<label for="r1">radio1</label>
	<div class="level2">屬於radio1的 Div </div>
	</p>
	
	<p>
		<input name="RadioGroup1" type="radio" class="checkShow" value="v2">
		radio2		
		<a href="#">dummy link</a> 
		<span class="level2">radio2的span</span>
	<div class="level2">屬於radio2的 Div </div>
	</p>
	
	<p>
		<input name="RadioGroup1" type="radio" class="checkShow" value="v3">
		radio3
		<span class="level2">屬於radio3的
		<input type="text" name="textfield">
		</span>	
	</p>
	<hr />
	2. 以 &lt;div&gt; 區隔Radio區塊： 
	<div>
		<input name="RadioGroup2" type="radio" class="checkShow" value="v1">
		radio1	</p>
		<div class="level2">屬於radio1的 Div </div>
	</div>
	
	<div>
		<label>
			<input name="RadioGroup2" type="radio" class="checkShow" value="v2">
			22radio2		
		</label>
		<a href="#">dummy link</a><span class="level2">radio2的span</span>
		<div class="level2">22屬於radio2的 Div </div>
	</div>
	
	<div>
		<input name="RadioGroup2" type="radio" class="checkShow" id="RadioGroup2" value="v3">
		radio3
		<span class="level2">屬於radio3的
		<input type="text" name="textfield">
		</span>	
	</div>
</form>
