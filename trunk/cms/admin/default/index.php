<link href="<?php echo WEBROOT ?>/cms/admin/css/content.css" rel="stylesheet" type="text/css" />
<?php 
$xfile = CMSXML;
$sx = simplexml_load_file($xfile);
$default = $sx->default;
$cmsid = isset($_GET['cmsid'])?$_GET['cmsid']:0;
$action = WEBROOT."/cms/admin/default/action.php?cmsid=$cmsid";
$fck_address = "cms/lib/editor/FCKeditor_2.6/";
?>

<form id="form1" name="form1" method="post" action="<?php echo $action ?>">
	<h4>客戶預設值：</h4>
<p>
<label class="level1">客戶名稱:</label>
<input name="cus_name" type="text" id="cus_name" value="<?php echo $default->cus_name ?>" size="60" />
	</p>
<p>
<label class="level1">客戶網址:</label>
<input name="cus_url" type="text" id="cus_url" value="<?php echo $default->cus_url ?>" size="60" />
	</p>
	<h4>Mata預設值：</h4>
<p>
<label class="level1">titlle:</label>
<input name="title" type="text" id="title" value="<?php echo $default->title ?>" size="60" />
	</p>
	<p><label class="level1">Description:</label>
		<textarea name="description" cols="74" rows="3" id="description"><?php echo $default->description ?></textarea>
	</p>
	<p>
	<label class="level1">Keywords:</label>
		<textarea name="keywords" cols="74" rows="2" id="keywords"><?php echo $default->keywords ?></textarea>
	</p>
	<h4>設計相關預設值：</h4>
	<p>
	<label class="level1">預設網頁套版：</label>
<?php include($_SERVER['SRVROOT'].'/cms/lib/ckfinder/forTemplate.php'); ?>
		<input name="template" type="text" id="template" value="<?php echo $default->template ?>" size="50" />
	<span class="help"> 
	預設網頁套版，指的是本網站所有頁面統一設定套版樣式，若該頁面需使用不同套版，請至內容管理之設計師項目去進行設定‧	</span>(預設儲存位置+說明)</p>
	<h4>進階設定</h4>
	<p>
	<label class="level1"><strong>線上編輯器 設定值 (FCKeditor)</strong></label>
&nbsp;	</p>

	<p>編輯器 DIV 的 id：
		<input name="fck_id" type="text" id="fck_id" value="<?php echo $default->fck_id ?>" size="8" />
		<br />
	<span class="help">系統預設: id=&quot;<?php echo 'cms_content'; ?>&quot; 
	(圍繞編輯器內容區的 &lt;div&gt; id 值，例： &lt;div id=&quot;cms_content&quot;&gt;&lt;/div&gt;)</span></p>
	<p>編輯器 DIV 的 class：
		<input name="fck_class" type="text" id="fck_class" value="<?php echo $default->fck_class ?>" size="8" /><br />
		<span class="help">系統無預設值，若有需要可加入使用
		(例:&lt;div id=&quot;cms_content&quot; class=&quot;class名稱&quot; &gt;)</span>	</p>
	<p>編輯區 CSS：
		<input name="fck_css" type="text" id="fck_css" value="<?php echo $default->fck_css ?>" size="50" /><br />
		<span class="help">系統預設: <a href="<?php echo WEBROOT.$fck_address.'editor/css/fck_editorarea.css'; ?>" target="_blank"><?php echo $fck_address.'editor/css/fck_editorarea.css'; ?></a>
		<br />
		(編輯器所見即所得之CSS，前端套版需同步套用此CSS)</span></p>
	<p>樣式(下拉選單)設定檔：
		<input name="fck_style" type="text" id="fck_style" value="<?php echo $default->fck_style ?>" size="50" /><br />
		<span class="help">系統預設: <a href="<?php echo WEBROOT.$fck_address.'fckstyles.xml'; ?>" target="_blank"><?php echo $fck_address.'fckstyles.xml'; ?></a></span>	</p>
	<p><img src="<?php echo WEBROOT ?>/cms/admin/css/images/small-icon/icon-template.gif" alt="樣板小圖示"/>樣板設定檔：
		<input name="fck_template" type="text" id="fck_template" value="<?php echo $default->fck_template ?>" size="50" /><br />
		<span class="help">系統預設: <a href="<?php echo WEBROOT.$fck_address.'fcktemplates.xml'; ?>" target="_blank"><?php echo $fck_address.'fcktemplates.xml'; ?></a></span>	</p>
<p>
		<input type="submit" name="Submit" value="更新" />
	</p>
</form>
