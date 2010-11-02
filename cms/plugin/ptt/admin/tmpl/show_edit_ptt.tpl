<script src="<{$validate_url}>"></script>
<link href="<{$css_path}>new.css" rel="stylesheet" type="text/css" />
<link href="<{$jq_multi_select_path}>ui/jquery.multiselect.css" rel="stylesheet" type="text/css" />
<script src="<{$jq_multi_select_path}>jquery.multiselect.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function aHover(url){
		location.href = url;
	}
	function calHover(){
		$('#calDialog').dialog("close");
		location.href = $("#calUrl").text();
	}
	function calAdd(){
		$('#calDialog').dialog("close");
	}
	function showCalDialog(url) {
		$("#calDialog").dialog("open");
		$("#calUrl").text(url);
	}

	//document on ready.
	$(document).ready(function(){
		$("#MySelectBox").multiSelect({
			state: open,
			shadow:true
		});
		$("#calText").text("確定取消新增文章?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#ptt_post_time").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#ptt_track_time").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#addForm").validate();
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
        <div id="sub_navi">
	        <label id="current_keyword">目前關鍵字</label>	
		<form action="<{$do_edit_ptt_url}>" method="POST" >
<select id="MySelectBox" multiple="multiple" name="kw_ids[]">
<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
		<option value="<{$sel_rows.kw_id}>"
		<{foreach from="$kw_ids" item="check_rows" name="kw_ids" }>
		<{if $sel_rows.kw_id == $check_rows.kw_ids }> 
				selected="selected"
		<{/if}>
		<{/foreach}>
		 ><{$sel_rows.kw_content}></option>
<{/foreach}>
</select>
<{foreach from="$ptt_data" item="ptt_rows" name="ptt_data" }>
        
		</div>
        <div id="sub_content">
          <label  class="title" >看版名稱:</label>
          <br />
		<select id="broad_sel" name="broad_sel">
				<option value="0">新增看板</option>
			<{foreach from="$broad_data" item="broad_rows" name="broad_data"}>
				<option value="<{$broad_rows.ptt_bid}>"
				<{if $broad_rows.ptt_bid == $ptt_rows.ptt_bid }>
					selected="select"
				<{/if}>
				 ><{$broad_rows.ptt_bid}></option>
			<{/foreach}>
		</select><br/>
          其它<input type="text" class="ptt_pid" name="ptt_bid" title=""/>(輸入後新增!)
          <br/>
          <div id="paper_box">
            <table >
              <tr>
                <td><label class="title">文章代碼:</label></td>
                <td colspan="4" ><input type="text" name="ptt_pid" id="ptt_pid" class="ptt_pid" value="<{$ptt_rows.ptt_pid}>" /></td>
                <td>
                </td>
              </tr>
              <tr>
                <td><label class="title">文章標題:</label></td>
                <td colspan="4" ><input type="text" name="ptt_title" id="ptt_title" class="paper_title" value="<{$ptt_rows.ptt_title}>" /></td>
                <td>
                </td>
              </tr>
			  
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td ><label class="title">發表日期:</label></td>
                <td colspan="4" ><input type="text" name="ptt_post_time" class="post_dat" id="ptt_post_time" value="<{$ptt_rows.ptt_post_time}>" /></td>
                <td>
                </td>

              </tr>
              <tr>
                <td ><label class="title">追蹤日期:</label></td>
                <td colspan="4" ><input type="text" name="ptt_track_time" class="post_dat" id="ptt_track_time" value="<{$ptt_rows.ptt_track_time}>" /></td>
                <td>
                </td>

              </tr>
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td><label class="title">處理狀態:</label></td>
                <td><label class="radio1">
                  <input type="radio" name="ptt_status" value="未處理" />
                  未處理</label>
                </td>
                <td><input type="radio" name="ptt_status" value="處理中" />
                  處理中 </td>
                <td><input type="radio" name="ptt_status" value="已處理" />
                  已處理 </td>
                <td><input type="radio" name="ptt_status" value="不處理" />
                  不處理 </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td><label class="title">文章類別:</label></td>
                <td><input type="radio" name="ptt_cate" value="未分類" />
                  未分類 </td>
                <td><input type="radio" name="ptt_cate" value="品牌" />
                  品牌 </td>
                <td><input type="radio" name="ptt_cate" value="產品" />
                  產品 </td>
                <td><input type="radio" name="ptt_cate" value="售後服務" />
                  售後服務 </td>
                <td><input type="radio" name="ptt_cate" value="銷售" />
                  銷售 </td>
              </tr>
              <tr>
                <td></td>
                <td><input type="radio" name="ptt_cate" value="行銷活動" />
                  行銷活動 </td>
                <td><input type="radio" name="ptt_cate" value="主動宣傳" />
                  主動宣傳 </td>
                <td><input type="radio" name="ptt_cate" value="其他" />
                  其他 </td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td><label class="title">評價層級:</label></td>
                <td><input type="radio" name="ptt_rank" value="未分類" />
                  未分類 </td>
                <td><input type="radio" name="ptt_rank" value="正面" />
                  正面 </td>
                <td><input type="radio" name="ptt_rank" value="一般" />
                  一般 </td>
                <td><input type="radio" name="ptt_rank" value="負面" />
                  負面 </td>
                <td><input type="radio" name="ptt_rank" value="惡意攻擊" />
                  惡意攻擊</td>
              </tr>
            </table>
            <br/>
            <br/>
<script type="text/javascript">
$("input:radio").val(["<{$ptt_rows.ptt_status}>", "<{$ptt_rows.ptt_cate}>", "<{$ptt_rows.ptt_rank}>"]);
</script>
			<{/foreach}>
            <input type="submit" name="button2" class="button60" value="新增文章" title=""/>
          <a href="#" onClick="showCalDialog('<{$cancel_add_url}>');">取消新增</a> </div>
        </form>
		</div>
  </div>