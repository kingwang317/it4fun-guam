<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php require_once($_SERVER['SRVROOT']."/cms/config/ini.php"); ?>
<?php
if (!$cms){
$cms = new cmstree('cmsid',CMSXML);
}
?>
<?php 
	function tree_treeview1($startNode, $deep=99, $startlevel=1){			
	global $cms;			
		foreach($startNode->childNodes as $cNode){
			if($cNode->nodeType==1 && $cNode->nodeName=='page' && $cNode->getAttribute('display')!='hide'){
			$thisId = $cNode->getAttribute('id');
			$loc = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?cmsid='.$thisId;
			
			$pri = (round(1/$startlevel, 2)>=1)?round(1/$startlevel, 2):round(1/$startlevel, 2)+0.2;
echo "<url>
  <loc>$loc</loc>
  <priority>$pri</priority>
</url>
";
						$hasChildPage = 0;
						if($cNode->hasChildNodes()){
							foreach($cNode->childNodes as $ccNode){
								if ($ccNode->nodeName=="page"){
									$hasChildPage =1;
									continue;
								}
							}
						}
						
					
						if ($hasChildPage){
							if($deep>1){
								tree_treeview1($cNode, $deep-1, $startlevel+1);
							}
						} 
			}
		}
	}
	
	function leveltree_treeview1($level, $deep=99){
	global $cms;
		if($cms->nowlevel+1>=$level){
			if($level==0){
				$pNode = $cms->get_node(0)->parentNode;
			} else {
				$pid = $cms->path[$level-1];
				$pNode =$cms->get_node($pid);
			}
			tree_treeview1($pNode, $deep, $level);
		}
	}
	
	
	
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php leveltree_treeview1(1,99);?>
</urlset>