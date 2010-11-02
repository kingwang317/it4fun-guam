<? 
//url functions
//2008/2/12 將 $url 位置改到後面去，設定為optional，預設值為 $_SERVER['REQUEST_URI']

/****************************************	2006/8/30 v1, 2006/9/4 v2*/
if(!function_exists('cutUrlVar')){
	function cutUrlVar($queryStringSet, $baseurl=''){
		if($baseurl==''){
		$baseurl = $_SERVER['REQUEST_URI'];
		}


		$ary = preg_split('/[\\s,]/',$queryStringSet);	
		foreach ( $ary as $qstr ){	
			if (preg_match("/($qstr)=\\w*&/",$baseurl)){
			$baseurl = preg_replace("/($qstr)=\\w*&/",'',$baseurl);
			} else {
			$baseurl = preg_replace("/([&\?]$qstr)=\\w*/",'',$baseurl);
			}
		}
	return $baseurl;
	}
	//ex: cutUrlVar('actionid,catview,pid',$baseurl);
}
/****************************************	2006/8/30*/
if(!function_exists('addUrlVar')){
	function addUrlVar($queryString='', $baseurl=''){
		if($baseurl==''){
		$baseurl = $_SERVER['REQUEST_URI'];
		}

	//先把重複的去掉 2008/1/26
		$qs = preg_replace("/=\w*/",'',$queryString);
		$qs = preg_replace("/&/",',',$qs);
		$baseurl = cutUrlVar($baseurl, $qs);
		
	//重新加上$queryString
		if($queryString){
			if (!ereg('\?+',$baseurl)){
			//echo "完全沒有問號";
			$newurl=$baseurl.'?'.$queryString;
			} elseif (ereg('\?$',$baseurl)){
			//echo "問號結尾";
			$newurl=$baseurl.$queryString;
			} else {
			//echo "有問號，且問號不是在最後";
			$newurl=$baseurl.'&'.$queryString;
			}
		} else {
			$newurl = $baseurl;
		}
		return $newurl;
	}
}
/****************************************	2007/01/17 */
if(!function_exists('makelink')){
	function makelink($addurlvar, $cuturlvar='', $baseurl=''){
		if($baseurl==''){
			$baselink = cutUrlVar($_SERVER['REQUEST_URI'],$cuturlvar);
		} else {
			$baselink = cutUrlVar($baseurl,$cuturlvar);
		}
		$tolink = addUrlVar($baselink, $addurlvar);
		return $tolink;
	}
}
/****************************************	2007/8/3 v1 */
if(!function_exists('keepUrlVar')){
	
	function keepUrlVar($queryStringSet, $baseurl=''){
		if($baseurl==''){
		$baseurl = $_SERVER['REQUEST_URI'];
		}
	
		$ary = preg_split('/[\\s,]/',$queryStringSet);	
		
		$qp =strpos($baseurl, '?');
		
		if($qp){
			$pureurl=substr($baseurl, 0, $qp);
			$qstring=substr($baseurl, $qp+1, strlen($baseurl)-$qp);
			$qAry = explode('&',$qstring);
			
			$keepAry = array();
			
			foreach ($ary as $qkey){
					$okAry = preg_grep ("/^$qkey=/", $qAry );
					$keepAry = array_merge($keepAry, $okAry);
			}
			
			//print_r($keepAry);
			
			for($i=0;$i<count($keepAry);$i++){
				$newqstr.=$keepAry[$i];
				if($i<count($keepAry)-1){
					$newqstr.='&';
				}
			}
		
		} else {
			return $baseurl;
		}
		
		if($newqstr){
			$newurl = $pureurl.'?'.$newqstr;
		} else {
			$newurl = $pureurl;
		}
		return $newurl;
		
	}
}	
//ex: keepUrlVar('actionid,catview,pid',$baseurl);

?>