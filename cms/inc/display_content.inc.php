<?php
if (empty($cms)){
$cms = new cmstree('cmsid',SRVROOT.'/cms/xml/cms.xml');
}

$contentlist = $cms->thisNode->childNodes;
$count = 0;
foreach ($contentlist as $contentNode){
	if($contentNode->nodeName=='content'){
		get_content($contentNode);
		$count++;
	}
}

if ($count==0){
	echo "尚未輸入內容";
}

function get_content($node){
	$method =  $node->getAttribute('method');
	//若沒有設定div id
	if($node->getAttribute('divid') != "")
		$divid = $node->getAttribute('divid');
	else
		$divid = "default";
	//若沒有設定class
	if($node->getAttribute('divclass') != "")
		$divclass = $node->getAttribute('divclass');
	else
		$divclass = "default";	
	//$divclass = isset($node->getAttribute('divclass'))?$node->getAttribute('divclass'):"default";
	
	echo "\n<div id=\"$divid\" class=\"$divclass\">";
			
	//prepare myinclude 
	global $cms;
	$templateUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.WEBROOT.$cms->nowtemplate;
	//echo $templateUrl;
	

	switch($method){
		case 'online':
			$file = CONTENTFOLDER.$node->getAttribute('filename');
			//myinclude($file,$templateUrl);
			ob_include($file);
		break;
		
		case 'include'; default:
			$incurl = $node->getAttribute('includeurl');
			if (file_exists(SRVROOT.$incurl)){
				//myinclude(SRVROOT.$incurl, $templateUrl);
				//print_r(SRVROOT.$incurl);
				ob_include(SRVROOT.$incurl);
			} else {
				echo "找不到檔案:$incurl";
			}
		break;
		
		case 'iframe':
			$iframeurl=$node->getAttribute('iframeurl');
			if(strpos($iframeurl,'http://')!==false){
				$file = $iframeurl;
			}else{
				$file = WEBROOT.$iframeurl;
			}
			
			$h=$node->getAttribute('iframe_h');
			if(!$h){
				$h=600;
			}
			$w=$node->getAttribute('iframe_w');
			if(!$w){
				$w='100%';
			}

			if($node->getAttribute('autoheight')==1){
				echo "<script type=\"text/javascript\" src=\"".LIBWEBROOT."/js/iframe_autoHeight/autoHeight_contentHeight.js\"></script>";
				echo "<iframe src=\"$file\" height=\"$h\" width=\"$w\" frameborder=\"0\" class=\"autoHeight\"></iframe>";
			} else {
				echo "<iframe src=\"$file\" height=\"$h\" width=\"$w\" frameborder=\"0\"></iframe>";
			}
		break;
		case 'plugin';

		$addWay = $node->getAttribute('addWay');
		$folder = $node->getAttribute('folder');
		$incurl = $node->getAttribute('pluginUrl');
		$iframeurl = $node->getAttribute('pluginUrl');
		
		if($addWay=='include'){
			if (file_exists(SRVROOT.$incurl)){
				ob_include(SRVROOT.$incurl);
			} else {
				echo "找不到檔案:$incurl";
			}
		} else if ($addWay =='iframe'){
			if(strpos($iframeurl,'http://')!==false){
				$file = $iframeurl;
			}else{
				$file = WEBROOT.$iframeurl;
			}
			
			$h=$node->getAttribute('iframe_h');
			if(!$h){
				$h=600;
			}
			$w=$node->getAttribute('iframe_w');
			if(!$w){
				$w='100%';
			}

			if($node->getAttribute('autoheight')==1){
				echo "<script type=\"text/javascript\" src=\"".LIBWEBROOT."/js/iframe_autoHeight/autoHeight_contentHeight.js\"></script>";
				echo "<iframe src=\"$file\" height=\"$h\" width=\"$w\" frameborder=\"0\" class=\"autoHeight\" allowtransparency=\"1\"></iframe>";
			} else {
				echo "<iframe src=\"$file\" height=\"$h\" width=\"$w\" frameborder=\"0\" allowtransparency=\"1\"></iframe>";
			}
		}



		break;
	}
	echo "</div>";
}
?>
<?php if(true){?>
<style>
#turnview{
position:fixed; top:20px; right:15px; position:absolute;
background-image:url(<?php echo $_SERVER['WEBROOT']; ?>/cms/admin/css/images/small-icon/turnview-blue.gif); background-position:3px 2px; background-repeat:no-repeat;
padding-left:20px;
border:#000000 solid 1px;
}
.highlightit div{
height:20px; line-height:20px;
background-color:#FFCC00;
padding-left:10px; padding-top:0px; padding-right:10px; padding-bottom:1px;
display:block; width:60px;
font-size:13px;
color:#000000; font-weight:normal;text-decoration:none;
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=70);
-moz-opacity: 0.7;
}
.highlightit:hover div{
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);
-moz-opacity: 1;
cursor:hand;
color:#0000FF; text-decoration:underline;
}
</style>
<?php }?>