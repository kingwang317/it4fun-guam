<?php
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$news_id = isset($_GET['news_id'])?$_GET['news_id']:"";
		if(!(isset($_GET['news_id']) && preg_match("/^[0-9]*$/", $_GET['news_id']))){
			redirect(WEBROOT, 0, "sorry!!你所要觀看的消息不合法");
			exit;
		}

		$db = init_db();
		$upload_path = "/cms/upload/news/";
		$img_path = WEBROOT.$upload_path;
		$dataTotal = $db->get_var("SELECT COUNT(news_id) FROM plu_news");
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT caption, content, img_name, ModiTime FROM plu_news WHERE news_id = '$news_id' LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql);
		if(isset($result)){
			foreach($result as $rows){
				$path = $img_path.$rows->img_name;
				if(empty($rows->img_name))
					$path = WEBROOT."/cms/upload/noImg.jpg";
?>
	<div class="image_box right">
		<img style="width:300px;height:248px;" src="<?php echo $path ?>" />
	</div>
	<div id="news_txtbox" class=" left">
		<h3 class="news_h3"><?php echo $rows->caption ?></h3>
		<h4 class="news_h4"><?php echo $rows->ModiTime ?></h4>
		<?php echo $rows->content ?>
		<a class="backurl" href="<?php echo WEBROOT."/index.php?cmsid=4"?>" >Back to News  &gt;&gt;</a>
	</div>
<?php
				}
			}
?>