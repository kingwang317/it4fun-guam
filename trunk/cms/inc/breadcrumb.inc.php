<?php
$separator = " > ";
if (empty($cms)){
$cms = new cmstree('cmsid',SRVROOT.'/cms/xml/cms.xml');
}

foreach ($cms->path as $nodeid){

	$myNode = $cms->get_node($nodeid);
	if($nodeid == 0){
		continue;
	}elseif($nodeid == $cms->cmsid){            //最後一個
		echo $myNode->getAttribute('name');
	} else {
		$cms->build_link($myNode);
		echo $separator;
	}
}

?>