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
		$myNode->setAttribute('iframeurl',$_POST['iframeurl']);
		$myNode->setAttribute('iframe_w',$_POST['iframe_w']);
		$myNode->setAttribute('iframe_h',$_POST['iframe_h']);
		$myNode->setAttribute('autoheight',$_POST['autoheight']);
		$myNode->setAttribute('divid',$_POST['divid']);
		$myNode->setAttribute('divclass',$_POST['divclass']);
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
	
	case 'add':
		$myNode = $cms->xpath->query("//page[@id=$editid]")->item(0);
		$pageChilds = $cms->xpath->query("//page[@id=$editid]/page");
		
		$element = $cms->dom->createElement('content');
		if ($pageChilds->length>0){
			$contentNode = $myNode->insertBefore($element,$pageChilds->item(0));
			
		} else {
			$contentNode = $myNode->appendChild($element);
		}
		
		$contentNode->setAttribute('method','iframe');
		$contentNode->setAttribute('iframeurl',$_POST['iframeurl']);
		$contentNode->setAttribute('iframe_w',$_POST['iframe_w']);
		$contentNode->setAttribute('iframe_h',$_POST['iframe_h']);
		$contentNode->setAttribute('autoheight',$_POST['autoheight']);
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
<script>
$(function(){
	$('#fance_wrap').remove();
});
</script>