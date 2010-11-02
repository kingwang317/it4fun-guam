<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php
$move = $_GET['move'];
$cmsid = $_GET['cmsid'];
$seq = $_GET['seq'];

$contentNodes = $cms->xpath->query("//page[@id=$cmsid]/content");
$thisNode = $contentNodes->item($seq);

if($move=="up"){
	$newNode = $thisNode->cloneNode(true);
	$thisNode->parentNode->insertBefore( $newNode, $thisNode->previousSibling );
	$thisNode->parentNode->removeChild($thisNode);
} elseif ($move =="down"){
	$newNode = $thisNode->cloneNode(true);
	$thisNode->parentNode->insertBefore( $newNode, $thisNode->nextSibling->nextSibling );
	$thisNode->parentNode->removeChild($thisNode);
}

$ok = $cms->dom->save(CMSXML);
if ($ok){
	echo "更新成功";
} else {
	echo "更新失敗";
}

$back = $_SERVER['HTTP_REFERER'];
header("location:$back");

?>

