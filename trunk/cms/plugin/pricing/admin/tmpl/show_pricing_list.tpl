<script type="text/javascript" src="<{$validate_url}>"></script>
<script type="text/javascript" src="<{$datepicker_url}>"></script>
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

	function calculateAvg(){
		var auc_amount = document.getElementsByName("auction_amount_value[]");
		var avg = 0;
		for(i = 0 ; i < auc_amount.length; i++){
			if(auc_amount[i]!=undefined && auc_amount[i].value!=''){
				avg+=parseInt(auc_amount[i].value);
			}
		}
		var auc_avg = document.getElementsByName("auction_amount_avg[]");
		for(i = 0 ; i < auc_avg.length ; i++){
			if(avg!==undefined && !isNaN(avg)){
				auc_avg[i].value = avg/auc_amount.length;
			}else{
				auc_avg[i].value = 0;
			}
		}
	}
	//document on ready.
	$(document).ready(function(){
		$("#calText").text("確定取消變更消息?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		calculateAvg();
		$("*[ref=dp]").each(function(){
			$(this).datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd', });
		});
//		$("#addForm").validate();
	});
	
</script>
<div id="calDialog"><span id="calText"></span><hr/><div id="calBtn"><input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a></div><input type="hidden" id="calUrl" value=""></div>
	<div id="content">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}></h4>
      <p class="notes"></p>
	  <form name="addForm" id="addForm" method="POST" action="<{$show_pricing_list_url}>&opt=1">
  	    <h4>台北市法拍公寓大樓均價行情</h4>
		<select name="taipeicityOpt">
			<option value="1"<{if $taipeicity==1}> selected<{/if}>>全區</option>
			<option value="100"<{if $taipeicity==100}> selected<{/if}>>中正區</option>
			<option value="103"<{if $taipeicity==103}> selected<{/if}>>大同區</option>
			<option value="104"<{if $taipeicity==104}> selected<{/if}>>中山區</option>
			<option value="105"<{if $taipeicity==105}> selected<{/if}>>松山區</option>
			<option value="106"<{if $taipeicity==106}> selected<{/if}>>大安區</option>
			<option value="108"<{if $taipeicity==108}> selected<{/if}>>萬華區</option>
			<option value="110"<{if $taipeicity==110}> selected<{/if}>>信義區</option>
			<option value="111"<{if $taipeicity==111}> selected<{/if}>>士林區</option>
			<option value="112"<{if $taipeicity==112}> selected<{/if}>>北投區</option>
			<option value="114"<{if $taipeicity==114}> selected<{/if}>>內湖區</option>
			<option value="115"<{if $taipeicity==115}> selected<{/if}>>南港區</option>
			<option value="116"<{if $taipeicity==116}> selected<{/if}>>文山區</option>
		</select>&nbsp;<input type="submit" class="button100" value="確定" />
	</form>
	<form name="addForm" id="addForm" method="POST" action="<{$do_edit_pricing_url}>&opt=1">
		<input type="hidden" name="taipeicity" value="<{$taipeicity}>" />
        <table summary="services">
			<tr>
			<th scope="row" class="column1">&nbsp;</th>
			<{section name=bar loop=$orderMonth}>
			  <th scope="row" class="column1"><{if $orderMonth[bar] == $smarty.now|date_format:'%m'}>當月<{else}><{$orderMonth[bar]}><{/if}></th>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">大樓</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicity_building[]" value="<{$taipeicity_building[bar][1]}>" /></td>
			<{/section}>
			</tr>
			<tr>
			<th scope="row" class="column1">公寓</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicity_apartment[]" value="<{$taipeicity_apartment[bar][1]}>" /></td>
			<{/section}>
			</tr>
			<tr class="odd">
			<td align="center"><b>說明</b></td>
			<td align="center" colspan="12">
				<textarea name="taipeicity_desc" cols="" rows=""><{$taipeicity_desc}></textarea>
			</td>
			</tr>
			</table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="儲存台北市法拍公寓大樓均價行情" title=""/>
	</p><br /><br />
	</form>
