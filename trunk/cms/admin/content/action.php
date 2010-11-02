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
	$myNodeList->item(0)->setAttribute('navfunc',isset($_POST['navfunc'])?$_POST['navfunc']:"");
	$myNodeList->item(0)->setAttribute('display',$_POST['display']);
	$myNodeList->item(0)->setAttribute('linkurl',isset($_POST['linkurl'])?$_POST['linkurl']:"");
	$myNodeList->item(0)->setAttribute('target',isset($_POST['target'])?$_POST['target']:"");
	$myNodeList->item(0)->setAttribute('customtarget',$_POST['customtarget']);
	$myNodeList->item(0)->setAttribute('li_class',$_POST['li_class']);
	$myNodeList->item(0)->setAttribute('a_class',$_POST['a_class']);
	$myNodeList->item(0)->setAttribute('a_title',$_POST['a_title']);
	break;
	case '3':
	$myNodeList->item(0)->setAttribute('title',$_POST['title']);
	$myNodeList->item(0)->setAttribute('description',$_POST['description']);
	$myNodeList->item(0)->setAttribute('keywords',$_POST['keywords']);
	$myNodeList->item(0)->setAttribute('urlqstring',$_POST['urlqstring']);
	break;	
	case '4':
	$myNodeList->item(0)->setAttribute('template',$_POST['template']);
	$myNodeList->item(0)->setAttribute('fck_css',$_POST['fck_css']);
	$myNodeList->item(0)->setAttribute('fck_style',$_POST['fck_style']);
	$myNodeList->item(0)->setAttribute('fck_template',$_POST['fck_template']);
	break;
	
	}
	$ok = $cms->dom->save(CMSXML);
	
	if ($ok){
		echo "更新成功";
	} else {
		echo "更新失敗";
	}
	$back = $_SERVER['HTTP_REFERER'];
	echo "<meta http-equiv=\"refresh\" content=\"1.6;URL=$back\" />";
?>