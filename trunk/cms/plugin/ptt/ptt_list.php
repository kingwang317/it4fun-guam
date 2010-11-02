<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		function set_value($id,$value,$type){
			$db = init_db();
			$sql = "UPDATE plu_ptt SET ptt_$type = '$value' WHERE ptt_id = '$id'";
			$db->query($sql);
		}
		if(isset($_GET['type'])){
			switch($_GET['type']){
				case "ptt_status":
				set_value($_POST['ptt_status_id'],$_POST['ptt_status_dialog'],"status");
				break;
				case "ptt_cate":
				set_value($_POST['ptt_cate_id'],$_POST['ptt_cate_dialog'],"cate");
				break;
				case "ptt_rank":
				set_value($_POST['ptt_rank_id'],$_POST['ptt_rank_dialog'],"rank");
				break;
				default:
				break;
			}
			break;
		}
		$filter = "";
		$require  = "";
		$order_by = "";
		$date_set = false;
		if(isset($_GET['ptt_is_search_bar'])){
			$filter = " WHERE ";
			$filter .= $_GET['ptt_kw_sel']!='all' ?"kw_ids LIKE '%[".$_GET['ptt_kw_sel']."]%' AND ":"";
			$require .=  $_GET['ptt_kw_sel']!='all' ?get_keyword($_GET['ptt_kw_sel']).",":"全部關鍵字,";
			$filter .= $_GET['ptt_status']!='all' ?"ptt_status = '".$_GET['ptt_status']."' AND ":"";
			$require .=  $_GET['ptt_status']!='all' ?$_GET['ptt_status'].",":"全部處理狀態,";
			$filter .= $_GET['ptt_cate']!='all' ?"ptt_cate = '".$_GET['ptt_cate']."' AND ":"";
			$require .=  $_GET['ptt_cate']!='all' ?$_GET['ptt_cate'].",":"全部文章類別,";
			$filter .= $_GET['ptt_rank']!='all' ?"ptt_rank = '".$_GET['ptt_rank']."' AND ":"";
			$require .=  $_GET['ptt_rank']!='all' ?$_GET['ptt_rank'].",":"全部評價層級,";
			$filter .= " ptt_id IS NOT NULL ";
			if($_GET['start_date'] != "" && $_GET['end_date'] != "" ){
				$date_set = true;
				$filter .= $_GET['range']!='1'?"AND ptt_post_time BETWEEN ":"AND ptt_track_time BETWEEN ";
				$filter .= "'".$_GET['start_date']."' AND '".$_GET['end_date']."'";
				
				$require .=   $_GET['start_date']." － ".$_GET['end_date'];
				$require .=   $_GET['range']!='1'?"發表,":"有回應,";
			}
		}
		if(isset($_GET['order_type'])){
			switch($_GET['order_type']){
			case "posti":
			$order_by = " ORDER BY ptt_post_time DESC ";
			break;
			case "postd":
			$order_by = " ORDER BY ptt_post_time ASC ";
			break;			
			case "replyi":
			$order_by = " ORDER BY ptt_track_time DESC ";
			break;
			case "replyd":
			$order_by = " ORDER BY ptt_track_time ASC ";
			break;
			case "statusi":
			$order_by = " ORDER BY ptt_status DESC ";
			break;
			case "statusd":
			$order_by = " ORDER BY ptt_status ASC ";
			break;
			default:
			
			break;
			}
			$order_type = $_GET['order_type'];
		}else{
			$order_type = "posti";
			$order_by = " ORDER BY ptt_post_time DESC ";
		}
		$count = 1;
		$sel_sql = "SELECT DISTINCT kw_id, kw_content FROM plu_keywords";
		$sel_result = $db->get_results($sel_sql);

		$dataTotal = $db->get_var("SELECT COUNT(ptt_id) FROM plu_ptt" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT * FROM plu_ptt ". $filter . $order_by ." LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql);
		$export_sql = "SELECT ptt_post_time,ptt_cate,CONCAT('PTT實業舫-',ptt_bid),ptt_rank,ptt_title,CONCAT('主題編號',ptt_pid),'' as qus1,'' as qus2,kw_ids FROM plu_ptt ". $filter . $order_by ."LIMIT 500";
		//$export_sql = "SELECT * FROM plu_ptt ". $filter . $order_by ."LIMIT 500";
		$export_result = $db->get_results($export_sql);
		$_SESSION['report_value'] = $export_result;
		
