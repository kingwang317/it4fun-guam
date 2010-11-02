<?php
/*
*/
class cmstree{
var $cmsid;
var $thisNode;
var $hereclass="current";
var $xfile;

var $dom;
var $xpath;
var $pid;
var $path;
var $nowlevel;
var $nowtemplate;

var $fck_css;
var $fck_style;
var $fck_template;

	function __construct($urlkey='cmsid',$xfile = '../xml/cms.xml'){

		$cmsid = isset($_REQUEST[$urlkey])?$_REQUEST[$urlkey]:0;
		//if(!$cmsid){$cmsid=0; }
		//echo "cmsid=".$cmsid."<>";

		$this->cmsid=$cmsid;
		$this->xfile=$xfile;

		$dom = new DOMDocument();
			
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;

		$dom->load($xfile);
		
		$this->dom=$dom;
		$this->xpath = new DOMXPath($dom);
		
		$this->thisNode = $this->get_node($cmsid);
		$this->pid = $this->get_pid($cmsid);
		//echo $this->pid;
	
		$this->path = $this->get_path($cmsid);
		//print_r($this->path);
		
		$this->nowlevel = $this->get_level($cmsid);
		//echo $this->nowlevel;
		$this->nowtemplate = $this->get_template($cmsid);
		
	}
	
	function get_node($id){
		$node = $this->xpath->query("//page[@id=$id]")->item(0);
		if(empty($node))
			$node = $this->xpath->query("//page[@id=0]")->item(0);
		return $node;
	}

	function get_pid($id){
		$thisNode = $this->get_node($id);
		//echo $id;
		if(empty($thisNode))
			$thisNode = $this->get_node(1);
		return $thisNode->parentNode->getAttribute('id');
	}	
	
	function get_path($id){
		$path[]=$id;
		if($id==0){ 
			return $path; 
		}
		$pid = $this->get_pid($id);
		if($pid){
			$path = array_merge($this->get_path($pid), $path);
		} else {
			$root[]=0;
			$path = array_merge($root, $path);
		}
		return $path;
	}

	function get_level($id){
		$path = $this->get_path($id);
		return count($path)-1;
	}	

	function get_template($id){
		$thisNode = $this->get_node($id);
		$template = $thisNode->getAttribute('template');
		
		if (!$template) {
			if($thisNode->parentNode->getAttribute($id)==0 || $thisNode-> getAttribute($id)==0){ //level1 and homepage
				$template = $this->xpath->query("/cms/default/template")->item(0)->nodeValue;
			} else {
				$pid = $thisNode->parentNode->getAttribute(id);
				$template = $this->get_template($pid);
			}
		}
		return $template;
	}
	
	function get_fck($id=false){
		if(!$id){$id=$this->cmsid;}
		$thisNode = $this->get_node($id);
		
		if ($thisNode->getAttribute('fck_css')){
			$fck_css=$thisNode->getAttribute('fck_css');
		} elseif ($this->xpath->query("/cms/default/fck_css")->item(0)->nodeValue){
			$fck_css=$this->xpath->query("/cms/default/fck_css")->item(0)->nodeValue;
		} else {
			$fck_css=FCK.'editor/css/fck_editorarea.css';
		}
		if ($thisNode->getAttribute('fck_style')){
			$fck_style=$thisNode->getAttribute('fck_style');
		} elseif ($this->xpath->query("/cms/default/fck_style")->item(0)->nodeValue){
			$fck_style=$this->xpath->query("/cms/default/fck_style")->item(0)->nodeValue;
		} else {
			$fck_style=FCK.'fckstyles.xml';
		}
		if ($thisNode->getAttribute('fck_template')){
			$fck_template=$thisNode->getAttribute('fck_template');
		} elseif ($this->xpath->query("/cms/default/fck_template")->item(0)->nodeValue){
			$fck_template=$this->xpath->query("/cms/default/fck_template")->item(0)->nodeValue;
		} else {
			$fck_template=FCK.'fcktemplates.xml';
		}
		
		//note: 1. 用到 ini.php 中 FCK 常數  2. 以後 FCKeditor 的版本如果有改這些預設，程式要跟著修改
		$this->fck_css = $fck_css;
		$this->fck_style = $fck_style;
		$this->fck_template = $fck_template;
		
		return true;
		
	}
	
	function breadcrumb(){
		foreach ($this->path as $nodeid){
			if($nodeid ==$this->cmsid){
				$myNode = $this->xpath->query("//page[@id=$nodeid]")->item(0);
				echo $myNode->getAttribute('name');
			} else {
				$myNode = $this->xpath->query("//page[@id=$nodeid]")->item(0);
				echo $myNode->getAttribute('name');
				echo " > ";
			}
		}
	}

