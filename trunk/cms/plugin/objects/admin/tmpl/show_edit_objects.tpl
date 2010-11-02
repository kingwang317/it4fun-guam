<script type="text/javascript" src="<{$form_url}>"></script>
<script type="text/javascript" src="<{$validate_url}>"></script>
<script type="text/javascript" src="<{$history_url}>"></script>
<script type="text/javascript" src="<{$wizard_url}>"></script>
<script type="text/javascript" src="<{$mrt_url}>"></script>
<script type="text/javascript" src="<{$datepicker_url}>"></script>
<script type="text/javascript">
	var dis=<{$district}>;
	var atime="<{$auction_date|date_format:"%H:%M"}>";
	var line=<{$mrtLine}>;
	var station=<{$mrtStation}>;
	var mt ="<{$management_fee_type}>";
	var rt = "<{$rent_type}>";
	var pt = "<{$parking_type}>";
	var qt1 = "<{$quotations_type_1}>";
	var qt2 = "<{$quotations_type_2}>";
	var qtime1 = "<{$quotations_times_1}>";
	var qtime2 = "<{$quotations_times_2}>";
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

	function calPrice(auction_price, total_area, unit_price){
		x = document.getElementById(auction_price);
		y = document.getElementById(total_area);
		if((x.value!==undefined && x.value!='') &&
			(y.value!==undefined && y.value!='')){
			result = document.getElementById(unit_price);
			result.value = (parseFloat(x.value) / parseFloat(y.value)).toFixed(2);
		}
		
	}
	
	function changeSection() { 	
		k=1;
		var county = document.getElementById("county");
		j = county.options[county.selectedIndex].value;
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
			a[1]=new Option("龜山鄉","333");
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
			if(dis!=0 && a[i].value == dis){
				a[i].selected = true;
			}
		}
	}

	function initialSelection(){
		selectedOption("auction_time", atime);
		selectedOption("mrtLine", line);
		changeStation('mrtLine','mrtStation')
		selectedOption("mrtStation", station);
		selectedOption("fee_type", mt);
		selectedOption("rent_type", rt);
		selectedOption("parking_type", pt);
		selectedOption("quotations_type_1", qt1);
		selectedOption("quotations_type_2", qt2);
		selectedOption("quotations_times_1", qtime1);
		selectedOption("quotations_times_2", qtime2);
	}
	
	function selectedOption(id, selectedValue){
		a = document.getElementById(id);
		for(i = 1 ; i < a.options.length ; i++){
			if(a.options[i].value == selectedValue){
				a.options[i].selected = true;
			}
		}
	}
	function showMsg(v){
	    if(v==1234){
			document.getElementById("taxMsg").style.display = "";
		}else{
		    document.getElementById("taxMsg").style.display = "none";
		}
	}

	function remind(address){
		$("th > span").each(function(index){
			if($(this).hasClass("addressRemind")){
				$(this).text(address+'　　　　');
			}
		});
	}
	
	//document on ready.
	function initialSelectColor(objName){
		x = document.getElementById(objName);
		x.style.color = x.options[x.selectedIndex].style.color;
	}
	$(document).ready(function(){
		$("#calText").text("確定取消變更消息?(按確定後無法復原)");
		$("#calDialog").dialog({
			autoOpen: false,
			modal:true
		});
		$("#datepicker").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#datepicker2").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#datepicker3").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#datepicker4").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		$("#datepicker5").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
		initialSelectColor("auction_inst");
		initialSelectColor("auction_times");
		initialSelectColor("auction_checked");
		initialSelectColor("auction_result");
		var address = document.getElementById("obj_addr").value;
		remind(address);
		$("#addForm").formwizard({ 
		  //form wizard settings
		  historyEnabled : false, 
		  formPluginEnabled: false, 
		  validationEnabled : true},
		 {
		   //validation settings
		 },
		 {
		   // form plugin settings
		 }
		);
		initialSelection();
		changeSection();
	});
	jQuery.validator.addMethod('auctionCheck', function(auction_Number){
		$.ajax({
			cache:false,
			async:false,
			type: "GET",
			url:"<{$check_auction_url}>",
			data:{auction_no:auction_Number},
			success:function(msg){
				result = (msg != 0)? false: true;
			}
		});
		return result;
	}, '案號重覆');
	jQuery.validator.addMethod('addressCheck', function(obj){
		distr = document.getElementById("district");
		addr = document.getElementById("obj_addr");
		if(distr.value!==undefined && distr.value!='' &&
			addr.value!==undefined && addr.value!=''){
			$.ajax({
				cache:false,
				async:false,
				type: "GET",
				url:"<{$check_address_url}>",
				data:{district:distr.value,obj_addr:addr.value},
				success:function(msg){
					result = (msg != 0)? false: true;
				}
			});
		}
		return result;
	}, '地址重覆');
</script>
<div id="calDialog">
	<span id="calText"></span><hr/>
	<div id="calBtn">
		<input type="button" class="button60" value="確定" onClick='calHover()' />&nbsp;&nbsp;&nbsp;<a href="#" onClick='calAdd()' />我反悔了</a>
	</div><input type="hidden" id="calUrl" value="">