function get_keyword($id){
	$db = init_db();
	$kw_sql = "SELECT DISTINCT kw_content FROM plu_keywords WHERE kw_id = '$id'";
	$kw = $db->get_var($kw_sql);
	return $kw;
}

?>
<script type="text/javascript">
	function aHover(url){
		location.href = url;
	}
	function calHover(){
		$('#calDialog').dialog("close");
		location.href = $("#calUrl").text();
	}
		var tab_path = "#remote-tab-5";
	    $("a").live("click", function () {
			var url = this.href
			if(url.indexOf("#")<0)
				url += tab_path;
			if(url.indexOf("<?php echo WEBROOT ?>")<0 && url.indexOf("http")>=0)
				window.open(url);
			else
				location.href = url;
            return false;
        });
	function calEdit(type){
		$('#'+type+'Dialog').dialog("close");
		return true;
	}
	function postVlaue(type){
		$('#'+type+'Dialog').dialog("close");
		$.post("<?php echo WEBROOT ?>/index.php?cmsid=5&type=ptt_"+type+"", $("#"+type+"_form").serialize());
		location.reload();
	}
	function showDialog(type,id,value) {
		$("#"+type+"Dialog").dialog("open");
		$("#ptt_"+type+"_id").val(id);
		$('input[name=ptt_'+type+'_dialog]:radio').filter('[value='+value+']').attr('checked', true);
	}

	//document on ready.
	$(document).ready(function(){
		$("#statusDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#cateDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#rankDialog").dialog({
			autoOpen: false,
			modal:true
		});
		var d = new Date();
		var x = document.getElementById("selForm");
		var month = ('0'+(d.getMonth()+1).toString());
		if(month.length>2)
			month = month.substr(month.length-2,2);
		var day = ('0'+d.getDate().toString());
		if(day.length>2)
			day = day.substr(day.length-2,2);
		x.end_date.value = d.getFullYear().toString() + '-' + month + '-' + day;
		x.start_date.value = d.getFullYear().toString() + '-' + d.getMonth() + '-' + 1;
		$("#start_date").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#end_date").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});	
	});
</script>
<?php 
if($date_set){

?>
<script type="text/javascript">
$("#start_date").val("<?php echo $_GET['start_date'];?>");
$("#end_date").val("<?php echo $_GET['end_date'];?>");
</script>
<?php 
}
?>
<h4>PTT口碑文章</h4>
        <div id="select">
		<form name="selForm" id="selForm" action="#remote-tab-5" method="GET" >
		<table class="praise">
		  <tr>
			<td class="k1">選擇關鍵字:</td>
			<td class="k2">
			<select name="ptt_kw_sel" >
						<option value="all" >全部</option>
						<?php foreach($sel_result as $sel_rows ){?>
						<option value="<?php echo $sel_rows->kw_id ?>"><?php echo $sel_rows->kw_content ?></option>
						<?php }?>
			</select>			</td>
			<td class="k3">處理狀態:</td>
			<td>
			<select name="ptt_status">
						<option value="all" >顯示全部</option>
						<option value="未處理" >未處理</option>
						<option value="處理中" >處理中</option>
						<option value="已處理" >已處理</option>
						<option value="不處理" >不處理</option>
			</select>			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>文章類別:</td>
			<td>              
			<select name="ptt_cate">
						<option value="all" >顯示全部</option>
						<option value="品牌" >品牌</option>
						<option value="產品">產品</option>
						<option value="售後服務">售後服務</option>
						<option value="銷售">銷售</option>
						<option value="行銷活動">行銷活動</option>
						<option value="主動宣傳">主動宣傳</option>
						<option value="其他">其他</option>
		   </select>			</td>
			<td>評價層級:</td>
			<td>
			<select name="ptt_rank">
						<option value="all">不指定</option>
						<option value="未分類">未分類</option>
						<option value="正面">正面</option>
						<option value="一般">一般</option>
						<option value="負面">負面</option>
						<option value="惡意攻擊">惡意攻擊</option>
					  </select>			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>指定期間:</td>
			<td>
				  <input name="range" id="range" checked="true" type="radio" value="0" />
			  發表日期
	    <input name="range" id="range" type="radio" value="1" />最新回應日期</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;從</td>
			<td><input name="start_date" id="start_date" type="text" /></td>
			<td>到</td>
			<td><input name="end_date" id="end_date" type="text" /></td>
			 <input name="ptt_is_search_bar" type="hidden" value="true" />
			<td><input type="submit" name="sel_button" class="button60" value="search" title=""/></td>
		  </tr>
