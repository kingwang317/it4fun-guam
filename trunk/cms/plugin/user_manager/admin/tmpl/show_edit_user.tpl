<script type="text/javascript">
	function aHover(url){
		location.href = url;
	}
	function calHover(){
		$('#calDialog').dialog("close");
		location.href = $("#calUrl").text();
	}
	function calEdit(){
		$('#calDialog').dialog("close");
	}
	function showCalDialog(url) {
		$("#calDialog").dialog("open");
		$("#calUrl").text(url);
	}
	//document on ready.
	$(document).ready(function(){
		$("#calText").text("確定取消修改?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
	}); 	
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calEdit()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_edit_user_url}>" >
        <table summary="services">
            <caption><{$func_Cname}></caption>
			<{foreach from="$site_data" item="row" name="site_data"}>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 使用者帳號</th>
				<td>
				<input  type="field" name="user_id" readonly="true" value="<{$row.user_id}>" />      
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 使用者密碼</th>
				<td>
				<input  type="password" name="user_passwd" value="" /> 
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">使用者暱稱</th>	
				<td>
				<input  type="field" name="user_name" value="<{$row.user_nickname}>" /> 
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1">使用者e-mail</th>
                <td>
                <input  type="field" name="user_email" value="<{$row.user_email}>" /> 
				</td>
              </tr>		
            </tbody>
			<{/foreach}>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="修改使用者" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消修改" onClick="showCalDialog('<{$cancel_edit_url}>')" />
	</p>
  </div>