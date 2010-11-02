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
		$("#calText").text("確定取消變更消息?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_reply_contact_url}>" enctype="multipart/form-data">
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
			<{foreach from="$contact_data" item="row" name="contact_data"}>
			  <tr>
				<th scope="row" class="column1">標題</th>
				<td><{$row.con_title}></td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">日期</th>
				<td><{$row.con_time}></td>
              </tr>	
              <tr>
				<th scope="row" class="column1">問題分類</th>
				<td>
				<{$row.cate_name}>
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">姓名</th>
				<td>
				<{$row.con_name}>
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">電話</th>
				<td>
				<{$row.con_phone}>
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">Email</th>
				<td>
				<{$row.con_email}>
				</td>
              </tr>			
              <tr>
                <th scope="row" class="column1">問題描述</th>
                <td>
                <textarea disabled="disabled" name="con_content"><{$row.con_content}></textarea>
				</td>
              </tr>
              <tr>
                <th scope="row" class="column1">回覆</th>
                <td>
                <textarea disabled="disabled" name="con_content"><{$row.con_reply}></textarea>
				</td>
              </tr>	
<{/foreach}>			  
            </tbody>
        </table>
	<p class="second">      
	<input type="button" name="button" class="button100" value="返回" title="" onClick="aHover('<{$cancel_add_url}>')" />
	</p>
	</form>
  </div>