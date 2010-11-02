<?php
/*
模組參數
套件名稱：訂單管理
開發人：Max Clapton
*/

class pricing{
	private $tmpl_path = "/cms/plugin/pricing/admin/tmpl/";
	private $plu_path = "?pluName=pricing&pluAdmin=admin/index.php";
	private $plu_subpath = "?pluName=pricing&pluAdmin=admin/sub.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/pricing/";
	private $plu_Cname = "訂單管理";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("pricing");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_pricing_list":
				$this->do_pricing_list();
				return false;
			default:
				$content = $this->show_pricing_list();
				return true;
		}
		return false;
	}

	function show_pricing_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "法拍價量資訊";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$thisMonth = date("m");
		$thisYear = date("Y");
		$opt = 0;
		$filter;
		if(isset($_GET['opt'])){
			$opt = $_GET['opt'];
		}
		if($opt == 1){
			if(isset($_POST['taipeicityOpt']) && is_numeric($_POST['taipeicityOpt'])){
				$filter = $_POST['taipeicityOpt'];
				$tpl->assign("taipeicity",$_POST['taipeicityOpt']);
			}else if(isset($_POST['taipeicity']) && is_numeric($_POST['taipeicity'])){
				$filter = $_POST['taipeicity'];
			}else{
				$filter = 1;
			}
		}else{
			$filter = 1;
		}
		$sql = $this->generateSql(1, $thisYear, $thisMonth, 'taipeicity_building', 'taipeicity_apartment', '', $filter);
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			$taipeibuildingArr = array();
			$taipeiapartmentArr = array();
			$idx;
			foreach($result as $key =>&$value){
				$idx = (12+$thisMonth-$value["M"])%12;
				if($value["item"] == 'taipeicity_building'){
					$taipeibuildingArr[$idx][0] = $value["M"];
					$taipeibuildingArr[$idx][1] = $value["value"];
				}else{
					$taipeiapartmentArr[$idx][0] = $value["M"];
					$taipeiapartmentArr[$idx][1] = $value["value"];
				}
			}
			$tpl->assign("taipeicity_building",$taipeibuildingArr);
			$tpl->assign("taipeicity_apartment",$taipeiapartmentArr);
		}
		if($opt == 2){
			if(isset($_POST['taipeicountyOpt']) && is_numeric($_POST['taipeicountyOpt'])){
				$filter = $_POST['taipeicountyOpt'];
				$tpl->assign("taipeicounty",$_POST['taipeicountyOpt']);
			}else if(isset($_POST['taipeicounty']) && is_numeric($_POST['taipeicounty'])){
				$filter = $_POST['taipeicounty'];
			}else{
				$filter = 3;
			}
		}else{
			$filter = 3;
		}
		$sql = $this->generateSql(2, $thisYear, $thisMonth, 'taipeicounty_building', 'taipeicounty_apartment', '', $filter);
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			$taipeibuildingArr = array();
			$taipeiapartmentArr = array();
			$idx;
			foreach($result as $key =>&$value){
				$idx = (12+$thisMonth-$value["M"])%12;
				if($value["item"] == 'taipeicounty_building'){
					$taipeibuildingArr[$idx][0] = $value["M"];
					$taipeibuildingArr[$idx][1] = $value["value"];
				}else{
					$taipeiapartmentArr[$idx][0] = $value["M"];
					$taipeiapartmentArr[$idx][1] = $value["value"];
				}
			}
			$tpl->assign("taipeicounty_building",$taipeibuildingArr);
			$tpl->assign("taipeicounty_apartment",$taipeiapartmentArr);
		}
		$sql = $this->generateSql(3, $thisYear, $thisMonth, 'taipeicity_issue', 'taipeicounty_issue');
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			$taipeibuildingArr = array();
			$taipeiapartmentArr = array();
			$idx;
			foreach($result as $key =>&$value){
				$idx = (12+$thisMonth-$value["M"])%12;
				if($value["item"] == 'taipeicity_issue'){
					$taipeibuildingArr[$idx] = $value["value"];
				}else{
					$taipeiapartmentArr[$idx] = $value["value"];
				}
			}
			$tpl->assign("taipeicity_issue",$taipeibuildingArr);
			$tpl->assign("taipeicounty_issue",$taipeiapartmentArr);
		}		
		$sql = $this->generateSql(4, $thisYear, $thisMonth, 'taipeicity_bidding', 'taipeicounty_bidding');
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			$taipeibuildingArr = array();
			$taipeiapartmentArr = array();
			$idx;
			foreach($result as $key =>&$value){
				$idx = (12+$thisMonth-$value["M"])%12;
				if($value["item"] == 'taipeicity_bidding'){
					$taipeibuildingArr[$idx] = $value["value"];
				}else{
					$taipeiapartmentArr[$idx] = $value["value"];
				}
			}
			$tpl->assign("taipeicity_bidding",$taipeibuildingArr);
			$tpl->assign("taipeicounty_bidding",$taipeiapartmentArr);
		}		
		$sql = $this->generateSql(5, $thisYear, $thisMonth, 'auction_amount');
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			$houseAmountArr = array();
			$idx=0;
			foreach($result as $key =>&$value){
				$houseAmountArr[$idx][0] = $value["pricing_date"];
				$houseAmountArr[$idx][1] = $value["value"];
				$idx++;
			}
			$tpl->assign("auction_amount",$houseAmountArr);
		}
		$sql = $this->generateSql(6, $thisYear, $thisMonth, 'leading', 'simultaneous', 'prosperity');
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			$analysis = array();
			$idx = 0;
			$item;
			foreach($result as $key =>&$value){
				$idx = $idx%4;
				if($value['item'] == 'leading'){
					$item = 0;
				}else if($value['item'] == 'simultaneous'){
					$item = 1;
				}else{
					$item = 2;
				}
				$analysis[$item][$idx] = $value['value'];
				$idx++;
			}
			$tpl->assign("analysis",$analysis);
		}
		$thisQuarter = floor(date('m')/4)*3+1;
		$sql = $this->generateSql(7, $thisYear, $thisQuarter, 'leading_return', 'simultaneous_return', 'prosperity_return');
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			foreach($result as $key =>$value){
				$tpl->assign($value['item'], $value['value']);
			}
		}

		$sql = "SELECT * FROM plu_pricing_desc WHERE pricing_date='".$thisYear."-".$thisMonth."-1' OR (item='analysis_desc' AND pricing_date='".$thisYear."-".$thisQuarter."-1')";
		$result = $db->get_results($sql, ARRAY_A);
		if(count($result)>0){
			foreach($result as $key =>$value){
				$tpl->assign($value['item'], $value['memo']);
			}
		}
		$orderMonth = array();
		$orderQuarter = array();
		for($i = 1 ; $i <= 12 ; $i++){
			$orderMonth[$i-1] = ((12+$thisMonth-$i)%12+1);
		}
		for($i = 0 ; $i < 4 ; $i++){
			$quarter = floor(date('m',strtotime(-($i*3)." Month"))/4)+1;
			$orderQuarter[$i] = date('y',strtotime(-($i*3)." Month")).'Q'.(string)$quarter;
		}
		$tpl->assign("show_pricing_list_url", $this->plu_path."&func=show_pricing_list");
		$tpl->assign("do_edit_pricing_url" , $this->plu_path."&func=do_pricing_list");
		$tpl->assign("datepicker_url", WEBROOT.'/cms/lib/js/chineseDatepicker.js');
		$tpl->assign("orderMonth", $orderMonth);
		$tpl->assign("orderQuarter", $orderQuarter);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		return $tpl->fetch("show_pricing_list.tpl");
	}
	
	function generateSql($opt, $thisYear, $thisMonth, $item1, $item2='',$item3='', $postcode=0){
		$sql = "SELECT MONTH(pricing_date) as M,item,value FROM plu_pricing ";
		$sql.="WHERE pricing_date>='".($thisYear-1)."/".($thisMonth+1)."/1' AND pricing_date<'".$thisYear."/".($thisMonth+1)."/1' AND ";
		$amount = 12;
		switch($opt){
			case 1:
			case 2:
				$sql.= "postcode=".$postcode." AND ";
				$amount = 24;
				break;
			case 3:
			case 4:
				break;
			case 5:
				$sql = "SELECT pricing_date, item, value FROM plu_pricing ";
				$sql.="WHERE pricing_date>='".($thisYear-1)."/".($thisMonth+1)."/1' AND pricing_date<'".$thisYear."/".($thisMonth+1)."/1' AND ";
				break;
			case 6:
				break;
			case 7:
				$sql = "SELECT pricing_date, item, value FROM plu_pricing ";
				$sql.="WHERE pricing_date='".$thisYear."/".$thisMonth."/1' AND ";
				$amount = 3;
				break;
		}
		$sql.="item IN ('".$item1."','".$item2."','".$item3."') ORDER BY item,pricing_date DESC LIMIT 0, ".$amount;
		return $sql;
	}
	
	function insertUpdateScript($postcode, $item, $date, $value){
		$db = init_db();
		if(preg_match("/^[0-9]+$/", $value)){
			$filter =" WHERE item='".$item."' AND postcode=".$postcode." AND pricing_date='".$date."' ";
			$sql = "SELECT COUNT(*) FROM plu_pricing ".$filter."";
			$hasValue = $db->get_var($sql);
			if($hasValue>0){
				$sql= " UPDATE plu_pricing SET value=".$value.$filter;
			}else{
				$sql= " INSERT INTO plu_pricing VALUES (".$postcode.",'".$date."','".$item."',".$value.")";
			}
			$db->query($sql);
		}
	}

	function insertUpdateDescription($date, $item, $value){
		$db = init_db();
		$filter = " WHERE pricing_date='".$date."' AND item='".$item."'";
		$sql = "SELECT COUNT(*) FROM plu_pricing_desc".$filter;
		$hasValue = $db->get_var($sql);
		if($hasValue>0){
			$sql= " UPDATE plu_pricing_desc SET memo='".$value."' ".$filter;
		}else{
			$sql= " INSERT INTO plu_pricing_desc(pricing_date,item,memo) VALUES ('".$date."','".$item."','".$value."')";
		}
		$db->query($sql);
	}

	function do_pricing_list(){
		$db = init_db();
		if(isset($_GET['opt'])){
			$opt = $_GET['opt'];
		}
		if(!(isset($opt) && preg_match("/^[0-9]+$/", $opt))){
			redirect($this->plu_path."&func=show_pricing_list", 0, "沒有此項目");
			exit;
		}
		switch($opt){
			case 1:
				$taipeicity = $_POST['taipeicity'] =='' || !preg_match("/^[0-9]+$/", $_POST['taipeicity'])?1:$_POST['taipeicity'];
				for($i = 0 ; $i < count($_POST['taipeicity_building']) ; $i++){
					$this->insertUpdateScript($taipeicity, 'taipeicity_building', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicity_building'][$i]);
					$this->insertUpdateScript($taipeicity, 'taipeicity_apartment', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicity_apartment'][$i]);
				}
				$this->insertUpdateDescription(date('Y-m-1'), 'taipeicity_desc', $_POST['taipeicity_desc']);
				break;
			case 2:
				$taipeicounty = $_POST['taipeicounty'] =='' || !preg_match("/^[0-9]+$/", $_POST['taipeicounty'])?3:$_POST['taipeicounty'];
				for($i = 0 ; $i < count($_POST['taipeicounty_building']) ; $i++){
					$this->insertUpdateScript($taipeicounty, 'taipeicounty_building', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicounty_building'][$i]);
					$this->insertUpdateScript($taipeicounty, 'taipeicounty_apartment', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicounty_apartment'][$i]);
				}
				$this->insertUpdateDescription(date('Y-m-1'), 'taipeicounty_desc', $_POST['taipeicounty_desc']);
				break;
			case 3:
				for($i = 0 ; $i < count($_POST['taipeicity_issue']) ; $i++){
					$this->insertUpdateScript(1, 'taipeicity_issue', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicity_issue'][$i]);
					$this->insertUpdateScript(3, 'taipeicounty_issue', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicounty_issue'][$i]);
				}
				$this->insertUpdateDescription(date('Y-m-1'), 'issue_desc', $_POST['issue_desc']);
				break;
			case 4:
				for($i = 0 ; $i < count($_POST['taipeicity_bidding']) ; $i++){
					$this->insertUpdateScript(1, 'taipeicity_bidding', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicity_bidding'][$i]);
					$this->insertUpdateScript(3, 'taipeicounty_bidding', date('Y-m-1',strtotime(-$i." Month")), $_POST['taipeicounty_bidding'][$i]);
				}
				$this->insertUpdateDescription(date('Y-m-1'), 'bidding_desc', $_POST['bidding_desc']);
				break;
			case 5:
				for($i = 0 ; $i < count($_POST['auction_amount_date']) ; $i++){
					if(preg_match("/^[0-9]{4}\/[0-9]{1,2}\/[0-9]{1,2}$/",$_POST['auction_amount_date'][$i])){
						$this->insertUpdateScript(0, 'auction_amount', $_POST['auction_amount_date'][$i], $_POST['auction_amount_value'][$i]);
					}
				}
				$this->insertUpdateDescription(date('Y-m-1'), 'auction_amount_desc', $_POST['auction_amount_desc']);
				break;
			case 6:
				for($i = 0 ; $i < count($_POST['leading']) ; $i++){
					$quarter = floor(date('m',strtotime(-($i*3)." Month"))/4)*3+1;
					$pricing_date = date('Y',strtotime(-($i*3)." Month")).'-'.(string)$quarter.'-1';
					$this->insertUpdateScript(0, 'leading', $pricing_date, $_POST['leading'][$i]);
					$this->insertUpdateScript(0, 'simultaneous', $pricing_date, $_POST['simultaneous'][$i]);
					$this->insertUpdateScript(0, 'prosperity', $pricing_date, $_POST['prosperity'][$i]);
				}
				$thisQuarter = floor(date('m')/4)*3+1;
				$thisYear = date('Y');
				$this->insertUpdateScript(0, 'leading_return', $thisYear.'-'.$thisQuarter.'-1', $_POST['leading_return']);
				$this->insertUpdateScript(0, 'simultaneous_return', $thisYear.'-'.$thisQuarter.'-1', $_POST['simultaneous_return']);
				$this->insertUpdateScript(0, 'prosperity_return', $thisYear.'-'.$thisQuarter.'-1', $_POST['prosperity_return']);
				$this->insertUpdateDescription($thisYear.'-'.$thisQuarter.'-1', 'analysis_desc', $_POST['analysis_desc']);
				break;
		}
/*
		$order_id = isset($_GET['order_id'])?$_GET['order_id']:"";
		if(!(isset($_GET['order_id']) && preg_match("/^[0-9]*$/", $_GET['order_id']))){
			redirect($this->plu_path."&func=show_pricing_list", 0, "你所要刪除的產品不合法");
			exit;
		}
*/
//		$sql  = "DELETE FROM plu_pricing WHERE order_id = $order_id ";
//		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_pricing_list", 0, "修改已完成");
	}
}
?>