<?php 	
require_once($_SERVER['SRVROOT'].'/cms/admin/config/ini.php');
require_once($_SERVER['SRVROOT'].FCK.'fckeditor.php'); // 1. 以正確的絕對路徑 include fckeditor.php 主程式
require_once($_SERVER['SRVROOT'].'/cms/lib/editor/ckfinder/ckfinder.php');

	$oFCKeditor = new FCKeditor('content') ;   //2. FCKeditor 元件 具現化 new FCKeditor('表單欄位名稱')
	$oFCKeditor->Width  = '100%' ;
	$oFCKeditor->Height = '200px' ;
	$oFCKeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置
	$oFCKeditor->ToolbarSet = 'myBasic';
	//載入內容
	$oFCKeditor->Value = $content;
	CKFinder::SetupFCKeditor($oFCKeditor,WEBROOT.'/cms/lib/editor/ckfinder/' ) ;
	$oFCKeditor->Create() ; //4. 執行 Create() 動作完成設計步驟
?>
