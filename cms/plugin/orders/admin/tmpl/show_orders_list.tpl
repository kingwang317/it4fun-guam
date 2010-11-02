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
<div id="delDialog"><span id="delText"></span><hr/><div id="delBtn"><input type="button" class="button60" value="確定" onClick='delHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calDel()' />我反悔了</a></div><input type="hidden" id="delUrl" value=""></div>
<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
		<hr/>
		 <div>
          <h5>【訂單管理】</h5>
			<div style="margin-left:20px;">
			<form method="POST" action="<{$show_orders_list_url}>">
              搜尋&nbsp;<select name="search_item">
				<option value="0">訂單編號</option>
				<option value="1">訂購人姓名</option>
				<option value="2">收件人姓名</option>
				<option value="3">商品名稱</option>
				<option value="4">訂購人帳號</option>
			  </select>&nbsp;
			  <input type="field" name="search_txt" value="">&nbsp;
			  <input type="submit" name="searchbtn" class="button100" value="搜尋" />
			</form>
			</div><hr />
			<div style="margin-left:20px">
			<form name="frm" id="frm" method="POST" action="<{$show_orders_list_url}>&opt=1">
				狀態：<BR />
				出貨狀態：<select name="deliveryStatus">
				<option value="1">看全部</option>
				<option value="2">已出貨</option>
				<option value="3">未出貨</option>
				</select><input type="submit" name="button" class="button100" value="確定"><br />
			<form name="frm" id="frm" method="POST" action="<{$show_orders_list_url}>&opt=2">
				付款狀態：<select name="paymentStatus">
				<option value="1">看全部</option>
				<option value="2">已付款</option>
				<option value="3">未付款</option>
				</select><input type="submit" name="button" class="button100" value="確定"><br />
			<form name="frm" id="frm" method="POST" action="<{$show_orders_list_url}>&opt=3">
				入帳狀態：<select name="recordedStatus">
				<option value="1">看全部</option>
				<option value="2">已入帳</option>
				<option value="3">未入帳</option>
				</select><input type="submit" name="button" class="button100" value="確定"><br />
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
		<th scope="col">出貨狀態</th>
		<th scope="col">訂單編號</th>	
		<th scope="col">訂購人姓名</th>
		<th scope="col">訂購日期</th>
		<th scope="col">付款狀態</th>
		<th scope="col">總價</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$orders_data" item="rows" name="orders_data"}>
	<tr>
		<td class="column1"><{$smarty.foreach.orders_data.index+1}></td>
		<td class="column1"><a href="<{$show_edit_orders_link}><{$rows.order_id}>"><{if $rows.delivery_status == 1}>已出貨<{else}>未出貨<{/if}></a></td>
		<td class="column1"><a href="<{$show_edit_orders_link}><{$rows.order_id}>"><{$rows.order_number}></a></td>
		<td class="column1"><{$rows.order_name}></td>
		<td class="column1"><{$rows.order_date}></td>
		<td class="column1"><{if $rows.payment_status == 1}>已付款<{else}>未付款<{/if}></td>
		<td class="column1"><{$rows.total_amount}></td>
		<td>
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_order_link}><{$rows.order_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="8" align="center" class="column1">目前無任何訂單</td>
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