<script type="text/javascript" src="<{$datepicker_url}>"></script>
<script type="text/javascript">
	function aHover(url){
		location.href = url;
	}
	function delHover(){
		$('#delDialog').dialog("close");
		location.href = $("#delUrl").text();
	}
	function calDel(){
		$('#delDialog').dialog("close");
	}
	function showDelDialog(url) {
		$("#delDialog").dialog("open");
		$("#delUrl").text(url);
	}
	function changeSection() { 	
		k=1;
		var county = document.getElementById("county");
		j = county.selectedIndex;
		a=new Array(); 

		if(j==1) { // 台北市 category items --> 
			a[1]=new Option("中正區","100"); 
			a[2]=new Option("大同區","103"); 
			a[3]=new Option("中山區","104"); 
			a[4]=new Option("松山區","105"); 
			a[5]=new Option("大安區","106"); 
			a[6]=new Option("萬華區","108"); 
			a[7]=new Option("信義區","110"); 
			a[8]=new Option("士林區","111"); 
			a[9]=new Option("北投區","112"); 
			a[10]=new Option("內湖區","114"); 
			a[11]=new Option ("南港區","115"); 
			a[12]=new Option ("文山區","116"); 
		} 

		if(j==2) { // 基隆市 category items --> 
			a[1]=new Option("仁愛區","200"); 
			a[2]=new Option("信義區","201"); 
			a[3]=new Option("中正區","202"); 
			a[4]=new Option("中山區","203"); 
			a[5]=new Option("安樂區","204"); 
			a[6]=new Option("暖暖區","205"); 
			a[7]=new Option("七堵區","206"); 
		} 

							
		if(j==3) { // 台北縣 category items 
			a[1]=new Option("萬里鄉","207"); 
			a[2]=new Option("金山鄉","208"); 
			a[3]=new Option("板橋市","220"); 
			a[4]=new Option("汐止市","221"); 
			a[5]=new Option("深坑鄉","222"); 
			a[6]=new Option("石碇鄉","223"); 
			a[7]=new Option("瑞芳鎮","224"); 
			a[8]=new Option("平溪鄉","226"); 
			a[9]=new Option("雙溪鄉","227");
			a[10]=new Option("貢寮鄉","228");
			a[11]=new Option("新店市","231");
			a[12]=new Option("坪林鄉","232");
			a[13]=new Option("烏來鄉","233");
			a[14]=new Option("永和市","234");
			a[15]=new Option("中和市","235");
			a[16]=new Option("土城市","236"); 
			a[17]=new Option("三峽鎮","237"); 
			a[18]=new Option("樹林市","238"); 
			a[19]=new Option("鶯歌鎮","239"); 
			a[20]=new Option("三重市","241"); 
			a[21]=new Option("新莊市","242"); 
			a[22]=new Option("泰山鄉","243"); 
			a[23]=new Option("林口鄉","244"); 
			a[24]=new Option("蘆洲市","247"); 
			a[25]=new Option("五股鄉","248"); 
			a[26]=new Option("八里鄉","249"); 
			a[27]=new Option("淡水鎮","251"); 
			a[28]=new Option("三芝鄉","252"); 
			a[29]=new Option("石門鄉","253"); 
		}

		if(j==4) { // 宜蘭縣 category items 
			a[1]=new Option("宜蘭市","260");
			a[2]=new Option("頭城鎮","261");
			a[3]=new Option("礁溪鄉","262");
			a[4]=new Option("狀圍鄉","263");
			a[5]=new Option("員山鄉","264");
			a[6]=new Option("羅東鎮","265");
			a[7]=new Option("三星鄉","266");
			a[8]=new Option("大同鄉","267");
			a[9]=new Option("五結鄉","268");
			a[10]=new Option("冬山鄉","269");
			a[11]=new Option("蘇澳鄉","270");
			a[12]=new Option("南澳鄉","272");
		}
		
		if(j==5) { // 桃園縣 category items 
			a[1]=new Option("中壢市","320");
			a[2]=new Option("平鎮市","324");
			a[3]=new Option("龍潭鄉","325");
			a[4]=new Option("楊梅鎮","326");
			a[5]=new Option("新屋鄉","327");
			a[6]=new Option("觀音鄉","328");
			a[7]=new Option("桃園市","330");
			a[8]=new Option("龜山鄉","333");
			a[9]=new Option("八德市","334");
			a[10]=new Option("大溪鎮","335");
			a[11]=new Option("復興鄉","336");
			a[12]=new Option("大圍鄉","337");
			a[13]=new Option("蘆竹鄉","338");
		}


		if(j==6) { // 新竹市 category items 
			a[1]=new Option("新竹市","300"); 
		}

		if(j==7) { // 新竹縣 category items 
			a[1]=new Option("竹北市","302");
			a[2]=new Option("湖口鄉","303");
			a[3]=new Option("新豐鄉","304");
			a[4]=new Option("新埔鎮","305");
			a[5]=new Option("關西鎮","306");
			a[6]=new Option("芎林鄉","307");
			a[7]=new Option("寶山鄉","308");
			a[8]=new Option("竹東鎮","310");
			a[9]=new Option("五峰鄉","311");
			a[10]=new Option("橫山鄉","312");
			a[11]=new Option("尖石鄉","313");
			a[12]=new Option("北埔鄉","314");
			a[13]=new Option("峨眉鄉","315");
		}

		if(j==8) { // 苗栗縣 category items 
			a[1]=new Option("竹南鎮","350");
			a[2]=new Option("頭份鎮","351");
			a[3]=new Option("三灣鄉","352");
			a[4]=new Option("南庄鄉","353");
			a[5]=new Option("獅潭鄉","354");
			a[6]=new Option("後龍鎮","356");
			a[7]=new Option("通宵鎮","357");
			a[8]=new Option("苑裡鎮","358");
			a[9]=new Option("苗栗市","360");
			a[10]=new Option("造橋鄉","361");
			a[11]=new Option("頭屋鄉","362");
			a[12]=new Option("公館鄉","363");
			a[13]=new Option("大湖鄉","364");
			a[14]=new Option("泰安鄉","365");
			a[15]=new Option("銅鑼鄉","366");
			a[16]=new Option("三義鄉","367");
			a[17]=new Option("西湖鄉","368");
			a[18]=new Option("卓蘭鎮","369");
						}

		if(j==9) { // 台中市 category items 
			a[1]=new Option("中區","400");
			a[2]=new Option("東區","401");
			a[3]=new Option("南區","402");
			a[4]=new Option("西區","403");
			a[5]=new Option("北區","404");
			a[6]=new Option("北屯區","406"); 
			a[7]=new Option("西屯區","407"); 
			a[8]=new Option("南屯區","408"); 
		}

		if(j==10) { // 台中縣 category items 
			a[1]=new Option("太平市","411");
			a[2]=new Option("大里市","412");
			a[3]=new Option("霧峰鄉","413");
			a[4]=new Option("烏日鄉","414");
			a[5]=new Option("豐原市","420");
			a[6]=new Option("后里鄉","421");
			a[7]=new Option("石岡鄉","422");
			a[8]=new Option("東勢鎮","423");
			a[9]=new Option("和平鄉","424");
			a[10]=new Option("新社鄉","426");
			a[11]=new Option("潭子鄉","427");
			a[12]=new Option("大雅鄉","428");
			a[13]=new Option("神岡鄉","429");
			a[14]=new Option("大肚鄉","432");
			a[15]=new Option("沙鹿鎮","433");
			a[16]=new Option("龍井鄉","434");
			a[17]=new Option("梧棲鎮","435");
			a[18]=new Option("清水鎮","436");
			a[19]=new Option("大甲鎮","437");
			a[20]=new Option("外埔鄉","438");
			a[21]=new Option("大安鄉","439");
		}

		if(j==11) { // 彰化縣 category items 
			a[1]=new Option("彰化市","500");
			a[2]=new Option("芬園鄉","502");
			a[3]=new Option("花壇鄉","503");
			a[4]=new Option("秀水鄉","504");
			a[5]=new Option("鹿港鎮","505");
			a[6]=new Option("福興鄉","506");
			a[7]=new Option("線西鄉","507");
			a[8]=new Option("和美鎮","508");
			a[9]=new Option("伸港鄉","509");
			a[10]=new Option("員林鎮","510");
			a[11]=new Option("社頭鄉","511");
			a[12]=new Option("永靖鄉","512");
			a[13]=new Option("埔心鄉","513");
			a[14]=new Option("溪湖鎮","514");
			a[15]=new Option("大村鄉","515");
			a[16]=new Option("埔鹽鄉","516");
			a[17]=new Option("田中鎮","520");
			a[18]=new Option("北斗鎮","521");
			a[19]=new Option("田尾鄉","522");
			a[20]=new Option("埤頭鄉","523");
			a[21]=new Option("溪州鄉","524");
			a[22]=new Option("竹塘鄉","525");
			a[23]=new Option("二林鎮","526");
			a[24]=new Option("大城鄉","527");
			a[25]=new Option("芳苑鄉","528");
			a[26]=new Option("二水鄉","600");
		}

		if(j==12) { // 南投縣 category items 
			a[1]=new Option("南投市","540");
			a[2]=new Option("中寮鄉","541");
			a[3]=new Option("草屯鎮","542");
			a[4]=new Option("國姓鄉","544");
			a[5]=new Option("埔里鎮","545");
			a[6]=new Option("仁愛鄉","546");
			a[7]=new Option("名間鄉","551");
			a[8]=new Option("集集鎮","552");
			a[9]=new Option("水里鄉","553");
			a[10]=new Option("魚池鄉","555");
			a[11]=new Option("信義鄉","556");
			a[12]=new Option("竹山鎮","557");
			a[13]=new Option("鹿谷鄉","558");
		}

		if(j==13) { // 嘉義市 category items 
			a[1]=new Option("嘉義市","600"); 
		}

		if(j==14) { // 嘉義縣 category items 
			a[1]=new Option("番路鄉","602");
			a[2]=new Option("梅山鄉","603");
			a[3]=new Option("竹崎鄉","604");
			a[4]=new Option("阿里山鄉","605");
			a[5]=new Option("中埔鄉","606");
			a[6]=new Option("大埔鄉","607");
			a[7]=new Option("水上鄉","608");
			a[8]=new Option("鹿草鄉","611");
			a[9]=new Option("太保市","612");
			a[10]=new Option("朴子市","613");
			a[11]=new Option("東石鄉","614");
			a[12]=new Option("六腳鄉","615");
			a[13]=new Option("新港鄉","616");
			a[14]=new Option("民雄鄉","621");
			a[15]=new Option("大林鎮","622");
			a[16]=new Option("溪口鄉","623");
			a[17]=new Option("義竹鄉","624");
			a[18]=new Option("布袋鎮","625");
		}

		if(j==15) { // 雲林縣 category items 
			a[1]=new Option("斗南鎮","630");
			a[2]=new Option("大埤鄉","631");
			a[3]=new Option("虎尾鎮","632");
			a[4]=new Option("土庫鎮","633");
			a[5]=new Option("褒忠鄉","634");
			a[6]=new Option("東勢鄉","635");
			a[7]=new Option("臺西鄉","636");
			a[8]=new Option("崙背鄉","637");
			a[9]=new Option("麥寮鄉","638");
			a[10]=new Option("斗六市","640");
			a[11]=new Option("林內鄉","643");
			a[12]=new Option("古坑鄉","646");
			a[13]=new Option("薊桐鄉","647");
			a[14]=new Option("西螺鎮","648");
			a[15]=new Option("二崙鄉","649");
			a[16]=new Option("北港鎮","651");
			a[17]=new Option("水林鄉","652");
			a[18]=new Option("口湖鄉","653");
			a[19]=new Option("四湖鄉","654");
			a[20]=new Option("元長鄉","655");
		}

		if(j==16) { // 台南市 category items 
			a[1]=new Option("中區","700");
			a[2]=new Option("東區","701");
			a[3]=new Option("南區","702");
			a[4]=new Option("西區","703");
			a[5]=new Option("北區","704");
			a[6]=new Option("安平區","708"); 
			a[7]=new Option("安南區","709"); 
		}

		if(j==17) { // 台南縣 category items 
			a[1]=new Option("永康市","710");
			a[2]=new Option("歸仁鄉","711");
			a[3]=new Option("新化鎮","712");
			a[4]=new Option("左鎮鄉","713");
			a[5]=new Option("玉井鄉","714");
			a[6]=new Option("楠西鄉","715");
			a[7]=new Option("南化鄉","716");
			a[8]=new Option("仁德鄉","717");
			a[9]=new Option("關廟鄉","718");
			a[10]=new Option("龍崎鄉","719");
			a[11]=new Option("官田鄉","720");
			a[12]=new Option("麻豆鎮","721");
			a[13]=new Option("佳里鎮","722");
			a[14]=new Option("西港鄉","723");
			a[15]=new Option("七股鄉","724");
			a[16]=new Option("將軍鄉","725");
			a[17]=new Option("學甲鎮","726");
			a[18]=new Option("北門鄉","727");
			a[19]=new Option("新營市","730");
			a[20]=new Option("後壁鄉","731");
			a[21]=new Option("白河鎮","732");
			a[22]=new Option("東山鄉","733");
			a[23]=new Option("六甲鄉","734");
			a[24]=new Option("下營鄉","735");
			a[25]=new Option("柳營鄉","736");
			a[26]=new Option("鹽水鎮","737");
			a[27]=new Option("善化鎮","741");
			a[28]=new Option("大內鄉","742");
			a[29]=new Option("山上鄉","743");
			a[30]=new Option("新市鄉","744");
			a[31]=new Option("安定鄉","745");
		}

		if(j==18) { // 高雄市 category items 
			a[1]=new Option("新興區","800"); 
			a[2]=new Option("前金區","801"); 
			a[3]=new Option("苓雅區","802"); 
			a[4]=new Option("鹽埕區","803"); 
			a[5]=new Option("鼓山區","804"); 
			a[6]=new Option("旗津區","805"); 
			a[7]=new Option("前鎮區","806"); 
			a[8]=new Option("三民區","807"); 
			a[9]=new Option("楠梓區","811"); 
			a[10]=new Option("小港區","812"); 
			a[11]=new Option("左營區","813"); 
		}

		if(j==19) { // 高雄縣 category items 
			a[1]=new Option("仁武鄉","814");
			a[2]=new Option("大社鄉","815");
			a[3]=new Option("岡山鎮","820");
			a[4]=new Option("路竹鄉","821");
			a[5]=new Option("阿蓮鄉","822");
			a[6]=new Option("田寮鄉","823");
			a[7]=new Option("燕巢鄉","824");
			a[8]=new Option("橋頭鄉","825");
			a[9]=new Option("梓官鄉","826");
			a[10]=new Option("彌陀鄉","827");
			a[11]=new Option("永安鄉","828");
			a[12]=new Option("湖內鄉","829");
			a[13]=new Option("鳳山市","830");
			a[14]=new Option("大寮鄉","831");
			a[15]=new Option("林園鄉","832");
			a[16]=new Option("鳥松鄉","833");
			a[17]=new Option("大樹鄉","840");
			a[18]=new Option("旗山鎮","842");
			a[19]=new Option("美濃鎮","843");
			a[20]=new Option("六龜鄉","844");
			a[21]=new Option("內門鄉","845");
			a[22]=new Option("杉林鄉","846");
			a[23]=new Option("甲仙鄉","847");
			a[24]=new Option("桃源鄉","848");
			a[25]=new Option("三民鄉","849");
			a[26]=new Option("茂林鄉","851");
			a[27]=new Option("茄萣鄉","852");
		}

		if(j==20) { // 澎湖縣 category items 
			a[1]=new Option("馬公市","880");
			a[2]=new Option("西嶼鄉","881");
			a[3]=new Option("望安鄉","882");
			a[4]=new Option("七美鄉","883");
			a[5]=new Option("白沙鄉","884");
			a[6]=new Option("湖西鄉","885");
		}

		if(j==21) { // 屏東縣 category items 
			a[1]=new Option("屏東市","900");
			a[2]=new Option("三地門鄉","901");
			a[3]=new Option("霧臺鄉","902");
			a[4]=new Option("瑪家鄉","903");
			a[5]=new Option("九如鄉","904");
			a[6]=new Option("里港鄉","905");
			a[7]=new Option("高樹鄉","906");
			a[8]=new Option("鹽埔鄉","907");
			a[9]=new Option("長治鄉","908");
			a[10]=new Option("麟洛鄉","909");
			a[11]=new Option("竹田鄉","911");
			a[12]=new Option("內埔鄉","912");
			a[13]=new Option("萬丹鄉","913");
			a[14]=new Option("潮州鎮","920");
			a[15]=new Option("泰武鄉","921");
			a[16]=new Option("來義鄉","922");
			a[17]=new Option("萬巒鄉","923");
			a[18]=new Option("崁頂鄉","924");
			a[19]=new Option("新埤鄉","925");
			a[20]=new Option("南州鄉","926");
			a[21]=new Option("林邊鄉","927");
			a[22]=new Option("東港鎮","928");
			a[23]=new Option("琉球鄉","929");
			a[24]=new Option("佳冬鄉","931");
			a[25]=new Option("新園鄉","932");
			a[26]=new Option("枋寮鄉","940");
			a[27]=new Option("枋山鄉","941");
			a[28]=new Option("春日鄉","942");
			a[29]=new Option("獅子鄉","943");
			a[30]=new Option("車城鄉","944");
			a[31]=new Option("牡丹鄉","945");
			a[32]=new Option("恆春鎮","946");
			a[33]=new Option("滿州鄉","947");
		}

		if(j==22) { // 臺東縣 category items 
			a[1]=new Option("臺東市","950");
			a[2]=new Option("綠島鄉","951");
			a[3]=new Option("蘭嶼鄉","952");
			a[4]=new Option("延平鄉","953");
			a[5]=new Option("卑南鄉","954");
			a[6]=new Option("鹿野鄉","955");
			a[7]=new Option("關山鎮","956");
			a[8]=new Option("海端鄉","957");
			a[9]=new Option("池上鄉","958");
			a[10]=new Option("東河鄉","959");
			a[11]=new Option("成功鎮","961");
			a[12]=new Option("長濱鄉","962");
			a[13]=new Option("太麻里鄉","963");
			a[14]=new Option("金峰鄉","964");
			a[15]=new Option("大武鄉","965");
			a[16]=new Option("達仁鄉","966");
		}

		if(j==23) { // 花蓮縣 category items 
			a[1]=new Option("花蓮市","970");
			a[2]=new Option("新城鄉","971");
			a[3]=new Option("秀林鄉","972");
			a[4]=new Option("吉安鄉","973");
			a[5]=new Option("壽豐鄉","974");
			a[6]=new Option("鳳林鎮","975");
			a[7]=new Option("光復鄉","976");
			a[8]=new Option("豐濱鄉","977");
			a[9]=new Option("瑞穗鄉","978");
			a[10]=new Option("萬榮鄉","979");
			a[11]=new Option("玉里鎮","981");
			a[12]=new Option("卓溪鄉","982");
			a[13]=new Option("富里鄉","983");
		}

		if(j==24) { // 金門縣 category items 
			a[1]=new Option("金湖鎮","891");
			a[2]=new Option("金寧鄉","892");
			a[3]=new Option("金城鎮","893");
			a[4]=new Option("烈嶼鄉","894");
			a[5]=new Option("烏坵鄉","896");
		}

		if(j==25) { // 連江縣 category items 
			a[1]=new Option("南竿","209");
			a[2]=new Option("北竿","210");
			a[3]=new Option("莒光","211");
			a[4]=new Option("東引","212");
		}

		if(j==26) { // 南海諸島 category items 
			a[1]=new Option("東沙","817");
			a[2]=new Option("南沙","819");
			a[3]=new Option("釣魚台","290"); 
		}

		var district = document.getElementById("district");

		for (i=district.length-1;i>0;i--) {
			district.remove(i);
		}
		for(i = 1 ; i < a.length ; i++){
			district.add(a[i],null);
		}
	}
	//document on ready.
	$(document).ready(function(){
		$("#delText").text("確定刪除?(按確定後無法復原)");
		$("#delDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#beginDate").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#endDate").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
	}); 
	