<hr />
  <div>
	  <form name="addForm" id="addForm" method="POST" action="<{$show_pricing_list_url}>&opt=2">
  	    <h4>台北縣法拍公寓大樓均價行情</h4>
		<select name="taipeicountyOpt">
			<option value="3"<{if $taipeicounty==3}> selected<{/if}>>全區</option>
			<option value="207"<{if $taipeicounty==207}> selected<{/if}>>萬里鄉</option>
			<option value="208"<{if $taipeicounty==208}> selected<{/if}>>金山鄉</option>
			<option value="220"<{if $taipeicounty==220}> selected<{/if}>>板橋市</option>
			<option value="221"<{if $taipeicounty==221}> selected<{/if}>>汐止市</option>
			<option value="222"<{if $taipeicounty==222}> selected<{/if}>>深坑鄉</option>
			<option value="223"<{if $taipeicounty==223}> selected<{/if}>>石碇鄉</option>
			<option value="224"<{if $taipeicounty==224}> selected<{/if}>>瑞芳鎮</option>
			<option value="226"<{if $taipeicounty==226}> selected<{/if}>>平溪鄉</option>
			<option value="227"<{if $taipeicounty==227}> selected<{/if}>>雙溪鄉</option>
			<option value="228"<{if $taipeicounty==228}> selected<{/if}>>貢寮鄉</option>
			<option value="231"<{if $taipeicounty==231}> selected<{/if}>>新店市</option>
			<option value="232"<{if $taipeicounty==232}> selected<{/if}>>坪林鄉</option>
			<option value="233"<{if $taipeicounty==233}> selected<{/if}>>烏來鄉</option>
			<option value="234"<{if $taipeicounty==234}> selected<{/if}>>永和市</option>
			<option value="235"<{if $taipeicounty==235}> selected<{/if}>>中和市</option>
			<option value="236"<{if $taipeicounty==236}> selected<{/if}>>土城市</option>
			<option value="237"<{if $taipeicounty==237}> selected<{/if}>>三峽鎮</option>
			<option value="238"<{if $taipeicounty==238}> selected<{/if}>>樹林市</option>
			<option value="239"<{if $taipeicounty==239}> selected<{/if}>>鶯歌鎮</option>
			<option value="241"<{if $taipeicounty==241}> selected<{/if}>>三重市</option>
			<option value="242"<{if $taipeicounty==242}> selected<{/if}>>新莊市</option>
			<option value="243"<{if $taipeicounty==243}> selected<{/if}>>泰山鄉</option>
			<option value="244"<{if $taipeicounty==244}> selected<{/if}>>林口鄉</option>
			<option value="247"<{if $taipeicounty==247}> selected<{/if}>>蘆洲市</option>
			<option value="248"<{if $taipeicounty==248}> selected<{/if}>>五股鄉</option>
			<option value="249"<{if $taipeicounty==249}> selected<{/if}>>八里鄉</option>
			<option value="251"<{if $taipeicounty==251}> selected<{/if}>>淡水鎮</option>
			<option value="252"<{if $taipeicounty==252}> selected<{/if}>>三芝鄉</option>
			<option value="253"<{if $taipeicounty==253}> selected<{/if}>>石門鄉</option>
		</select>&nbsp;<input type="submit" class="button100" value="確定" />
		</form>
        <form name="addForm" id="addForm" method="POST" action="<{$do_edit_pricing_url}>&opt=2">
		<input type="hidden" name="taipeicounty" value="<{$taipeicounty}>" />
        <table summary="services">
			<tr>
			<th scope="row" class="column1">&nbsp;</th>
			<{section name=bar loop=$orderMonth}>
			  <th scope="row" class="column1"><{if $orderMonth[bar] == $smarty.now|date_format:'%m'}>當月<{else}><{$orderMonth[bar]}><{/if}></th>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">大樓</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicounty_building[]" value="<{$taipeicounty_building[bar][1]}>" /></td>
			<{/section}>
			</tr>
			<tr>
			<th scope="row" class="column1">公寓</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicounty_apartment[]" value="<{$taipeicounty_apartment[bar][1]}>" /></td>
			<{/section}>
			</tr>
			<tr class="odd">
			<td align="center"><b>說明</b></td>
			<td align="center" colspan="12">
				<textarea name="taipeicounty_desc" cols="" rows=""><{$taipeicounty_desc}></textarea>
			</td>
			</tr>
			</table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="儲存台北縣法拍公寓大樓均價行情" title=""/>
	</p><br />
	</div><br />
	</form>
<hr />
  <div>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_edit_pricing_url}>&opt=3">
  	    <h4>台北縣市房屋買賣登記件數</h4>
        <table summary="services">
			<tr>
			<th scope="row" class="column1">&nbsp;</th>
			<{section name=bar loop=$orderMonth}>
			  <th scope="row" class="column1"><{if $orderMonth[bar] == $smarty.now|date_format:'%m'}>當月<{else}><{$orderMonth[bar]}><{/if}></th>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">台北市</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicity_issue[]" value="<{$taipeicity_issue[bar]}>" /></td>
			<{/section}>
			</tr>
			<tr>
			<th scope="row" class="column1">台北縣</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicounty_issue[]" value="<{$taipeicounty_issue[bar]}>" /></td>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">說明</th>
			<td align="center" colspan="12">
				<textarea name="issue_desc" cols="" rows=""><{$issue_desc}></textarea>
			</td>
			</tr>
			</table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="儲存台北縣市房屋買賣登記件數" title=""/>
	</p><br />
	</div><br />
	</form>
