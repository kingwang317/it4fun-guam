<?php
$error = 0;

/******************** 定義 WEBROOT *********************/
function webroot($nowfile){
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$webRoot  = str_replace(array($docRoot, $nowfile), '', $thisFile);
$webRoot = str_replace('/home','', $webRoot);
$srvRoot  = str_replace($nowfile, '', $thisFile);
define('WEBROOT', $webRoot);
define('SRVROOT', $srvRoot);
}
webroot('/cms/install/steps/action.php');
$srvroot = SRVROOT;
$webroot = WEBROOT;

/******************** .htaccess content *********************/
$htaccess = "
AddDefaultCharset UTF-8
ErrorDocument 404 $webroot/404.php
php_flag output_buffering On
SetEnv SRVROOT $srvroot
SetEnv WEBROOT $webroot
SetEnv SITE_KEY ZDQxZDhjZDk4ZjAwYjIwNGU5ODAwOTk4ZWNmODQyN2V8NTI0Mjg4MDB8MjA5OS0xMi0zMXwxNDAuMTI3LjE0OS4yMzZ8MTA4ODg=
php_flag magic_quotes_gpc off
php_flag register_globals off
Options -Indexes

RewriteEngine On
#RewriteRule ^cms/(.*)\/index-([0-9]+)\.html$ index.php?cmsid=$2&theme=$1 [L,NC]
RewriteRule ^cms/(.*)\/index-([0-9]+)\.html$ index.php?cmsid=$2&theme=$1 [L,NC]
";

//0. 定義 .htaccess 的相對路徑
$htFile = '../../../.htaccess';
//1. 檢查.htaccess 是否存在
if (!file_exists($htFile)){
echo ".htaccess 檔案不存在，請確認檔案 .htaccess 上傳至根目錄。";
return;
}
//2. 檢查.htaccess 是否可寫入
if (!is_writable($htFile)){
echo ".htaccess 檔案無法寫入，請修改檔案 .htacess 權限為可寫入。";
return;
}
//3. 寫入.htaccess
$ok = file_put_contents($htFile,$htaccess);
if ($ok){
echo "<p>.htaccess 設定成功。</p>";
} else {
echo ".htaccess 寫入失敗。";
	if($_SERVER['SRVROOT']!=$srvroot){
		return;
	}
} 

/******************** 檢查檔案權限 *********************/
$file ='/cms/xml/cms.xml';
if (is_writable(SRVROOT.$file)){
	echo "<div>$file 可寫入 .... OK</div>";
} else {
	echo "<div>$file 無法寫入 .... 請更改檔案權限</div>";
	$error++;
}

$file ='/cms/resource';
if (is_writable(SRVROOT.$file)){
	echo "<div>$file 可寫入 .... OK</div>";
} else {
	echo "<div>$file 無法寫入 .... 請更改檔案權限</div>";
	$error++;
}

$file ='/cms/resource';
if (is_executable(SRVROOT.$file)){
	echo "<div>$file 可執行 .... OK</div>";
} else {
	echo "<div>$file 無法執行 .... 請更改檔案權限</div>";
	$error++;
}

$file ='/cms/resource/contents';
if(file_exists(SRVROOT.$file)){
	if (is_writable(SRVROOT.$file)){
		echo "<div>$file 可寫入 .... OK</div>";
	} else {
		echo "<div>$file 無法寫入 .... 請更改檔案權限</div>";
		$error++;
	}
}

$file ='/cms/resource/file';
if(file_exists(SRVROOT.$file)){
	if (is_writable(SRVROOT.$file)){
		echo "<div>$file 可寫入 .... OK</div>";
	} else {
		echo "<div>$file 無法寫入 .... 請更改檔案權限</div>";
		$error++;
	}
}

$file ='/cms/resource/flash';
if(file_exists(SRVROOT.$file)){
	if (is_writable(SRVROOT.$file)){
		echo "<div>$file 可寫入 .... OK</div>";
	} else {
		echo "<div>$file 無法寫入 .... 請更改檔案權限</div>";
		$error++;
	}
}

$file ='/cms/resource/image';
if(file_exists(SRVROOT.$file)){
	if (is_writable(SRVROOT.$file)){
		echo "<div>$file 可寫入 .... OK</div>";
	} else {
		echo "<div>$file 無法寫入 .... 請更改檔案權限</div>";
		$error++;
	}
}

$file ='/cms/resource/media';
if(file_exists(SRVROOT.$file)){
	if (is_writable(SRVROOT.$file)){
		echo "<div>$file 可寫入 .... OK</div>";
	} else {
		echo "<div>$file 無法寫入 .... 請更改檔案權限</div>";
		$error++;
	}
}

if($error<1){
$adminUrl = 'http://www.'.$_SERVER['HTTP_HOST'].WEBROOT.'/cms/admin/';
$frontUrl = 'http://www.'.$_SERVER['HTTP_HOST'].WEBROOT.'/';
?>
<p>初始安裝成功 ( 請至後台管理網站內容 )。</p>
<p>後台：<a href="<?php echo $adminUrl; ?>"><?php echo $adminUrl; ?></a></p>
<p>前台： <a href="<?php echo $frontUrl; ?>"><?php echo $frontUrl; ?></a></p>
<?php 
} //end if
?>