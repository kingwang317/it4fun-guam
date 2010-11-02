<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<!-- 
jquery 於之前加入
-->
<script>
function addCss(e, css){
	if(e.contentDocument){ //FireFox
		cDocument = e.contentDocument;
	} else { //IE
		cDocument = e.contentWindow.document;
	}
	
	cssLink = cDocument.createElement('link');
	cssLink.setAttribute('href',css);
	cssLink.setAttribute('rel','stylesheet');
	//cssLink.setAttribute('type','text/css');

	cDocument.body.insertBefore(cssLink,cDocument.body.firstChild);
	//cDocument.body.appendChild(cssLink);
}

</script>

<?php
$cmsid = $_REQUEST['cmsid'];
if(!isset($cmsid)){
	echo "請選擇頁面";
	return;
}
?>

<!--msgbox css 設定在母頁 index.php-->
<div id="msgbox">asdf</div>

<div class="h3title"><h3>內容設定</h3></div>
<div id="add">
    <span class="icon01">
    <a href="javascript:popup('<?php echo WEBROOT."/cms/admin/content/inc/page2-online.php?cmsid=$cmsid"; ?>','',800,500);" >新增線上編輯</a>
    </span>  
    <span class="icon01">
    <a href="javascript:popup('<?php echo WEBROOT."/cms/admin/content/inc/page2-include.php?cmsid=$cmsid"; ?>','',600,400);" >新增include</a>
    </span> 
    <span class="icon01">
    <a href="javascript:popup('<?php echo WEBROOT."/cms/admin/content/inc/page2-iframe.php?cmsid=$cmsid"; ?>','',650,400);">新增iframe</a>
    </span>
    <span class="icon01">
    <a href="javascript:popup('<?php echo WEBROOT."/cms/admin/content/inc/page2-plugin.php?cmsid=$cmsid"; ?>','',800,500);" >新增 Plugin</a>
    </span>
    <span class="turnview">
    <a href="<?php echo WEBROOT; ?>/index.php?cmsid=<?php echo $cmsid ?>&mode=admin">預覽畫面</a>
    </span>
</div>

<br class="clear">
	<style>
		.box1{
		background:#e4eaf1; display:block;
		background-image:url(<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/bg-box1.gif); background-position: right 5px; background-repeat:no-repeat;
		}
		
		.box2{
		background:#d5e9c1;
		background-image:url(<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/bg-box2.gif); background-position: right 5px; background-repeat:no-repeat;
		}
		
		.box3{
		background:#eddebb;
		background-image:url(<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/bg-box3.gif); background-position: right 5px; background-repeat:no-repeat;
		}
		
		.box4{
		background:#eeeeee;
		background-image:url(<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/bg-box4.gif); background-position: right 5px; background-repeat:no-repeat;
		}
		.admin{
		display:block;
		background-image:url(<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/icon-admin.gif); background-position:top; background-repeat:no-repeat; width:185px; height:54px; line-height:54px; color:#FFFFFF; font-size:15px; font-weight:bold; text-align:center; margin-left:auto; margin-right:auto; text-decoration:none;
		}
		.admin:hover{
		color:#000000;
		}
	</style>

<?php 
global $cms;
$default_fck_css = $cms->xpath->query("//default/fck_css")->item(0)->nodeValue;

$pageNode = $cms->xpath->query("//page[@id=$cmsid]")->item(0);
$fck_css = $pageNode->getAttribute('fck_css');
$content_css = "";
if($fck_css){
	$content_css = $fck_css;
}elseif($default_fck_css){
	$content_css = $default_fck_css;
}