</script>
<div id="delDialog"><span id="delText"></span><hr/><div id="delBtn"><input type="button" class="button60" value="確定" onClick='delHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calDel()' />我反悔了</a></div><input type="hidden" id="delUrl" value=""></div>
<div id="objContent">
		<{include_php file="$plu_header_path"}>
        <h4><{$func_Cname}>&nbsp;&nbsp;<input type="button" name="button" class="button100" value="新增物件" onClick="aHover('<{$show_add_objects_link}>')" title=""/></h4>
		<hr/>
		 <div>
			<div style="margin-left:20px;">
			<form method="POST" action="<{$show_objects_list_url}>&OPT=<{$OPT}>">
              <b>搜尋物件：</b><br />
			  地區：
			  <select name="county" id="county" onChange="changeSection()"> 
						<OPTION value="" selected>--請選擇--</OPTION>
						<option value="1">台北市</OPTION>
						<option value="2">基隆市</OPTION>
						<option value="3">台北縣</OPTION>
						<option value="4">宜蘭縣</OPTION>
						<option value="5">桃園縣</OPTION>
						<option value="6">新竹市</OPTION>
						<option value="7">新竹縣</OPTION>
						<option value="8">苗栗縣</OPTION>
						<option value="9">台中市</OPTION>
						<option value="10">台中縣</OPTION>
						<option value="11">彰化縣</OPTION>
						<option value="12">南投縣</OPTION> 
						<option value="13">嘉義市</OPTION> 
						<option value="14">嘉義縣</OPTION>
						<option value="15">雲林縣</OPTION>
						<option value="16">台南市</OPTION>
						<option value="17">台南縣</OPTION>
						<option value="18">高雄市</OPTION>
						<option value="19">高雄縣</OPTION>
						<option value="23">澎湖縣</OPTION>
						<option value="20">屏東縣</OPTION>
						<option value="22">台東縣</OPTION>
						<option value="21">花蓮縣</OPTION>
						<option value="24">金門縣</OPTION>
						<option value="25">連江縣</OPTION>
						<option value="26">海南諸島</OPTION>
				</select>&nbsp;&nbsp;
				<select name="district" id="district"> 
					<option value="">--請選擇--</option> 
				</select>&nbsp;&nbsp;
				案號：<input type="field" name="auction_no" value="" />&nbsp;&nbsp;&nbsp;
				開標日期：<input type="field" name="beginDate" value="" id="beginDate" maxlength="10" class="date" /><b><font size="4">-</font></b><input type="field" name="endDate" value="" id="endDate" maxlength="10" class="date" /><br />
				物件地址：<input type="text" name="addr" value="" /><br />
				未放置：<input type="checkbox" name="unplaced_land" value="land">謄本&nbsp;&nbsp;<input type="checkbox" name="unplaced_pic" value="pic">相片&nbsp;&nbsp;<input type="checkbox" name="unplaced_struct" value="structure">平面圖&nbsp;&nbsp;<!--<input type="checkbox" name="unplaced" value="intro">公告&nbsp;&nbsp;-->
				<input type="checkbox" name="unplaced_market" value="market">行情&nbsp;&nbsp;<input type="checkbox" name="unplaced_info" value="info">房訊&nbsp;&nbsp;
			  <input type="submit" name="searchbtn" class="button100" value="搜尋" />
			</form>
			</div><hr />
		</div><br /><span>
		<div>搜尋結果：<BR /><{$searchStr}>
		</div>
		 <div class="page-bread top-next">
		 排序：<{if $OPT!=1}><a href="<{$show_objects_list_url}>&OPT=1"><{/if}>日期新到舊<{if $OPT!=1}></a><{/if}>&nbsp;|&nbsp;<{if $OPT!=2}><a href="<{$show_objects_list_url}>&OPT=2"><{/if}>日期舊到新<{if $OPT!=2}></a><{/if}>&nbsp;|&nbsp;<{if $OPT!=3}><a href="<{$show_objects_list_url}>&OPT=3"><{/if}>拍次++<{if $OPT!=3}></a><{/if}>&nbsp;|&nbsp;<{if $OPT!=4}><a href="<{$show_objects_list_url}>&OPT=4"><{/if}>拍次--<{if $OPT!=4}></a><{/if}>&nbsp;|&nbsp;<{if $OPT!=5}><a href="<{$show_objects_list_url}>&OPT=5"><{/if}>序號++<{if $OPT!=5}></a><{/if}>&nbsp;|&nbsp;<{if $OPT!=6}><a href="<{$show_objects_list_url}>&OPT=6"><{/if}>序號--<{if $OPT!=6}></a><{/if}><BR />
		 共<{$count}>筆： <{$pager}>
		</div></span><BR />
