<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php
if($_POST['name']==''){
	echo "請填寫導覽名稱";
	echo " <a href=\"javascript: history.go(-1)\">Back</a>";
	exit;
}

$cmsPid = $_POST['cmsid'];
 $maxid=0;
foreach($cms->dom->getElementsByTagName('page') as $targetEle){
	$id=$targetEle->getAttribute('id');
	if ($maxid<(int)$id) $maxid=(int)$id;
} 
$thisId = $maxid+1;
$pNode = $cms->xpath->query("//page[@id=$cmsPid]")->item(0);
$newNode = $cms->dom->createElement('page');
$newNode->setAttribute('id',$thisId);

$newNode->setAttribute('name',$_POST['name']);

if($_POST['hide']=='hide'){
	$newNode->setAttribute('display','hide');
} else {
	$newNode->setAttribute('display','show');
}


if($_POST['addAt']=='first'){
	$pageChild = $cms->xpath->query("./page",$pNode);
	
	//echo $pageChild->item(0)->getAttribute('name');
	
	if ($pageChild->length > 0){
		$pNode->insertBefore($newNode,$pageChild->item(0));
	} else {
		$pNode->appendChild($newNode);
	}
		
} else {
	$pNode->appendChild($newNode);
}

	$ok = $cms->dom->save(CMSXML);


$backurl = $_SERVER['WEBROOT']."/cms/admin/index.php?cmsroot=content&cmsid=$thisId";

	if ($ok){
		echo "新增成功";
		header("location:$backurl");
	} else {
		echo "新增失敗";
	}
	

?>