$contentNodes = $cms->xpath->query("//page[@id=$cmsid]/content");
for($i=0;$i<$contentNodes->length;$i++){
	$seq = $i+1;
	$message = '';
	//get editor area css
	$thisNode = $contentNodes->item($i);
	$toMoveUp = WEBROOT."/cms/admin/content/inc/page2-moveUpDown.php?move=up&cmsid=$cmsid&seq=$i";
	$toMoveDown = WEBROOT."/cms/admin/content/inc/page2-moveUpDown.php?move=down&cmsid=$cmsid&seq=$i";
	$contentMethod = $contentNodes->item($i)->getAttribute('method');
	
	switch($contentMethod){
	case 'online':
		$method = "線上編輯區塊";
		$toEdit =WEBROOT."/cms/admin/content/inc/page2-online.php?cmsid=$cmsid&order=$i&action=edit";
		$toDelete =WEBROOT."/cms/admin/content/inc/page2-online-action.php?cmsid=$cmsid&order=$i&action=delete";
		$file = WEBROOT.'/cms/resource/contents/'.$contentNodes->item($i)->getAttribute('filename');
		$message= "檔案位置：".'/cms/resource/contents/'.$contentNodes->item($i)->getAttribute('filename');
		$winw = 800;
		$winh = 600;
		$css = 'box1';
		if($content_css){
			$content_css = $_SERVER['WEBROOT'].$content_css;
			$addCss = 1;
		}else
			$addCss = 0;
	break;
	
	case 'include':
		$method = "include區塊";
		$toEdit =WEBROOT."/cms/admin/content/inc/page2-include.php?cmsid=$cmsid&order=$i&action=edit";
		$toDelete =WEBROOT."/cms/admin/content/inc/page2-include-action.php?cmsid=$cmsid&order=$i&action=delete";
		$includeurl = $contentNodes->item($i)->getAttribute('includeurl');
		$file=WEBROOT.$includeurl;
		$message= "URL：".$includeurl;
		$winw = 600;
		$winh = 400;
		$css = 'box2';
		$addCss = 0;
	break;
	
	case 'iframe':
		$method = "iframe區塊";
		$toEdit =WEBROOT."/cms/admin/content/inc/page2-iframe.php?cmsid=$cmsid&order=$i&action=edit";
		$toDelete =WEBROOT."/cms/admin/content/inc/page2-iframe-action.php?cmsid=$cmsid&order=$i&action=delete";
		$iframeurl=$contentNodes->item($i)->getAttribute('iframeurl');
		$iframe_h=$contentNodes->item($i)->getAttribute('iframe_h');
		$iframe_w=$contentNodes->item($i)->getAttribute('iframe_w');
				if(strpos($iframeurl,'http://')!==false){
					$file = $iframeurl;
				}else{
					$file = WEBROOT.$iframeurl;
				}
		
		$message= "URL：".$iframeurl;
		$winw = 650;
		$winh = 400;
		$css = 'box3';

		
	break;
	case 'plugin':
		$method = "外掛區塊";
		$css = 'box4';
		$toEdit =WEBROOT."/cms/admin/content/inc/page2-plugin2.php?cmsid=$cmsid&order=$i&action=edit";
		$toDelete =WEBROOT."/cms/admin/content/inc/page2-plugin-action.php?cmsid=$cmsid&order=$i&action=delete";
		$addWay = $thisNode->getAttribute('addWay');
		$folder = $thisNode->getAttribute('folder');
		$pluginUrl = $thisNode->getAttribute('pluginUrl');
		$pluginTitle = $thisNode->getAttribute('pluginTitle');
		
		$pluginXML = $_SERVER['SRVROOT'].'/cms/plugin/'.$folder.'/config.xml';
		$sx = simplexml_load_file($pluginXML);
		$pluginName = $sx->name;
		$pluginAdmin = $sx->admin;
		$pluginAdmin = $_SERVER['WEBROOT'].'/cms/plugin/'.$folder.'/'.$pluginAdmin;
		$winw = 600;
		$winh = 450;
	break;
	}

	$divid=$contentNodes->item($i)->getAttribute('divid');
	$divclass=$contentNodes->item($i)->getAttribute('divclass');
	if($divid){
		$message.=" ( id=\"$divid\" ) ";
	}
	if($divclass){
		$message.=" ( class=\"$divclass\" ) ";
	}
	

?>



		

	<div class="<?php echo $css; ?>" style="padding-bottom:10px; margin-bottom:10px;">
   	  <div class="toolbar" style="padding-top:5px;">
            <span class="fileinfo">
  				<span class="t2"><?php echo $seq.'. '.$method ?>：</span> 	          
                <span class="icon01" style="float:left; line-height:normal;"><a href="javascript:popup('<?php echo $toEdit ?>','',<?php echo $winw ?>,<?php echo $winh ?>);">修改</a></span>
           
                <?php if(isset($thisNode->previousSibling->nodeName))if($thisNode->previousSibling->nodeName=='content'){ 	?>
                <a href="<?php echo $toMoveUp; ?>" class="ajax"><img src="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/small-icon/arrow_up.gif" alt="^" border="0" align="absmiddle" />上移</a>
                <?php } else { echo "&nbsp;"; }//end if ?>
        
                <?php if(isset($thisNode->nextSibling->nodeName))if($thisNode->nextSibling->nodeName=='content'){ 	?>
                <a href="<?php echo $toMoveDown; ?>" class="ajax"><img src="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/small-icon/arrow_down.gif" alt="V" border="0" align="absmiddle" />下移</a>
                <?php } //end if ?>
                
             	<a href="javascript:cpost('<?php echo $toDelete ?>');" ><img src="<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/css/images/small-icon/icon-del.png" alt="del" border="0" align="absmiddle" />刪除本區塊</a>            </span>
            <br style="clear:both; padding:0px; line-height:100%; margin:0px;">
   	  </div>	
        
<?php if($contentMethod!='plugin'){ ?>        
		<div class="file" style="border:1px solid gray; margin:0px 10px; padding:0px;" >
			<iframe src="<?php echo $file ?>" height="250" width="100%" frameborder="0" class="autoHeight" <?php if ($addCss==1){ echo "onload=\"addCss(this,'$content_css')\"";} ?>></iframe>            
		</div>  
<?php } else { ?>        
		<div class="file" style="border:1px solid #ffffff; margin:0px 10px; padding:10px; background-color:#FFFFFF;" >
        	<p style="font-size:15px; font-weight:bold; text-align:center; margin:0px; padding:0px; padding-bottom:10px;"><?php echo $pluginName ?> - <?php echo $pluginTitle ?></p>
        	<p style="text-align:center; margin:0px; padding:0px;"><a href="<?php echo $pluginAdmin ?>" target="_blank" class="admin">後台管理</a></p>        
        	<p style="text-align:center;">[<?php echo $addWay; ?>] : <?php echo $pluginUrl ?></p>

		</div>  
<?php } ?> 

	  <div class="msg" style="border:0px solid gray; color:#777777; padding:0px 5px; margin:5px 10px 0px; text-align:right;">
			<?php echo $message; ?>	 
      </div>     
  
    </div>      		

<?php
} //end for
?>

<script>
//ajax link
$('.ajax').click(function(){
	var u = $(this).attr('href');
		$.ajax({
			type: "GET",
			url: u,
			success: function(msg){
				$("#msgbox").html(msg);
				showMsgbox();
				loadContent(<?php echo $cmsid ?>);
			}
			
		});
	return false;
});


function cpost(u){
		$.ajax({
			type: "POST",
			url: u,
			beforeSend: function(){
				if(confirm('確定刪除?')){
					return true;
				} else {
					return false;
				}
			},
			success: function(msg){
				$("#msgbox").html(msg);
				showMsgbox();
				loadContent(<?php echo $cmsid ?>);
			}
			
		});
}
</script>