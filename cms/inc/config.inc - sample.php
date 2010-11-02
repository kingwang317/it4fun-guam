<?php 
/* Please rename this file to config.inc.php */

define('SITE_ROOT',	$_SERVER['SRVROOT']);
define('SITE_BASE', '');
define('URL_HOST', 'localhost');
define('URL_ROOT', '');
define('SITE_KEY', 'ZDQxZDhjZDk4ZjAwYjIwNGU5ODAwOTk4ZWNmODQyN2V8NTI0Mjg4MDB8MjA5OS0xMi0zMXwxNDAuMTI3LjE0OS4yMzZ8MTA4ODg=');
define('WEBROOT', $_SERVER['WEBROOT']);
define('SRVROOT', $_SERVER['SRVROOT']);
//定義 LIBROOT
define('LIBSRVROOT',SRVROOT.'/cms/lib');
define('LIBWEBROOT',WEBROOT.'/cms/lib');
//定義 CORESRVROOT
define('CORESRVROOT',SRVROOT.'/cms/core');
//其他常數設定
define('CMSXML',SRVROOT.'/cms/xml/cms.xml');
define('CONTENTFOLDER',SRVROOT.'/cms/resource/contents/');
define('FCK','/cms/lib/editor/FCKeditor_2.6/fckeditor/');
//定義資料庫
define('DB_USER', 'root');
define('DB_PASSWD', '');
define('DB_NAME', 'yata_cms');
define('DB_HOST', 'localhost');

/******************** include tree.class.php *********************/
require_once(CORESRVROOT.'/tree.class.php');
$cms = new cmstree('cmsid',CMSXML);
$startLevel = 0;
$deep = 99;

/******************** include  com.func.php *********************/
require_once(CORESRVROOT.'/com.func.php');


/**************** 安全性 ****************/
//magic_quotes 安全脫溢處理
//require_once(SRVROOT.'/cms/lib/magicQuotes/safeEscapeString.php');

//register global 安全關閉
if (ini_get('register_globals')==1) echo "***register_globals目前為開啟狀態，請設定為關閉，確保安全***</br>";

?>