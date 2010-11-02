<link href="<{$css_path}>control.css" rel="stylesheet" type="text/css" />
<link href="<{$jq_multi_select_path}>ui/jquery.multiselect.css" rel="stylesheet" type="text/css" />
<script src="<{$jq_multi_select_path}>jquery.multiselect.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function aHover(url){
		location.href = url;
	}
	function delHover(){
		$('#delDialog').dialog("close");
		location.href = $("#delUrl").text();
	}
	function calDel(){
		$('#delDialog').dialog("close");
	}
	function showDelDialog(url) {
		$("#delDialog").dialog("open");
		$("#delUrl").text(url);
	}
	//document on ready.
	$(document).ready(function(){
		$("#MySelectBox").multiSelect({
			state: open,
			shadow:true
		});
		$("#delText").text("確定刪除?(按確定後無法復原)");
		$("#delDialog").dialog({
			autoOpen: false,
			modal:true
		});
	}); 
</script>
<div id="delDialog"><span id="delText"></span><hr/><div id="delBtn"><input type="button" class="button60" value="確定" onClick='delHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calDel()' />我反悔了</a></div><input type="hidden" id="delUrl" value=""></div>
  <div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}><input type="button"name="button"class="button60" value="新增文章" onClick="aHover('<{$show_add_kp_link}>')" title=""/></h4>
		
        <div id="sub_navi">
	        <label id="current_keyword">目前關鍵字</label>	
			<form action="<{$show_kp_list_link}>" method="POST" >
<select id="MySelectBox" multiple="multiple" name="kw_ids[]">
<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
<option value="<{$sel_rows.kw_id}>"><{$sel_rows.kw_content}></option>
<{/foreach}>
</select>
			<input type="submit" name="button" class="button360" value="確認" title=""/>
        </form>
		</div>
        <div id="sub_content">		
		<br clear="all"/>
		<p class="notes">關鍵字&nbsp;&nbsp;&nbsp;&nbsp;:<strong>
			<{foreach from="$kw_ids" item="id_rows" name="kw_ids"}>
				<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
					<{if $sel_rows.kw_id == $id_rows}>
						<{$sel_rows.kw_content}>,
					<{/if}>
				<{/foreach}>
			<{foreachelse}>
				全部顯示
			<{/foreach}>
		</strong></p><br/>
		
		<p class="notes">文章總數: <strong><{$count}></strong>篇文章</p>
		 <div id="top-next">共<{$count}>篇： <{$pager}></div><br/>
		<hr/>
		<table width="500px" >
	<{foreach from="$kp_data" item="rows" name="kp_data"}>
		  <tr height="100px">
			<td>
			<input type="button"name="button"class="button62grey" value="修改" onClick="aHover('<{$show_edit_kp_link}><{$rows.kp_id}>')" title=""/>
			<input type="button"name="button"class="button60grey" value="刪除" onClick="showDelDialog('<{$do_del_kp_link}><{$rows.kp_id}>')" title=""/>
			</td>
			<td>
			文章標題：<U><{$rows.kp_title}></U><br />
			發表日期： <{$rows.kp_post_time}>
			</td>
		  </tr>
	<{foreachelse}>
	<tr>
		<td colspan="6" align="center" class="column1">目前無任何消息</td>
	</tr>
	<{/foreach}>
		</table>

		<hr/>
		 <div id="bottom-next">共<{$count}>篇： <{$pager}></div>
		</div>
   
		</div>