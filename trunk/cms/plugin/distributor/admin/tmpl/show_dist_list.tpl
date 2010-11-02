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
          <h5>【服務據點管理】</h5>
              <input type="button" name="button" class="button100" value="新增據點" onClick="aHover('<{$show_add_dist_link}>')" title=""/>
		 <form name="frm" id="frm" method="POST" action="">
		 <div class="page-bread">
			<span class="top-next" style="float:left;width:60%">
			服務地區：
			<select name="place_id">
			<option value="">--請選擇--</option>
			<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
			<option value="<{$sel_rows.place_id}>" <{if $place_id == $sel_rows.place_id}>selected="selected"<{/if}>><{$sel_rows.place_name}></option>
			<{/foreach}>
			</select>
			<input type="submit" name="button" class="button100" value="確定">
			<input type="button" name="button" class="button100" value="新增地區" onClick="aHover('<{$show_add_dist_place}>')" title=""/>
			</span>
			<span class="top-next" style="float:left;width:40%">
			<{if $news_orderby_cond != "ASC"}>
				排序：日期新到舊&nbsp;|&nbsp;<a href="<{$dist_orderby_url}>">日期舊到新<a/>
			<{else}>
				排序：<a href="<{$dist_orderby_url}>">日期新到舊<a/>&nbsp;|&nbsp;日期舊到新
			<{/if}>
			</span>
		</div>
		 <div class="page-bread top-next">
		 共<{$count}>筆： <{$pager}>
		</div>
		</form>
<table summary="services">
	<caption>服務據點列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">圖片(LOGO)</th>
		<th scope="col">經銷商名稱</th>	
		<th scope="col">聯絡方式</th>
		<th scope="col">變更</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$dist_data" item="rows" name="dist_data"}>
	<tr>
		<td class="column1"><{$smarty.foreach.dist_data.index+1}></td>
		<td class="column1"><{if $rows.img_name != ""}><img src="<{$img_path}><{$rows.img_name}>" width="90" height="60" /><{/if}></td>
		<td class="column1"><{$rows.dist_name}></td>
		<td class="column1"><{$rows.dist_address}> 聯絡電話：<{$rows.dist_phone}></td>
		<td>		  
			<input type="button" name="button" class="button60" value="變更" title="" onClick="aHover('<{$show_edit_dist_link}><{$rows.dist_id}>')" />	       
		</td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_dist_link}><{$rows.dist_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="6" align="center" class="column1">目前無任何消息</td>
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