<hr />
  <div>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_edit_pricing_url}>&opt=4">
  	    <h4>台北縣市投標人氣指數</h4>
        <table summary="services">
			<tr>
			<th scope="row" class="column1">&nbsp;</th>
			<{section name=bar loop=$orderMonth}>
			  <th scope="row" class="column1"><{if $orderMonth[bar] == $smarty.now|date_format:'%m'}>當月<{else}><{$orderMonth[bar]}><{/if}></th>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">台北市</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicity_bidding[]" value="<{$taipeicity_bidding[bar]}>" /></td>
			<{/section}>
			</tr>
			<tr>
			<th scope="row" class="column1">台北縣</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" name="taipeicounty_bidding[]" value="<{$taipeicounty_bidding[bar]}>" /></td>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">說明</th>
			<td align="center" colspan="12">
				<textarea name="bidding_desc" cols="" rows=""><{$bidding_desc}></textarea>
			</td>
			</tr>
			</table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="儲存台北縣市投標人氣指數" title=""/>
	</p><br />
	</div><br />
	</form>
<hr />
  <div>
	  <form name="auctionForm" id="auctionForm" method="POST" action="<{$do_edit_pricing_url}>&opt=5">
  	    <h4>拍賣中房屋件數</h4>
        <table summary="services">
			<tr>
			<th scope="row" class="column1">&nbsp;</th>
			<{section name=bar loop=$orderMonth}>
			  <th scope="row" class="column1"><input type="field" style="width:30px" name="auction_amount_date[]" ref="dp" value="<{if $auction_amount[bar][0] != NULL}><{math equation="century-1911" century=$auction_amount[bar][0]|date_format:'%Y'}><{$auction_amount[bar][0]|date_format:'-%m-%d'}><{/if}>" /></th>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">件數</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" id="auction_amount_value[]" name="auction_amount_value[]" value="<{if $auction_amount[bar][1] != NULL}><{$auction_amount[bar][1]}><{/if}>" onBlur="calculateAvg()" /></td>
			<{/section}>
			</tr>
			<tr>
			<th scope="row" class="column1">平均值</th>
			<{section name=bar loop=$orderMonth}>
			  <td align="center"><input type="field" style="width:30px" id="auction_amount_avg[]" name="auction_amount_avg[]" /></td>
			<{/section}>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">說明</th>
			<td align="center" colspan="12">
				<textarea name="auction_amount_desc" cols="" rows=""><{$auction_amount_desc}></textarea>
			</td>
			</tr>
			</table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="儲存拍賣中房屋件數" title=""/>
	</p><br />
	</div><br />	
	</form>
<hr />
  <div>
	  <form name="addForm" id="addForm" method="POST" action="<{$do_edit_pricing_url}>&opt=6">
  	    <h4>房地產景氣動向圖</h4>
        <table summary="services">
			<tr>
			<th scope="row" class="column1">&nbsp;</th>
			<{section name=bar loop=$orderQuarter}>
			  <th scope="row" class="column1"><{$orderQuarter[bar]}></th>
			<{/section}>
            <th scope="row" class="column1">漲/跌</th>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">領先指標</th>
			<{section name=bar loop=$orderQuarter}>
			  <td align="center"><input type="field" name="leading[]" value="<{$analysis[0][bar]}>" /></td>
			<{/section}>
			<td align="center"><input type="field" name="leading_return" value="<{$leading_return}>" /></td>
			</tr>
			<tr>
			<th scope="row" class="column1">同時指標</th>
			<{section name=bar loop=$orderQuarter}>
			  <td align="center"><input type="field" name="simultaneous[]" value="<{$analysis[1][bar]}>" /></td>
			<{/section}>
			<td align="center"><input type="field" name="simultaneous_return" value="<{$simultaneous_return}>" /></td>
			</tr>
			<tr class="odd">
			<th scope="row" class="column1">景氣燈號及分數</th>
			<{section name=bar loop=$orderQuarter}>
			  <td align="center"><input type="field" name="prosperity[]" value="<{$analysis[2][bar]}>" /></td>
			<{/section}>
			<td align="center"><input type="field" name="prosperity_return" value="<{$prosperity_return}>" /></td>
			</tr>
			<tr>
			<th scope="row" class="column1">綜合分析</th>
			<td align="center" colspan="5">
				<textarea name="analysis_desc" cols="" rows=""><{$analysis_desc}></textarea>
			</td>
			</tr>
			</table>
	<p class="second">      
	<input type="submit" name="button" class="button100" value="儲存房地產景氣動向圖" title=""/>
	<input type="button" class="button100" value="取消變更" onClick="showCalDialog('<{$cancel_add_url}>')" />
	</p><br />
	</div><br />
	</form>