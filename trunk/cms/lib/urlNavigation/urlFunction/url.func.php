<? 
//url functions
//2008/2/12 全新版本
//將 $url 位置改到後面去，設定為optional，預設值為 $_SERVER['REQUEST_URI']

/*****************************************/
if(!function_exists('cutUrl')){
	function cutUrl($querySet, $baseUrl=''){
		if($baseUrl==''){
		$baseUrl = $_SERVER['REQUEST_URI'];
		}
	
		if(strpos($baseUrl,'?')!==false){
			$urlinfo = parse_url($baseUrl);
			$query = $urlinfo['query'];
			parse_str($query, $queryAry);
			
			$cutAry = explode(',', $querySet);
			
			foreach($cutAry as $cutKey){
				$queryAry[$cutKey]='';
			}
			$queryAry = array_filter($queryAry);
			$newQuery = http_build_query($queryAry);
			$baseUrl = substr($baseUrl,0,strpos($baseUrl,'?'));
			$newUrl = $baseUrl.'?'.$newQuery;
			return $newUrl;
		} else {
			return $baseUrl;
		}
	}
}
//ex: cutUrl('actionid,catview,pid',$baseurl);

/*****************************************/
if(!function_exists('addUrl')){
	function addUrl($queryString, $baseUrl=''){
		if($baseUrl==''){
		$baseUrl = $_SERVER['REQUEST_URI'];
		}
	
		$urlinfo = parse_url($baseUrl);
		$query = $urlinfo['query'];
		parse_str($query, $baseQueryAry);
		
		parse_str($queryString, $addQueryAry);
		
		$queryAry = array_merge($baseQueryAry,$addQueryAry);
		
		$newQuery = http_build_query($queryAry);
		
		if(strpos($baseUrl,'?')!==false){
			$baseUrl = substr($baseUrl,0,strpos($baseUrl,'?'));
		}
		
		$newUrl = $baseUrl.'?'.$newQuery;
		return $newUrl;
	
	}
}
//ex: addUrl('v3=100&v4=哈&v5=12345',$testurl);
/*****************************************/
if(!function_exists('keepUrl')){
	function keepUrl($querySet, $baseUrl=''){
		if($baseUrl==''){
		$baseUrl = $_SERVER['REQUEST_URI'];
		}
	
		if(strpos($baseUrl,'?')!==false){
			$urlinfo = parse_url($baseUrl);
			$query = $urlinfo['query'];
			parse_str($query, $queryAry);
			
			$keepAry = explode(',', $querySet);
	
			foreach($keepAry as $keepKey){
				$newQueryAry[$keepKey]=$queryAry[$keepKey];
			}
	
			$newQuery = http_build_query($newQueryAry);
			$baseUrl = substr($baseUrl,0,strpos($baseUrl,'?'));
			$newUrl = $baseUrl.'?'.$newQuery;
			return $newUrl;
		} else {
			return $baseUrl;
		}
	}
}	
//ex: keepUrl('actionid,catview,pid',$baseurl);
/*****************************************/
if(!function_exists('makeUrl')){
	function makeUrl($addUrl, $cutUrl='', $baseUrl=''){
		if($baseUrl==''){
			$baseUrl = $_SERVER['REQUEST_URI'];
		} 		
		$baseUrl = cutUrl($cutUrl, $baseUrl);
		$newUrl = addUrl($addUrl, $baseUrl);
		return $newUrl;
	}
}
//ex: makeUrl('v4=test','v1,v2,v3',$testurl);
?>