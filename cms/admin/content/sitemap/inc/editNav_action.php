<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php 
if(isset($_POST['cmsid'])){ 
$editid=$_POST['cmsid'];
} else {
echo "can't access this page directly";
return;
}

	$myNodeList = $cms->xpath->query("//page[@id=$editid]");

	switch($_POST['step']){
	case '1':
	$myNodeList->item(0)->setAttribute('name',$_POST['name']);
	$myNodeList->item(0)->setAttribute('navfunc',$_POST['navfunc']);
	$myNodeList->item(0)->setAttribute('display',$_POST['display']);
	$myNodeList->item(0)->setAttribute('linkurl',$_POST['linkurl']);
	$myNodeList->item(0)->setAttribute('target',$_POST['target']);
	$myNodeList->item(0)->setAttribute('customtarget',$_POST['customtarget']);
	$myNodeList->item(0)->setAttribute('li_class',$_POST['li_class']);
	$myNodeList->item(0)->setAttribute('a_class',$_POST['a_class']);
	$myNodeList->item(0)->setAttribute('a_title',$_POST['a_title']);
	break;
	}
	$ok = $cms->dom->save(CMSXML);
	
	if ($ok){
		echo "更新成功";	
		echo "<script>window.opener.location.reload(); window.self.close();</script>";

	} else {
		echo "更新失敗";
	}
?>
