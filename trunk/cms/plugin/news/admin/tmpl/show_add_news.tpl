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
		$("#calText").text("確定取消新增消息?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		var d = new Date();
		var x = document.getElementById("addForm");
		var month = ('0'+(d.getMonth()+1).toString());
		if(month.length>2)
			month = month.substr(month.length-2,2);
		var day = ('0'+d.getDate().toString());
		if(day.length>2)
			day = day.substr(day.length-2,2);
		x.publish_date.value = d.getFullYear().toString() + '-' + month + '-' + day;
		$("#datepicker").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#addForm").validate();
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_add_news_url}>" enctype="multipart/form-data">
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 預計公佈時間</th>
				<td>
				<input type="field" name="publish_date" value="" id="datepicker" maxlength="10" class="required" /> 
				&nbsp;&nbsp;時間：<SELECT name="publish_hour" class="required">
					<OPTION value="" selected>--請選擇--</OPTION>
					<{section name=i start=0 loop=24 step=1}>
						<OPTION value="<{$smarty.section.i.index}>"<{if $smarty.section.i.index ==0}> selected<{/if}>><{$smarty.section.i.index|string_format:"%02s"}></OPTION>
					<{/section}>
				</SELECT>&nbsp;&nbsp;時&nbsp;&nbsp;
				<SELECT name="publish_minutes" class="required">
					<OPTION value="" selected>--請選擇--</OPTION>				
					<{section name=i start=0 loop=60 step=10}>
						<OPTION value="<{$smarty.section.i.index}>"<{if $smarty.section.i.index ==0}> selected<{/if}>><{$smarty.section.i.index|string_format:"%02s"}></OPTION>
					<{/section}>
				</SELECT>&nbsp;&nbsp;分
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 標題</th>
				<td>
				<input type="text" name="caption" value="" class="required" /> 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 內文</th>
				<td>
				<{$content_editor}>
				<!--<input type="text" name="content" value="" class="required" />-->
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
				<input type="text" name="pic_desc" value="" /> 
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">上傳影音</th>
				<td>
				<input type="file" name="movie" value="" /> 
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">影音說明</th>	
				<td>
				<input type="text" name="movie_desc" value="" /> 
				</td>
              </tr>
              <tr class="odd">
                <th scope="row" class="column1">消息分類</th>
                <td>
					<select name="cate_id">
					<option value="0">--請選擇--</option>
					<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
						<option value="<{$sel_rows.cate_id}>"><{$sel_rows.cate_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>		
<{ if $meta_field == true}>			  
              <tr>
                <th scope="row" class="column1"> meta_title</th>	
				<td>
				<textarea name="meta_title" cols="" rows=""></textarea>
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1"> meta_keyword</th>
                <td>
                <textarea name="meta_keyword" cols="" rows=""></textarea>
				</td>
              </tr>		
              <tr>
                <th scope="row" class="column1"> meta_desc</th>
                <td>
                <textarea name="meta_desc" cols="" rows=""></textarea>
				</td>
              </tr>		
<{/if}>			  
            </tbody>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="新增消息" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消新增" onClick="showCalDialog('<{$cancel_add_url}>')" />
	</p>
  </div>