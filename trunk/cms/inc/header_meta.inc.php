<?php
require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php");

$cms = new cmstree('cmsid',SRVROOT.'/cms/xml/cms.xml');
$title = $cms->thisNode->getAttribute('title');
$keywords = $cms->thisNode->getAttribute('keywords');
$description = $cms->thisNode->getAttribute('description');
/* echo $title;
echo "<pre>";
print_r($cms);
echo "</pre>"; */
if(!$title){
	$title=$cms->xpath->query("/cms/default/title")->item(0)->nodeValue;
}
if(!$keywords){
	$keywords=$cms->xpath->query("/cms/default/keywords")->item(0)->nodeValue;
}
if(!$description){
	$description=$cms->xpath->query("/cms/default/description")->item(0)->nodeValue;
}
?>
<title><?php echo $title ?></title>
<meta name="description" content="<?php echo $description ?>" />
<meta name="keywords" content="<?php echo $keywords ?>" />
<?php 	
/* HTML 範例
<title>摩比斯網路行銷</title>
<meta name="description" content="摩比斯網路行銷 - 網站排名，關鍵字排名，網頁設計，虛擬主機 - 網站成功專業顧問" />
<meta name="keywords" content="網路行銷，網站排名，關鍵字排名，網頁設計，虛擬主機，關鍵字行銷，網頁空間，網站行銷" />
*/
?>