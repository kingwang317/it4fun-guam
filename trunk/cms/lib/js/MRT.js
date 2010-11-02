function changeStation(sourceObj, destObj) { 	
	k=1;
	var station = document.getElementById(sourceObj);
	j = station.selectedIndex;
	a=new Array(); 
	if(j==1) { 
		a[1]=new Option("動物園站","019");
		a[2]=new Option("木柵站","018");
		a[3]=new Option("萬芳社區站","017");
		a[4]=new Option("萬芳醫院站","016");
		a[5]=new Option("辛亥站","015");
		a[6]=new Option("麟光站","014");
		a[7]=new Option("六張犁站","013");
		a[8]=new Option("科技大樓站","012");
		a[9]=new Option("大安站","011");
		a[10]=new Option("忠孝復興站","010");
		a[11]=new Option("南京東路站","009");
		a[12]=new Option("中山國中站","008");
		a[13]=new Option("松山機場站","007");
		a[14]=new Option("大直站","021");
		a[15]=new Option("劍南路站","022");
		a[16]=new Option("西湖站","023");
		a[17]=new Option("港墘站","024");
		a[18]=new Option("文德站","025");
		a[19]=new Option("內湖站","026");
		a[20]=new Option("大湖公園站","027");
		a[21]=new Option("葫洲站","028");
		a[22]=new Option("東湖站","029");
		a[23]=new Option("南港軟體園區站","030");
		a[24]=new Option("南港展覽館站","031");
	}
	if(j==2){
		a[1]=new Option("淡水站","071");
		a[2]=new Option("紅樹林站","070");
		a[3]=new Option("竹圍站","069");
		a[4]=new Option("關渡站","068");
		a[5]=new Option("忠義站","067");
		a[6]=new Option("復興崗站","066");
		a[7]=new Option("新北投站","065");
		a[8]=new Option("北投站","064");
		a[9]=new Option("奇岩站","063");
		a[10]=new Option("唭哩岸站","062");
		a[11]=new Option("石牌站","061");
		a[12]=new Option("明德站","060");
		a[13]=new Option("芝山站","059");
		a[14]=new Option("士林站","058");
		a[15]=new Option("劍潭站","057");
		a[16]=new Option("圓山站","056");
		a[17]=new Option("民權西路站","055");
		a[18]=new Option("雙連站","054");
		a[19]=new Option("中山站","053");
		a[20]=new Option("台北車站","051");
		a[21]=new Option("台大醫院站","050");
		a[22]=new Option("中正紀念堂站","042");
	}
	if(j==3){
		a[1] = new Option("小南門站","043");
	}
	if(j==4){
		a[1]=new Option("古亭站","041");
		a[2]=new Option("台電大樓站","040");
		a[3]=new Option("公館站","039");
		a[4]=new Option("萬隆站","038");
		a[5]=new Option("景美站","037");
		a[6]=new Option("大坪林站","036");
		a[7]=new Option("七張站","035");
		a[8]=new Option("新店市公所站","034");
		a[9]=new Option("新店站","033");
		a[10]=new Option("小碧潭站","032");
	}
	if(j==5){
		a[1]=new Option("頂溪站","045");
		a[2]=new Option("永安市場站","046");
		a[3]=new Option("景安站","047");
		a[4]=new Option("南勢角站","048");
	}
	if(j==6){
		a[1] = new Option("南港站","097");
		a[2] = new Option("昆陽站","096");
		a[3] = new Option("後山埤站","095");
		a[4] = new Option("永春站","094");
		a[5] = new Option("市政府站","093");
		a[6] = new Option("國父紀念館站","092");
		a[7] = new Option("忠孝敦化站","091");
		a[8] = new Option("忠孝復興站","010");
		a[9] = new Option("忠孝新生站","089");
		a[10] = new Option("善導寺站","088");
		a[11] = new Option("台北車站","051");
		a[12] = new Option("西門站","086");
		a[13] = new Option("龍山寺站","085");
		a[14] = new Option("江子翠站","084");
		a[15] = new Option("新埔站","083");
		a[16] = new Option("板橋站","082");
		a[17] = new Option("府中站","081");
		a[18] = new Option("亞東醫院站","080");
		a[19] = new Option("海山站","079");
		a[20] = new Option("土城站","078");
		a[21] = new Option("永寧站","077");
	}
	var subStation = document.getElementById(destObj);

	for (i=subStation.length-1;i>0;i--) {
		subStation.remove(i);
	}
	for(i = 1 ; i < a.length ; i++){
		subStation.add(a[i],null);
	}
}		