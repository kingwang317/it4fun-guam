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
          <h5><{$func_Cname}></h5>
              <input type="button"name="button"class="button100" value="身分列表" onClick="aHover('<{$show_pri_list_url}>')" title=""/>
			  <input type="button"name="button"class="button100" value="新增身份" onClick="aHover('<{$show_add_pri_url}>')" title=""/>
         <div class="page-bread top-next">
         <p>
         共<{$count}>筆
         </p>
        </div>
<table summary="services">
	<caption>商品服務列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">使用者帳號</th>
		<th scope="col">使用者名稱</th>	
		<th scope="col">使用者身分</th>	
		<th scope="col">操作</th>
	</tr>	
	</thead>
	<tbody>
<{foreach from="$site_data" item="rows" name="site_data"}>
<tr>
	<td class="column1"><{$rows.count}></td>
	<td class="column1"><{$rows.user_id}></td>
	<td class="column1"><{$rows.user_nickname}></td>
	<td class="column1">
	<select name="sel_<{$rows.user_id}>">
	<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
	<{$rows.user_pri}>
	<{if $rows.user_pri == $sel_rows.pri_id}>
	<option value="<{$sel_rows.pri_id}>" selected="selected" ><{$sel_rows.pri_name}></option>
	<{else}>
	<option value="<{$sel_rows.pri_id}>"><{$sel_rows.pri_name}></option>
	<{/if}>
	<{/foreach}>
	</select>
	</td>
	<td>		  
		<input type="submit"name="button"class="button60" value="變更"title="" onClick="aHover('<{$rows.show_edit_pri_link}>')" />	       
	</td>
</tr>
<{/foreach}>
	</tbody>
</table>
        <div class="page-bread bottom-next">
         <p>
         共<{$count}>筆
         </p>
        </div>
  </div>