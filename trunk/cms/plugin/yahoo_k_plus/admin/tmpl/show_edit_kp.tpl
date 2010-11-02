<script type="text/javascript" src="<{$validate_url}>"></script>
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
	function getKPData(){
		var url = "index.php?cmsroot=get_data&pluName=yahoo_k_plus&pluAdmin=admin/index.php&func=get_kp_data&qid=" + $('#kp_qid').val();
		$.ajax({
			type: "GET",
			url: url,
			success: function (data, textStatus) {
				if(data.reply_time == "" || data.title == "")
					alert("不對唷!!請確定網址是否正確輸入");
				$('#post_time').val(data.reply_time);
				$('#kp_title').val(data.title);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				alert("request failed: " + textStatus);
			},
			dataType: "json"
		});
	}
	//document on ready.
	$(document).ready(function(){
		$("#MySelectBox").multiSelect({
			state: open,
			shadow:true
		});
		$("#calText").text("確定取消變更文章?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#post_time").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
        <div id="sub_navi">
	        <label id="current_keyword">目前關鍵字</label>	
		<form action="<{$do_edit_kp_url}>" method="POST" >
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
		
<{foreach from="$kp_data" item="kp_rows" name="kp_data" }>

		</div>
        <div id="sub_content">
          <label  class="title" >Qid:</label>
          <br />
          <input type="text" class="url" name="kp_qid" id="kp_qid" value="<{$kp_rows.q_id}>" />
          <input type="button"name="button2" class="button260" value="產出標題" title="" onClick="getKPData();" />
          <br/>
          <br/>
          <hr/>
          <div id="paper_box">
            <table >
              <tr>
                <td><label class="title">文章標題:</label></td>
                <td colspan="4" ><input type="text" name="kp_title" id="kp_title" class="paper_title" value="<{$kp_rows.kp_title}>" /></td>
                <td>
                </td>
              </tr>
			  
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td ><label class="title">發表日期:</label></td>
                <td colspan="4" ><input type="text" name="post_time" class="post_dat" id="post_time" value="<{$kp_rows.kp_post_time}>" /></td>
                <td>
                </td>

              </tr>
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td><label class="title">處理狀態:</label></td>
                <td><label class="radio1">
                  <input type="radio" name="kp_status" id="kp_status" value="未處理" />
                  未處理</label>
                </td>
                <td><input type="radio" name="kp_status" id="kp_status" value="處理中" />
                  處理中 </td>
                <td><input type="radio" name="kp_status" id="kp_status" value="已處理" />
                  已處理 </td>
                <td><input type="radio" name="kp_status" id="kp_status" value="不處理" />
                  不處理 </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td><label class="title">文章類別:</label></td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="未分類" />
                  未分類 </td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="品牌" />
                  品牌 </td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="產品" />
                  產品 </td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="售後服務" />
                  售後服務 </td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="銷售" />
                  銷售 </td>
              </tr>
              <tr>
                <td></td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="行銷活動" />
                  行銷活動 </td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="主動宣傳" />
                  主動宣傳 </td>
                <td><input type="radio" name="kp_cate" id="kp_cate" value="其他" />
                  其他 </td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="6" >&nbsp;</td>
              </tr>
              <tr>
                <td><label class="title">評價層級:</label></td>
                <td><input type="radio" name="kp_rank" id="kp_rank" value="未分類" />
                  未分類 </td>
                <td><input type="radio" name="kp_rank" id="kp_rank" value="正面" />
                  正面 </td>
                <td><input type="radio" name="kp_rank" id="kp_rank" value="一般" />
                  一般 </td>
                <td><input type="radio" name="kp_rank" id="kp_rank" value="負面" />
                  負面 </td>
                <td><input type="radio" name="kp_rank" id="kp_rank" value="惡意攻擊" />
                  惡意攻擊</td>
              </tr>
            </table>
            <br/>
            <br/>
<script type="text/javascript">
$("input:radio").val(["<{$kp_rows.kp_status}>", "<{$kp_rows.kp_cate}>", "<{$kp_rows.kp_rank}>"]);
</script>
	<{/foreach}>		
            <input type="submit" name="button2" class="button60" value="變更文章" title=""/>
          <a href="#" onClick="showCalDialog('<{$cancel_edit_url}>');">取消變更</a> </div>
        </form>
		</div>
  </div>