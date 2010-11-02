<?php

//在自己的位置中加上參數，如果已經有別的參數了，加上&符號

// myscript:
	function redirect($url,$sec=0){
	echo "<meta http-equiv=\"refresh\" content=\"$sec;URL=$url\" />";
	}	
//----------------------------------------------------------			
	function refresh($sec=0){
	echo "<meta http-equiv=\"refresh\" content=\"$sec\" />";			
	}
/****************************************	2006/8/30 v1, 2006/9/4 v2*/
	function cutUrlVar($url, $queryStringSet){
		$ary = preg_split('/[\\s,]/',$queryStringSet);	
		foreach ( $ary as $qstr ){	
			if (preg_match("/($qstr)=\\w*&/",$url)){
			$url = preg_replace("/($qstr)=\\w*&/",'',$url);
			} else {
			$url = preg_replace("/([&\?]$qstr)=\\w*/",'',$url);
			}
		}
	return $url;
	}
	//ex: cutUrlVar($url,'actionid,catview,pid');

/****************************************	2007/8/3 v1 */
	function keepUrlVar($url, $queryStringSet){
		$ary = preg_split('/[\\s,]/',$queryStringSet);	
		
		$qp =strpos($url, '?');
		
		if($qp){
			$pureurl=substr($url, 0, $qp);
			$qstring=substr($url, $qp+1, strlen($url)-$qp);
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
			return $url;
		}
		
		if($newqstr){
			$newurl = $pureurl.'?'.$newqstr;
		} else {
			$newurl = $pureurl;
		}
		return $newurl;
		
	}
	
	//ex: keepUrlVar($url,'actionid,catview,pid');
/****************************************	2008/1/31*/
	function addUrlVar($url, $queryString=''){
	//先把重複的去掉 2008/1/26
		$qs = preg_replace("/=\w*/",'',$queryString);
		$qs = preg_replace("/&/",',',$qs);
		$url = cutUrlVar($url, $qs);
		
	//重新加上$queryString
		if($queryString){
			if (!ereg('\?+',$url)){
			//echo "完全沒有問號";
			$newurl=$url.'?'.$queryString;
			} elseif (ereg('\?$',$url)){
			//echo "問號結尾";
			$newurl=$url.$queryString;
			} else {
			//echo "有問號，且問號不是在最後";
			$newurl=$url.'&'.$queryString;
			}
		} else {
			$newurl = $url;
		}
		return $newurl;
	}
/****************************************	2006/8/30*/
/*	function addUrlVar($url, $queryString=''){
		if($queryString){
			if (!ereg('\?+',$url)){
			//echo "完全沒有問號";
			$newurl=$url.'?'.$queryString;
			} elseif (ereg('\?$',$url)){
			//echo "問號結尾";
			$newurl=$url.$queryString;
			} else {
			//echo "有問號，且問號不是在最後";
			$newurl=$url.'&'.$queryString;
			}
		} else {
			$newurl = $url;
		}
		return $newurl;
	}
*//****************************************	2007/11/16*/
//改良的 addUrlVar 將減掉重複的qstring (測試使用)
	function addUrlVar2($url, $queryKey='', $queryValue=''){
		$url = cutUrlVar($url, $queryKey);
		$queryString = $queryKey.'='.$queryValue;
		if($queryKey){
			if (!ereg('\?+',$url)){
			//echo "完全沒有問號";
			$newurl=$url.'?'.$queryString;
			} elseif (ereg('\?$',$url)){
			//echo "問號結尾";
			$newurl=$url.$queryString;
			} else {
			//echo "有問號，且問號不是在最後";
			$newurl=$url.'&'.$queryString;
			}
		} else {
			$newurl = $url;
		}
		return $newurl;
	}
/* test addUrlVar2 
	$url = "http://www.example.com?id=5";
	echo addUrlVar2($url, 'id', 5);	
*/
/****************************************	2006/11/28*/
	function toUrl($url, $queryString=''){
		echo addUrlVar($url, $queryString);
	}

/****************************************	2007/01/17 */
function makelink($addurlvar, $cuturlvar='', $baseurl=''){
if($baseurl==''){
	$baselink = cutUrlVar($_SERVER['REQUEST_URI'],$cuturlvar);
} else {
	$baselink = cutUrlVar($baseurl,$cuturlvar);
}
$tolink = addUrlVar($baselink, $addurlvar);
return $tolink;
}

/****************************************	2007/01/17 */
//echo addlink("news=edit&editid=$news_id", '修改', 'news');
function addlink($display, $addurlvar, $cuturlvar='', $baselink=''){
$tolink = makelink($addurlvar, $cuturlvar, $baselink);
echo "<a href=\"$tolink\">$display</a>";
}

/******************************************* 2006/8/31  v1.  2006/9/21 v2 + failUrl*/
// 預設的 url 為目前的 URL 去掉 query string 
	function successOrNot($subj, $okMsg='default', $failMsg='default', $okUrl='default', $failUrl='default'){
	//function prerequire: myscript::redirect();
	
	if($okMsg=='default') $okMsg='資料已更新';
	if($failMsg=='default') $failMsg='資料更新失敗';
	if($okUrl=='default') $okUrl=str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
	if($failUrl=='default') $failUrl=$okUrl;
	
		if ($subj==true){
		echo $okMsg;
		redirect($okUrl, 1.6);	
		} else {
		//echo $failMsg;
		//echo " <a href=\"$towhere\">back</a>";
		echo "
		$failMsg
		<script>
		alert('$failMsg');
		</script>
		";
		redirect($failUrl,0);	
		//header("location:$towhere");
		}
		
	exit;
	}

/*************** 回上頁按鈕 2006/10/12  v1. */
	function backbtn($text="back"){
	$backurl = $_SERVER['HTTP_REFERER'];
	echo "<a href=\"$backurl\">$text</a>";
	}
/*************** 直接回上頁 2006/11/08  v1. */
	function back($msg=NULL){
	$backurl = $_SERVER['HTTP_REFERER'];
	
	if ($msg)
	{
		echo "$msg";
		redirect($backurl,1.2);	
	} 
	else 
	{	
	header("location:$backurl");
	}
	}


?>