<table summary="services">
	<caption>最新產品列表</caption>
	<thead>
	<tr class="odd">
		<th scope="col">序號</th>
		<th scope="col">案號</th>
		<th scope="col">拍次</th>	
		<th scope="col">開標日期</th>
		<th scope="col">開標結果</th>
		<th scope="col">地址</th>
		<th scope="col">類型</th>
		<th scope="col">總坪數</th>
		<th scope="col">底價</th>
		<th scope="col">保證金</th>
		<th scope="col">相片</th>
		<th scope="col">謄本</th>
		<th scope="col">圖</th>
		<th scope="col">行情</th>
		<th scope="col">房訊</th>
		<th scope="col">發佈狀態</th>
		<th scope="col">刪除</th>
	</tr>	
	</thead>
	<tbody>
	<{foreach from="$objects_data" item="rows" name="objects_data"}>
	<tr<{if $smarty.foreach.objects_data.index % 2 == 1}> class="odd"<{/if}>>
		<td class="column1"><{$smarty.foreach.objects_data.index+1}></td>
		<td class="column1"><a href="<{$show_edit_objects_link}><{$rows.object_id}>"><{$rows.auction_no}></a></td>
		<td class="column1"><span style="color:<{if $rows.auction_times=="應買"}>#9900CC<{elseif $rows.auction_times=="特拍"}>#FF6600<{else}>#0000FF<{/if}>"><{$rows.auction_times}></td>
		<td class="column1"><{math equation="century-1911" century=$rows.auction_date|date_format:'%Y'}><{$rows.auction_date|date_format:'-%m-%d'}></td>
		<td class="column1"><span style="color:<{if $rows.auction_result=="待標中"}>#0000FF<{elseif $rows.auction_result=="流標"}>#009900<{elseif $rows.auction_result=="停拍"}>#FF6600<{else}>#FF0000<{/if}>"><{$rows.auction_result}>
		<{if $rows.auction_result_memo !=''}><br /><span style="color:#FF0000"><{$rows.auction_result_memo}></span><{/if}>
		</td>
		<td class="column1"><{$rows.county}><{$rows.district}><{$rows.obj_addr}></td>
		<td class="column1"><{$rows.obj_type}></td>
		<td class="column1"><{$rows.total_area|string_format:"%.1f"}></td>
		<td class="column1"><{$rows.auction_base_price}></td>
		<td class="column1"><{$rows.margin}></td>
		<td class="column1"><img src="<{$img_path}>u134.jpg" width="13" height="12"><br />x<{$rows.photo_amount}></td>
		<td class="column1"><{if $rows.total_area==0}>缺<{else}>足<{/if}></td>
		<td class="column1"><img src="<{$img_path}>u140.jpg" width="13" height="11"><br />x<{$rows.house_amount}></td>
		<td class="column1">
			<{if $rows.quotations_addr_1=='' && $rows.quotations_type_1=='' && $rows.quotations_date_1=='0000-00-00' && $rows.quotations_times_1=='' && $rows.quotations_price_1==0 && $rows.quotations_totalprice_1==0 && $rows.quotations_unitprice_1==0
			  && $rows.quotations_addr_2=='' && $rows.quotations_type_2=='' && $rows.quotations_date_2=='0000-00-00' && $rows.quotations_times_2=='' && $rows.quotations_price_2==0 && $rows.quotations_totalprice_2==0 && $rows.quotations_unitprice_2==0}>缺
			<{else}>足<{/if}>
		</td>
		<td class="column1"><img src="<{$img_path}>u150.png" width="17" height="14"><br />x<{$rows.pic_amount}></td>
		<td class="column1"><{if $rows.publish_date|date_format:'%Y-%m-%d' > $smarty.now|date_format:'%Y-%m-%d'}>未發佈<{else}>已發佈<{/if}></td>
		<td class="column1">
		  <input type="button" name="button" class="button60" value="刪除" title="" onClick="showDelDialog('<{$do_del_objects_link}><{$rows.object_id}>')" />		
		</td>
	</tr>
	<{foreachelse}>
	<tr>
		<td colspan="17" align="center" class="column1">目前無任何物件</td>
	</tr>
	<{/foreach}>
	</tbody>
</table>
        <div class="page-bread bottom-next">
         <p>
         共<{$count}>筆： <{$pager}>
         </p>
        </div>
  </div>