<?php 
if(isset($_GET['is_search_bar'])){
?>
<script type="text/javascript">
//$('input[name=range]:radio').filter('[value=<?php echo $_GET['range']; ?>]').attr('checked', true);
//$("select").val(["<?php echo $_GET['ptt_kw_sel']; ?>","<?php echo $_GET['ptt_status']; ?>","<?php echo $_GET['ptt_cate']; ?>","<?php echo $_GET['ptt_rank']; ?>"]);
</script>
<?php 
}
?>	  
		</table>
		
          <hr/>
			  <div id="notes">
              <input type="submit" name="sel_button" class="button100" value="export" title=""/>
			  </form>
			  <p id="search_condition">搜尋條件:<strong class="black"><?php echo $require; ?></strong></p>
			  <p id="search_result">搜尋結果: 共 <strong class="black"><?php echo ceil($dataTotal/10) ?></strong> 頁，<strong class="black"><?php echo $dataTotal ?></strong> 篇文章；顯示 <?php echo $dataStart+1 ." - ".$dataLen?>項</p>
			  <br clear="all"/>
			  </div>
			         <div id="sort">
					 <strong class="black">排序 : </strong>
					 <a href="<?php echo WEBROOT."/?".str_replace('cmsid=5','',$_SERVER['QUERY_STRING']) ?>&order_type=posti#remote-tab-5" <?php if($order_type=="posti")echo 'class="order-style"'?>>發表日期較新</a> |
					 <a href="<?php echo WEBROOT."/?".str_replace('cmsid=5','',$_SERVER['QUERY_STRING']) ?>&order_type=postd#remote-tab-5" <?php if($order_type=="postd")echo 'class="order-style"'?>>發表日期較舊</a> |
					 <a href="<?php echo WEBROOT."/?".str_replace('cmsid=5','',$_SERVER['QUERY_STRING']) ?>&order_type=replyi#remote-tab-5" <?php if($order_type=="replyi")echo 'class="order-style"'?>>回應日期較新</a> |
					 <a href="<?php echo WEBROOT."/?".str_replace('cmsid=5','',$_SERVER['QUERY_STRING']) ?>&order_type=replyd#remote-tab-5" <?php if($order_type=="replyd")echo 'class="order-style"'?>>回應日期較舊</a> |
					 <a href="<?php echo WEBROOT."/?".str_replace('cmsid=5','',$_SERVER['QUERY_STRING']) ?>&order_type=statusi#remote-tab-5" <?php if($order_type=="statusi")echo 'class="order-style"'?>>狀態已處理 </a>|
					 <a href="<?php echo WEBROOT."/?".str_replace('cmsid=5','',$_SERVER['QUERY_STRING']) ?>&order_type=statusd#remote-tab-5" <?php if($order_type=="statusd")echo 'class="order-style"'?>>狀態未處理 </a>
					</div>
					<br/>
                     <div id="top-next"><?php print_r(str_replace("cmsid=5","",$pagejump)); ?></div>
				<table class="tab" name="ptt_table" id="ptt_table">
					<thead>
					   <tr>
							<th scope="col"  width="10%">序號</th>
							<th scope="col" abbr="number" width="10%">狀態</th>
							<th scope="col" abbr="services" width="20%">口碑文章標題</th>	
							<th scope="col" abbr="services" width="15%">看版</th>	
							<th scope="col" abbr="services" width="15%">代碼</th>	
							<th scope="col" abbr="picture" width="10%">文章類別</th>
							<th scope="col" abbr="Services Content" width="10%">評價層級</th>
							<th scope="col" abbr="change" width="10%">發表日期</th>
					   </tr>
					</thead>
					<tbody>
