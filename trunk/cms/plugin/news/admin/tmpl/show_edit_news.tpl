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
	  <form name="addForm" id="addForm" method="POST" action="<{$do_edit_news_url}>" enctype="multipart/form-data">
        <table summary="services">
            <caption><{$func_Cname}></caption>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 預計公佈時間</th>
				<td>
				<input type="field" name="publish_date" value="<{$publish_date}>" id="datepicker" maxlength="10" class="required" /> 
				&nbsp;&nbsp;時間：<SELECT name="publish_hour" class="required">
					<OPTION value="">--請選擇--</OPTION>
					<{section name=i start=0 loop=24 step=1}>
						<OPTION value="<{$smarty.section.i.index}>" <{if $publish_hour == $smarty.section.i.index}> selected="selected"<{/if}>><{$smarty.section.i.index|string_format:"%02s"}></OPTION>
					<{/section}>
				</SELECT>&nbsp;&nbsp;時&nbsp;&nbsp;
				<SELECT name="publish_minutes" class="required">
					<OPTION value="">--請選擇--</OPTION>				
					<{section name=i start=0 loop=60 step=10}>
						<OPTION value="<{$smarty.section.i.index}>" <{if $publish_minutes == $smarty.section.i.index}> selected="selected"<{/if}>><{$smarty.section.i.index|string_format:"%02s"}></OPTION>
					<{/section}>
				</SELECT>&nbsp;&nbsp;分
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 標題</th>
				<td>
				<input type="text" name="caption" value="<{$caption}>" class="required" /> 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 內文</th>
				<td>
				<{$content_editor}>
				<!--<input type="text" name="content" value="<{$content}>" class="required" />-->
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">上傳圖片</th>
				<td>
				<{ if $img_name != "" }><img src="<{$img_name}>" height="80" width="120" /><{/if}>
				<input type="file" name="pic" value="" /> 
				</td>
              </tr>	
              <tr>
                <th scope="row" class="column1">圖片說明</th>	
				<td>
				<input type="text" name="pic_desc" value="<{$img_desc}>" /> 
				</td>
              </tr>
              <tr class="odd">
                <th scope="row" class="column1">新增圖片</th>	
				<td>
				<input type="submit" name="addPic" value="新增圖片" /> 
				</td>
              </tr> 
              <tr>
				<th scope="row" class="column1">上傳影音</th>
				<td>
				<{ if $movie_name != "" }><embed src="<{$movie_name}>" /><{/if}>
				<input type="file" name="movie" value="" /> 
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1">影音說明</th>	
				<td>
				<input type="text" name="movie_desc" value="<{$movie_desc}>" /> 
				</td>
              </tr>
              <tr>
                <th scope="row" class="column1">新增影音</th>	
				<td>
				<input type="submit" name="addMovie" value="新增影音" /> 
				</td>
              </tr> 
              <tr class="odd">
                <th scope="row" class="column1">消息分類</th>
                <td>
					<select name="cate_id">
					<option value="0">--請選擇--</option>
					<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
						<option value="<{$sel_rows.cate_id}>" <{if $cate_id == $sel_rows.cate_id}>selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>		
<{ if $meta_field == true}>			  
              <tr>
                <th scope="row" class="column1"> meta_title</th>	
				<td>
				<textarea name="meta_title" cols="" rows=""><{$meta_title}></textarea>
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1"> meta_keyword</th>
                <td>
                <textarea name="meta_keyword" cols="" rows=""><{$meta_keyword}></textarea>
				</td>
              </tr>		
              <tr>
                <th scope="row" class="column1">* meta_desc</th>
                <td>
                <textarea name="meta_desc" cols="" rows=""><{$meta_desc}></textarea>
				</td>
              </tr>		
<{/if}>			  
            </tbody>
        </table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="儲存變更" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消變更" onClick="showCalDialog('<{$cancel_edit_url}>')" />
	</p>
	</form>
  </div>