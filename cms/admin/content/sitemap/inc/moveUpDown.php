<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php
$move = $_GET['move'];
$cmsid = $_GET['cmsid'];

if($move=="up"){
	$newNode = $cms->thisNode->cloneNode(true);
	if($cms->thisNode->previousSibling->nodeName=="#text"){
		$cms->thisNode->parentNode->insertBefore( $newNode, $cms->thisNode->previousSibling->previousSibling );
	} else {
		$cms->thisNode->parentNode->insertBefore( $newNode, $cms->thisNode->previousSibling );
	}
	$cms->thisNode->parentNode->removeChild($cms->thisNode);
} elseif ($move =="down"){
	$newNode = $cms->thisNode->cloneNode(true);
	if($cms->thisNode->nextSibling->nodeName=="#text"){
		$cms->thisNode->parentNode->insertBefore( $newNode, $cms->thisNode->nextSibling->nextSibling->nextSibling );
	}else{
		$cms->thisNode->parentNode->insertBefore( $newNode, $cms->thisNode->nextSibling->nextSibling );
	}
	$cms->thisNode->parentNode->removeChild($cms->thisNode);
}

$ok = $cms->dom->save(CMSXML);
if ($ok){
	echo "更新成功";
} else {
	echo "更新失敗";
}
$back = $_SERVER['HTTP_REFERER'];
header("location:$back");
//echo "<meta http-equiv=\"refresh\" content=\"1.6;URL=$back\" />";

?>