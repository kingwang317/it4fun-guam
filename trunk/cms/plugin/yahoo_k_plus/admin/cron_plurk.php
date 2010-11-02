<?php 
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$my_db = init_db();
		$gene_db = get_db("kingwang","awoo_sakura","login","login.tw");
		$my_sql = "SELECT kw_id FROM plu_keywords";
		$result = $my_db->get_results($my_sql);
		$ids = "-99999";
		echo "OK";
		if(isset($result))
			foreach($result as $kw_ids){
			$ids = $ids .",". $kw_ids->kw_id;
		}
		echo $ids;
		mysql_query("SET NAMES 'latin1'");
		$gene_sql = "SELECT ctime,plurk,plurk_content,kid FROM plurk_monitor WHERE kid IN (-344)";
		$result = $gene_db->get_results($gene_sql);
		if(isset($result))
		foreach($result as $plurks){
			//echo mb_convert_encoding($plurks->plurk_content,"UTF-8","latin1_swedish_ci");
			echo $plurks->plurk_content;
		/*$qid = $urls->q_id;
		$id = $urls->kp_id;
		echo "抓取".$qid."的回應資料<br />";
		$crawler = new ykpCrawler($qid,"answer");
		$reply_time = $crawler->get('reply_time');
		echo $reply_time."<br />";*/
		$update_sql = "INSERT INTO `plu_plurk` (
		`plurk_id` ,
		`kw_ids` ,
		`plurk_url` ,
		`plurk_title` ,
		`plurk_post_time` ,
		`plurk_status` ,
		`plurk_cate` ,
		`plurk_rank` ,
		`ModiTime`
		)
		VALUES (
		NULL , '[$plurks->kid]', '$plurks->plurk', '".htmlspecialchars($plurks->plurk_content)."', '$plurks->ctime', '未處理', '未分類', '其他', '');";
		$my_db->query($update_sql);
		/*unset($crawler);
		flush();
		//sleep(2);
		sleep(rand(60, 180));*/
		}		
?>