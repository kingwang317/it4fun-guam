<script type="text/javascript" src="<{$jquery_dnd_url}>"></script>
<script type="text/javascript">
	function showSecCate(){
		var x=document.getElementById("cate_id");
		var subset = document.getElementById("second_cate_id");
		var id = x.options[x.selectedIndex].value;
		for (i=subset.length-1;i>0;i--) {
			subset.remove(i);
		}
		<{$second_cate}>
		for(i = 0 ; i < a.length ; i++){
			subset.add(a[i],null);
		}
	}
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
	function chkHover(){
		$('#checkDialog').dialog("close");
		var order = $('#admin_table').tableDnDSerialize(); 
		$.post("<{$do_change_category_order_url}>", order, function(theResponse){
			$("#response").html('排序變更完畢');
			$("#response").slideDown('slow');
			slideout();
		}); 
	}
	function calCheck(){
		$('#checkDialog').dialog("close");
	}
	function slideout(){
		setTimeout(function(){
		$("#response").slideUp("slow", function () {
		});
	}, 2000);}
	
	//document on ready.
	$(document).ready(function(){
		$("#delText").text("確定刪除?(按確定後無法復原)");
		$("#delDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#checkText").text("確定變動順序嗎？(按確定後無法復原)");
		$("#checkDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#table-2 tr:even').addClass('odd')");

		$('#admin_table').tableDnD({
			onDrop: function(table, row) {
				$("#checkDialog").dialog("open");
			}
		});
	}); 
</script>
<div id="delDialog"><span id="delText"></span><hr/><div id="delBtn"><input type="button" class="button60" value="確定" onClick='delHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calDel()' />我反悔了</a></div><input type="hidden" id="delUrl" value=""></div>
<div id="checkDialog"><span id="checkText"></span><hr/><div id="chkBtn"><input type="button" class="button60" value="確定" onClick='chkHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calCheck()' />取消</a></div><input type="hidden" id="delUrl" value=""></div>
<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
		<hr/>
		 <div>
          <h5>【商品/服務管理】</h5>
			<div style="margin-left:20px;">
			<form method="POST" action="<{$search_item_url}>">
              搜尋&nbsp;<select name="search_item">
				<option value="0">分類名稱</option>
				<option value="1">編號</option>
				<option value="2">商品/服務名稱</option>
			  </select>&nbsp;
			  <input type="text" name="search_txt" value="">&nbsp;
			  <input type="submit" name="searchbtn" class="button100" value="搜尋" />
			</form>
			</div>
			<div style="margin-left:20px">
				<input type="button" name="button" class="button100" value="新增分類" onClick="aHover('<{$show_add_product_category}>')" title=""/>
			</div>
		</div>
<div id="response"></div>
<table summary="services" id="admin_table">
	<thead>
	<tr class='nodrop nodrag'>
		<th scope="col">序號</th>
		<th scope="col"><{ if $show_product == false}>第1層分類<{else}>第2層分類<{/if}></th>
		<th scope="col">變更</th>
		<th scope="col">刪除</th>
		<th scope="col"><{ if $show_product == false}>第2層分類<{else}>商品列表<{/if}></th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$category_data" item="rows" name="category_data"}>
	<tr id="<{$rows.cate_id}>">
		<td class="column1"><{$smarty.foreach.category_data.index+1}></td>
		<td class="column1"><{$rows.cate_name}></td>
		<td>		  
			<input type="button" name="button" class="button60" value="變更" title="" onClick="aHover('<{$show_edit_category_link}><{$rows.cate_id}>')" />	       
		</td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_category_link}><{$rows.cate_id}>')" />		
		</td>
		<td>
		  <input type="button" name="button" class="button60" value="<{ if $show_product == false}>第2層分類<{else}>商品列表<{/if}>" title="" onClick="aHover('<{$show_subcate_link}><{$rows.cate_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="5" align="center" class="column1">目前無任何產品分類</td>
	</tr>
	<{/foreach}>
	</tbody>
</table>
</div>