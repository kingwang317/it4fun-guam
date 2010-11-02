<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php
$myNode = $cms->xpath->query("//page[@id={$_POST['cmsid']}]")->item(0);

$childNodes = $cms->xpath->query("//page[@id={$_POST['cmsid']}]/page");

if($_POST['cmsid']==0){
echo '<div align="center">';
echo "此頁為根目錄無法刪除。";
echo "<br /><a href=\"javascript:window.close()\">關閉視窗</a>";
echo '</div>';
}elseif($childNodes->length>0){
echo '<div align="center">';
echo "此階層下含有子階層，無法刪除<br>請移除子階層後再執行刪除。";
echo "<br /><a href=\"javascript:window.close()\">關閉視窗</a>";
echo '</div>';
} else {
	$pid = $myNode->parentNode->getAttribute('id');
	$myNode->parentNode->removeChild($myNode); 
	$ok = $cms->dom->save(CMSXML);

	$backurl = $_SERVER['WEBROOT'].'/cms/admin/index.php?cmsroot=content&cmsid='.$pid;

	if ($ok){
		echo "刪除成功";
		echo "
			<script>
			function closeWindow(){
			window.opener.location.href='$backurl';
			window.close(); 
			}
			closeWindow();
			</script>
		";
	} else {
		echo "刪除失敗";
		echo "<br /><a href=\"javascript:window.close()\">關閉視窗</a>";
	}


$backurl = keepUrl('',$_POST['comefrom']);
$backurl = addUrl('cmsid='.$pid,$backurl);
//echo "<meta http-equiv=\"refresh\" content=\"1.6;URL=$backurl\" />"; 
}
?>
