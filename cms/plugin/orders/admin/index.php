<?php
/*
模組參數
套件名稱：訂單管理
開發人：Max Clapton
*/

class orders{
	private $tmpl_path = "/cms/plugin/orders/admin/tmpl/";
	private $plu_path = "?pluName=orders&pluAdmin=admin/index.php";
	private $plu_subpath = "?pluName=orders&pluAdmin=admin/sub.php";
	private $plu_header_path = "/cms/admin/template/plu_header.php";
	private $upload_path = "/cms/upload/orders/";
	private $plu_Cname = "訂單管理";
	
    function __construct() {
		require_once($_SERVER['SRVROOT']."/cms/inc/incpkg.inc.php");
		require_once(SRVROOT."/cms/inc/admin_breadcrumb.inc.php");
		require_once(SRVROOT."/cms/lib/ezsql/shared/ez_sql_core.php");
		//驗證權限
		auth_valid_function("orders");
		//呼叫基本套件
		include_db_pkg();
    }
	
	function get_content(&$content){
		$func = isset($_GET["func"])?$_GET["func"]:"";
		switch($func){
			case "do_edit_orders":
				$this->do_edit_orders();
				return false;
			case "do_del_orders":
				$this->do_del_orders();
				return false;
			case "show_edit_orders":
				$content = $this->show_edit_orders();
				return true;
			default:
				$content = $this->show_orders_list();
				return true;
		}
		return false;
	}

	function show_orders_list(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;
		//加入麵包屑
		$func_Cname = "訂單管理";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 1);

		$filter = "";
		if(isset($_GET['opt']))
		{
			switch($_GET['opt']){
				case 1:
					if($_POST['deliveryStatus'] == 2){
						$filter = " WHERE delivery_status = 1";
					}else if($_POST['deliveryStatus'] == 3){
						$filter = " WHERE delivery_status = 0";
					}
					break;
				case 2:
					if($_POST['paymentStatus'] == 2){
						$filter = " WHERE payment_status = 1";
					}else if($_POST['paymentStatus'] == 3){
						$filter = " WHERE payment_status = 0";
					}
					break;
				case 3:
					if($_POST['recordedStatus'] == 2){
						$filter = " WHERE recorded_status = 1";
					}else if($_POST['recordedStatus'] == 3){
						$filter = " WHERE recorded_status = 0";
					}
					break;
			}
		}else if(isset($_POST['search_item'])){
			$txt = htmlspecialchars($_POST['search_txt']);
			switch($_POST['search_item']){
				case 0:
					$filter = " WHERE order_number='$txt'";
					break;
				case 1:
					$filter = " WHERE order_name='$txt'";
					break;
				case 2:
					$filter = " WHERE receiver_name='$txt'";
					break;
				case 3:
					$filter = " a JOIN plu_orders_detail b ON a.order_id=b.order_id JOIN plu_product c ON b.prod_id=c.prod_id WHERE c.name='$txt'";
					break;
				case 4:
					$filter = " a JOIN plu_member b ON a.member_id=b.member_id WHERE account='$txt'";
					break;
			}
		}
		$dataTotal = $db->get_var("SELECT COUNT(order_id) FROM plu_orders" . $filter);
		list($dataStart, $dataLen, $pagejump) = init_sliding_pager($dataTotal);
		$sql = "SELECT delivery_status, order_id, order_name, order_date, payment_status, total_amount FROM plu_orders". $filter . " LIMIT $dataStart, $dataLen";
		$result = $db->get_results($sql, ARRAY_A);
		
