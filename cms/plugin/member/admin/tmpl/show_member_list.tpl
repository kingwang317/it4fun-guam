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
          <h5>【會員管理】</h5>
		 <div>
			<form name="frm" method="POST" action="<{$search_member_url}>">
				搜尋會員:&nbsp;<input type="field" name="search_item" value="" /><input type="submit" class="button100" value="搜尋"/>
			</form><hr />
              <input type="button" name="button" class="button100" value="新增會員" onClick="aHover('<{$show_add_member_link}>')" title=""/><br />
		 </div>
		 <form name="frm" id="frm" method="POST" action="<{$show_member_list}>">
		 <div class="page-bread">
			會員分類：
			<select name="gid">
			<option value="">--請選擇--</option>
			<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
			<option value="<{$sel_rows.group_id}>" <{if $cate_id == $sel_rows.group_id}>selected="selected"<{/if}>><{$sel_rows.group_name}></option>
			<{/foreach}>
			</select>
			<input type="submit" name="button" class="button100" value="確定">
			<input type="button" name="button" class="button100" value="新增分類" onClick="aHover('<{$show_add_group_url}>')" title=""/>
		</div>
		 <div class="page-bread top-next">
		 共<{$count}>筆： <{$pager}>
		</div>
		</form>
<table summary="services">
	<caption>會員列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">帳號</th>
		<th scope="col">姓名</th>	
		<th scope="col">生日</th>
		<th scope="col">上次[購買]日期</th>
		<th scope="col">變更</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$member_data" item="rows" name="member_data"}>
	<tr>
		<td class="column1"><{$smarty.foreach.member_data.index+1}></td>
		<td class="column1"><{$rows.account}></td>
		<td class="column1"><{$rows.name}></td>
		<td class="column1"><{$rows.birth}></td>
		<td class="column1"><{if $rows.lastorderdate != ""}><{$rows.lastorderdate}><{else}>無<{/if}></td>
		<td>		  
			<input type="button" name="button" class="button60" value="變更" title="" onClick="aHover('<{$show_edit_member_link}><{$rows.member_id}>')" />	       
		</td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_member_link}><{$rows.member_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="7" align="center" class="column1">目前無任何會員</td>
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