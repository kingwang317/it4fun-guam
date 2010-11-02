<?php
if (!$pid){
	$pid = 0;
}
if (!$deep){
	$deep = 99;
}
if (!$cms){
$cms = new cmstree('cmsid',CMSXML);
}
$cms->idtree($pid,$deep);
?>