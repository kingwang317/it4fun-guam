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
          <h5>【最新消息管理】</h5>
              <input type="button" name="button" class="button100" value="新增消息" onClick="aHover('<{$show_add_news_link}>')" title=""/>
		 <form name="frm" id="frm" method="POST" action="<{$show_news_list}>">
		 <div class="page-bread">
			<span class="top-next" style="float:left;width:60%">
			消息分類：
			<select name="cid">
			<option value="">--請選擇--</option>
			<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
			<option value="<{$sel_rows.cate_id}>" <{if $cate_id == $sel_rows.cate_id}>selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
			<{/foreach}>
			</select>
			<input type="submit" name="button" class="button100" value="確定">
			<input type="button" name="button" class="button100" value="新增分類" onClick="aHover('<{$show_add_news_category}>')" title=""/>
			</span>
			<span class="top-next" style="float:left;width:40%">
			<{if $news_orderby_cond != "ASC"}>
				排序：日期新到舊&nbsp;|&nbsp;<a href="<{$news_orderby_url}>">日期舊到新<a/>
			<{else}>
				排序：<a href="<{$news_orderby_url}>">日期新到舊<a/>&nbsp;|&nbsp;日期舊到新
			<{/if}>
			</span>
		</div>
		 <div class="page-bread top-next">
		 共<{$count}>筆： <{$pager}>
		</div>
		</form>
<table summary="services">
	<caption>最新消息列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">標題</th>
		<th scope="col">圖片</th>	
		<th scope="col">日期</th>
		<th scope="col">變更</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$news_data" item="rows" name="news_data"}>
	<tr>
		<td class="column1"><{$smarty.foreach.news_data.index+1}></td>
		<td class="column1"><{$rows.caption}></td>
		<td class="column1"><{if $rows.img_name != ""}><img src="<{$img_path}><{$rows.img_name}>" width="90" height="60" /><{/if}></td>
		<td class="column1"><{$rows.ModiTime}></td>
		<td>		  
			<input type="button" name="button" class="button60" value="變更" title="" onClick="aHover('<{$show_edit_news_link}><{$rows.news_id}>')" />	       
		</td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_news_link}><{$rows.news_id}>')" />		
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