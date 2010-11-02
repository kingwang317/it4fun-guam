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
          <h5>【文件下載管理】</h5>
		 <div>
             <input type="button" name="button" class="button100" value="上傳文件" onClick="aHover('<{$show_add_doc_link}>')" title=""/><br />
		 </div>
		 <form name="frm" id="frm" method="POST" action="<{$show_doc_list_url}>">
		 <div class="page-bread">
			文件分類：
			<select name="cate_id">
			<option value="">--請選擇--</option>
			<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
			<option value="<{$sel_rows.cate_id}>" <{if $cate_id == $sel_rows.cate_id}>selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
			<{/foreach}>
			</select>
			<input type="submit" name="button" class="button100" value="確定">
			<input type="button" name="button" class="button100" value="新增分類" onClick="aHover('<{$show_add_cate_url}>')" title=""/>
		</div>
		 <div class="page-bread top-next">
		 共<{$count}>筆： <{$pager}>
		</div>
		</form>
<table summary="services">
	<caption>文件列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">文件標題</th>
		<th scope="col">文件名稱</th>	
		<th scope="col">日期</th>
		<th scope="col">變更</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$doc_data" item="rows" name="doc_data"}>
	<tr>
		<td class="column1"><{$smarty.foreach.doc_data.index+1}></td>
		<td class="column1"><{$rows.caption}></td>
		<td class="column1"><{$rows.name}></td>
		<td class="column1"><{$rows.PublishDate}></td>
		<td>		  
			<input type="button" name="button" class="button60" value="變更" title="" onClick="aHover('<{$show_edit_doc_link}><{$rows.doc_id}>')" />	       
		</td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_doc_link}><{$rows.doc_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="6" align="center" class="column1">目前無任何文件</td>
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