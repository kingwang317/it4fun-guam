<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>

<?php 
$cmsid = $_POST['cmsid'];
$toPid = $_POST['toPid'];

$thisNode = $cms->get_node($cmsid);
$pNode = $cms->get_node($toPid);

if (!$pNode){
	echo "此id不存在，無法移動到此id";
	echo "<meta http-equiv=\"refresh\" content=\"1.6;URL={$_POST['comefrom']}\" />"; 
	exit;
}

$path = $cms->get_path($toPid);
//print_r($path);
if (array_search($cmsid, $path)!==false){
	echo "無法移到自己階層之下";
	echo "<meta http-equiv=\"refresh\" content=\"1.6;URL={$_POST['comefrom']}\" />"; 
	exit;
}

$newNode = $thisNode->cloneNode(true);
$pNode->appendChild($newNode);
$thisNode->parentNode->removeChild($thisNode);

$ok = $cms->dom->save(CMSXML);
if ($ok){
echo "
	<script>
	function closeWindow(){
	window.opener.loadLeft();
	window.close(); 
	}
	closeWindow();
	</script>
";

} else {
	echo "更新失敗";
}

//echo "<meta http-equiv=\"refresh\" content=\"1.6;URL={$_POST['comefrom']}\" />"; 
?>


