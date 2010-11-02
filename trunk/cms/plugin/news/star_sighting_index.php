<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/news/";
		$img_path = WEBROOT.$upload_path;
		$img_array = array();
		$dataTotal = $db->get_var("SELECT COUNT(news_id) FROM plu_news WHERE cate_id = '3'");
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT news_id, caption, content, img_name, ModiTime FROM plu_news WHERE cate_id = '3' ORDER BY img_desc LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql);
?>
<script type="text/javascript">
function aHover(url){
	location.href = url + location.href;
}
function printPage() { 
	   window.print(); 
}
function mailTo() { 
	var url = "mailto:?Subject=Cervival Star Sighting Page&body=" + 'Cervival Star Sighting Content';
	location.href = url;
} 
</script>
<div id="starsighting_txtbox" class=" left">
   <h3 class="starsighting_h3">Sightings<span class="icon_h4"></span>
   <span class="iconwrap">
   <img class="icon" onClick="aHover('http://www.facebook.com/share.php?u=')" src="images/fun.gif"/>
   <img class="icon" onClick="aHover('http://twitter.com/home/?status=')" src="images/twinter.gif"/>
   <img class="icon" onClick="aHover('http://www.plurk.com/?qualifier=shares&status=')" src="images/plurk.gif"/>
	 <input type="button"name="button" class="button_bw" onClick="mailTo()" value="email"title=""/> 
	 <input type="button"name="button" class="button_bw" value="Print" title="" onClick="printPage()"/>                        
  </span>
  </h3>
   
 <div id="box_warp">
<div id="main">
	<div id="pages">
<?php
		if(isset($result)){
			foreach($result as $rows){
				$path = $img_path.$rows->img_name;
				if(empty($rows->img_name))
					$path = WEBROOT."/cms/upload/noImg.jpg";
				$img_array[] =  array("img_path" => $path);
				
?>
		<div class="page">
		<div class="navi"></div>
			<div class="scrollable">
				<div class="items">
					<div class="item">
						<img style="width:500px;height:333px;" src="<?php echo $path ?>" />
						 <h3 class="starsighting2"><?php echo $rows->caption ?></h3>
						 <h4 class="starsighting_h4"><?php echo $rows->ModiTime ?></h4>
						<?php echo $rows->content ?>
					</div>
				</div>
			</div>
		</div>

<?php
				}
			}
		//print_r($img_array);	
?>
	</div>
</div>
<ul id="main_navi">
	<?php foreach($img_array as $images){?>
	<li><img style="width:75px;height:75px;" src="<?php echo $images['img_path']; ?>"/></li>
	<?php }?>
</ul>
</div>
</div>