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
		$("#calText").text("確定取消新增文件?(按確定後無法復原)");
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
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_add_doc_url}>" enctype="multipart/form-data">
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 預計公佈日期</th>
				<td>
					<input type="field" name="PublishDate" value="" id="datepicker" class="required date" /> 
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 文件標題</th>
				<td>
				<input type="text" name="caption" value="" maxlength="100" class="required" /> 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 上傳文件</th>
				<td>
					<input type="file" name="uploadDoc" value="" class="required" /> 
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1"> 文件說明</th>
				<td>
				<textarea name="desc" cols="" rows=""></textarea>
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">文件分類</th>	
				<td>
					<select name="cid">
					<option value="-1">--請選擇--</option>
					<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
					<option value="<{$sel_rows.cate_id}>" <{if $cate_id == $sel_rows.cate_id}>selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>	
            </tbody>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="上傳文件" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消上傳" onClick="showCalDialog('<{$cancel_add_url}>')" />
	</p>
	</form>
  </div>