<?php
if (!$startLevel){
	$startLevel = 0;
}
if (!$deep){
	$deep = 99;
}
if (!$cms){
$cms = new cmstree('cmsid',SRVROOT.'/cms/xml/cms.xml');
}
/* echo "<pre>";
print_r($cms);
echo "</pre>"; */
//echo $cms->get_rss_details().$cms->get_rss_items();
$cms->leveltree($startLevel,$deep);
//$cms->idtree(5);
?>