</div>
<div id="content">
    <{include_php file="$plu_header_path"}>
    <h4><{$func_Cname}></h4>
    <p class="notes">(*為必填)</p>
	<form name="addForm" id="addForm" method="POST" action="<{$do_edit_objects_url}>" enctype="multipart/form-data">
 	<div class="step" id="firstStep">
       <table summary="services">
            <thead>
			  <tr>
				<th colspan="2" align="left">1.拍賣公告</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 預計公佈日期</th>
				<td>
					<input type="field" name="obj[publish_date]" value="<{math equation="century-1911" century=$publish_date|date_format:'%Y'}><{$publish_date|date_format:'-%m-%d'}>" id="datepicker" maxlength="10" class="required" />
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 區域</th>
				<td>
					<select name="obj[county]" id="county" onChange="dis=0;changeSection()" class="required"> 
						<OPTION value="">--請選擇--</OPTION>
						<option value="1"<{if $county==1}> selected<{/if}>>台北市</OPTION>
						<option value="3"<{if $county==3}> selected<{/if}>>台北縣</OPTION>
						<option value="5"<{if $county==5}> selected<{/if}>>桃園縣</OPTION>
					</select>
					<select name="obj[district]" id="district" class="required"> 
						<option value="">--請選擇--</option> 
					</select> 
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 物件地址</th>
				<td>
					<input type="text" name="obj[obj_addr]" value="<{$obj_addr}>" id="obj_addr" onChange="remind(this.value)" class="addressCheck required" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">* 類型</th>
				<td>
					<select  name="obj[obj_type]" class="required">
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="大樓／住家"<{if $obj_type== "大樓／住家"}> selected<{/if}>>大樓／住家</OPTION>
						<OPTION value="大樓／住辦"<{if $obj_type== "大樓／住辦"}> selected<{/if}>>大樓／住辦</OPTION>
						<OPTION value="大樓／套房"<{if $obj_type== "大樓／套房"}> selected<{/if}>>大樓／套房</OPTION>
						<OPTION value="公寓／住家"<{if $obj_type== "公寓／住家"}> selected<{/if}>>公寓／住家</OPTION>
						<OPTION value="公寓／一樓"<{if $obj_type== "公寓／一樓"}> selected<{/if}>>公寓／一樓</OPTION>
						<OPTION value="公寓／別墅"<{if $obj_type== "公寓／別墅"}> selected<{/if}>>公寓／別墅</OPTION>
						<OPTION value="商用／辦公"<{if $obj_type== "商用／辦公"}> selected<{/if}>>商用／辦公</OPTION>
						<OPTION value="商用／廠辦"<{if $obj_type== "商用／廠辦"}> selected<{/if}>>商用／廠辦</OPTION>
						<OPTION value="店面／透天"<{if $obj_type== "店面／透天"}> selected<{/if}>>店面／透天</OPTION>
						<OPTION value="店面／一樓"<{if $obj_type== "店面／一樓"}> selected<{/if}>>店面／一樓</OPTION>
						<OPTION value="透天／住家"<{if $obj_type== "透天／住家"}> selected<{/if}>>透天／住家</OPTION>
						<OPTION value="透天／別墅"<{if $obj_type== "透天／別墅"}> selected<{/if}>>透天／別墅</OPTION>
						<OPTION value="透天／廠辦"<{if $obj_type== "透天／廠辦"}> selected<{/if}>>透天／廠辦</OPTION>
						<OPTION value="其他／車位"<{if $obj_type== "其他／車位"}> selected<{/if}>>其他／車位</OPTION>
					</select>
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 拍賣機關</th>
				<td>
					<select id="auction_inst" name="obj[auction_inst]" class="required" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; font-style:normal; font-weight:bold; text-decoration:none" onchange="this.style.color=this.options[this.selectedIndex].style.color">
						<OPTION value="" selected>--請選擇--</OPTION>
						<OPTION value="台北法院" style=" color:#993300;"<{if $auction_inst== "台北法院"}> selected<{/if}>>台北法院</OPTION>
						<OPTION value="士林法院" style=" color:#993300;"<{if $auction_inst== "士林法院"}> selected<{/if}>>士林法院</OPTION>
						<OPTION value="板橋法院" style=" color:#993300;"<{if $auction_inst== "板橋法院"}> selected<{/if}>>板橋法院</OPTION>
						<OPTION value="桃園法院" style=" color:#993300;"<{if $auction_inst== "桃園法院"}> selected<{/if}>>桃園法院</OPTION>
						<OPTION value="台灣金服公司" style="color:#FFCC00"<{if $auction_inst== "台灣金服公司"}> selected<{/if}>>台灣金服公司</OPTION>
						<OPTION value="台北執行處" style="color:#0000FF"<{if $auction_inst== "台北執行處"}> selected<{/if}>>台北執行處</OPTION>
						<OPTION value="士林執行處" style="color:#0000FF"<{if $auction_inst== "士林執行處"}> selected<{/if}>>士林執行處</OPTION>
						<OPTION value="板橋執行處" style="color:#0000FF"<{if $auction_inst== "板橋執行處"}> selected<{/if}>>板橋執行處</OPTION>
						<OPTION value="桃園執行處" style="color:#0000FF"<{if $auction_inst== "桃園執行處"}> selected<{/if}>>桃園執行處</OPTION>
						<OPTION value="其他機關" style="color:#000000" <{if $auction_inst== "其他機關"}> selected<{/if}>>其他機關</OPTION>
					</select>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 案號</th>
				<td>
					<input type="field" name="obj[auction_no]" value="<{$auction_no}>" class="auctionCheck required" id="auction_no" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 16px; color:#993300; font-style:normal; font-weight:bold; text-decoration:none" />
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 拍次</th>
				<td>
					<select id="auction_times" name="obj[auction_times]" class="required" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; font-style:normal; font-weight:normal; text-decoration:none" onchange="this.style.color=this.options[this.selectedIndex].style.color">
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="1拍" style="color:#0000FF"<{if $auction_times== "1拍"}> selected<{/if}>>1拍</OPTION>
						<OPTION value="2拍" style="color:#0000FF"<{if $auction_times== "2拍"}> selected<{/if}>>2拍</OPTION>
						<OPTION value="3拍" style="color:#0000FF"<{if $auction_times== "3拍"}> selected<{/if}>>3拍</OPTION>
						<OPTION value="應買" style="color:#9900CC"<{if $auction_times== "應買"}> selected<{/if}>>應買</OPTION>
						<OPTION value="特拍" style="color:#FF6600"<{if $auction_times== "特拍"}> selected<{/if}>>特拍</OPTION>
					</select>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 點交否</th>
				<td>
					<select id="auction_checked" name="obj[auction_checked]" class="required" class="required" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; font-style:normal; font-weight:normal; text-decoration:none" onchange="this.style.color=this.options[this.selectedIndex].style.color">
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="點交" style="color:#006600"<{if $auction_checked== "點交"}> selected<{/if}>>點交</OPTION>
						<OPTION value="部分點交" style="color:#FF6600"<{if $auction_checked== "部分點交"}> selected<{/if}>>部分點交</OPTION>
						<OPTION value="不點交" style="color:#FF0000"<{if $auction_checked== "不點交"}> selected<{/if}>>不點交</OPTION>
					</select>
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 開標日期</th>
				<td>
					<input type="field" name="obj[auction_date]" id="datepicker2" maxlength="10" class="required" value="<{math equation="century-1911" century=$auction_date|date_format:'%Y'}><{$auction_date|date_format:'-%m-%d'}>" />
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 投標時間</th>
				<td>
					<select name="obj[auction_time]" id="auction_time" class="required">
					<OPTION value="">--請選擇--</OPTION>
					<OPTION value="09:30"<{if $auction_date|date_format:'%H:%M' =="09:30"}> selected<{/if}>>09:30</OPTION>
					<OPTION value="10:30"<{if $auction_date|date_format:'%H:%M' =="10:30"}> selected<{/if}>>10:30</OPTION>
					<OPTION value="14:30"<{if $auction_date|date_format:'%H:%M' =="14:30"}> selected<{/if}>>14:30</OPTION>
					<{*
					<{section name=i start=0 loop=48 step=1}>
						<OPTION value="<{$smarty.section.i.index/2|string_format:"%02d"}>:<{if $smarty.section.i.index%2 == 0}>00<{else}>30<{/if}>"><{$smarty.section.i.index/2|string_format:"%02d"}>:<{if $smarty.section.i.index%2 == 0}>00<{else}>30<{/if}></OPTION>
					<{/section}>
					*}>
					</select>
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">* 拍賣底價</th>
				<td>
					<input type="field" name="obj[auction_base_price]" value="<{$auction_base_price}>" id="auction_base_price" onBlur="calPrice('auction_base_price','total_area','announce_unit_price')" class="required number" style="background-color:#FFFFFF; text-align: right ; font-family:'Arial'; font-size: 16px; font-style:normal; font-weight:bold; text-decoration:none" />&nbsp;&nbsp;萬元
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 保證金</th>
				<td>
					<input type="field" name="obj[margin]" value="<{$margin}>" class="required number" style="background-color:#FFFFFF; text-align: right ; font-family:'Arial'; font-size: 16px; font-style:normal; font-weight:bold; text-decoration:none" />&nbsp;&nbsp;萬元
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">* 開標結果</th>
				<td>
					<select id="auction_result" name="obj[auction_result]" class="required" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; font-style:normal; font-weight:normal; text-decoration:none"  onchange="this.style.color=this.options[this.selectedIndex].style.color">
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="待標中" style="color:#0000FF"<{if $auction_result== "待標中"}> selected<{/if}>>待標中</OPTION>
						<OPTION value="流標" style="color:#009900"<{if $auction_result== "流標"}> selected<{/if}>>流標</OPTION>
						<OPTION value="停拍" style="color:#FF6600"<{if $auction_result== "停拍"}> selected<{/if}>>停拍</OPTION>
						<OPTION value="撤回" style="color:#FF0000"<{if $auction_result== "撤回"}> selected<{/if}>>撤回</OPTION>
						<OPTION value="拍定" style="color:#FF0000"<{if $auction_result== "拍定"}> selected<{/if}>>拍定</OPTION>
					</select>
					&nbsp;&nbsp;
					<input type="field" name="obj[auction_result_memo]" value="<{$auction_result_memo}>" class="required" style="color:#FF0000; text-align: left ; font-family:'Arial'; font-size: 13px; font-style:normal; font-weight:normal; text-decoration:none" >
				</td>
              </tr>	
			  <tr class="odd">
				<th scope="row" class="column1">* 每坪單價</th>
				<td>
					<input type="field" name="obj[announce_unit_price]" value="<{$announce_unit_price|string_format:"%.2f"}>" id="announce_unit_price" class="number" style="background-color:#FFFFFF; text-align: right ; font-family:'Arial'; font-size: 16px; color:#ff0000; font-style:normal; font-weight:bold; text-decoration:none" />&nbsp;&nbsp;<span style="color:#0000FF; font-size:16px;">萬元 <strong>(公告底價/建物總坪數)</strong></span>
				</td>
			  </tr>
              <tr>
				<th scope="row" class="column1">* 拍定單價</th>
				<td>
					<span style="font-family:'Arial'; font-size: 16px; color:#ff0000; font-style:normal; "><strong>拍定價</strong></span><input type="field" name="obj[auction_price]" value="<{$auction_price}>" class="number" onBlur="calPrice('auction_price','total_area','unit_price')" id="auction_price" style="text-align: right ; font-family:'Arial'; font-size: 16px; color:#ff0000; font-style:normal; " />&nbsp;&nbsp;<span style="color:#0000FF; font-size:16px;">萬元</span>&nbsp;&nbsp;
					<span style="font-family:'Arial'; font-size: 16px; color:#ff0000; font-style:normal; "><strong>拍定單價</strong></span><input type="field" name="obj[unit_price]" value="<{$unit_price|string_format:"%.2f"}>" id="unit_price" class="number" style="background-color:#FFFFFF; text-align: right ; font-family:'Arial'; font-size: 16px; color:#ff0000; font-style:normal; font-weight:bold; text-decoration:none" />&nbsp;&nbsp;<span style="color:#0000FF; font-size:16px;">萬元 <strong>(拍定價/建物總坪數)</strong></span>
				</td>
              </tr>			  
		  </tbody>
        </table>
  </div>
  <div class="step" id="secondStep">
        <table summary="services">
			<thead>
			  <tr>
				<th colspan="2" align="left"><span class="addressRemind"></span>2.謄本資料</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">* 土地坪數</th>
				<td>
					<select  name="land[square_feet_result]" class="required" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#FF9900; font-style:normal; font-weight:normal; text-decoration:none">
						<OPTION value="" selected>--請選擇--</OPTION>
						<OPTION selected value="持分">持分</OPTION>
						<OPTION value="全部">全部</OPTION>
					</select>
					<input type="field" name="land[land_ping]" value="<{$land_ping}>" class="required number" />&nbsp;&nbsp;坪
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">* 土地增值稅</th>
				<td>
					<input type="radio" name="land[tax]" value="0" class="{required:true}"<{if $tax==0}> checked<{/if}> />無 
					&nbsp;&nbsp;
					<input type="radio" name="land[tax]" value="1" id="hasTax" class="{required:true}"<{if $tax==1}> checked<{/if}> />有
					&nbsp;&nbsp;
					<input type="field" name="land[tax_value]" value="<{$tax_value}>" class="{required:#hasTax:checked} number" onKeyup="showMsg(this.value)" />萬
					&nbsp;&nbsp;
					<input type="radio" name="land[tax]" value="2" class="{required:true}"<{if $tax==2}> checked<{/if}> />未確定
