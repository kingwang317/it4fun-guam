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
        <h4><{$func_Cname}></h4>
		<hr/>
          <h5>【聯絡表單管理】</h5>
		  <br />
		 <form name="frm" id="frm" method="POST" action="">
		 <div class="page-bread">
			<span class="top-next" style="float:left;width:60%">
			表單分類：
			<select name="cid">
			<option value="">--請選擇--</option>
			<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
			<option value="<{$sel_rows.Ccate_id}>" 
			<{if $cate_id == $sel_rows.Ccate_id}>
			selected="selected"
			<{/if}>
			><{$sel_rows.Ccate_name}></option>
			<{/foreach}>
			</select>
			<input type="submit" name="button" class="button100" value="確定">
			<input type="button" name="button" class="button100" value="新增分類" onClick="aHover('<{$show_add_contact_category}>')" title=""/>
			</span>
			<span class="top-next" style="float:left;width:40%">
			<{if $contact_orderby_cond != "ASC"}>
				排序：日期新到舊&nbsp;|&nbsp;<a href="<{$contact_orderby_url}>">日期舊到新<a/>
			<{else}>
				排序：<a href="<{$contact_orderby_url}>">日期新到舊<a/>&nbsp;|&nbsp;日期舊到新
			<{/if}>
			</span>
		</div>
		 <div class="page-bread top-next">
		 共<{$count}>筆： <{$pager}>
		</div>
		</form>
<table summary="services">
	<caption>聯絡表單列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">狀態</th>
		<th scope="col">標題</th>
		<th scope="col">姓名</th>	
		<th scope="col">電話</th>
		<th scope="col">日期</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$contact_data" item="rows" name="contact_data"}>
	<tr>
		<td class="column1"><{$smarty.foreach.contact_data.index+1}></td>
		<td class="column1">
			<{if $rows.con_reply == ""}>
				<a href="<{$show_reply_contact_link}><{$rows.con_id}>">未回覆</a>
			<{else}>
				已回覆
			<{/if}>
		</td>
		
		<{if $rows.con_reply == ""}>
			<td class="column1"><{$rows.con_title}></td>
		<{else}>
			<td class="column1"><a href="<{$show_contact_detail_link}><{$rows.con_id}>"><{$rows.con_title}></a></td>
		<{/if}>
		<td class="column1"><{$rows.con_name}></td>
		<td class="column1"><{$rows.con_phone}></td>
		<td class="column1"><{$rows.con_time}></td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_contact_link}><{$rows.con_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="7" align="center" class="column1">目前無任何消息</td>
	</tr>
	<{/foreach}>
	</tbody>
</table>
        <div class="page-bread bottom-next">
         <p>
         共<{$count}>筆： <{$pager}>
         </p>
        </div>
  </div>