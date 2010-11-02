<?php 
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once("yahoo_crawler.php");
		include_db_pkg();
		$db = init_db();
		$sql = "SELECT kp_id,q_id FROM plu_yahoo_kplus WHERE kp_status != '不處理'";
		$result = $db->get_results($sql);
		if(isset($result))
		foreach($result as $urls){
		$qid = $urls->q_id;
		$id = $urls->kp_id;
		echo "抓取".$qid."的回應資料<br />";
		$crawler = new ykpCrawler($qid,"answer");
		$reply_time = $crawler->get('reply_time');
		echo $reply_time."<br />";
		$update_sql = "UPDATE plu_yahoo_kplus SET kp_track_time = '$reply_time' WHERE kp_id = '$id'";
		$db->query($update_sql);
		unset($crawler);
		flush();
		//sleep(2);
		sleep(rand(60, 180));
		}		
?>