<div id="taxMsg" style="display:none"><span style="color:#000000; font-size:16px;">土地拍賣底價低於土地公告現值，將來移轉時需負擔土地增值稅。</span><span style=" font-family:'Verdana'; color:#000000; font-size:16px;">(</span><span style=" font-family:'\'b7\'73\'b2\'d3\'a9\'fa\'c5\'e9'; color:#009900; font-size:16px;">自用稅率</span><span style=" font-family:'Verdana'; color:#000000; font-size:16px;"> 10%</span><span style="color:#000000; font-size:16px;">；</span><span style="color:#FF6600; font-size:16px;">一般稅率</span><span style=" font-family:'Verdana'; color:#000000; font-size:16px;"> 20%, 30%, 40%)</span></div>
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">* 建物</th>
				<td>
					<span style="color:#006600; font-size:16px;">完工年份:</span>
						<input type="field" name="land[deadline]" class="required number" value="<{$deadline}>" />年&nbsp;&nbsp;&nbsp;&nbsp;
					<span style="color:#006600; font-size:16px;">結構:</span>
						<select name="land[structure]" class="required" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
							<OPTION value="">--請選擇--</OPTION>
							<OPTION value="SRC鋼骨"<{if $structure== "SRC鋼骨"}> selected<{/if}>>SRC鋼骨</OPTION>
							<OPTION value="SRC鋼筋"<{if $structure== "SRC鋼筋"}> selected<{/if}>>SRC鋼筋</OPTION>
							<OPTION value="RC鋼筋"<{if $structure== "RC鋼筋"}> selected<{/if}>>RC鋼筋</OPTION>
							<OPTION value="加強磚造"<{if $structure== "加強磚造"}> selected<{/if}>>加強磚造</OPTION>
							<OPTION value="其他"<{if $structure== "其他"}> selected<{/if}>>其他</OPTION>
						</SELECT>&nbsp;&nbsp;&nbsp;&nbsp;
					<span style="color:#006600; font-size:16px;">用途:</span>
						<select  name="land[usage]" class="required" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
							<OPTION value="">--請選擇--</OPTION>
							<OPTION value="商業用"<{if $usage== "商業用"}> selected<{/if}>>商業用</OPTION>
							<OPTION value="住家用"<{if $usage== "住家用"}> selected<{/if}>>住家用</OPTION>
							<OPTION value="國民住宅"<{if $usage== "國民住宅"}> selected<{/if}>>國民住宅</OPTION>
							<OPTION value="住商用"<{if $usage== "住商用"}> selected<{/if}>>住商用</OPTION>
							<OPTION value="住工用"<{if $usage== "住工用"}> selected<{/if}>>住工用</OPTION>
							<OPTION value="工業用"<{if $usage== "工業用"}> selected<{/if}>>工業用</OPTION>
							<OPTION value="工商用"<{if $usage== "工商用"}> selected<{/if}>>工商用</OPTION>
							<OPTION value="其他"<{if $usage== "其他"}> selected<{/if}>>其他</OPTION>
						</SELECT>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1"><span style="color:#0000FF; font-size:16px; font-weight:bold;">* 建物總坪數</font></th>
				<td><input type="field" name="land[total_area]" value="<{$total_area}>" class="required number" onBlur="calPrice('auction_price','total_area','unit_price');calPrice('auction_base_price','total_area','announce_unit_price')" id="total_area"  style="background-color:#FFFFFF; text-align: right ; font-family:'Arial'; font-size: 16px; color:#0000FF; font-style:normal; font-weight:bold; text-decoration:none" />坪</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">主建物</th>
				<td><input type="field" name="land[main_area]" value="<{$main_area}>" class="number" style="text-align: right ; font-family:'Arial'; color:#993300;" />坪</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">附屬建物</th>
				<td>
					<select  name="land[append_item][0]" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="陽台"<{if $append_item_1== "陽台"}> selected<{/if}>>陽台</OPTION>
						<OPTION value="平台"<{if $append_item_1== "平台"}> selected<{/if}>>平台</OPTION>
						<OPTION value="露台"<{if $append_item_1== "露台"}> selected<{/if}>>露台</OPTION>
						<OPTION value="騎樓"<{if $append_item_1== "騎樓"}> selected<{/if}>>騎樓</OPTION>
						<OPTION value="夾層"<{if $append_item_1== "夾層"}> selected<{/if}>>夾層</OPTION>
						<OPTION value="地下室"<{if $append_item_1== "地下室"}> selected<{/if}>>地下室</OPTION>
						<OPTION value="增建"<{if $append_item_1== "增建"}> selected<{/if}>>增建</OPTION>
						<OPTION value="公設"<{if $append_item_1== "公設"}> selected<{/if}>>公設</OPTION>
						<OPTION value="車位"<{if $append_item_1== "車位"}> selected<{/if}>>車位</OPTION>
					</SELECT>
					<input name="land[append_area][0]"  type="field" class="number" value="<{$append_area_1}>" style="text-align: right ; font-family:'Arial';" />
					<span style="color:#000000; font-size:16px;">坪&nbsp;&nbsp;</span>
					<select  name="land[append_item][1]" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="陽台"<{if $append_item_2== "陽台"}> selected<{/if}>>陽台</OPTION>
						<OPTION value="平台"<{if $append_item_2== "平台"}> selected<{/if}>>平台</OPTION>
						<OPTION value="露台"<{if $append_item_2== "露台"}> selected<{/if}>>露台</OPTION>
						<OPTION value="騎樓"<{if $append_item_2== "騎樓"}> selected<{/if}>>騎樓</OPTION>
						<OPTION value="夾層"<{if $append_item_2== "夾層"}> selected<{/if}>>夾層</OPTION>
						<OPTION value="地下室"<{if $append_item_2== "地下室"}> selected<{/if}>>地下室</OPTION>
						<OPTION value="增建"<{if $append_item_2== "增建"}> selected<{/if}>>增建</OPTION>
						<OPTION value="公設"<{if $append_item_2== "公設"}> selected<{/if}>>公設</OPTION>
						<OPTION value="車位"<{if $append_item_2== "車位"}> selected<{/if}>>車位</OPTION>
					</SELECT>
					<input name="land[append_area][1]"  type="field" value="<{$append_area_2}>" class="number" style="text-align: right ; font-family:'Arial';" />
					<span style="color:#000000; font-size:16px;">坪&nbsp;&nbsp;</span>
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">附屬建物</th>
				<td>
					<select  name="land[append_item][2]" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="陽台"<{if $append_item_3== "陽台"}> selected<{/if}>>陽台</OPTION>
						<OPTION value="平台"<{if $append_item_3== "平台"}> selected<{/if}>>平台</OPTION>
						<OPTION value="露台"<{if $append_item_3== "露台"}> selected<{/if}>>露台</OPTION>
						<OPTION value="騎樓"<{if $append_item_3== "騎樓"}> selected<{/if}>>騎樓</OPTION>
						<OPTION value="夾層"<{if $append_item_3== "夾層"}> selected<{/if}>>夾層</OPTION>
						<OPTION value="地下室"<{if $append_item_3== "地下室"}> selected<{/if}>>地下室</OPTION>
						<OPTION value="增建"<{if $append_item_3== "增建"}> selected<{/if}>>增建</OPTION>
						<OPTION value="公設"<{if $append_item_3== "公設"}> selected<{/if}>>公設</OPTION>
						<OPTION value="車位"<{if $append_item_3== "車位"}> selected<{/if}>>車位</OPTION>
					</SELECT>
					<input name="land[append_area][2]"  type="field" value="<{$append_area_3}>" class="number" style="text-align: right ; font-family:'Arial';" />
					<span style="color:#000000; font-size:16px;">坪&nbsp;&nbsp;</span>
					<select  name="land[append_item][3]" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="陽台"<{if $append_item_4== "陽台"}> selected<{/if}>>陽台</OPTION>
						<OPTION value="平台"<{if $append_item_4== "平台"}> selected<{/if}>>平台</OPTION>
						<OPTION value="露台"<{if $append_item_4== "露台"}> selected<{/if}>>露台</OPTION>
						<OPTION value="騎樓"<{if $append_item_4== "騎樓"}> selected<{/if}>>騎樓</OPTION>
						<OPTION value="夾層"<{if $append_item_4== "夾層"}> selected<{/if}>>夾層</OPTION>
						<OPTION value="地下室"<{if $append_item_4== "地下室"}> selected<{/if}>>地下室</OPTION>
						<OPTION value="增建"<{if $append_item_4== "增建"}> selected<{/if}>>增建</OPTION>
						<OPTION value="公設"<{if $append_item_4== "公設"}> selected<{/if}>>公設</OPTION>
						<OPTION value="車位"<{if $append_item_4== "車位"}> selected<{/if}>>車位</OPTION>
					</SELECT>
					<input name="land[append_area][3]"  type="field" value="<{$append_area_4}>" class="number" style="text-align: right ; font-family:'Arial';" />
					<span style="color:#000000; font-size:16px;">坪&nbsp;&nbsp;</span>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">附屬建物</th>
				<td>
					<select  name="land[append_item][4]" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="陽台"<{if $append_item_5== "陽台"}> selected<{/if}>>陽台</OPTION>
						<OPTION value="平台"<{if $append_item_5== "平台"}> selected<{/if}>>平台</OPTION>
						<OPTION value="露台"<{if $append_item_5== "露台"}> selected<{/if}>>露台</OPTION>
						<OPTION value="騎樓"<{if $append_item_5== "騎樓"}> selected<{/if}>>騎樓</OPTION>
						<OPTION value="夾層"<{if $append_item_5== "夾層"}> selected<{/if}>>夾層</OPTION>
						<OPTION value="地下室"<{if $append_item_5== "地下室"}> selected<{/if}>>地下室</OPTION>
						<OPTION value="增建"<{if $append_item_5== "增建"}> selected<{/if}>>增建</OPTION>
						<OPTION value="公設"<{if $append_item_5== "公設"}> selected<{/if}>>公設</OPTION>
						<OPTION value="車位"<{if $append_item_5== "車位"}> selected<{/if}>>車位</OPTION>
					</SELECT>
					<input name="land[append_area][4]"  type="field" value="<{$append_area_5}>" class="number" style="text-align: right ; font-family:'Arial';" />
					<span style="color:#000000; font-size:16px;">坪&nbsp;&nbsp;</span>
					<select  name="land[append_item][5]" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#000000; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="">--請選擇--</OPTION>
						<OPTION value="陽台"<{if $append_item_6== "陽台"}> selected<{/if}>>陽台</OPTION>
						<OPTION value="平台"<{if $append_item_6== "平台"}> selected<{/if}>>平台</OPTION>
						<OPTION value="露台"<{if $append_item_6== "露台"}> selected<{/if}>>露台</OPTION>
						<OPTION value="騎樓"<{if $append_item_6== "騎樓"}> selected<{/if}>>騎樓</OPTION>
						<OPTION value="夾層"<{if $append_item_6== "夾層"}> selected<{/if}>>夾層</OPTION>
						<OPTION value="地下室"<{if $append_item_6== "地下室"}> selected<{/if}>>地下室</OPTION>
						<OPTION value="增建"<{if $append_item_6== "增建"}> selected<{/if}>>增建</OPTION>
						<OPTION value="公設"<{if $append_item_6== "公設"}> selected<{/if}>>公設</OPTION>
						<OPTION value="車位"<{if $append_item_6== "車位"}> selected<{/if}>>車位</OPTION>
					</SELECT>
					<input name="land[append_area][5]"  type="field" value="<{$append_area_6}>" class="number" style="text-align: right ; font-family:'Arial';" />
					<span style="color:#000000; font-size:16px;">坪</span>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">附屬建物</th>
				<td>
					<input name="land[append_item][6]"  type="field" value="<{$append_item_7}>" />
					<input name="land[append_area][6]"  type="field" value="<{$append_area_7}>" class="number" style="text-align: right ; font-family:'Arial';" />
					<span style="color:#000000; font-size:16px;">坪</span>
				</td>
              </tr>	
            </tbody>
        </table>
	</div>
  <div class="step" id="thirdStep">
        <table summary="services">
			<thead>
			  <tr>
				<th colspan="2" align="left"><span class="addressRemind"></span>3.他項權利</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">銀行</th>
				<th scope="row" class="column1">金額</th>
              </tr>	
              <tr class="odd">
				<td>
					<input type="field" name="obj[bank_name][0]" value="<{$bank_name_1}>" />
				</td>
				<td>
					<input type="field" name="obj[bank_value][0]" value="<{$bank_value_1}>" class="number" />萬元
				</td>
              </tr>	
              <tr>
				<td>
					<input type="field" name="obj[bank_name][1]" value="<{$bank_name_2}>" />
				</td>
				<td>
					<input type="field" name="obj[bank_value][1]" value="<{$bank_value_2}>" class="number" />萬元
				</td>
              </tr>	
              <tr class="odd">
				<td>
					<input type="field" name="obj[bank_name][2]" value="<{$bank_name_3}>" />
				</td>
				<td>
					<input type="field" name="obj[bank_value][2]" value="<{$bank_value_3}>" class="number" />萬元
				</td>
              </tr>	
           </tbody>
		   <tr style="border-width:0 0 0 0;height:16px">
			<td colspan="2">&nbsp;</td>
		   </tr>
			<thead>
			  <tr>
				<th colspan="2" align="left">4.查封事項</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">查封日期</th>
				<th scope="row" class="column1">債權人</th>
              </tr>	
              <tr class="odd">
				<td>
					<input type="field" name="obj[seal_date]" value="<{math equation="century-1911" century=$seal_date|date_format:'%Y'}><{$seal_date|date_format:'-%m-%d'}>" id="datepicker3" maxlength="10" />
				</td>
				<td>
					<input type="text" name="obj[debtee]" value="<{$debtee}>" />
				</td>
              </tr>	
              <tr>
				<td colspan="2">
					筆錄<br />
					<{$content_editor}>
				</td>
              </tr>	
           </tbody>
        </table>
	</div>
  <div class="step" id="fifthStep">
        <table summary="services">
			<thead>
			  <tr>
				<th colspan="2" align="left"><span class="addressRemind"></span>5.其他資訊</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">捷運站</th>
				<td>
                    <select id="mrtLine" name="obj[mrtLine]" onChange="changeStation('mrtLine','mrtStation')">
					  <option value="">--請選擇--</option>
						<option style='background-color: #CC9900;' value="1">文山內湖線</option>
						<option style='background-color: #FD5B56;' value="2">淡水線</option>
						<option style='background-color: #CCFF99;' value="3">小南門線</option>
						<option style='background-color: #009900;' value="4">新店線</option>
						<option style='background-color: #FFCC66;' value="5">中和線</option>
						<option style='background-color: #398AFC;' value="6">板南線</option>
                    </select>&nbsp;&nbsp;
					<select id="mrtStation" name="obj[mrtStation]">
					  <option value="">--請選擇--</option>
					</select>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">社區名稱</th>
				<td>
					<input type="text" name="obj[community]" value="<{$community}>" />
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">管理費</th>
				<td>
                    <select name="obj[management_fee_type]" id="fee_type"> 
					  <option value="">--請選擇--</option>
					  <option value="每月">每月</option>
					  <option value="每坪">每坪</option>
					  <option value="每季">每季</option>
                    </select>&nbsp;&nbsp;
					<input type="field" name="obj[management_fee]" value="<{$management_fee}>" />元
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">房屋租金</th>
				<td>
                    <select name="obj[rent_type]" id="rent_type">                      
					  <option value="">--請選擇--</option>
					  <option value="每月">每月</option>
					  <option value="每坪">每坪</option>
                    </select>&nbsp;&nbsp;
					<input type="field" name="obj[rent_fee]" value="<{$rent_fee}>" />元
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">車位租金</th>
				<td>
                    <select name="obj[parking_type]" id="parking_type">                      
					  <option value="">--請選擇--</option>
					  <option value="平面">平面</option>
					  <option value="機械">機械</option>
                    </select>&nbsp;&nbsp;
					<input type="field" name="obj[parking_fee]" class="number" value="<{$parking_fee}>" />元
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">區域介紹</th>
				<td>
					<input type="file" name="obj[area_intro]" />&nbsp;&nbsp;
					<input type="text" name="obj[area_intro_desc]" value="<{if $area_intro_desc==''}>輸入圖片說明<{else}><{$area_intro_desc}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
		  </tbody>
        </table>
	</div>
  <div class="step" id="sixthStep">
        <table summary="services">
			<thead>
			  <tr>
				<th colspan="2" align="left"><span class="addressRemind"></span>6.附近拍定行情</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<td colspan="2">(1)</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">地址</th>
				<td>
					<input type="text" name="obj[quotations_addr][0]" value="<{$quotations_addr_1}>" />
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">類型</th>
				<td>
					<select name="obj[quotations_type][0]" id="quotations_type_1">
						<OPTION value="" selected>--請選擇--</OPTION>
						<OPTION value="大樓／住家">大樓／住家</OPTION>
						<OPTION value="大樓／住辦">大樓／住辦</OPTION>
						<OPTION value="大樓／套房">大樓／套房</OPTION>
						<OPTION value="公寓／住家">公寓／住家</OPTION>
						<OPTION value="公寓／一樓">公寓／一樓</OPTION>
						<OPTION value="公寓／別墅">公寓／別墅</OPTION>
						<OPTION value="商用／辦公">商用／辦公</OPTION>
						<OPTION value="商用／廠辦">商用／廠辦</OPTION>
						<OPTION value="店面／透天">店面／透天</OPTION>
						<OPTION value="店面／一樓">店面／一樓</OPTION>
						<OPTION value="透天／住家">透天／住家</OPTION>
						<OPTION value="透天／別墅">透天／別墅</OPTION>
						<OPTION value="透天／廠辦">透天／廠辦</OPTION>
						<OPTION value="其他／車位">其他／車位</OPTION>
					</select>
				</td>
              </tr>	
			  <tr class="odd">
				<th scope="row" class="column1">拍定日期</th>
				<td>
					<input type="field" name="obj[quotations_date][0]" id="datepicker4" maxlength="10" value="<{math equation="century-1911" century=$quotations_date_1|date_format:'%Y'}><{$quotations_date_1|date_format:'-%m-%d'}>" />
				</td>
			  </tr>
              <tr>
				<th scope="row" class="column1">拍次</th>
				<td>
					<select name="obj[quotations_times][0]" id="quotations_times_1" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#0000FF; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="" selected>--請選擇--</OPTION>
						<OPTION value="1拍" style="color:#0000FF">1拍</OPTION>
						<OPTION value="2拍" style="color:#0000FF">2拍</OPTION>
						<OPTION value="3拍" style="color:#0000FF">3拍</OPTION>
						<OPTION value="應買" style="color:#FF00FF">應買</OPTION>
						<OPTION value="特拍" style="color:#FF6600">特拍</OPTION>
					</select>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">拍定價金</th>
				<td>
					<input type="field" name="obj[quotations_price][0]" value="<{$quotations_price_1}>" id="qp1" onBlur="calPrice('qp1','area1', 'p1')" class="number" />&nbsp;&nbsp;萬元
				</td>
              </tr>				  
              <tr>
				<th scope="row" class="column1">總坪數</th>
				<td>
					<input type="field" name="obj[quotations_totalprice][0]" value="<{$quotations_totalprice_1}>" id="area1" onBlur="calPrice('qp1','area1', 'p1')" class="number" />&nbsp;&nbsp;坪
				</td>
              </tr>				  
              <tr class="odd">
				<th scope="row" class="column1">單價</th>
				<td>
					<input type="field" name="obj[quotations_unitprice][0]" value="<{$quotations_unitprice_1|string_format:"%.2f"}>" id="p1" class="number" />&nbsp;&nbsp;<span style="color:#0000FF; font-size:16px;">萬元 (拍定價金/建物總坪數)</span>
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">相片</th>
				<td>
					<{if $quotations_pic_1!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$quotations_pic_1}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[quotations_pic][0]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[quotations_pic][0]" value="" />&nbsp;&nbsp;
				</td>
              </tr>
              <tr>
				<td colspan="2">(2)</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">地址</th>
				<td>
					<input type="text" name="obj[quotations_addr][1]" value="<{$quotations_addr_2}>" />
				</td>
              </tr>	
              <tr>
				<th scope="row" class="column1">類型</th>
				<td>
					<select  name="obj[quotations_type][1]" id="quotations_type_2">
						<OPTION value="" selected>--請選擇--</OPTION>
						<OPTION value="大樓／住家">大樓／住家</OPTION>
						<OPTION value="大樓／住辦">大樓／住辦</OPTION>
						<OPTION value="大樓／套房">大樓／套房</OPTION>
						<OPTION value="公寓／住家">公寓／住家</OPTION>
						<OPTION value="公寓／一樓">公寓／一樓</OPTION>
						<OPTION value="公寓／別墅">公寓／別墅</OPTION>
						<OPTION value="商用／辦公">商用／辦公</OPTION>
						<OPTION value="商用／廠辦">商用／廠辦</OPTION>
						<OPTION value="店面／透天">店面／透天</OPTION>
						<OPTION value="店面／一樓">店面／一樓</OPTION>
						<OPTION value="透天／住家">透天／住家</OPTION>
						<OPTION value="透天／別墅">透天／別墅</OPTION>
						<OPTION value="透天／廠辦">透天／廠辦</OPTION>
						<OPTION value="其他／車位">其他／車位</OPTION>
					</select>
				</td>
              </tr>	
			  <tr class="odd">
				<th scope="row" class="column1">拍定日期</th>
				<td>
					<input type="field" name="obj[quotations_date][1]" id="datepicker5" maxlength="10" value="<{math equation="century-1911" century=$quotations_date_2|date_format:'%Y'}><{$quotations_date_2|date_format:'-%m-%d'}>" />
				</td>
			  </tr>
              <tr>
				<th scope="row" class="column1">拍次</th>
				<td>
					<select  name="obj[quotations_times][1]" id="quotations_times_2" style="background-color:#FFFFFF; text-align: left ; font-family:'Arial'; font-size: 13px; color:#0000FF; font-style:normal; font-weight:normal; text-decoration:none" >
						<OPTION value="" selected>--請選擇--</OPTION>
						<OPTION value="1拍" style="color:#0000FF">1拍</OPTION>
						<OPTION value="2拍" style="color:#0000FF">2拍</OPTION>
						<OPTION value="3拍" style="color:#0000FF">3拍</OPTION>
						<OPTION value="應買" style="color:#FF00FF">應買</OPTION>
						<OPTION value="特拍" style="color:#FF6600">特拍</OPTION>
					</select>
				</td>
              </tr>	
              <tr class="odd">
				<th scope="row" class="column1">拍定價金</th>
				<td>
					<input type="field" name="obj[quotations_price][1]" value="<{$quotations_price_2}>" id="qp2" onBlur="calPrice('qp2','area2', 'p2')" class="number" />&nbsp;&nbsp;萬元
				</td>
              </tr>				  
              <tr>
				<th scope="row" class="column1">總坪數</th>
				<td>
					<input type="field" name="obj[quotations_totalprice][]" value="<{$quotations_totalprice_2}>" id="area2" onBlur="calPrice('qp2','area2', 'p2')" class="number" />&nbsp;&nbsp;坪
				</td>
              </tr>				  
              <tr class="odd">
				<th scope="row" class="column1">單價</th>
				<td>
					<input type="field" name="obj[quotations_unitprice][1]" value="<{$quotations_unitprice_2|string_format:"%.2f"}>" id="p2" class="number" />&nbsp;&nbsp;<span style="color:#0000FF; font-size:16px;">萬元 (拍定價金/建物總坪數)</span>
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">相片</th>
				<td>
					<{if $quotations_pic_2!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$quotations_pic_2}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[quotations_pic][1]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[quotations_pic][1]" value="" />&nbsp;&nbsp;
				</td>
              </tr>
			</tbody>
        </table>
	</div>
  <div class="step" id="seventhStep">
        <table summary="services">
			<thead>
			  <tr>
				<th colspan="2" align="left"><span class="addressRemind"></span>7.即時房訊</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">檔案1</th>
				<td>
					<{if $house_pic_1!=""}>
						<span style="float:left;text-align:center">
							<a href="<{$file_path}><{$house_pic_1}>" /><{$house_pic_1}></a><br />
							<input type="checkbox" name="del[house_pic][0]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[house_pic][]" value="" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">檔案說明</th>
				<td>
					<input type="text" name="obj[house_desc][]" value="<{$house_desc_1}>" />
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">檔案2</th>
				<td>
					<{if $house_pic_2!=""}>
						<span style="float:left;text-align:center">
							<a href="<{$file_path}><{$house_pic_2}>" /><{$house_pic_2}></a><br />
							<input type="checkbox" name="del[house_pic][1]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[house_pic][]" value="" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">檔案說明</th>
				<td>
					<input type="text" name="obj[house_desc][]" value="<{$house_desc_2}>" />
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">檔案3</th>
				<td>
					<{if $house_pic_3!=""}>
						<span style="float:left;text-align:center">
							<a href="<{$file_path}><{$house_pic_3}>" /><{$house_pic_3}></a><br />
							<input type="checkbox" name="del[house_pic][2]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[house_pic][]" value="" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">檔案說明</th>
				<td>
					<input type="text" name="obj[house_desc][]" value="<{$house_desc_3}>" />
				</td>
              </tr>
			</tbody>
        </table>
	</div>
  <div class="step" id="eighthStep">
        <table summary="services">
			<thead>
			  <tr>
				<th colspan="2" align="left"><span class="addressRemind"></span>8.物件圖片</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">建物平面圖</th>
				<td>
					<{if $structure_pic_1!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$structure_pic_1}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[structure_pic][0]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[structure_pic][]" />&nbsp;&nbsp;
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">建物位置圖</th>
				<td>
					<{if $structure_pic_2!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$structure_pic_2}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[structure_pic][1]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[structure_pic][]" />&nbsp;&nbsp;
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">其他圖片</th>
				<td>
					<{if $structure_other_pic!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$structure_other_pic}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[structure_other_pic]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[structure_other_pic]" />&nbsp;&nbsp;<input type="text" name="obj[structure_desc]" value="<{if $structure_desc==''}>輸入圖片說明<{else}><{$structure_desc}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
		  </tbody>
		   <tr style="border-width:0 0 0 0;height:16px;background-color:#FFFFFF">
			<td colspan="2">&nbsp;</td>
		   </tr>
			<thead>
			  <tr>
				<th colspan="2" align="left">9.物件相片</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<th scope="row" class="column1">上傳圖片1</th>
				<td>
					<{if $pic_1!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_1}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][0]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_1==''}>輸入圖片說明<{else}><{$pic_desc_1}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">上傳圖片2</th>
				<td>
					<{if $pic_2!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_2}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][1]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_2==''}>輸入圖片說明<{else}><{$pic_desc_2}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">上傳圖片3</th>
				<td>
					<{if $pic_3!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_3}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][2]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_3==''}>輸入圖片說明<{else}><{$pic_desc_3}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">上傳圖片4</th>
				<td>
					<{if $pic_4!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_4}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][3]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_4==''}>輸入圖片說明<{else}><{$pic_desc_4}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">上傳圖片5</th>
				<td>
					<{if $pic_5!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_5}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][4]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_5==''}>輸入圖片說明<{else}><{$pic_desc_5}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">上傳圖片6</th>
				<td>
					<{if $pic_6!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_6}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][5]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_6==''}>輸入圖片說明<{else}><{$pic_desc_6}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
              <tr>
				<th scope="row" class="column1">上傳圖片7</th>
				<td>
					<{if $pic_7!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_7}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][6]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_7==''}>輸入圖片說明<{else}><{$pic_desc_7}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
              <tr class="odd">
				<th scope="row" class="column1">上傳圖片8</th>
				<td>
					<{if $pic_8!=""}>
						<span style="float:left;text-align:center">
							<img src="<{$file_path}><{$pic_8}>" width="120" height="80" /><br />
							<input type="checkbox" name="del[pic][7]" />刪除
						</span>
					<{/if}>
					<input type="file" name="obj[pic][]" />&nbsp;&nbsp;<input type="text" name="obj[pic_desc][]" value="<{if $pic_desc_8==''}>輸入圖片說明<{else}><{$pic_desc_8}><{/if}>" onFocus="if(this.value=='輸入圖片說明')this.value=''" onBlur="if(this.value=='')this.value='輸入圖片說明'" />
				</td>
              </tr>
		  </tbody>
        </table>
	</div>
  <div class="step" id="tenthStep">
        <table summary="services">
			<thead>
			  <tr>
				<th align="left"><span class="addressRemind"></span>10.物件研析</th>
			  </tr>
			</thead>
            <tbody>
              <tr>
				<td>
				<textarea rows="" cols="" name="obj[analysis_memo]"><{$analysis_memo}></textarea>
				</td>
              </tr>
		  </tbody>
        </table>
	</div>
	<p class="second">      
	<input type="reset" class="button100" value="Reset Form" />
	<input type="submit" class="button100" value="儲存拍賣公告" title=""/>
	</p><br />
	</form>
</div>