<?php 	
//header("Content-Type:text/html;charset=BIG5");
require_once($_SERVER['SRVROOT'].FCK.'fckeditor.php'); // 1. 以正確的絕對路徑 include fckeditor.php 主程式
require_once($_SERVER['SRVROOT'].'/cms/lib/editor/ckfinder/ckfinder.php');

//mobiuscms2.0 抓取預設值
$xfile = CMSXML;
$sx = simplexml_load_file($xfile);
$default = $sx->default;

//here to get content

	$oFCKeditor = new FCKeditor('content') ;   //2. FCKeditor 元件 具現化 new FCKeditor('表單欄位名稱')
	$oFCKeditor->Width  = '100%' ;
	$oFCKeditor->Height = '75%' ;
	//echo WEBROOT.FCK;
	$oFCKeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置
	$oFCKeditor->ToolbarSet = 'MyToolBar';

	if($default->fck_id!=''){
		$oFCKeditor->Config["BodyId"] = $default->fck_id;
	} else {
		$oFCKeditor->Config["BodyId"] = 'cms_content';
	}

	$oFCKeditor->Config["BodyClass"] =$default->fck_class;
	
	
	if($fck_css){
		$oFCKeditor->Config["EditorAreaCSS"] =  WEBROOT.$fck_css;
	}elseif($default->fck_css!=''){
		$oFCKeditor->Config["EditorAreaCSS"] =  WEBROOT.$default->fck_css ;
	}
	
	if($fck_style){
		$oFCKeditor->Config["StylesXmlPath"] =  WEBROOT.$fck_style ;
	}elseif($default->fck_style!=''){
		$oFCKeditor->Config["StylesXmlPath"] =  WEBROOT.$default->fck_style ;
	}
	
	if($fck_template){
		$oFCKeditor->Config["TemplatesXmlPath"] =  WEBROOT.$fck_template ;
	}elseif($default->fck_template!=''){
		$oFCKeditor->Config["TemplatesXmlPath"] =  WEBROOT.$default->fck_template ;
	}

	//$oFCKeditor->Config["EditorAreaCSS"] =  WEBROOT.$cms_content_css ;
	//$oFCKeditor->Config["StylesXmlPath"] = WEBROOT.$cms_fck_xml ;
	//$oFCKeditor->Config["TemplatesXmlPath"] = WEBROOT.'/cms/lib/editor/fcktemplates.xml';
	//載入內容
	if(isset($_GET['action']) && $_GET['action'] == "edit")
		$oFCKeditor->Value = $content;
	//echo WEBROOT.'/cms/lib/editor/ckfinder/';
	CKFinder::SetupFCKeditor($oFCKeditor,WEBROOT.'/cms/lib/editor/ckfinder/' ) ;
	$oFCKeditor->Create() ; //4. 執行 Create() 動作完成設計步驟
?>
