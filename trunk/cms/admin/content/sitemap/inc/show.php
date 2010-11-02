<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php
$cmsid = $_GET['cmsid'];

$thisNode = $cms->get_node($cmsid);
$thisNode->setAttribute('display','show');

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