<script type="text/javascript" src="<{$validate_url}>"></script>
<script type="text/javascript">
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
		$("#calText").text("確定取消新增會員?(按確定後無法復原)");
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
	  <form name="addForm" id="addForm" method="POST" action="<{$do_add_member_url}>">
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 帳號</th>
				<td>
					<input type="field" name="account" value="" maxlength="20" class="required" /> 
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 姓名</th>
				<td>
				<input type="field" name="name" value="" maxlength="20" class="required" /> 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 密碼</th>
				<td>
					<input type="password" name="password" id="password" value="" maxlength="20" class="required password" /> 
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 確認密碼</th>
				<td>
				<input type="password" name="confirmPwd" id="password_again" value="" maxlength="20" class="required" equalTo="#password" /> 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 性別</th>
				<td>
				<input type="radio" name="sex" value="女" checked="checked" />女
				<input type="radio" name="sex" value="男" />男
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">生日</th>
				<td>
				<input type="field" name="birth" id="datepicker" value="" /> 
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">電話</th>	
				<td>
				<input type="field" name="tel" value="" maxlength="15" /> 
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1">手機</th>	
				<td>
				<input type="field" name="cellphone" value="" maxlength="15" /> 
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">* E-Mail</th>	
				<td>
				<input type="text" name="email" value=""  class="required email" /> 
				</td>
              </tr>
              <tr class="odd">
                <th scope="row" class="column1">地址</th>
                <td>
				<input type="text" name="addr" value="" /> 
				</td>
              </tr>		
              <tr>
                <th scope="row" class="column1">會員分類</th>	
				<td>
					<select name="gid">
					<option value="-1">--請選擇--</option>
					<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
					<option value="<{$sel_rows.group_id}>" <{if $cate_id == $sel_rows.group_id}>selected="selected"<{/if}>><{$sel_rows.group_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>	
            </tbody>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="新增會員" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消新增" onClick="showCalDialog('<{$cancel_add_url}>')" />
	</p>
  </div>