<?php
require_once($_SERVER['SRVROOT'].'/cms/inc/admin_breadcrumb.inc.php');
$trail = new Breadcrumb();
?>
<script type="text/javascript">
function logoutHaver(){
	location.href = "index.php?func=logout";
}
function changeLangHaver(lang){
	location.href = "index.php?func=set_lang&lang="+lang;
}
</script>
<div  class="page-bread">
 <p><?php $trail->output();?>
  <b class="user">使用者 : <?php echo get_login_id() ?><input type="button"name="button"class="button60" value="登出" onClick="logoutHaver()" title=""/><br /><br />
      Change Language 
<select name="change_lang" id="change_lang" onChange="changeLangHaver(this.value);">
<option value="ZH-TW" >繁體中文</option>
<option value="ZH-CN" >简体中文</option>
<option value="DE" >Deutsch</option>
<option value="EN" >English</option>
</select>
  </b>
  </p>
  

</div>
<script type="text/javascript">
$('#change_lang').val('<?php echo $_SESSION['lang']; ?>');
</script>