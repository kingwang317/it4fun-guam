<?php
function init_pager($params)
{
	require_once(PAGER_LIB. "/Pager.php");
	return Pager::factory($params);
}
function init_sliding_pager($dataTotal, $perPage=10)
{
	$params = array(
		'totalItems' 	=> $dataTotal,	    
		'perPage' 		=> $perPage,	//每頁顯示資料筆數
		'delta' 		=> 5,			// 每頁顯示跳頁數
		'append' 		=> true,
		'clearIfVoid' 	=> false,
		'urlVar' 		=> 'page',		//參數名稱
		'mode'  		=> 'Sliding',
		'altPrev'		=> '上一頁',
		'prevImg'		=>	'<< Previous',
		'altNext'		=>	'下一頁',
		'nextImg'		=>	'Next >>'
	);
	$dataStart = empty($_REQUEST[$params['urlVar']]) ? 0:($_REQUEST[$params['urlVar']]-1) * $params['perPage'];
	$dataLen = $params['perPage'];
	$pager = init_pager($params);
	$links = $pager->getLinks();
	
	return array($dataStart, $dataLen, $links['all']);
}
?>
