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
	//document on ready.
	$(document).ready(function(){
		$("#delText").text("確定刪除?(按確定後無法復原)");
		$("#delDialog").dialog({
			autoOpen: false,
			modal:true
		});
	}); 
</script>
<div id="delDialog"><span id="delText"></span><hr/><div id="delBtn"><input type="button" class="button60" value="確定" onClick='delHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calDel()' >我反悔了</a></div><input type="hidden" id="delUrl" value=""></div>
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
			<hr />
			<div style="margin-left:20px">
			<form name="frm" id="frm" method="POST" action="<{$show_product_list_url}>">
				分類：<br />
				第1層：<select name="cate_id" id="cate_id" onChange="showSecCate()">
				<option value="">--請選擇--</option>
				<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
				<option value="<{$sel_rows.cate_id}>" <{if $cate_id == $sel_rows.cate_id}>selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
				<{/foreach}>
				</select>&nbsp;&nbsp;
				<input type="submit" name="button" class="button100" value="確定"><br />
				第2層：<select name="second_cate_id" id="second_cate_id">
					<option value="-1">--請選擇--</option>
					<{foreach from="$sec_sel_data" item="sel_rows" name="sel_data"}>
						<option value="<{$sel_rows.cate_id}>"<{if $sec_cate_id == $sel_rows.cate_id}> selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
					<{/foreach}>
				</select>&nbsp;&nbsp;
				<input type="submit" name="button" class="button100" value="確定"><br />
				<input type="button" name="button" class="button100" value="新增商品" onClick="aHover('<{$show_add_product_link}>')" title=""/>
				<input type="button" name="button" class="button100" value="新增分類" onClick="aHover('<{$show_add_product_category}>')" title=""/>
			</form>
			</div>
		</div>
		 <div class="page-bread top-next">
		 共<{$count}>筆： <{$pager}>
		</div>
<table summary="services">
	<caption>最新產品列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">編號</th>
		<th scope="col">商品/服務</th>	
		<th scope="col">圖片</th>
		<th scope="col">商品服務內容</th>
		<th scope="col">變更</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$product_data" item="rows" name="product_data"}>
	<tr>
		<td class="column1"><{$smarty.foreach.product_data.index+1}></td>
		<td class="column1"><{$rows.prod_number}></td>
		<td class="column1"><{$rows.name}></td>
		<td class="column1"><{if $rows.img_name != ""}><img src="<{$img_path}><{$rows.img_name}>" width="90" height="60" /><{/if}></td>
		<td class="column1"><{$rows.content|truncate:30}></td>
		<td>		  
			<input type="button" name="button" class="button60" value="變更" title="" onClick="aHover('<{$show_edit_product_link}><{$rows.prod_id}>')" />	       
		</td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_product_link}><{$rows.prod_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="7" align="center" class="column1">目前無任何產品</td>
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