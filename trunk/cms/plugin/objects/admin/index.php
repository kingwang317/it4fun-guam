<?php
/*
模組參數
套件名稱：物件管理
開發人：Max Clapton
*/

class objects{
	private $tmpl_path = "/cms/plugin/objects/admin/tmpl/";
	private $plu_path = "?pluName=objects&pluAdmin=admin/index.php";
	private $plu_subpath = "?pluName=objects&pluAdmin=admin/sub.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/objects/";
	private $plu_Cname = "物件管理";
	private $img_path = "/cms/plugin/objects/admin/image/";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("objects");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_add_objects":
				$this->do_add_objects();
				return false;
			case "do_edit_objects":
				$this->do_edit_objects();
				return false;
			case "do_del_objects":
				$this->do_del_objects();
				return false;
			case "check_address":
				$this->checkAddress();
				return false;
			case "check_auction":
				$this->checkAuction();
				return false;
			case "show_add_objects":
				$content = $this->show_add_objects();
				return true;
			case "show_edit_objects":
				$content = $this->show_edit_objects();
				return true;
			default:
				$content = $this->show_objects_list();
				return true;
		}
		return false;
	}

	function checkAddress(){
		echo $this->hasAddress($_GET['district'], $_GET['obj_addr'], isset($_GET['object_id'])?$_GET['object_id']:null);
	}
	
	function hasAddress($district, $addr, $object_id=null){
		$db = init_db();

		$sql = "SELECT COUNT(*) FROM plu_objects WHERE district=".$district." AND obj_addr='".$addr."'";
		if(isset($object_id)){
			$sql.=" AND object_id<>".$object_id;
		}
		
		return $db->get_var($sql);
	}
	
	function checkAuction(){
		echo $this->hasAuctionNumber($_GET['auction_no'], isset($_GET['object_id'])?$_GET['object_id']:null);
	}
	
	function hasAuctionNumber($auction_no, $object_id=null){
		$db = init_db();
//		$district = $_GET['district'];
//		$addr = $_GET['obj_addr'];

//		$sql = "SELECT COUNT(*) FROM plu_objects WHERE district=".$district." AND obj_addr='".$addr."' AND auction_no=".$auction_no;
		$sql = "SELECT COUNT(*) FROM plu_objects WHERE auction_no='".$auction_no."'";
		if(isset($object_id)){
			$sql.=" AND object_id<>".$object_id;
		}
		return $db->get_var($sql);		
	}
	
	function setFilterValue(&$strFilter, $filterValue){
		if(empty($strFilter))
			$strFilter=" WHERE ".$filterValue;
		else
			$strFilter.=" AND ".$filterValue;
	}

	function show_objects_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "物件管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);
		$county= array(0,'台北市','基隆市','台北縣','宜蘭縣',
					'桃園縣','新竹市','新竹縣','苗栗縣','台中市','台中縣',
					'彰化縣','南投縣','嘉義市','嘉義縣','雲林縣','台南市',
					'台南縣','高雄市','高雄縣','澎湖縣','屏東縣','台東縣',
					'花蓮縣','金門縣','連江縣','海南諸島');
		$district = array('100'=>'中正區','103'=>'大同區','104'=>'中山區','105'=>'松山區','106'=>'大安區','108'=>'萬華區','110'=>'信義區','111'=>'士林區','112'=>'北投區','114'=>'內湖區','115'=>'南港區','116'=>'文山區',
'200'=>'仁愛區','201'=>'信義區','202'=>'中正區','203'=>'中山區','204'=>'安樂區','205'=>'暖暖區','206'=>'七堵區',
'207'=>'萬里鄉','208'=>'金山鄉','220'=>'板橋市','221'=>'汐止市','222'=>'深坑鄉','223'=>'石碇鄉','224'=>'瑞芳鎮','226'=>'平溪鄉','227'=>'雙溪鄉','228'=>'貢寮鄉',
'231'=>'新店市','232'=>'坪林鄉','233'=>'烏來鄉','234'=>'永和市','235'=>'中和市','236'=>'土城市','237'=>'三峽鎮','238'=>'樹林市','239'=>'鶯歌鎮','241'=>'三重市',
'242'=>'新莊市','243'=>'泰山鄉','244'=>'林口鄉','247'=>'蘆洲市','248'=>'五股鄉','249'=>'八里鄉','251'=>'淡水鎮','252'=>'三芝鄉','253'=>'石門鄉',
'260'=>'宜蘭市','261'=>'頭城鎮','262'=>'礁溪鄉','263'=>'狀圍鄉','264'=>'員山鄉','265'=>'羅東鎮','266'=>'三星鄉','267'=>'大同鄉','268'=>'五結鄉','269'=>'冬山鄉','270'=>'蘇澳鄉','272'=>'南澳鄉',
'320'=>'中壢市','324'=>'平鎮市','325'=>'龍潭鄉','326'=>'楊梅鎮','327'=>'新屋鄉','328'=>'觀音鄉','330'=>'桃園市','333'=>'龜山鄉','334'=>'八德市','335'=>'大溪鎮','336'=>'復興鄉','337'=>'大圍鄉','338'=>'蘆竹鄉',
'300'=>'新竹市',
'302'=>'竹北市','303'=>'湖口鄉','304'=>'新豐鄉','305'=>'新埔鎮','306'=>'關西鎮','307'=>'芎林鄉','308'=>'寶山鄉','310'=>'竹東鎮','311'=>'五峰鄉','312'=>'橫山鄉','313'=>'尖石鄉','314'=>'北埔鄉','315'=>'峨眉鄉',
'350'=>'竹南鎮','351'=>'頭份鎮','352'=>'三灣鄉','353'=>'南庄鄉','354'=>'獅潭鄉','356'=>'後龍鎮','357'=>'通宵鎮','358'=>'苑裡鎮','360'=>'苗栗市','361'=>'造橋鄉','362'=>'頭屋鄉','363'=>'公館鄉','364'=>'大湖鄉','365'=>'泰安鄉','366'=>'銅鑼鄉','367'=>'三義鄉','368'=>'西湖鄉','369'=>'卓蘭鎮',
'400'=>'中區','401'=>'東區','402'=>'南區','403'=>'西區','404'=>'北區','406'=>'北屯區','407'=>'西屯區','408'=>'南屯區',
'411'=>'太平市','412'=>'大里市','413'=>'霧峰鄉','414'=>'烏日鄉','420'=>'豐原市','421'=>'后里鄉','422'=>'石岡鄉','423'=>'東勢鎮','424'=>'和平鄉','426'=>'新社鄉','427'=>'潭子鄉','428'=>'大雅鄉','429'=>'神岡鄉','432'=>'大肚鄉','433'=>'沙鹿鎮','434'=>'龍井鄉','435'=>'梧棲鎮','436'=>'清水鎮','437'=>'大甲鎮','438'=>'外埔鄉','439'=>'大安鄉',
'500'=>'彰化市','502'=>'芬園鄉','503'=>'花壇鄉','504'=>'秀水鄉','505'=>'鹿港鎮','506'=>'福興鄉','507'=>'線西鄉','508'=>'和美鎮','509'=>'伸港鄉','510'=>'員林鎮','511'=>'社頭鄉','512'=>'永靖鄉','513'=>'埔心鄉','514'=>'溪湖鎮','515'=>'大村鄉','516'=>'埔鹽鄉','520'=>'田中鎮','521'=>'北斗鎮','522'=>'田尾鄉','523'=>'埤頭鄉','524'=>'溪州鄉','525'=>'竹塘鄉','526'=>'二林鎮','527'=>'大城鄉','528'=>'芳苑鄉','600'=>'二水鄉',
'540'=>'南投市','541'=>'中寮鄉','542'=>'草屯鎮','544'=>'國姓鄉','545'=>'埔里鎮','546'=>'仁愛鄉','551'=>'名間鄉','552'=>'集集鎮','553'=>'水里鄉','555'=>'魚池鄉','556'=>'信義鄉','557'=>'竹山鎮','558'=>'鹿谷鄉',
'600'=>'嘉義市',
'602'=>'番路鄉','603'=>'梅山鄉','604'=>'竹崎鄉','605'=>'阿里山鄉','606'=>'中埔鄉','607'=>'大埔鄉','608'=>'水上鄉','611'=>'鹿草鄉','612'=>'太保市','613'=>'朴子市','614'=>'東石鄉','615'=>'六腳鄉','616'=>'新港鄉','621'=>'民雄鄉','622'=>'大林鎮','623'=>'溪口鄉','624'=>'義竹鄉','625'=>'布袋鎮',
'630'=>'斗南鎮','631'=>'大埤鄉','632'=>'虎尾鎮','633'=>'土庫鎮','634'=>'褒忠鄉','635'=>'東勢鄉','636'=>'臺西鄉','637'=>'崙背鄉','638'=>'麥寮鄉','640'=>'斗六市','643'=>'林內鄉','646'=>'古坑鄉','647'=>'薊桐鄉','648'=>'西螺鎮','649'=>'二崙鄉','651'=>'北港鎮','652'=>'水林鄉','653'=>'口湖鄉','654'=>'四湖鄉','655'=>'元長鄉',
'700'=>'中區','701'=>'東區','702'=>'南區','703'=>'西區','704'=>'北區','708'=>'安平區','709'=>'安南區',
'710'=>'永康市','711'=>'歸仁鄉','712'=>'新化鎮','713'=>'左鎮鄉','714'=>'玉井鄉','715'=>'楠西鄉','716'=>'南化鄉','717'=>'仁德鄉','718'=>'關廟鄉','719'=>'龍崎鄉','720'=>'官田鄉','721'=>'麻豆鎮','722'=>'佳里鎮','723'=>'西港鄉','724'=>'七股鄉','725'=>'將軍鄉','726'=>'學甲鎮','727'=>'北門鄉','730'=>'新營市','731'=>'後壁鄉','732'=>'白河鎮','733'=>'東山鄉','734'=>'六甲鄉','735'=>'下營鄉','736'=>'柳營鄉','737'=>'鹽水鎮','741'=>'善化鎮','742'=>'大內鄉','743'=>'山上鄉','744'=>'新市鄉','745'=>'安定鄉',
'800'=>'新興區','801'=>'前金區','802'=>'苓雅區','803'=>'鹽埕區','804'=>'鼓山區','805'=>'旗津區','806'=>'前鎮區','807'=>'三民區','811'=>'楠梓區','812'=>'小港區','813'=>'左營區',
'814'=>'仁武鄉','815'=>'大社鄉','820'=>'岡山鎮','821'=>'路竹鄉','822'=>'阿蓮鄉','823'=>'田寮鄉','824'=>'燕巢鄉','825'=>'橋頭鄉','826'=>'梓官鄉','827'=>'彌陀鄉','828'=>'永安鄉','829'=>'湖內鄉','830'=>'鳳山市','831'=>'大寮鄉','832'=>'林園鄉','833'=>'鳥松鄉','840'=>'大樹鄉','842'=>'旗山鎮','843'=>'美濃鎮','844'=>'六龜鄉','845'=>'內門鄉','846'=>'杉林鄉','847'=>'甲仙鄉','848'=>'桃源鄉','849'=>'三民鄉','851'=>'茂林鄉','852'=>'茄萣鄉',
'880'=>'馬公市','881'=>'西嶼鄉','882'=>'望安鄉','883'=>'七美鄉','884'=>'白沙鄉','885'=>'湖西鄉',
'900'=>'屏東市','901'=>'三地門鄉','902'=>'霧臺鄉','903'=>'瑪家鄉','904'=>'九如鄉','905'=>'里港鄉','906'=>'高樹鄉','907'=>'鹽埔鄉','908'=>'長治鄉','909'=>'麟洛鄉','911'=>'竹田鄉','912'=>'內埔鄉','913'=>'萬丹鄉','920'=>'潮州鎮','921'=>'泰武鄉','922'=>'來義鄉','923'=>'萬巒鄉','924'=>'崁頂鄉','925'=>'新埤鄉','926'=>'南州鄉','927'=>'林邊鄉','928'=>'東港鎮','929'=>'琉球鄉','931'=>'佳冬鄉','932'=>'新園鄉','940'=>'枋寮鄉','941'=>'枋山鄉','942'=>'春日鄉','943'=>'獅子鄉','944'=>'車城鄉','945'=>'牡丹鄉','946'=>'恆春鎮','947'=>'滿州鄉',
'950'=>'臺東市','951'=>'綠島鄉','952'=>'蘭嶼鄉','953'=>'延平鄉','954'=>'卑南鄉','955'=>'鹿野鄉','956'=>'關山鎮','957'=>'海端鄉','958'=>'池上鄉','959'=>'東河鄉','961'=>'成功鎮','962'=>'長濱鄉','963'=>'太麻里鄉','964'=>'金峰鄉','965'=>'大武鄉','966'=>'達仁鄉',
'970'=>'花蓮市','971'=>'新城鄉','972'=>'秀林鄉','973'=>'吉安鄉','974'=>'壽豐鄉','975'=>'鳳林鎮','976'=>'光復鄉','977'=>'豐濱鄉','978'=>'瑞穗鄉','979'=>'萬榮鄉','981'=>'玉里鎮','982'=>'卓溪鄉','983'=>'富里鄉',
'891'=>'金湖鎮','892'=>'金寧鄉','893'=>'金城鎮','894'=>'烈嶼鄉','896'=>'烏坵鄉',
'209'=>'南竿','210'=>'北竿','211'=>'莒光','212'=>'東引',
'817'=>'東沙','819'=>'南沙','290'=>'釣魚台');
		$searchStr = "";
		$filter = "";
		$order = "";
		if(isset($_POST['searchbtn'])){
			if(!empty($_POST['county']) && preg_match("/^[0-9]*$/", $_POST["county"])){
				$this->setFilterValue($filter , "county=".$_POST['county']);
				$searchStr = $county[$_POST['county']].",";
			}
			if(!empty($_POST['district']) && preg_match("/^[0-9]*$/", $_POST["district"])){
				$this->setFilterValue($filter , "district=".$_POST['district']);
				$searchStr.=$district[$_POST['district']].",";
			}
			if(!empty($_POST['auction_no'])){
				$this->setFilterValue($filter , "auction_no LIKE '%".htmlspecialchars($_POST['auction_no']."%'"));
				$searchStr.=htmlspecialchars($_POST['auction_no']).",";
			}
			if(!empty($_POST['beginDate']) && preg_match("/^[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}$/", $_POST['beginDate'])){
				$searchStr.=$_POST['beginDate'];
				$_POST['beginDate'] = $this->formatDate($_POST['beginDate']);
				$this->setFilterValue($filter , "auction_date>='".$_POST['beginDate']."'");
			}
			if(!empty($_POST['endDate']) && preg_match("/^[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}$/", $_POST['endDate'])){
				$searchStr.="-".$_POST['endDate'].",<BR />";
				$_POST['endDate'] = $this->formatDate($_POST['endDate']);
				$this->setFilterValue($filter , "auction_date<='".$_POST['endDate']."'");
			}else{
				$searchStr.="-<BR />";
			}
			if(!empty($_POST['addr'])){
				$this->setFilterValue($filter , "obj_addr LIKE '%".htmlspecialchars($_POST['addr']."%'"));
				$searchStr.=sprintf('%7s',$_POST['addr'])."...,";
			}
			$searchStr.="未放置";
			if(!empty($_POST['unplaced_land'])&&$_POST['unplaced_land']=='land'){
				$this->setFilterValue($filter , "b.total_area=0");
				$searchStr.="謄本、";
			}
			if(!empty($_POST['unplaced_pic'])&&$_POST['unplaced_pic']=='pic'){
				$this->setFilterValue($filter , "c.pha IS NULL ");
				$searchStr.="相片、";
			}
			if(!empty($_POST['unplaced_struct'])&&$_POST['unplaced_struct']=='structure'){
				$this->setFilterValue($filter , "e.hoa IS NULL ");
				$searchStr.="平面圖";
			}
			if(!empty($_POST['unplaced_market'])&&$_POST['unplaced_market']=='market'){
				$this->setFilterValue($filter , "quotations_addr_1 = '' AND quotations_addr_2 ='' ");
				$searchStr.="行情";
			}
			if(!empty($_POST['unplaced_info'])&&$_POST['unplaced_info']=='info'){
				$this->setFilterValue($filter , "d.pia IS NULL ");
				$searchStr.="房訊";
			}
			
			$_SESSION['filter'] = $filter;
		}else if(!empty($_GET['page']) && isset($_SESSION['filter']) && !empty($_SESSION['filter'])){
			$filter=$_SESSION['filter'];
		}
		if(isset($_GET['OPT'])){
			switch($_GET['OPT']){
				case 2:
					$order = "auction_date";
					break;
				case 3:
					$order = "auction_times";
					break;
				case 4:
					$order = "auction_times DESC";
					break;
				case 5:
					$order = "object_id";
					break;
				case 6:
					$order = "object_id DESC";
					break;
				default:
					$order = "auction_date DESC";
			}
			$order = " ORDER BY ".$order;
		}else{
			$order = " ORDER BY auction_date DESC";
		}

		$dataTotal = $db->get_var("SELECT COUNT(*) FROM plu_objects a JOIN plu_objects_household b ON a.object_id=b.object_id
LEFT JOIN (SELECT object_id,COUNT(item) as pha FROM plu_objects_pic WHERE item LIKE 'pic_%' GROUP BY object_id) c ON (a.object_id=c.object_id)
LEFT JOIN (SELECT object_id,COUNT(item) as pia FROM plu_objects_pic WHERE item LIKE 'house_pic_%' GROUP BY object_id) d ON (a.object_id=d.object_id)
LEFT JOIN (SELECT object_id,COUNT(item) as hoa FROM plu_objects_pic WHERE item LIKE 'structure_%' GROUP BY object_id) e ON (a.object_id=e.object_id) ".$filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT a.*,IFNULL(b.total_area, 0) as total_area,IFNULL(c.pha, 0) as photo_amount,IFNULL(d.pia,0) as pic_amount,IFNULL(e.hoa,0) as house_amount FROM plu_objects a JOIN plu_objects_household b ON a.object_id=b.object_id
LEFT JOIN (SELECT object_id,COUNT(item) as pha FROM plu_objects_pic WHERE item LIKE 'pic_%' GROUP BY object_id) c ON (a.object_id=c.object_id)
LEFT JOIN (SELECT object_id,COUNT(item) as pia FROM plu_objects_pic WHERE item LIKE 'house_pic_%' GROUP BY object_id) d ON (a.object_id=d.object_id)
LEFT JOIN (SELECT object_id,COUNT(item) as hoa FROM plu_objects_pic WHERE item LIKE 'structure_%' GROUP BY object_id) e ON (a.object_id=e.object_id) ";
		$sql.= $filter.$order." LIMIT $dataStart, $dataLen";
//		echo $sql."<BR />";
		$result = $db->get_results($sql, ARRAY_A);
		$newArray = array();
		$i = 0;
		if(isset($result) && count($result)>0){
			foreach($result as $row){
				$newArray[$i] = array();
				foreach($row as $key => $value){
					if($key == "county"){
						$newArray[$i][$key] = $county[$value];
					}else if($key == "district"){
						$newArray[$i][$key] = $district[$value];
					}else{
						$newArray[$i][$key] = $value;
					}
				}
				$i++;
			}
		}
		
		$tpl->assign("searchStr", $searchStr);
		$tpl->assign("show_objects_list_url", $this->plu_path."&func=show_objects_list");
		$tpl->assign("OPT", isset($_GET['OPT'])?intval($_GET['OPT']):1);
		$tpl->assign("objects_data", $newArray);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("show_add_objects_link", $this->plu_path."&func=show_add_objects");
		$tpl->assign("datepicker_url", WEBROOT.'/cms/lib/js/chineseDatepicker.js');
		$tpl->assign("show_add_objects_category", $this->plu_subpath."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("img_path", WEBROOT.$this->img_path);
		$tpl->assign("show_edit_objects_link" , $this->plu_path."&func=show_edit_objects&object_id=");
		$tpl->assign("do_del_objects_link" , $this->plu_path."&func=do_del_objects&object_id=");
		return $tpl->fetch("show_objects_list.tpl");
	}
	
	function do_del_objects(){
		$db = init_db();
		$object_id = isset($_GET['object_id'])?$_GET['object_id']:"";
		if(!(isset($_GET['object_id']) && preg_match("/^[0-9]*$/", $_GET['object_id']))){
			redirect($this->plu_path."&func=show_objects_list", 0, "你所要刪除的物件不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_objects WHERE object_id = $object_id ";
		$db->query($sql);
		$sql  = "DELETE FROM plu_objects_household WHERE object_id = $object_id ";
		$db->query($sql);
		$sql  = "DELETE FROM plu_objects_pic WHERE object_id = $object_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_objects_list", 0, "刪除已完成");
	}

	function show_add_objects(){
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;

		//加入麵包屑
		$func_Cname = "新增物件";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);

		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('obj[memo]');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置

		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("wizard_url", WEBROOT.'/cms/lib/jquery/jquery.form.wizard.js');
		$tpl->assign("history_url", WEBROOT.'/cms/lib/jquery/jquery.history.js');
		$tpl->assign("mrt_url", WEBROOT.'/cms/lib/js/MRT.js');
		$tpl->assign("form_url", WEBROOT.'/cms/lib/jquery/jquery.form.js');
		$tpl->assign("check_address_url", $this->plu_path."&cmsroot=get_data&func=check_address");
		$tpl->assign("check_auction_url", $this->plu_path."&cmsroot=get_data&func=check_auction");
		$tpl->assign("datepicker_url", WEBROOT.'/cms/lib/js/chineseDatepicker.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_add_objects_url" , $this->plu_path."&func=do_add_objects");
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_objects_list");
		return $tpl->fetch("show_add_objects.tpl");
	}
	
	function formatDate($value){
		if(!empty($value) && preg_match("/^[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}$/", $value)){
			list($year, $month, $day) = split('[/.-]',$value);
			return ($year+1911).'-'.$month.'-'.$day;
		}else{
			return '';
		}
	}
	
	function do_add_objects(){
		$db = init_db();
		$sql = "INSERT INTO plu_objects SET ";
		$i;
		foreach($_POST['obj'] as $key => &$v){
			if(is_array($v)){
				$i = 1;
				foreach($v as &$subV){
					if(strpos($key,'date')){
						$subV = $this->formatDate($subV);
					}
					if($subV == "輸入圖片說明")
						$subV="";
					$sql.="`".$key."_".$i."`='".htmlspecialchars($subV)."',";
					$i++;
				}
			}else{
				if(strpos($key,'date')){
					$v = $this->formatDate($v);
				}
				if($v == "輸入圖片說明")
					$v = "";
				else if($key == "auction_date"){
					$v.=" ".$_POST['obj']['auction_time'];
				}else if($key == "auction_time")
					continue;
				$sql.="`".$key."`='".htmlspecialchars($v)."',";
			}
		}
		$sql.="`ModiTime`=NOW()";
		//$sql = substr($sql,0,-1);
		$db->query($sql);
		$sql = "SELECT last_insert_id()";
		$id = $db->get_var($sql);
		
		//戶籍謄本
		$sql = "INSERT INTO plu_objects_household SET ";
		foreach($_POST['land'] as $key => &$v){
			if(is_array($v)){
				$i = 1;
				foreach($v as &$subV){
					$sql.="`".$key."_".$i."`='".htmlspecialchars($subV)."',";
					$i++;
				}
			}else{
				if($key=="append_item"){
					$sql.="`append_item_7`='".htmlspecialchars($v)."',";
				}else{
					$sql.="`".$key."`='".htmlspecialchars($v)."',";
				}
			}
		}
		$sql.="`object_id`=".$id;
		$db->query($sql);

		foreach($_FILES['obj']['name'] as $key => $file){
			if(is_array($file)){
				foreach($file as $key2 => $file2){
					if($_FILES['obj']["size"][$key][$key2] && $_FILES['obj']["error"][$key][$key2] == UPLOAD_ERR_OK){
						$tmp_name = $_FILES['obj']["tmp_name"][$key][$key2];
						$filename = $_FILES['obj']["name"][$key][$key2];
						$name = "objects_".$id."_".$key."_".($key2+1).substr($filename, strrpos($filename, "."));
						move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
						$sql = "INSERT INTO plu_objects_pic(object_id,item,filename) VALUES (".$id.",'".$key."_".($key2+1)."','".$name."')";
						$db->query($sql);
					}
				}
			}else{
				if($_FILES['obj']["size"][$key] && $_FILES['obj']["error"][$key] == UPLOAD_ERR_OK){
					$tmp_name = $_FILES['obj']["tmp_name"][$key];
					$filename = $_FILES['obj']["name"][$key];
					$name = "objects_".$id."_".$key.substr($filename, strrpos($filename, "."));
					move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
					$sql = "INSERT INTO plu_objects_pic(object_id,item,filename) VALUES (".$id.",'".$key."','".$name."')";
					$db->query($sql);
				}
			}
		}
		redirect($this->plu_path."&func=show_objects_list", 0, "新增完成");
	}
	
	function show_edit_objects(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;

		//加入麵包屑
		$func_Cname = "變更物件";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$object_id = isset($_GET['object_id'])?$_GET['object_id']:"";
		$sql = "SELECT * FROM plu_objects a WHERE a.object_id=$object_id";
		$result = $db->get_row($sql, ARRAY_A);

		require_once(SRVROOT.FCK.'fckeditor.php');
		$fckeditor = new FCKeditor('obj[memo]');
		$fckeditor->Width  = '100%' ;
		$fckeditor->Height = '400px' ;
		$fckeditor->BasePath = WEBROOT.FCK;  //3.重要參數： 以 url路徑指定 FCKeditor 主程式所在位置
		$fckeditor->Value = htmlspecialchars_decode($result["memo"]);
		$tpl->assign("content_editor", $fckeditor->CreateHtml());
		
		foreach($result as $key => $value){
			$tpl->assign($key, htmlspecialchars_decode($value));
		}
		$sql = "SELECT * FROM plu_objects_household a WHERE a.object_id=$object_id";
		$result = $db->get_row($sql, ARRAY_A);
		foreach($result as $key => $value){
			if($key == "object_id")
				continue;
			$tpl->assign($key, htmlspecialchars_decode($value));
		}
		$sql = "SELECT * FROM plu_objects_pic a WHERE a.object_id=$object_id";
		$result = $db->get_results($sql, ARRAY_A);
		$tpl->assign("file_path", WEBROOT.$this->upload_path);
		for($i = 0 ; $i < count($result); $i++){
			$tpl->assign($result[$i]['item'], $result[$i]['filename']);
		}

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("wizard_url", WEBROOT.'/cms/lib/jquery/jquery.form.wizard.js');
		$tpl->assign("history_url", WEBROOT.'/cms/lib/jquery/jquery.history.js');
		$tpl->assign("mrt_url", WEBROOT.'/cms/lib/js/MRT.js');
		$tpl->assign("form_url", WEBROOT.'/cms/lib/jquery/jquery.form.js');
		$tpl->assign("datepicker_url", WEBROOT.'/cms/lib/js/chineseDatepicker.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("check_address_url", $this->plu_path."&cmsroot=get_data&func=check_address&object_id=".$object_id);
		$tpl->assign("check_auction_url", $this->plu_path."&cmsroot=get_data&func=check_auction&object_id=".$object_id);
		$tpl->assign("do_edit_objects_url" , $this->plu_path."&func=do_edit_objects&object_id=".$object_id);
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_objects_list");
		return $tpl->fetch("show_edit_objects.tpl");
	}
	function do_edit_objects(){
		$db = init_db();
		if(!(isset($_GET["object_id"]) && preg_match("/^[0-9]*$/", $_GET["object_id"]))){
			redirect($this->plu_path."&func=show_objects_list", 0, "你所要訂單編號不合法");
			exit;
		}
		$object_id = $_GET["object_id"];
		$filter = " WHERE object_id=".$object_id;
		$i;
		if(isset($_POST['del']) && count($_POST['del'])> 0){
			foreach($_POST['del'] as $key => &$v){
				if(is_array($v)){
					$i = 1;
					foreach($v as &$subV){
						$sql="DELETE FROM plu_objects_pic ".$filter. " AND `item`='".$key."_".$i."'";
						$i++;
					}
				}else{
					$sql="DELETE FROM plu_objects_pic ".$filter." AND `item`='".$key."'";
				}
				$db->query($sql);
			}
		}
		$sql = "UPDATE plu_objects SET ";
		foreach($_POST['obj'] as $key => &$v){
			if(is_array($v)){
				$i = 1;
				foreach($v as &$subV){
					if(strpos($key,'date')){
						$subV = $this->formatDate($subV);
					}
					if($subV == "輸入圖片說明")
						$subV="";
					$sql.="`".$key."_".$i."`='".htmlspecialchars($subV)."',";
					$i++;
				}
			}else{
				if(strpos($key,'date')){
					$v = $this->formatDate($v);
				}
				if($v == "輸入圖片說明")
					$v = "";
				else if($key == "auction_date"){
					$v.=" ".$_POST['obj']['auction_time'];
				}else if($key == "auction_time")
					continue;
				$sql.="`".$key."`='".htmlspecialchars($v)."',";
			}
		}
		$sql.="`ModiTime`=NOW()". $filter;
		$db->query($sql);
		
		//戶籍謄本
		$sql = "UPDATE plu_objects_household SET ";
		foreach($_POST['land'] as $key => &$v){
			if(is_array($v)){
				$i = 1;
				foreach($v as &$subV){
					$sql.="`".$key."_".$i."`='".htmlspecialchars($subV)."',";
					$i++;
				}
			}else{
				if($key=="append_item"){
					$sql.="`append_item_7`='".htmlspecialchars($v)."',";
				}else{
					$sql.="`".$key."`='".htmlspecialchars($v)."',";
				}
			}
		}
		$sql = substr($sql,0,-1). $filter;
		$db->query($sql);

		foreach($_FILES['obj']['name'] as $key => $file){
			if(is_array($file)){
				foreach($file as $key2 => $file2){
					if($_FILES['obj']["size"][$key][$key2] && $_FILES['obj']["error"][$key][$key2] == UPLOAD_ERR_OK){
						$tmp_name = $_FILES['obj']["tmp_name"][$key][$key2];
						$filename = $_FILES['obj']["name"][$key][$key2];
						$name = "objects_".$object_id."_".$key."_".($key2+1).substr($filename, strrpos($filename, "."));
						move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
						$hasData = $db->get_var("SELECT COUNT(*) FROM plu_objects_pic WHERE object_id=".$object_id." AND item='".$key."_".($key2+1)."'");
						if($hasData==0)
							$sql = "INSERT INTO plu_objects_pic(object_id,item,filename) VALUES (".$object_id.",'".$key."_".($key2+1)."','".$name."')";
						else
							$sql = "UPDATE plu_objects_pic SET filename='".$name."' WHERE object_id=".$object_id." AND item='".$key."_".($key2+1)."'";
						$db->query($sql);
					}
				}
			}else{
				if($_FILES['obj']["size"][$key] && $_FILES['obj']["error"][$key] == UPLOAD_ERR_OK){
					$tmp_name = $_FILES['obj']["tmp_name"][$key];
					$filename = $_FILES['obj']["name"][$key];
					$name = "objects_".$object_id."_".$key.substr($filename, strrpos($filename, "."));
					move_uploaded_file($tmp_name, SRVROOT.$this->upload_path.$name);
					$hasData = $db->get_var("SELECT COUNT(*) FROM plu_objects_pic WHERE object_id=".$object_id." AND item='".$key."'");
					if($hasData==0)
						$sql = "INSERT INTO plu_objects_pic(object_id,item,filename) VALUES (".$object_id.",'".$key."','".$name."')";
					else
						$sql = "UPDATE plu_objects_pic SET filename='".$name."' WHERE object_id=".$object_id." AND item='".$key."'";
					$db->query($sql);
				}
			}
		}
		redirect($this->plu_path."&func=show_objects_list", 0, "變更已完成");
	}
}
?>