	function tree($startNode, $deep=99){
	echo "\n<ul>";	
		foreach($startNode->childNodes as $cNode){
			if($cNode->nodeType==1 && $cNode->nodeName=='page' && $cNode->getAttribute('display')!='hide'){
			$li_class=$cNode->getAttribute('li_class');
				if($li_class){
					echo "\n<li class=\"$li_class\">";
				}else{
					echo "\n<li>";
				}
				//echo $cNode->getAttribute('id'); echo " ";
				
				$this->build_link($cNode);
				//if ($cNode->getAttribute('id')==$this->cmsid){echo " <=Imhere";}
								
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
						$this->tree($cNode, $deep-1);
					}
				}
				echo "</li>";
			}
		}
	echo "</ul>";	
	}
	function get_rss_items($pid=0, $deep=99,$item=""){
 		$node = $this->get_node($pid);
		foreach($node->childNodes as $cNode){
			$hasChildPage = 0;
			$items .= '<item>
						 <title>'.$cNode->getAttribute('title').'</title>
						 <link>'.$cNode->getAttribute('name').'</link>
						 <description><![CDATA['. $cNode->getAttribute('description') .']]></description>
					 </item>';			
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
					$this->get_rss_items($cNode->getAttribute('id'), $deep-1,$items);
				}
			}
		}
		$items .= '</channel>
		 </rss>';
		return $item;
	}
	function get_rss_details()
	{
			$details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
					<rss version="2.0">
						<channel>
							<title>title</title>
							<link>link</link>
							<description>description</description>
							<language>language</language>
							<image>
								<title>image_title</title>
								<url>image_url</url>
								<link>image_link</link>
								<width>image_width</width>
								<height>image_height</height>
							</image>';
		return $details;
	}
	function idtree($pid, $deep=99){
		$node = $this->get_node($pid);
		$this->tree($node, $deep);
	}

	function leveltree($level, $deep=99){
		if($this->nowlevel+1>=$level){
			if($level==0){
				$pNode = $this->get_node(0)->parentNode;
			} else {
				$pid = $this->path[$level-1];
				$pNode =$this->get_node($pid);
			}
			$this->tree($pNode, $deep);
		}
	}
	function get_tree($level, $deep=99){
		if($this->nowlevel+1>=$level){
			if($level==0){
				$pNode = $this->get_node(0)->parentNode;
			} else {
				$pid = $this->path[$level-1];
				$pNode =$this->get_node($pid);
			}
			return $pNode;
		}
	}
	function build_link($node, $display="", $navfunc=""){
		if(!$navfunc) {
			$navfunc = $node->getAttribute('navfunc');
		}
		if(!$display){
			$display = $node->getAttribute('name');
		}

		switch ($navfunc){
			case 'template'; default:
				$id = $node->getAttribute('id');
				
				if($node->getAttribute('urlqstring')!=''){
					$qstring = WEBROOT."/index.php?cmsid=$id&theme=".$node->getAttribute('urlqstring');
				} else {
					$qstring = WEBROOT."/index.php?cmsid=$id";
				}
				/*if($node->getAttribute('urlqstring')!=''){
					$qstring = WEBROOT."/cms/".$node->getAttribute('urlqstring')."/index-$id.html";
				} else {
					$qstring = WEBROOT."/cms/theme/index-$id.html";
				}*/			
				$url=$qstring;
				
				$a_class = $node->getAttribute('a_class');
				
				
				if (array_search($id,$this->path) && $a_class!=''){
					echo "<a href=\"$url\" class=\"$this->hereclass $a_class\"><span>$display</span></a>\n";
				} elseif ($a_class!=''){
					echo "<a href=\"$url\" class=\"$a_class\"><span>$display</span></a>\n";
				} elseif (array_search($id,$this->path)){
					echo "<a href=\"$url\" class=\"$this->hereclass\"><span>$display</span></a>\n";
				} else {
					echo "<a href=\"$url\"><span>$display</span></a>\n";
				}
			break;
			
			case 'link':
				$linkurl = $node->getAttribute('linkurl');
				if ($linkurl){
					$target = $node->getAttribute('target');
					if (!$target){
						$target = "_self";
					}
					echo "<a href=\"$linkurl\" target=\"$target\"><span>$display</span></a>";
				} else {
					echo $display;
				}
			break;
			
			case 'nextlevel':
				$id = $node->getAttribute('id');
				$firstChildId  = $node->getElementsByTagName('page')->item(0)->getAttribute('id');
				if($firstChildId){
					if($node->getAttribute('urlqstring')!=''){
						$qstring = "cmsid=$firstChildId&theme=".$node->getAttribute('urlqstring');
					} else {
						$qstring = "cmsid=$firstChildId";
					}
					$url=$_SERVER['PHP_SELF'].'?'.$qstring;
					$a_class = $node->getAttribute('a_class');
					if (array_search($id,$this->path) && $a_class!=''){
						echo "<a href=\"$url\" class=\"$this->hereclass $a_class\"><span>$display</span></a>\n";
					} elseif ($a_class!=''){
						echo "<a href=\"$url\" class=\"$a_class\"><span>$display</span></a>\n";
					} elseif (array_search($id,$this->path)){
						echo "<a href=\"$url\" class=\"$this->hereclass\"><span>$display</span></a>\n";
					} else {
						echo "<a href=\"$url\"><span>$display</span></a>\n";
					}
				} else {
					$this->build_link($node, $display, 'template');
				}
			break;
			
			case 'text':
				echo $display;
			break;
	
		}
	
	}
	
	
	/*********我加的********/
	function  genetree($level, $deep=99){
		if($this->nowlevel+1>=$level){
			if($level==0){
				$pNode = $this->get_node(0)->parentNode;
			} else {
				$pid = $this->path[$level-1];
				$pNode =$this->get_node($pid);
			}
			$this->genetreeput($pNode, $deep);
		}
	}
	
	function genetreeput($startNode, $deep=99){			
		
		foreach($startNode->childNodes as $cNode){
			if($cNode->nodeType==1 && $cNode->nodeName=='page' && $cNode->getAttribute('display')!='hide'){
			$li_class=$cNode->getAttribute('li_class');

				//echo $cNode->getAttribute('id'); echo " ";
				echo '<div class="technical-nav">
         <div class="t-nav-bg">
         <div class="t-nav-01">
		 <div class="t-nav-text">';
				$this->build_link2($cNode);
				//if ($cNode->getAttribute('id')==$this->cmsid){echo " <=Imhere";}
								echo " </div></div>
         </div>
         </div>";	
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
						$this->tree($cNode, $deep-1);
					}
				} 
				
			}
		}
	
	}
	
	
	function build_link2($node, $display="", $navfunc=""){
		if(!$navfunc) {
			$navfunc = $node->getAttribute('navfunc');
		}
		if(!$display){
			$display = $node->getAttribute('name');
		}
	
		switch ($navfunc){
			case 'template'; default:
				$id = $node->getAttribute('id');
				
				if($node->getAttribute('urlqstring')!=''){
					$qstring = "cmsid=$id&theme=".$node->getAttribute('urlqstring');
				} else {
					$qstring = "cmsid=$id";
				}
				
				$url=$_SERVER['PHP_SELF'].'?'.$qstring;
				
				$a_class = $node->getAttribute('a_class');
				
				
				if (array_search($id,$this->path) && $a_class!=''){
					echo "<a href=\"$url\" class=\"$this->hereclass $a_class\">$display</a>\n";
				} elseif ($a_class!=''){
					echo "<a href=\"$url\" class=\"$a_class\">$display</a>\n";
				} elseif (array_search($id,$this->path)){
					echo "<a href=\"$url\" class=\"$this->hereclass\">$display</a>\n";
				} else {
					echo "<a href=\"$url\">$display</a>\n";
				}
			break;
			
			case 'link':
				$linkurl = $node->getAttribute('linkurl');
				if ($linkurl){
					$target = $node->getAttribute('target');
					if (!$target){
						$target = "_self";
					}
					echo "<a href=\"$linkurl\" target=\"$target\">$display</a>";
				} else {
					echo $display;
				}
			break;
			
			case 'nextlevel':
				$id = $node->getAttribute('id');
				$firstChildId  = $node->getElementsByTagName('page')->item(0)->getAttribute('id');
				if($firstChildId){
					if($node->getAttribute('urlqstring')!=''){
						$qstring = "cmsid=$firstChildId&theme=".$node->getAttribute('urlqstring');
					} else {
						$qstring = "cmsid=$firstChildId";
					}
					$url=$_SERVER['PHP_SELF'].'?'.$qstring;
					$a_class = $node->getAttribute('a_class');
					if (array_search($id,$this->path) && $a_class!=''){
						echo "<a href=\"$url\" class=\"$this->hereclass $a_class\">$display</a>\n";
					} elseif ($a_class!=''){
						echo "<a href=\"$url\" class=\"$a_class\">$display</a>\n";
					} elseif (array_search($id,$this->path)){
						echo "<a href=\"$url\" class=\"$this->hereclass\">$display</a>\n";
					} else {
						echo "<a href=\"$url\">$display</a>\n";
					}
				} else {
					$this->build_link($node, $display, 'template');
				}
			break;
			
			case 'text':
				echo $display;
			break;
	
		}
	
	}
	
}



?>