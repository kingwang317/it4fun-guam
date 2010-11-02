<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<?php 
if($_REQUEST['cmsid']){
	$cmsid=$_REQUEST['cmsid'];
}else{
	$_REQUEST['cmsid']=0;
	$cmsid=0;
}
?>
<!--左側導覽-->




<script type="text/javascript">
$(function(){
	var css_tree = readCookie('cms_tree');

if(css_tree==1){
		$('#navigation ul').treeview({
			persist: "location"
		});
		
		$('#treeNav a').removeClass('current');
		$('#treeOpen').addClass('current');
	} else {	
		$('#navigation ul').treeview({
			persist: "location",
			collapsed: true,
			unique: true,
			animated: "fast"
		});
		$('#treeNav a').removeClass('current');
		$('#treeCollapsed').addClass('current');
	}
	
	$('#treeCollapsed').click(function(){
		writeCookie('cms_tree',0,24);
		window.location.reload();
		return false;
	});
	
	$('#treeOpen').click(function(){
		writeCookie('cms_tree',1,24);
		window.location.reload();
		return false;
	});

	
});
</script>
<style>
/* 上方開合設定 */
#treeNav{
margin-top:5px; border-bottom:#CCCCCC dotted 1px;
}
#treeNav a{
font-size:13px;
color:#333333;
text-decoration:underline;
}
#treeNav a:hover{
color:#FF6666;
}
#treeNav .current{
background: #FFFF99;
}
</style>

<!--結構管理視窗設定-->
<script type="text/javascript">
$(function(){
	$('.row').css('display','none');
	$('.hoverMe').mouseover(function(){
		$('.row').show();
	});
	$('.row').mouseout(function(){
		$(this).hide();
	});
	
});
</script>
<style>
/* 展開浮動區塊選項 */
	.row{
		position:absolute;
		left:-3px;
		top:-4px;
		width:450px;
		padding:2px 10px;
		background-color:#fafafa;
		border:#67a7e3 solid 1px;
		border:#466cb4 solid 1px;
/*		border-bottom:1px solid #cccccc;
		border-right:1px solid #cccccc;*/
		display:none;
	}
	.row a{
	text-decoration:none;
	padding:3px 5px 2px 5px; line-height:120%; margin-right:0px;
	}
	.row a:visited{
	padding:3px 5px 2px 5px; line-height:120%;
	}
	.row a:hover{
	padding:3px 5px 2px 5px; line-height:120%;
	background-color:#e1e1e1;
	}
	.hoverMe{
		position:relative;
	}
	.imhere{
	text-decoration:none;
	}
.link2{
background-image:url(<?php echo WEBROOT; ?>/cms/admin/css/images/small-icon/add-page-yellow.gif);
background-repeat:no-repeat; background-position:0px 0px;
padding-left:18px;
}
.link4{
background-image:url(<?php echo WEBROOT; ?>/cms/admin/css/images/small-icon/application_form_edit.png);
background-repeat:no-repeat; background-position:0px 0px;
padding-left:18px;
}
.link5{
background-image:url(<?php echo WEBROOT; ?>/cms/admin/css/images/small-icon/arrow_up.gif);
background-repeat:no-repeat; background-position:-5px -2px;
padding-left:10px;
}
.link6{
background-image:url(<?php echo WEBROOT; ?>/cms/admin/css/images/small-icon/arrow_down.gif);
background-repeat:no-repeat; background-position:-5px -2px;
padding-left:10px;
}
.link7{
background-image:url(<?php echo WEBROOT; ?>/cms/admin/css/images/small-icon/del.png);
background-repeat:no-repeat; background-position:0px 0px;
padding-left:18px;
}
/*  */
#navside{
/*border:#8b9dba solid 1px; border:#cccccc solid 1px;*/
/*background-image:url(<?php echo WEBROOT; ?>/cms/admin/css/images/navigation-bg.gif); background-position:top; background-repeat:repeat-x;*/
}
#navigation{
/*border:#ffffff solid 2px; background-color:#f6f8fa; */padding:5px 0px;
}
#navigation ul li{
margin:0px; padding:0px; padding-left:15px;
}
#navigation a{
text-decoration:none; 
}
a .name{
padding:2px 5px 2px 5px;
color:#000000;
text-decoration:none;
}
#navigation a.current .name{
background-color:#466cb4; color:#FFFFFF; border:#67a7e3 solid 0px;
}
.hoverMe{padding:5px;
background-image:url(<?php echo WEBROOT; ?>/cms/admin/css/images/small-icon/page_white_wrench.png); background-position:0px 2px; background-repeat:no-repeat; padding-left:18px;
}
#navigation ul{
background-color:transparent;
}
.idd{
color:#325bac; font-family:Arial, Helvetica, sans-serif, "新細明體"; font-size:12px;
}
</style>

<!--新增子階層設定-->
<script>
$(function(){
	$('*.addChild').click(function(){
		$('#addChild').remove();
		if ($(this).parents('li:first').find('ul:first').size()>0){
			$(this).parents('li:first').find('ul:first').prepend('<li id="addChild">test</li>');
		} else {
			$(this).parents('li:first').append('<ul><li id="addChild">test</li></ul>');
		}
		
		$("#addChild").load("<?php echo $_SERVER['WEBROOT'] ?>/cms/admin/content/sitemap/inc/addChild.php",{
		cmsid:'<?php echo $cmsid; ?>'
		}).hide();
		$('#addChild').slideDown('slow');
		return false;
	});
});

