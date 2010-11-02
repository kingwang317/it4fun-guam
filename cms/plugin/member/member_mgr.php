<?php 
		require_once(SRVROOT."/cms/inc/incpkg.inc.php");
		include_db_pkg();
		$db = init_db();
		if(isset($_GET['type'])){
			if($_GET['type'] == "add"){
				$account = $_POST['account'];
				$pwd = md5($_POST['pwd']);
				$name = $_POST['name'];
				$email = $_POST['email'];
				$sex = $_POST['sex'];
				$group = $_POST['group'];
				$add_sql = "INSERT INTO `plu_member` (
						`member_id` ,
						`group_id` ,
						`account` ,
						`name` ,
						`password` ,
						`sex` ,
						`birth` ,
						`tel` ,
						`cellphone` ,
						`email` ,
						`addr` ,
						`modiTime`
						)
						VALUES (
						NULL , '$group', '$account ', '$name', '$pwd', '$sex', NOW( ) , '', '', '$email', '', NOW( )
						);";
				$db->query($add_sql);
			}else if($_GET['type'] == "edit"){
				$id = $_GET['member_id'];
				$account = $_POST["account$id"];
				if($_POST["pwd$id"] == ""){
					$pwd = "";
				}else{
					$pwd = md5($_POST["pwd$id"]);
				}
				
				$name = $_POST["name$id"];
				$email = $_POST["email$id"];
				$sex = $_POST["sex$id"];
				$group = $_POST["group$id"];
				$edit_sql = "UPDATE `plu_member` SET `group_id` = '$group',`account` = '$account',`name` = '$name',";
				if(!empty($pwd))
					$edit_sql .=	"`password` = '$pwd' ,";
				$edit_sql .= "`sex` = '$sex',`email` = '$email' WHERE `plu_member`.`member_id` ='$id' LIMIT 1 ;";
				$db->query($edit_sql);
			}else if($_GET['type'] == "delete"){
				$id = $_GET['member_id'];
				$del_sql = "DELETE FROM `plu_member` WHERE `plu_member`.`member_id` = '$id' LIMIT 1";
				$db->query($del_sql);
			}
		}
		$sql = "SELECT * FROM plu_member as m,plu_member_group as g WHERE m.group_id = g.group_id";
		$result = $db->get_results($sql);
		//print_r($result);
?>
<script type="text/javascript">
	function postValue(type,id){
		if(type == "add"){
			$.post("<?php echo WEBROOT ?>/index.php?cmsid=6&type=add", $("#member_list").serialize());
		}else if(type == "edit"){
			$.post("<?php echo WEBROOT ?>/index.php?cmsid=6&member_id="+id+"&type=edit", $("#member_list").serialize());	
		}else if(type == "delete"){
			$.post("<?php echo WEBROOT ?>/index.php?cmsid=6&member_id="+id+"&type=delete");	
		}
		
		setTimeout("location.reload()",100);
	}
</script>
        <h4>權限管理</h4>
        <div id="select">
				<form name="member_list" id="member_list" method="POST" action="" >
				<table class="tab">
					<thead>
						<tr>
							<th colspan="8" >修改使用者</th>
					   </tr>
					   <tr>
							<th scope="col"  width="10%">序號</th>
							<th scope="col" abbr="number" width="10%">帳號</th>
							<th scope="col" abbr="password" width="10%">密碼</th>
							<th scope="col" abbr="services" width="28%">姓名</th>	
							<th scope="col" abbr="picture" width="13%">性別</th>
							<th scope="col" abbr="Services Content" width="13%">E-mail</th>
							<th scope="col" abbr="change" width="13%">身分</th>
							<th scope="col" abbr="Remove" width="13%">編輯</th>
					   </tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					//if(isset($result))
					foreach($result as $rows){
					
					?>
						<tr>
							<td scope="row" class="column1"><?php echo $count++; ?></td>	
							<td class="column1"><input type="text" name="account<?php echo $rows->member_id; ?>" value="<?php echo $rows->account; ?>"></td>
							<td class="column1"><input type="password" name="pwd<?php echo $rows->member_id; ?>" value=""></td>
							<td class="column1"><input type="text" name="name<?php echo $rows->member_id; ?>" value="<?php echo $rows->name; ?>"></td>
							<td class="column1">
								<select name="sex<?php echo $rows->member_id; ?>" >
									<option value="男" <?php if($rows->sex == "男") echo "selected=selected" ?> >男</option>
									<option value="女" <?php if($rows->sex == "女") echo "selected=selected" ?> >女</option>
								</select>
							</td>
							<td class="column1"><input type="text" name="email<?php echo $rows->member_id; ?>" value="<?php echo $rows->email; ?>"></td>
							<td class="column1">
								<select name="group<?php echo $rows->member_id; ?>" >
								
									<option value="1" <?php if($rows->group_id == 1) echo "selected=selected" ?> >閱讀者</option>
									<option value="2" <?php if($rows->group_id == 3) echo "selected=selected" ?> >編輯者</option>
									<option value="2" <?php if($rows->group_id == 2) echo "selected=selected" ?> >管理者</option>
								</select>
							</td>
							<td class="column1">
							<input type="button" name="edit_btn" class="button60" value="確定" onclick="postValue('edit','<?php echo $rows->member_id; ?>')" title=""/>
							<input type="button" name="del_btn" class="button60" value="刪除" onclick="postValue('delete','<?php echo $rows->member_id; ?>')" title=""/></td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
				<table class="tab">
					<thead>
						<tr>
							<th colspan="8" >新增使用者</th>
					   </tr>
					   <tr>
							<th scope="col"  width="10%">序號</th>
							<th scope="col" abbr="number" width="10%">帳號</th>
							<th scope="col" abbr="password" width="10%">密碼</th>
							<th scope="col" abbr="services" width="28%">姓名</th>	
							<th scope="col" abbr="picture" width="13%">性別</th>
							<th scope="col" abbr="Services Content" width="13%">E-mail</th>
							<th scope="col" abbr="change" width="13%">身分</th>
							<th scope="col" abbr="Remove" width="13%">編輯</th>
					   </tr>
					</thead>
					<tbody>
						<tr>
							<td scope="row" class="column1"><?php echo 1; ?></td>	
							<td class="column1"><input type="text" name="account" value=""></td>
							<td class="column1"><input type="password" name="pwd" value=""></td>
							<td class="column1"><input type="text" name="name" value=""></td>
							<td class="column1">
								<select name="sex" >
									<option value="男">男</option>
									<option value="女">女</option>
								</select>
							</td>
							<td class="column1"><input type="text" name="email" value=""></td>
							<td class="column1">
								<select name="group" >
									<option value="1">閱讀者</option>
									<option value="2">管理者</option>
									<option value="3">編輯者</option>
								</select>
							</td>
							<td class="column1"><input type="button" name="add_btn" class="button60" onclick="postValue('add','-1')" value="新增"title=""/></td>
						</tr>
					</tbody>
				</table>
				</form>							
        </div>