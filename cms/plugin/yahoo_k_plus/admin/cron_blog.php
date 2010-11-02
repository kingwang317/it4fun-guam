<?php 
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$my_db = init_db();
		$gene_db = get_db("kingwang","awoo_sakura","datamining","login.tw");
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
		$gene_sql = "SELECT ctime,kid,lid FROM otaku_blog WHERE kid IN ($ids)";
		$result = $gene_db->get_results($gene_sql);
		if(isset($result))
		foreach($result as $blogs){
			echo $blogs->lid;
		$update_sql = "INSERT INTO `plu_blog` (
		`blog_id` ,
		`kw_ids` ,
		`blog_url` ,
		`blog_title` ,
		`blog_post_time` ,
		`blog_status` ,
		`blog_cate` ,
		`blog_rank` ,
		`ModiTime`
		)
		VALUES (
		NULL , '[$blogs->kid]', '$blogs->lid', '', '$blogs->ctime', '未處理', '未分類', '其他', '');";
		$my_db->query($update_sql);
		}
		//不能JOIN GENE資料庫，分開更新
		$my_lid_sql = "SELECT DISTINCT blog_url FROM plu_blog";
		$result = $my_db->get_results($my_lid_sql);
		$lids = "-99999";
		echo "OK";
		if(isset($result))
			foreach($result as $lid_ids){
			$lids = $lids .",". $lid_ids->blog_url;
		}
		$gene_lid_sql = "SELECT DISTINCT lid,url,title FROM blog WHERE lid IN ($lids)";
		$result = $gene_db->get_results($gene_lid_sql);
		$up_sql = "";
		if(isset($result))
		foreach($result as $lids){
			$up_sql = "UPDATE `plu_blog` SET `blog_url` = '".htmlspecialchars($lids->url)."',`blog_title` = '".htmlspecialchars($lids->title)."' WHERE `blog_url` = '$lids->lid';";
			echo $up_sql;
			$my_db->query($up_sql);
		}
		
		
?>