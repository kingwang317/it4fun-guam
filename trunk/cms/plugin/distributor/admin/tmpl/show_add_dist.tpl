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
		$("#calText").text("確定取消新增據點?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#addForm").validate();
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_add_dist_url}>" enctype="multipart/form-data">
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr class="odd">
				<th scope="row" class="column1">* 據點名稱</th>
				<td>
				<input type="field" name="dist_name" value="" class="required" /> 
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">據點網址</th>
				<td>
				<input type="text" name="dist_url" value="" /> 
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">* 據點電話</th>
				<td>
				<input type="field" name="dist_phone" value="" class="required" /> 
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">* 據點地址</th>
				<td>
				<input type="text" name="dist_address" value="" class="required" /> 
				</td>
              </tr>				  
              <tr class="odd">
				<th scope="row" class="column1">上傳圖片</th>
				<td>
				<input type="file" name="pic" value="" /> 
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">圖片說明</th>	
				<td>
				<input type="field" name="pic_desc" value="" /> 
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1">服務地區</th>
                <td>
					<select name="place_id">
					<option value="0">--請選擇--</option>
					<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
						<option value="<{$sel_rows.place_id}>"><{$sel_rows.place_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>			
            </tbody>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="新增消息" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消新增" onClick="showCalDialog('<{$cancel_add_url}>')" />
	</p>
  </div>