</script>


<div id="treeNav">
導覽顯示： 
	<a href="#" id="treeCollapsed" class="current">收合顯示</a>
	 | 
	<a href="#" id="treeOpen">全部展開</a>
</div>
<?php
if (!isset($startLevel)){
	$startLevel = 0;
}
if (!isset($deep)){
	$deep = 99;
}
if (!isset($cms)){
$cms = new cmstree('cmsid',SRVROOT.'/cms/xml/cms.xml');
}


	
	function tree($startNode, $deep=99){
	global $cms;			
	echo "\n<ul class='treeview'>";	
		foreach($startNode->childNodes as $cNode){
			if($cNode->nodeType==1 && $cNode->nodeName=='page'){
				echo "\n<li>";
				if ($cNode->getAttribute('id')==$cms->cmsid){ echo "\n<span  class=\"imhere\">"; }
				build_link($cNode);
				if($cNode->getAttribute('display')=='hide'){
					$toShow = WEBROOT."/cms/admin/sitemap/inc/show.php?cmsid=".$cNode->getAttribute('id'); 
					echo ' <span style="font-size: xx-small; font-weight: normal;color: #999999;"> &nbsp; [ 隱藏中 | <a href="'.$toShow.'">顯示</a> ] </span>';
				}
				//echo "<a href=\"#\">新增頁面於此階層之下</a>";
				if ($cNode->hasChildNodes() && $cNode->lastChild->nodeName=="page"){
					if($deep>1){
						tree($cNode, $deep-1);
					}
				} 
				if ($cNode->getAttribute('id')==$cms->cmsid){ echo "</span>"; }
				echo "</li>";
			}
		}
	echo "</ul>";	
	}
	
	function leveltree($level, $deep=99){
	global $cms;
		if($cms->nowlevel+1>=$level){
			if($level==0){
				$pNode = $cms->get_node(0)->parentNode;
			} else {
				$pid = $cms->path[$level-1];
				$pNode =$cms->get_node($pid);
			}
			tree($pNode, $deep);
		}
	}

	function build_link($node){
		$display = $node->getAttribute('name');
		
	global $cms;
		$id = $node->getAttribute('id');

		// 導覽順序 1.cmsid 2.cmsroot
		$url = $_SERVER['WEBROOT']."/cms/admin/index.php?cmsroot=content&cmsid=$id";		
		if(isset($_GET['cmsroot'])){
			$url.="&cmsroot=".$_GET['cmsroot'];
		}
			
		$toSelf = $url;
		$toDelete = WEBROOT.'/cms/admin/content/sitemap/inc/deleteNode.php';
		$toMoveUp = WEBROOT."/cms/admin/content/sitemap/inc/moveUpDown.php?move=up&cmsid=$id";
		$toMoveDown = WEBROOT."/cms/admin/content/sitemap/inc/moveUpDown.php?move=down&cmsid=$id"; 

		$toNewParent = WEBROOT."/cms/admin/content/sitemap/inc/newParent.php?cmsid=$id"; 
		//print_r($cms->path[$cms->nowlevel]);
		
		if ($cms->path[$cms->nowlevel]==$id){
			

?>
<script>
function doGet(u){
    $.get(u,'',loadLeft);
}
</script>


<span style="position:relative; z-index:99; background:white;">
	<span style="color:#333333;"><?php echo $id ?></span> 
	<a href="<?php echo $toSelf ?>" class="<?php echo $cms->hereclass ?>"><span class="name"><?php echo $display ?></span></a>	
		<span class="hoverMe"><a onclick="return false" href="#" class="eh">結構管理</a>
			<span class="row">
				<a href="#" class="addChild"><span class="link2">新增子階層</span></a>
				<a href="<?php echo $toNewParent ?>" target="_blank" onclick="popup('<?php echo $toNewParent ?>','',200,100); return false;"><span class="link4">變更階層</span></a>
	
				<?php if(isset($cms->thisNode->previousSibling->nodeName))if($cms->thisNode->previousSibling->nodeName=='page' || ($cms->thisNode->previousSibling->nodeName=='#text' && $cms->thisNode->previousSibling->previousSibling->nodeName=='page')){ ?>
				<a href="javascript:doGet('<?php echo $toMoveUp ?>');"><span class="link5">上移</span></a>
				<?php } //end if ?>
	
				<?php if(isset($cms->thisNode->nextSibling->nodeName))if($cms->thisNode->nextSibling->nodeName=='page' || ($cms->thisNode->nextSibling->nodeName=='#text' && $cms->thisNode->nextSibling->nextSibling->nodeName=='page')){ ?>
				<a href="javascript:doGet('<?php echo $toMoveDown ?>');"><span class="link6">下移</span></a>	
				<?php } //end if ?>
				<a href="javascript:popup('<?php echo $toDelete ?>?cmsid=<?php echo $id ?>','',300,150);"><span class="link7">刪除</span></a>    		</span>		</span></span>
<?php
		} else {
			echo '<span class="idd">'.$id.'</span> '; 
			echo "<a href=\"$toSelf\"><span>$display</span></a>\n";
		}
	}
?>
<div id="navigation">
<div id="treeNav">
<?php leveltree(0,1); ?>
	<div  style="padding-left:20px;">
		<?php leveltree(1,$deep); ?>
	</div>
</div>
</div>