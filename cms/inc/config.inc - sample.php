<?php 
/* Please rename this file to config.inc.php */

define('SITE_ROOT',	$_SERVER['SRVROOT']);
define('SITE_BASE', '');
define('URL_HOST', 'localhost');
define('URL_ROOT', '');
define('SITE_KEY', 'ZDQxZDhjZDk4ZjAwYjIwNGU5ODAwOTk4ZWNmODQyN2V8NTI0Mjg4MDB8MjA5OS0xMi0zMXwxNDAuMTI3LjE0OS4yMzZ8MTA4ODg=');
define('WEBROOT', $_SERVER['WEBROOT']);
define('SRVROOT', $_SERVER['SRVROOT']);
//�w�q LIBROOT
define('LIBSRVROOT',SRVROOT.'/cms/lib');
define('LIBWEBROOT',WEBROOT.'/cms/lib');
//�w�q CORESRVROOT
define('CORESRVROOT',SRVROOT.'/cms/core');
//��L�`�Ƴ]�w
define('CMSXML',SRVROOT.'/cms/xml/cms.xml');
define('CONTENTFOLDER',SRVROOT.'/cms/resource/contents/');
define('FCK','/cms/lib/editor/FCKeditor_2.6/fckeditor/');
//�w�q��Ʈw
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


/**************** �w���� ****************/
//magic_quotes �w���淸�B�z
//require_once(SRVROOT.'/cms/lib/magicQuotes/safeEscapeString.php');

//register global �w������
if (ini_get('register_globals')==1) echo "***register_globals�ثe���}�Ҫ��A�A�г]�w�������A�T�O�w��***</br>";

?>