<?php
/********************  myinclude  2007/08/02 *********************/
function myinclude($absPath, $restoreUrl=""){

	if(!$restoreUrl){
		$restoreUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	}
	
	if(strpos($absPath,$_SERVER['DOCUMENT_ROOT'])!==false){
		$docroot =$_SERVER['DOCUMENT_ROOT'];
		// $relativePath = ltrim($absPath,$docroot); 表現錯誤 以以下三行代替
		$start = strrpos($absPath, $docroot) + strlen($docroot);
		$length = strlen($absPath) - $start;
		$relativePath = substr ( $absPath, $start, $length );
		
		$url = 'http://'.$_SERVER['HTTP_HOST'].''.$relativePath;
		preg_match('/cms\/admin\//',$url,$matches);
	//	if(strlen($matches[0])==10){
		//	echo "\n".'<base href="'.$url.'" />'."\n";
	//	}
	//	echo "\n".'<base href="'.$url.'" />'."\n";
		//$head.="\n".'<base href="'.$url.'" />'."\n";
		include($absPath);
		echo "\n".'<base href="'.$restoreUrl.'" />'."\n";
	} else {
	echo '<div>include error: REQUIRE ABSOLUTE PATH</div>';
	}
}


?>