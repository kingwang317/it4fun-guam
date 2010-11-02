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
		$("#calText").text("確定取消新增分類?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
		$("#addForm").validate();
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
	<form name="addForm" id="addForm" method="POST" action="<{$do_add_category_url}>" >
      <p class="notes">(*為必填)</p>
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr>
				<th scope="row" class="column1">屬於</th>
				<td>
					<select name="cate_id">
					<option value="-1">--請選擇--</option>
					<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
						<option value="<{$sel_rows.cate_id}>"<{if $parent_id==$sel_rows.cate_id}>selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">*分類名稱</th>
				<td>
				<input type="text" name="name" value="<{$cate_name}>" class="required" /> 
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">分類描述</th>	
				<td>
				<textarea name="description" rows="" cols=""><{$cate_content}></textarea>
				</td>
              </tr>	
            </tbody>
        </table>
	  </p>
	  <p class="second">      
	    <input type="submit" name="button" class="button100" value="<{if $cate_name != ""}>儲存變更<{else}>新增分類<{/if}>" title=""/>
	    <input type="button" name="button2" class="button80grey" value="<{if $cate_name != ""}>取消變更<{else}>取消新增<{/if}>" onClick="showCalDialog('<{$cancel_add_url}>')" />
	  </p>
	</form>
  </div>