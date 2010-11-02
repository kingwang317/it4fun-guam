<?php
session_start();
?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/config.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/auth.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/std.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/database.inc.php'); ?>
<?php require_once($_SERVER['SRVROOT'].'/cms/inc/default.inc.php'); ?>
<?php
		if(isset($_GET['func']) && $_GET['func'] == "logout"){
			user_logout();
			redirect(WEBROOT."/login.php", 0, '您已登出');
			exit;
		}
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		if(isset($_GET['sel_button']) && $_GET['sel_button'] == "export" && isset($_SESSION['report_value'])){
		include(SRVROOT."/cms/inc/report.inc.php");

		$get_kws_sql =  "SELECT DISTINCT kw_id,kw_content FROM plu_keywords";
		$kws_text = "";
		$kws = $db->get_results($get_kws_sql);
		foreach($kws as $kw_rows){
			$kws_text .= "[".$kw_rows->kw_id."]".$kw_rows->kw_content.",";
		}
		$cols_name=array();
		$cols_name[]=array("網路口碑監控日報表     2010年 8 月 8 日");
		$cols_name[]=array("類別：品牌問題/產品問題/售後服務/銷售問題/行銷活動/主動宣傳/其他                 關鍵字對應：$kws_text");
		$cols_name[]=array("日期","類別","平台/論壇","評價層級","問題","問題網址","問題回覆/解答者","問題回覆/解答日期","關鍵字");
		//$_SESSION['report_value'] = $result;
		/*echo $col++;
		echo "<pre>";
		print_r( $_SESSION['report_value'] );
		echo "</pre>";
		foreach($_SESSION['report_value'] as $rows){
			foreach($rows as $key => $val ){
				print_r( $rows["$key"] );
				print "Key $key, Value $val\n";
			}
		}*/
		export_xls($_SESSION['report_value'],$cols_name,"export","export");
		exit;
	}
auth_check("member",false,false);
$user_id = get_login_id();
$get_member_group_sql = "SELECT group_id,name FROM plu_member WHERE account = '$user_id'";
$member_info = $db->get_results($get_member_group_sql,ARRAY_A);
$_SESSION['member_group'] = $member_info[0]['group_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS後台管理系統-商品服務列表</title>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.history_remote.pack.js" type="text/javascript"></script>
    <script src="js/jquery.tabs.pack.js" type="text/javascript"></script>
	
    <script type="text/javascript">
	function aHover(url){
		location.href = url;
	}
       $(function() {
		$('#container-9').tabs({ 

			remote: true,
			fxAutoHeight: true,
		});
		});
		function contentReload(){
			location.reload();
		}
		function alertText(){
			alert("請點擊右上角的'更新'按鈕，取得最新的資訊!!");
		}
    </script>
	<link href="css/blog.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
	<div id="header">
        <div id="logo"><a href="http://www.awoo.com.tw/" title="阿物"><img src="images/awoo_cms_logo.jpg" alt="阿物國際事業有限公司"/></a></div>
        <h1>櫻花口碑監控系統
        <br clear="all"/>
        <a  class="headerurl" href="http://www.awoo.com.tw/" title="網址">http://www.awoo.com.tw/</a></h1>
        <address>awoo International Co., Ltd.Leading brand of SEO in Taiwan</address>
    </div>
	   <div  id="user">使用者:<?php echo $member_info[0]['name']; ?>
          <input type="button"name="button" class="button60" value="登出" title="" onclick="aHover('<?php echo WEBROOT ?>/index.php?func=logout')" />
		  <input type="button"name="button" class="button60" value="更新" title="切換tab時，請更新資料" onclick="contentReload()" />
        </div>
	<div id="content">
        <div id="container-9">
            <ul>
                <li><a onclick="alertText();" href="<?php echo WEBROOT ?>/index.php?cmsid=3&<?php echo $_SERVER['QUERY_STRING'] ?>"><span>部落格</span></a></li>
                <li><a onclick="alertText();"href="<?php echo WEBROOT ?>/index.php?cmsid=1&<?php echo $_SERVER['QUERY_STRING'] ?>"><span>噗浪</span></a></li>
				<li><a onclick="alertText();" href="<?php echo WEBROOT ?>/index.php?cmsid=2&<?php echo $_SERVER['QUERY_STRING'] ?>"><span>YAHOO!奇摩知識+</span></a></li>
				<li><a onclick="alertText();" href="<?php echo WEBROOT ?>/index.php?cmsid=4&<?php echo $_SERVER['QUERY_STRING'] ?>"><span>Mobile01</span></a></li>
				<li><a onclick="alertText();" href="<?php echo WEBROOT ?>/index.php?cmsid=5&<?php echo $_SERVER['QUERY_STRING'] ?>"><span>PTT</span></a></li>
				<?php 
				if($member_info[0]['group_id'] == "2"){
				?>
					<li><a  href="<?php echo WEBROOT ?>/index.php?cmsid=6&<?php echo $_SERVER['QUERY_STRING'] ?>"><span>權限管理</span></a></li>
				<?php 
				}
				?>
			</ul>
        </div>
  </div>
    <div id="footer">
      <p>阿物國際事業有限公司 | 電話：(02)2351-1319 | 傳真：(02)2391-6426 | 服務信箱：service@awoo.com.tw | 地址：台北市中正區齊東街59號1樓</p>
      <p>版權所有.轉載必究.Copyright © 2010 awoo.com.tw.All Rights Reserved </p>
    </div>
</div>
</body>
</html>
