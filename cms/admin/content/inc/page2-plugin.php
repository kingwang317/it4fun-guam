<?php require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php"); ?>
<style>
.icon01{
background-image:url(../../css/images/bg-icon.gif);
background-repeat:no-repeat;
height:22px;
line-height:22px;
width:97px;
text-align:center;
display:block;
font-size:12px;
}
.icon01 a:link, .icon01 a:visited{
color:#000000;
text-decoration:none;
font-size:12px;
}
.icon01 a:hover{
color:#266591;
}
#name{
color:#0033CC;
}

</style>
<?php 
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
?>
<p>請選擇新增外掛：</p>
<?php include_once(LIBSRVROOT."/tableStyle/includeMe.php"); ?>

<?php
$cmsid = $_GET['cmsid'];
?>
<?php
foreach ($sx->plugin as $plugin){
	if($plugin->active=='on'){
	$folder = $plugin['folder'];
	$file = $plugin->front;
	
	$pattern = '/^\//i';
	if(preg_match($pattern,$file)){
		$pluginUrl = $file;
	} else {
		$pluginUrl = '/cms/plugin/'.$folder.'/'.$file;
	}
	
	
	
	
	
	
?>	
<table border="1" class="table" style="width:100%;">
	<tr>
	  <th colspan="3" style="text-align:left;"><?php echo $plugin->name ?> <span style="font-weight:normal;">(/cms/plugin/<?php echo $plugin['folder'] ?>/)</span></th>
	</tr>
	<form id="form1" name="form1" method="post" action="page2-plugin2.php">
	<tr>
		<td>[front] <?php echo $pluginUrl; ?></td>
        <td id="name"><?php echo $plugin->front['title'] ?></td>
      <td width="35">
        	<input type="submit" name="button" id="button" value="加入" />
        	<input name="cmsid" type="hidden" value="<?php echo $_GET['cmsid']; ?>" />
        	<input name="pluginUrl" type="hidden" value="<?php echo $pluginUrl; ?>" />
        	<input name="folder" type="hidden" value="<?php echo $plugin['folder'] ?>" />
        	<input name="pluginName" type="hidden" value="<?php echo $plugin->name ?>" />
        	<input name="pluginTitle" type="hidden" value="<?php echo $plugin->front['title'] ?>" />        </td>
	</tr>
	</form>
	<?php 
	foreach ($plugin->widget as $widget){
		$file = $widget;
		if(preg_match($pattern,$file)){
			$pluginUrl = $file;
		} else {
			$pluginUrl = '/cms/plugin/'.$folder.'/'.$file;
		}
	?>
	<form id="form1" name="form1" method="post" action="page2-plugin2.php">
	<tr>
		<td>[widget] <?php echo $pluginUrl ?></td>
		<td id="name"><?php echo $widget['title'] ?></td>
		<td>
        	<input type="submit" name="button" id="button" value="加入" />
        	<input name="cmsid" type="hidden" value="<?php echo $_GET['cmsid']; ?>" />
        	<input name="pluginUrl" type="hidden" value="<?php echo $pluginUrl ?>" />
        	<input name="folder" type="hidden" value="<?php echo $plugin['folder'] ?>" />
        	<input name="pluginName" type="hidden" value="<?php echo $plugin->name ?>" />
        	<input name="pluginTitle" type="hidden" value="<?php echo $widget['title'] ?>" />        </td>
	</tr>
	</form>
	<?php } //end foreach?>
</table>
<br />
	<?php } //end if?>
<?php } //end foreach?>
<form id="form1" name="form1" method="post" action="">
</form>
