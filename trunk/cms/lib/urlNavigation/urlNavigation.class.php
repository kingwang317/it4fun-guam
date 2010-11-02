<?php
/*
url 參數導覽系統 

2008-03-09 v1 (取代舊版 urlToPage) 
Curtiss Lee

1. listMenu() -> 列出導覽
-----------------------------------------------
2. includePage() -> 根據 url 參數 include 檔案
3. iframePage() -> 根據 url 參數 iframe 檔案 (auto adjust height accroding to content)
4. iframePage2() -> 根據 url 參數 iframe 檔案 (fix screen height)

*/

//取得此 script 所在之真實路徑
$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));
$nowWebPath = substr_replace($nowSrvPath, '', 0, strpos($nowSrvPath, $_SERVER['DOCUMENT_ROOT'])+ strlen($_SERVER['DOCUMENT_ROOT']));
//import urlFunctions
if (!file_exists($nowSrvPath.'/urlFunction/url.func.php')){
	echo "urlFunction/url.func.php required"; exit;
} else {
	require_once($nowSrvPath.'/urlFunction/url.func.php');
}

class urlNavigation {

var $sx;		//simplaxml 資料物件
var $urlKey; 	//作用中的 url key 
var $urlVar;	//現在的 url 參數值
var $nowFile;	//準備引入的檔案
var $baseUrl;	//現在的網址
var $currentClass; //作用中導覽的 class 名稱 (預設current)
var $nowWebPath; //此檔案實際的網頁路徑

	function urlNavigation($xmlfile='navigation.xml'){
		//checkfile
		if (!file_exists($xmlfile)){
			echo "找不到必要的 xml 檔案 $xmlfile";
			exit;
		}
		//取得此 script 真實 web 路徑
		global $nowWebPath;
		$this->nowWebPath = $nowWebPath;
		//取得 webroot
		$webroot = substr_replace($_SERVER['SRVROOT'], '', 0, strpos($_SERVER['SRVROOT'], $_SERVER['DOCUMENT_ROOT'])+ strlen($_SERVER['DOCUMENT_ROOT']));
		
		//get data
		$data = file_get_contents($xmlfile);
		$data = str_replace('{SRVROOT}',$_SERVER['SRVROOT'], $data);
		$data = str_replace('{WEBROOT}',$webroot, $data);
		
		//set sx
		$sx = simplexml_load_string($data);
		$this->sx = $sx;
		//get urlKey
		$this->urlKey = $sx['urlKey'];
		//get urlVar
		if ($_REQUEST["$this->urlKey"]) {
			$this->urlVar = $_REQUEST["$this->urlKey"];
		} else {
			//如果沒有 url 參數傳入，設定 urlvar 為陣列的第一筆資料
			$this->urlVar = $sx->page['urlValue'];
		}
		//get nowfile
		foreach ($sx->page as $page){
			if($page['urlValue'] == $this->urlVar){
				$this->nowFile = $page['file'];
				break;
			}
		}
		
		//get baseurl
		$this->baseurl=cutUrl($this->urlKey, $_SERVER['REQUEST_URI']);
		
		//get currentClass
		if(!$sx['currentClass']==''){
			$this->currentClass = $sx['currentClass'];
		} else {
			$this->currentClass = "current";
		}
	}


	function listMenu(){
		echo "\n<ul>\n";
		foreach($this->sx->page as $page){
			if(!$page['menuTitle']==''){
				$url=addUrl($this->urlKey.'='.$page['urlValue'], $this->baseurl );
				if($this->urlVar == $page['urlValue']){
					echo "<li><a href=\"$url\" class=\"$this->currentClass\">".$page['menuTitle']."</a></li>\n";
				} else {
					if(!$page['hide']=='hide'){ 
						echo "<li><a href=\"$url\">".$page['menuTitle']."</a></li>\n";
					}
				}
			}
		}
		echo "</ul>\n";
	}


	function includePage(){
		if (!file_exists($this->nowFile)) {
			echo "$this->nowFile page not exist, please check url in your xml data";	
		} else {
			include($this->nowFile);
		}
	}

	function iframePage($width='100%'){ // auto adjust height accroding to content
		echo '<script type="text/javascript" src="'.$this->nowWebPath.'/js/iframe_autoHeight/autoHeight.js"></script>';
		echo "<iframe src=\"$this->nowFile\" height=\"500\" width=\"$width\" frameborder=\"0\" class=\"autoHeight\"></iframe>";
	}
	
	function iframePage2($width='100%'){ //fix screen height
		echo '<script type="text/javascript" src="'.$this->nowWebPath.'/js/iframe_fixScreenHeight/resize_iframe.js"></script>';
		echo "<iframe id=\"glu\" src=\"$this->nowFile\" width=\"$width\" frameborder=\"0\" onload=\"resize_iframe()\"></iframe>";
	}
}
?>

<?php

/*//demo:
$nav = new urlNavigation('demo/toBeInclude/includePage/navigation.xml');
$nav->listMenu();
$nav->includePage();
*/
?>