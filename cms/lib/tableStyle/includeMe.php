<?php
/*
talbeStyle功能：
1 .table 樣式
2. 自動設定 雙數行的 .odd class

To Aplly:
1. include Me
2. set .table to table
3. 標題請設定 .heading 或使用 <thead><tfoot> 以正確計算雙數行

To Design:
預設 css/table_lightgray.css

2008-3/15 Curtiss
*/

toTable();

function toTable(){
	$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));
	$nowWebPath = substr_replace($nowSrvPath, '', 0, strpos($nowSrvPath, $_SERVER['DOCUMENT_ROOT'])+ strlen($_SERVER['DOCUMENT_ROOT']));
?>
	<script src="<?php echo $nowWebPath ?>/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
	//submit 按鈕的 hover 效果
	$(function(){
		//為 table 加上條紋
		$('.table tbody tr[@class!="heading"]:odd').attr('class','odd');
		//去除 table 如果原本有設定的 border 屬性 (for IE7)
		$('table[@class="table"]').removeAttr('border'); 
	});
	</script>
	<link href="<?php echo $nowWebPath ?>/css/table_lightgray.css" rel="stylesheet" type="text/css">
<?php
}
?>