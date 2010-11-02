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
		$("#calText").text("確定取消變更產品?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#datepicker").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#addForm").validate();
		$("#pic").MultiFile({
			max: 5,
			accept: 'gif|jpg|png|bmp|swf'
		});
		<{if $sec_cate_id == NULL}>showSecCate();<{/if}>
	});
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes">(*為必填)</p>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_edit_product_url}>" enctype="multipart/form-data">
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
				<th scope="row" class="column1">* 第1層分類</th>
				<td>
					<select name="cate_id" id="cate_id" onChange="showSecCate()" class="required">
					<option value="">--請選擇--</option>
					<{foreach from="$sel_data" item="sel_rows" name="sel_data"}>
						<option value="<{$sel_rows.cate_id}>"<{if $cate_id == $sel_rows.cate_id}> selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1"> 第2層分類</th>
				<td>
					<select name="second_cate_id" id="second_cate_id">
					<option value="-1">--請選擇--</option>
					<{foreach from="$sec_sel_data" item="sel_rows" name="sel_data"}>
						<option value="<{$sel_rows.cate_id}>"<{if $sec_cate_id == $sel_rows.cate_id}> selected="selected"<{/if}>><{$sel_rows.cate_name}></option>
					<{/foreach}>
					</select>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 商品名稱</th>
				<td>
					<input type="text" name="name" value="<{$name}>" class="required" />
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1"> 商品編號</th>
				<td>
					<input type="text" name="prod_number" value="<{$prod_number}>" />
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 商品內容</th>
				<td>
				<{$content_editor}>
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">上傳圖片</th>
				<td>
				<{ if $img_name != "" }>
					<{foreach from="$img_name" item="img" name="sel_data"}>
						<img src="<{$img_path}><{$img}>" width="120" height="80" />
					<{/foreach}>
				<{/if}>
				<input type="file" name="pic[]" id="pic" value="" /> 
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1">圖片說明</th>	
				<td>
				<input type="text" name="pic_desc" value="<{$img_desc}>" /> 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">顯示狀態</th>
				<td>
				<input type="radio" name="display" value="1"<{ if $display == true }> checked<{/if}> />顯示&nbsp;
				<input type="radio" name="display" value="0"<{ if $display == false }> checked<{/if}> />隱藏
				</td>
              </tr>	
              <tr class="odd">
                <th scope="row" class="column1">促銷中?</th>	
				<td>
				<input type="radio" name="promotion" value="0"<{ if $promotion == false }> checked <{/if}> />無&nbsp;
				<input type="radio" name="promotion" value="1"<{ if $promotion == true }> checked <{/if}> />有
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">商品價格</th>
				<td>
					<input type="text" name="price" value="<{$price}>" />
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">促銷價格</th>
				<td>
					<input type="text" name="prom_price" value="<{$prom_price}>" />
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
	<input type="submit" name="button" class="button100" value="變更商品" title=""/>
	<input type="button" name="button2" class="button80grey" value="取消變更" onClick="showCalDialog('<{$cancel_edit_url}>')" />
	</p>
  </div>
