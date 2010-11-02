<?php 
header("Pragma: no-cache");
header("Cache: no-cache");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php");
require_once($_SERVER['SRVROOT']."/cms/inc/auth.inc.php");

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$rootNode = $dom->createElement('plugins');
$dom->appendChild($rootNode);

    $dir    = SRVROOT.'/cms/plugin';
    $dirAry = scandir($dir);
	
	foreach($dirAry as $key => $filename){
    	if (is_dir("$dir/$filename") == true && $filename != '.' && $filename != '..'){
    		$subDirAry = scandir("$dir/$filename");
			$hasConfig = array_search('config.xml', $subDirAry);
			if($hasConfig){
				$dom2 = new DOMDocument();
				$dom2->load("$dir/$filename/config.xml");
				$node2=$dom2->getElementsByTagName('plugin')->item(0);
				$node=$dom->importNode($node2, true);
				$node->setAttribute("folder",$filename);
				$rootNode->appendChild($node);
			}
		}
	}
	

//echo $dom->saveXML();

$sx = simplexml_import_dom($dom);

$cmsid = isset($_GET['cmsid'])?$_GET['cmsid']:0;
$pluName = isset($_GET['pluName'])?$_GET['pluName']:"user_manager";
$pluAdmin = isset($_GET['pluAdmin'])?$_GET['pluAdmin']:"admin/index.php";
$inc_plu =  $_SERVER['SRVROOT'].'/cms/plugin/'.$pluName.'/'.$pluAdmin;
$content = "";
require_once($inc_plu);
$mod = new $pluName();
//print_r($mod);
$status = $mod->get_content($content);
if( $status == false ) exit;
?>
<script>
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
	
</script>
<script type="text/javascript">
function popup(url,name,windowWidth,windowHeight){
    myleft=(screen.width)?(screen.width-windowWidth)/2:100;
	mytop=(screen.height)?(screen.height-windowHeight)/2:100;
	properties = "width="+windowWidth+",height="+windowHeight+",scrollbars=yes, top="+mytop+",left="+myleft+',menubar=no,resizable=yes,toolbar=no,location=no,scrollbars=no,status=no,directories=no,personalbar=no,titlebar=no';
    window.open(url,name,properties);
}
</script>
<div id="navi">
		<div id="sidetree">
				<h3 class="treeview_title">CMS後台管理系統</h3>
			<ul id="tree">
			<li><a href="javascript:popup('<?php echo WEBROOT."/cms/admin/content/inc/page2-online.php?cmsid=-1&order=0&action=edit"; ?>','',600,400);"><?php echo "0 頁尾設定" ?></a></li>
			<li><a href="javascript:popup('<?php echo WEBROOT."/cms/admin/content/inc/page2-online.php?cmsid=-2&order=1&action=edit"; ?>','',600,400);"><?php echo "1 關於我們" ?></a>
			<ul>
			<li>
			<a href="javascript:popup('<?php echo WEBROOT."/cms/admin/content/inc/page2-online.php?cmsid=-2&order=0&action=edit"; ?>','',600,400);"><?php echo "1.0 關於我們(影音)" ?></a>
			</li>
			</ul>
			</li>
<?php
//抓取其擁有的權限
$counter = 2;
$funcs = auth_get_functions();
//抓取plugin之xml
foreach ($sx->plugin as $plugin){
	if(in_array($plugin['folder'],$funcs) || is_maintainer()){
		if($plugin->active=='on'){
			$folder = $plugin['folder'];
			$file = $plugin->front;
			$admin = $plugin->admin;
			$sub_counter = 0;
			$pattern = '/^\//i';
			if(preg_match($pattern,$admin)){
				$adminUrl = $admin;
			} else {
				$adminUrl = $_SERVER['WEBROOT'].'/cms/admin/index.php?pluName='.$folder.'&pluAdmin='.$admin.'&time='.time();
			}
?>	
	<li><a href="<?php echo $adminUrl ?>"><?php echo $counter." ".$plugin->name ?></a> 
		<?php if(isset($plugin->subAdmin)) echo "<ul>";?>
		<?php 
			//print_r($plugin->subAdmin);
		foreach ($plugin->subAdmin as $subAdmin){
			$sub_admin = $subAdmin;
			if(preg_match($pattern,$file)){
				$pluginUrl = $file;
			} else {
				$lang = isset($subAdmin['lang'])?"&lang=".$subAdmin['lang']:"";
				$pluginUrl = $_SERVER['WEBROOT'].'/cms/admin/index.php?pluName='.$folder.'&pluAdmin='.$sub_admin.$lang.'&time='.time();
			}
		?>
			<li><a href="<?php echo $pluginUrl ?>"><span><?php echo $counter.".".$sub_counter++." ".$subAdmin['title'] ?></span></a></li>
		<?php } //end foreach?>
		<?php if(isset($plugin->subAdmin)) echo "</ul>";?>	
	</li>

		<?php } //end if?>
	<?php } //end if?>
<?php $counter++; } //end foreach?>
<?php
if(is_maintainer()){?>
<li><a href="<?php echo $_SERVER['WEBROOT'].'/cms/admin/index.php?cmsroot=content&cmsid=0' ?>"><b><?php echo "結構管理" ?></b></a></li>
<li><a href="<?php echo $_SERVER['WEBROOT'].'/cms/admin/index.php?cmsroot=default&cmsid=0' ?>"><b><?php echo "全域設定" ?></b></a></li> 	
<?php }
?>
</ul></div></div>
<?php echo $content;//include("$inc_plu"); ?>
