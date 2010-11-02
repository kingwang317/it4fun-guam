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
		$("#calText").text("確定取消新增消息?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_add_category_url}>" >
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr>
				<th scope="row" class="column1">*分類名稱</th>
				<td>
				<input type="field" name="name" value="" /> 
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1">分類描述</th>	
				<td>
				<input type="field" name="description" value="" /> 
				</td>
              </tr>	
            </tbody>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="新增分類" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消新增" onClick="showCalDialog('<{$cancel_add_url}>')" />
	</p>
  </div>