		$tpl->assign("show_orders_list_url", $this->plu_path."&func=show_orders_list");
		$tpl->assign("orders_data", $result);
		$tpl->assign("pager", $pagejump);
		$tpl->assign("count", $dataTotal);
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("show_add_orders_link", $this->plu_path."&func=show_add_orders");
		$tpl->assign("show_add_orders_category", $this->plu_subpath."&func=show_add_category");
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("show_edit_orders_link" , $this->plu_path."&func=show_edit_orders&order_id=");
		$tpl->assign("do_del_orders_link" , $this->plu_path."&func=do_del_orders&order_id=");
		return $tpl->fetch("show_orders_list.tpl");
	}
	
	function do_del_orders(){
		$db = init_db();
		$order_id = isset($_GET['order_id'])?$_GET['order_id']:"";
		if(!(isset($_GET['order_id']) && preg_match("/^[0-9]*$/", $_GET['order_id']))){
			redirect($this->plu_path."&func=show_orders_list", 0, "你所要刪除的產品不合法");
			exit;
		}

		$sql  = "DELETE FROM plu_orders WHERE order_id = $order_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_orders_list", 0, "刪除已完成");
	}

	function show_edit_orders(){
		$db = init_db();
		$tpl = init_tpl(SRVROOT.$this->tmpl_path);
		$plu_header = SRVROOT.$this->plu_header_path;

		//加入麵包屑
		$func_Cname = "訂單明細";
		$trail = new Breadcrumb();
		$trail->add($func_Cname, $_SERVER['REQUEST_URI'], 2);
		$order_id = isset($_GET['order_id'])?$_GET['order_id']:"";
		$sql = "SELECT a.*,b.account,b.birth,SUM(qty*unit_price) as subtotal FROM plu_orders a JOIN plu_member b ON a.member_id=b.member_id ";
		$sql.= "JOIN plu_orders_detail c ON a.order_id=c.order_id WHERE a.order_id=$order_id GROUP BY a.order_id";
		$result = $db->get_row($sql, ARRAY_A);
		foreach($result as $key => $value){
			$tpl->assign($key, $value);
		}
		if(isset($result)){
			$sql = "SELECT b.name as prod_name, a.qty,a.unit_price FROM plu_orders_detail a JOIN plu_product b ON a.prod_id=b.prod_id WHERE order_id=$order_id";
			$sel_result = $db->get_results($sql, ARRAY_A);
			$tpl->assign("orders_data", $sel_result);
		}

		$tpl->assign("validate_url", WEBROOT.'/cms/lib/jquery/jquery.validate.js');
		$tpl->assign("func_Cname", $func_Cname);
		$tpl->assign("plu_header_path", $plu_header);
		$tpl->assign("do_edit_orders_url" , $this->plu_path."&func=do_edit_orders&order_id=".$order_id);
		$tpl->assign("cancel_add_url", $this->plu_path."&func=show_orders_list");
		return $tpl->fetch("show_edit_order.tpl");
	}
	function do_edit_orders(){
		$db = init_db();
		if(!(isset($_GET["order_id"]) && preg_match("/^[0-9]*$/", $_GET["order_id"]))){
			redirect($this->plu_path."&func=show_orders_list", 0, "你所要訂單編號不合法");
			exit;
		}
		$order_id = $_GET["order_id"];
		$payment_status =  isset($_POST['payment_status']) && ($_POST['payment_status']) == 1?true:false;
		$recorded_status =  isset($_POST['recorded_status']) && ($_POST['recorded_status']) == 1?true:false;
		$delivery_status =  isset($_POST['delivery_status']) && ($_POST['delivery_status']) == 1?true:false;
		$delivery_date = isset($_POST["delivery_date"])?$_POST["delivery_date"]:"";
		if($delivery_status && preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $delivery_date)<=0){
		    redirect($this->plu_path."&func=show_orders_list", 0, "請輸入日期時間.");
			exit;
		}

		$memo = isset($_POST['memo'])?$_POST['memo']:"";
		$memo = htmlspecialchars($memo);

		$sql  = "UPDATE plu_orders SET payment_status='$payment_status', recorded_status='$recorded_status', delivery_status='$delivery_status',";
		$sql .=	"delivery_date='$delivery_date', memo='$memo', modiTime=NOW() WHERE order_id=$order_id ";
		$db->query($sql);

		//echo $sql;
		redirect($this->plu_path."&func=show_orders_list", 0, "變更已完成");
	}
}
?>