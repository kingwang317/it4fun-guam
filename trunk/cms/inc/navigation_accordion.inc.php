<?php
if (!$startLevel){
	$startLevel = 1;
}
if (!$deep){
	$deep = 99;
}
if (!$cms){
$cms = new cmstree('cmsid',CMSXML);
}
?>
<?php 
	function tree_treeview1($startNode, $deep=99, $startlevel=1){			
	global $cms;			
	echo "\n<ul>";	
		foreach($startNode->childNodes as $cNode){
			if($cNode->nodeType==1 && $cNode->nodeName=='page' && $cNode->getAttribute('display')!='hide'){
			$thisId = $cNode->getAttribute('id');
			$thisLevel = $cms->get_level($thisId);
			$thisPid = $cms->get_pid($thisId);
			
			if ($thisLevel <= $startlevel || array_search($thisPid,$cms->path)){
			
				$li_class=$cNode->getAttribute('li_class');
					if($li_class){
						echo "\n<li class=\"$li_class\">";
					}else{
						echo "\n<li>";
					}
					
				
						$cms->build_link($cNode);
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
								tree_treeview1($cNode, $deep-1, $startlevel);
							}
						} 
					echo "</li>";
				}
			}
		}
	echo "</ul>";	
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

<?php leveltree_treeview1($startLevel,$deep);?>
