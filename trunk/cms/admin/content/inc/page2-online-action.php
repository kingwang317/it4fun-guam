<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php
if(isset($_REQUEST['cmsid'])){ 
$editid=$_REQUEST['cmsid'];
} else {
echo "can't access this page directly";
return;
}

switch($_REQUEST['action']){
	case 'edit':
		$myNode = $cms->xpath->query("//page[@id=$editid]/content")->item($_POST['order']);
		$filename = $myNode->getAttribute('filename');
		$myNode->setAttribute('divid',$_POST['divid']);
		$myNode->setAttribute('divclass',$_POST['divclass']);
		$ok = $cms->dom->save(CMSXML);
		if (!$ok){
			echo "divid 與 divclass 更新失敗";
		}
		
		$ok = file_put_contents ( CONTENTFOLDER.$filename, $_POST['content']);
		
		if ($ok===false){
			echo "更新失敗";
		} else {
			echo "更新成功";
			echo "<script>
			window.opener.loadContent('$editid');
			window.close();
			</script>";
		}
	break;
	
	case 'add':
		if(!file_exists(CONTENTFOLDER)){
		mkdir(CONTENTFOLDER);
		}
		
		$prefix = 'p'.$editid.'-';
		
		$start = 1;
	    do {
    	$prefilename =$prefix.$start++;
		$filename = $prefilename.'.htm';
   		} while (file_exists(CONTENTFOLDER.$filename));
		
		($_POST['content'])?$content=$_POST['content']:$content='';
		
		$ok = file_put_contents (CONTENTFOLDER.$filename, $content);
		if($ok===false){
			echo "更新失敗";
			return;
		}
		
		$myNode = $cms->xpath->query("//page[@id=$editid]")->item(0);
		$pageChilds = $cms->xpath->query("//page[@id=$editid]/page");
		
		$element = $cms->dom->createElement('content');
		if ($pageChilds->length>0){
			$contentNode = $myNode->insertBefore($element,$pageChilds->item(0));
			
		} else {
			$contentNode = $myNode->appendChild($element);
		}

		$contentNode->setAttribute('method','online');
		$contentNode->setAttribute('filename',$filename);
		$contentNode->setAttribute('divid',$_POST['divid']);
		$contentNode->setAttribute('divclass',$_POST['divclass']);

		$ok = $cms->dom->save(CMSXML);
		if ($ok){
			echo "更新成功";

			echo "<script>
			window.opener.loadContent('$editid');
			window.close();
			</script>";
		} else {
			echo "更新失敗";
		}
	break;
	
	case 'delete':
		$myNode = $cms->xpath->query("//page[@id=$editid]/content")->item($_REQUEST['order']);
		$filename = $myNode->getAttribute('filename');
		
		$ok=unlink(CONTENTFOLDER.$filename);
		if(!$ok){ 
			echo "檔案無法刪除";
		}
		
		$myNode->parentNode->removeChild($myNode);
		$ok = $cms->dom->save(CMSXML);
		if ($ok){
			echo "刪除成功";
		} else {
			echo "刪除失敗";
		}
		
	echo "<meta http-equiv=\"refresh\" content=\"1.6;URL={$_SERVER['HTTP_REFERER']}\" />"; 

	break;

	default:
	echo "no required varible";
	break;
}
?>
