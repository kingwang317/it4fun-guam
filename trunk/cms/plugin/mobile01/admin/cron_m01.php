<?php 		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");		require_once("m01_crawler.php");		include_db_pkg();		$db = init_db();		$sql = "SELECT m01_id,m01_url FROM plu_mobile01 WHERE m01_status != '不處理'";		$result = $db->get_results($sql);		if(isset($result))		foreach($result as $urls){		$url = $urls->m01_url;		$id = $urls->m01_id;		echo "抓取".$url."的回應資料<br />";		$fri_crawler = new m01Crawler($url);		$link_id = $fri_crawler->get('link_id');		echo "最終頁網址".$url."&p=".$link_id;		$sec_crawler = new m01Crawler($url."&p=".$link_id);		$reply_time = $sec_crawler->get('reply_time');		echo "<pre>";		print_r($reply_time);		echo "</pre>";		$update_sql = "UPDATE plu_mobile01 SET m01_track_time = '$reply_time' WHERE m01_id = '$id'";		$db->query($update_sql);		unset($fri_crawler);		unset($sec_crawler);		flush();		sleep(rand(60, 180));		}		?>