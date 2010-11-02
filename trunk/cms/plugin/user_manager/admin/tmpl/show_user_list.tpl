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
          <h5>【使用者管理】</h5>
              <input type="button"name="button"class="button100" value="新增使用者" onClick="aHover('<{$show_add_user_link}>')" title=""/>
         <div class="page-bread top-next">
         <p>
         共<{$count}>筆： <{$pager}>
         </p>
        </div>
<table summary="services">
	<caption>商品服務列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">帳號</th>
		<th scope="col">名稱</th>	
		<th scope="col">信箱</th>
		<th scope="col">操作</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
<{foreach from="$site_data" item="rows" name="site_data"}>
<tr>
	<td class="column1"><{$rows.count}></td>
	<td class="column1"><{$rows.user_id}></td>
	<td class="column1"><{$rows.user_nickname}></td>
	<td class="column1"><{$rows.user_email}></td>
	<td>		  
		<input type="button"name="button"class="button60" value="變更"title="" onClick="aHover('<{$rows.show_edit_user_link}>')" />	       
	</td>
	<td>
	  <input type="button"name="button"class="button60" value="刪除"title="" onClick="showDelDialog('<{$rows.do_del_user_link}>')" />		
	</td>
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