<script type="text/javascript" src="<{$validate_url}>"></script>
<script type="text/javascript" src="<{$multiFile_url}>"></script>
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
	function calHover(){
		$('#calDialog').dialog("close");
		location.href = $("#calUrl").text();
	}
	function calAdd(){
		$('#calDialog').dialog("close");
	}
	function showCalDialog(url) {
		$("#calDialog").dialog("open");
		$("#calUrl").text(url);
	}

	//document on ready.
	$(document).ready(function(){
		$("#calText").text("確定取消變更消息?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#datepicker").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#addForm").validate();
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_edit_orders_url}>">
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 付款狀態</th>
				<td>
				<input type="radio" name="payment_status" value="1" class="required:true"<{ if $payment_status==1}>checked<{/if}> />已付款 
				&nbsp;&nbsp;
				<input type="radio" name="payment_status" value="0" class="required"<{ if $payment_status==0}>checked<{/if}> />未付款 
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 入帳狀態</th>
				<td>
				<input type="radio" name="recorded_status" value="1" class="required:true"<{ if $recorded_status==1}>checked<{/if}> />已入帳 
				&nbsp;&nbsp;
				<input type="radio" name="recorded_status" value="0" class="required"<{ if $recorded_status==0}>checked<{/if}> />未入帳 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 出貨狀態</th>
				<td>
				<input type="radio" name="delivery_status" id="deliveried" value="1" class="required:true"<{ if $delivery_status==1}>checked<{/if}> />已付款，日期
				<input type="field" name="delivery_date" value="<{$delivery_date}>" id="datepicker" maxlength="10" class="{required:'input[@name=deliveried]:checked',date:true}" />
				&nbsp;&nbsp;
				<input type="radio" name="delivery_status" value="0" class="required"<{ if $delivery_status==0}>checked<{/if}> />未付款 
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">附註</th>
				<td>
					<input type="textarea" name="memo" value="<{$memo}>" />
				</td>
              </tr>	
            </tbody>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="變更商品" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消變更" onClick="showCalDialog('<{$cancel_edit_url}>')" />
	</p><br />
  <div>
	訂單資料：
        <table summary="services">
            <tbody>
              <tr>
				<th scope="row" class="column1">訂單編號</th>
				<td><{$order_number}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">付款方式</th>
				<td><{$payment_type}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">運送方式</th>
				<td><{$delivery_type}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">生日</th>
				<td><{$birth}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">商品小計</th>
				<td><{$subtotal}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">運費</th>
				<td><{$delivery_fees}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">手續費</th>
				<td><{$commission}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">總價</th>
				<td><{$total_amount}></td>
              </tr>	
            </tbody>
        </table>
	</div><br />
  <div>
	訂購人資料：
        <table summary="services">
            <tbody>
              <tr>
				<th scope="row" class="column1">姓名</th>
				<td><{$order_name}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">帳號</th>
				<td><{$account}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">電話</th>
				<td><{$order_tel}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">手機</th>
				<td><{$order_cellphone}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">Email</th>
				<td><{$order_mail}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">地址</th>
				<td><{$order_addr}></td>
              </tr>	
            </tbody>
        </table>
	</div><br />
  <div>
	收件人資料：
        <table summary="services">
            <tbody>
              <tr>
				<th scope="row" class="column1">姓名</th>
				<td><{$receiver_name}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">電話</th>
				<td><{$receiver_tel}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">手機</th>
				<td><{$receiver_cellphone}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">Email</th>
				<td><{$receiver_mail}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">地址</th>
				<td><{$receiver_addr}></td>
              </tr>	
            </tbody>
        </table>
	</div><br />
  <div>
	商品清單：
        <table summary="services">
	<thead>
	<tr class="odd">
		<th scope="col">商品名稱</th>
		<th scope="col">數量</th>
		<th scope="col">單價</th>	
		<th scope="col">商品小計</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$orders_data" item="rows" name="orders_data"}>
	<tr>
		<td class="column1"><{$rows.prod_name}></td>
		<td class="column1"><{$rows.qty}></td>
		<td class="column1"><{$rows.unit_price}></td>
		<td class="column1"><{$rows.qty*$rows.unit_price}></td>
	</tr>
	<{/foreach}>
	</tbody>
        </table>
	</div>
  </div>