<?php
		if(isset($result)){
			foreach($result as $rows){
?>
		<tr >
			<td scope="row" class="column1"><?php echo $count++?></td>	
			<td class="column1"><u onClick="showDialog('status','<?php echo $rows->ptt_id ?>','<?php echo $rows->ptt_status ?>');" ><?php echo $rows->ptt_status?></u></td>
			<td><u><?php echo $rows->ptt_title?></u></td>
			<td><u><?php echo $rows->ptt_bid?></u></td>
			<td><u><?php echo $rows->ptt_pid?></u></td>
			<td class="column1"><u onClick="showDialog('cate','<?php echo $rows->ptt_id ?>','<?php echo $rows->ptt_cate ?>');" ><?php echo $rows->ptt_cate?></u></td>
			<td class="column1"><u onClick="showDialog('rank','<?php echo $rows->ptt_id ?>','<?php echo $rows->ptt_rank ?>');" ><?php echo $rows->ptt_rank?></u></td>
			<td class="column1"><?php echo $rows->ptt_post_time?></td>
		</tr>
<?php
				}
			}
?>

					</tbody>
				</table>
        </div>
        <div id="bottom-next"><?php print_r(str_replace("cmsid=5","",$pagejump)); ?></div>

<div id="statusDialog" title="變更狀態" style="display:none" >
<form name="status_form" id="status_form" method="POST" >
<input type="hidden" name="ptt_status_id" id="ptt_status_id" />
<input name="ptt_status_dialog" checked="true" type="radio" value="未處理" />未處理<br/>
<input name="ptt_status_dialog" type="radio" value="處理中" />處理中<br/>
<input name="ptt_status_dialog"  type="radio" value="已處理" />已處理<br/>
<input name="ptt_status_dialog" type="radio" value="不處理" />不處理<br/>
<div id="calBtn"><input type="button" class="button60" value="確定" onClick='postVlaue("status")' />&nbsp;&nbsp;&nbsp;<a onClick='javascript:calEdit("status");return false;'><u>我反悔了</u></a></div>
</form>
</div>
<div id="cateDialog" title="變更類別" style="display:none" >
<form name="cate_form" id="cate_form" method="POST" >
<input type="hidden" name="ptt_cate_id" id="ptt_cate_id" />
<input name="ptt_cate_dialog" checked="true" type="radio" value="品牌" />品牌<br/>
<input name="ptt_cate_dialog" type="radio" value="產品" />產品<br/>
<input name="ptt_cate_dialog"  type="radio" value="售後服務" />售後服務<br/>
<input name="ptt_cate_dialog" type="radio" value="銷售" />銷售<br/>
<input name="ptt_cate_dialog" type="radio" value="行銷活動" />行銷活動<br/>
<input name="ptt_cate_dialog"  type="radio" value="主動宣傳" />主動宣傳<br/>
<input name="ptt_cate_dialog" type="radio" value="其他" />其他<br/>
<div id="calBtn"><input type="button" class="button60" value="確定" onClick='postVlaue("cate")' />&nbsp;&nbsp;&nbsp;<a onClick='javascript:calEdit("cate");return false;'><u>我反悔了</u></a></div>
</form>
</div>
<div id="rankDialog" title="變更評價層級" style="display:none" >
<form name="rank_form" id="rank_form" method="POST" >
<input type="hidden" name="ptt_rank_id" id="ptt_rank_id" />
<input name="ptt_rank_dialog" checked="true" type="radio" value="未分類" />未分類<br/>
<input name="ptt_rank_dialog" type="radio" value="正面" />正面<br/>
<input name="ptt_rank_dialog"  type="radio" value="一般" />一般<br/>
<input name="ptt_rank_dialog" type="radio" value="負面" />負面<br/>
<input name="ptt_rank_dialog" type="radio" value="惡意攻擊" />惡意攻擊<br/>
<div id="calBtn"><input type="button" class="button60" value="確定" onClick='postVlaue("rank")' />&nbsp;&nbsp;&nbsp;<a onClick='javascript:calEdit("rank");return false;'><u>我反悔了</u></a></div>
</form>

</div>
<?php
if($_SESSION['member_group'] == "1"){
?>
	<script type="text/javascript">
		$("#statusDialog").dialog('destroy');
		$("#cateDialog").dialog('destroy');
		$("#rankDialog").dialog('destroy');
	</script>
<?php
}
?>