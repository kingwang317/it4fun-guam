<?php
require_once("cms/inc/config.inc.php");
$filename = basename(__FILE__);
if(!file_exists(SRVROOT.'/'.$filename)){
echo "file not find, go <a href=\"cms/install/install.php\">install</a>";
exit;
}
if (!$cms){
	$cms = new cmstree();
}

ob_include(SRVROOT.$cms->nowtemplate,$cms->nowtemplate);



/****************** ob_include 區 start ********************/
//include 的檔案不能比此階層高 換句話說，include 不得為此檔案的 parent

function ob_include($incfile,$tmpl=null){
	global $absPath;
	if(isset($tmpl)){
		$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));
		$nowWebPath = substr_replace($nowSrvPath, '', 0, strpos($nowSrvPath, $_SERVER['DOCUMENT_ROOT'])+ strlen($_SERVER['DOCUMENT_ROOT']));
		$relativePath = str_replace($nowSrvPath,'',$incfile);
		$relativePath = dirname($relativePath);
		$relativePath = str_replace('.','',$relativePath);
		$absPath = WEBROOT.$relativePath;
	}
	ob_start('ob_replace');
	include($incfile);
	ob_flush();
	ob_clean();
}

		
function ob_replace($buffer){
	global $absPath;

	$pattern[0] ='/src="(?!\/|http:)/';
	$pattern[1] ='/src=\'(?!\/|http:)/';
	$pattern[2] ='/href="(?!\/|http:)/';
	$pattern[3] ='/href=\'(?!\/|http:)/';
	
	$replace[0] = 'src="'.$absPath.'/';
	$replace[1] = 'src=\''.$absPath.'/';
	$replace[2] = 'href="'.$absPath.'/';
	$replace[3] = 'href=\''.$absPath.'/';
	
	$newContent = preg_replace($pattern,$replace,$buffer);
	//$newContent.= $absPath;
	return $newContent;
}
/****************** ob_include 區 end ********************/

			


?>
