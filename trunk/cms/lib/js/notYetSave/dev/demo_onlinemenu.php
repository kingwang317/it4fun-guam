<script src="http://jquery.com/src/jquery.js"></script>
<script src="http://lib.mobius.tw/jquery/plugin/selectors/JQuery.moreSelectors.js"></script>
	<fieldset style="width:70%">
		<legend>Demo...</legend>

		<p>This dummy form demontrates some of the new selectors. You can edit fields, set the focus or move the mouse etc. The results in the panel below will change accordingly.</p>
		<hr/>

		<form id="divDummyForm">

		<p>
			<label for="txt1" id="lbl1" title="lbl1">Textboxes (txt1, txt2):</label><br/>
			<input type="text" id="txt1" value="" />
			<input type="text" id="txt2" value="" NAME="txt2"/>
		</p>

		<p>
			<label for="txa1" id="lbl2" title="lbl2">Textareas (txa3, txa4):</label><br/>

			<textarea id="txa1" style="width:100px;display:inline;"></textarea>
			<textarea id="txa2" style="width:100px;display:inline;"></textarea>
		</p>

		<p>
			<label for="lst1" id="lbl3" title="lbl3">Select Lists (lst1, lst2, lst3):</label><br/>
			<select id="lst1" multiple><option id="opt1" value="opt1" selected>opt1</option><option id="opt2" value="opt2" selected>opt2</option><option id="opt3" value="opt3">opt3</option></select>

			<select id="lst2"><option id="opt4" value="opt4">opt4</option><option id="opt5" value="opt5" selected>opt5</option><option id="opt6" value="opt6">opt6</option></select>
			<!--<select id="lst3"><option id="opt7" value="opt7">opt7</option><option id="opt8" value="opt8">opt8</option><option id="opt9" value="opt9">opt9</option></select>-->
			<!--<input type="button" value="Add item to lst1" onclick="lst1.options.add(document.createElement('<OPTION id=optNEW>NEW</option>'))" />-->
		</p>

		<p>
			<label for="chk1" id="lbl4" title="lbl4">Checkboxes (chk1,2): | Radio buttons (rad1,2,3):</label>

			<br/>
			<input type="checkbox" id="chk1" checked/>
			<input type="checkbox" id="chk2" />
			<input type="radio" id="rad1" name="chk" checked />
			<input type="radio" id="rad2" name="chk" />
			<input type="radio" id="rad3" name="chk"/>
		</p>

		<p>

			<label for="btn1" id="lbl5" title="lbl5">Buttons (btn1, btn2 & btn3):</label><br/>
			<button id="btn1" style="width:100px;" title="This is a <button> element" >Dummy</button>
			<input type="button" id="btn2" value="Dummy" style="width:100px;" title="This is an <input type=text> element" />
			<input type="reset" id="btn3" value="Reset" title="This is an <input type=reset> element" />
		</p>

		</form>

		<br/>
		<p>This panel shows the results of the :selector queries.
			<br/>The queries will be re-run in <b id="divCountdown">5</b> seconds:
			<br/>(This many queries at once eats cpu on each re-run, sorry!)
		</p>
		<div id="divTestResults" style="overflow:auto;border:1px solid silver;background-color:lightyellow;font-size:smaller;">
		</div>

	</fieldset>

	<script type="text/javascript" language="javascript">

		window.setInterval("doCountdown()",1000);

		// Display countdown timer for the demo refresh:
		function doCountdown(){

			var d = document.getElementById("divCountdown");
			var c = parseInt(d.innerText || d.textContent);
			c--;

			if(c<1){
				c = 5;
				runDemo();
			}

			if(d.innerText) d.innerText = c
			else if(d.textContent) d.textContent = c;

		}

		// Run the demo queries and refresh the results display:
		function runDemo(){

			var msg = '', csvList, jqForm = $("#divDummyForm");

			csvList = '';
			jqForm.find(":blur").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:blur") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":focus").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:focus") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":hover").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:hover") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":modified").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:modified") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":option").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:option") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":option-sel").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:option-sel") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":option-def").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:option-def") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":option-mod").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:option-mod") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":input").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:input") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":text").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:text") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":textarea").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:textarea") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":select").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:select") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":multiple").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:multiple") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":checkbox").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:checkbox") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":radio").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:radio") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":button").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:button") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":selected").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:selected") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find("INPUT:nth-last-child(1)").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/INPUT:nth-last-child(1)") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":nth-of-type(1)").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:nth-of-type(1)") -> ' + csvList + '<br/>';

			csvList = '';
			jqForm.find(":nth-child-of-type(1)").each(function(){ csvList += this.id + ', ' }).end();
			msg += '$("FORM/*:nth-child-of-type(1)") -> ' + csvList + '<br/>';

			//csvList = '';
			//jqForm.find(":in-view").each(function(){ csvList += this.id + ', ' }).end();
			//msg += '$("*:in-view") -> ' + csvList + '<br/>';

			document.getElementById("divTestResults").innerHTML = msg;
		
		}
	
	</script>

	<br/>
	<fieldset>
