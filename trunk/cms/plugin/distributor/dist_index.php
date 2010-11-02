<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		$upload_path = "/cms/upload/distributor/";
		$img_path = WEBROOT.$upload_path;
		$place_id = !empty($_POST["place_id"]) && preg_match("/^[0-9]*$/",$_POST["place_id"])?$_POST["place_id"]:NULL;
		$filter = isset($place_id)?" WHERE place_id = '$place_id' ":"";
		$sql = "SELECT dist_id, dist_name, dist_phone,dist_address,dist_url, img_name, ModiTime FROM plu_distributor". $filter;
		$result = $db->get_results($sql);
		$sel_sql = "SELECT DISTINCT place_id, place_name FROM plu_dist_place";
		$sel_result = $db->get_results($sel_sql);
?>
<div id="sponsors">
	<h3 class="distributors_h3">distributors<span></span></h3>
	<p   class="distributors_select" >
	<form action="" method="POST" >
		<label >Country:</label>
		<select name="place_id">
			<option value="0">--請選擇--</option>
			<?php 
									if(isset($sel_sql)){
										foreach($sel_result as $sel_rows){
			?>
			<option value="<?php echo $sel_rows->place_id?>" <?php if($place_id == $sel_rows->place_id)echo "selected='selected'"; ?> ><?php echo $sel_rows->place_name ?></option>
			<?php
										}
									}
			?>
		</select>
		<input type="submit" id="submit" value="Confirm" />
	</form>
	</p>

	<table  class="distributors_table">
		<tr>
			<td  class="blue" width="40%">Distributor</td>
			<td  class="blue" width="20%">Phone</td>
			<td  class="blue" width="40%">Address</td>
		</tr>
	<?php
			if(isset($result)){
				foreach($result as $rows){
					$path = $img_path.$rows->img_name;
					if(empty($rows->img_name))
						$path = WEBROOT."/cms/upload/noImg.jpg";
	?>
		<tr>
			<td><img src="<?php echo $path ?>" width="135" height="45" /><a href="<?php echo $rows->dist_url ?>" target="_blank" >[<?php echo $rows->dist_name ?>]</a></td>
			<td><?php echo $rows->dist_phone ?></td>
			<td><?php echo $rows->dist_address ?></td>
		</tr>
	<?php
					}
				}
	?>
	</table>
</div>