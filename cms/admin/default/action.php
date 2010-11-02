<?php
require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php");
$xfile = CMSXML;
$sx = simplexml_load_file($xfile);
$default = $sx->default;
$default->cus_name=$_POST['cus_name'];
$default->cus_url=$_POST['cus_url'];
$default->title=$_POST['title'];
$default->keywords=$_POST['keywords'];
$default->description=$_POST['description'];
$default->template=$_POST['template'];
$default->fck_id=$_POST['fck_id'];
$default->fck_class=$_POST['fck_class'];
$default->fck_css=$_POST['fck_css'];
$default->fck_style=$_POST['fck_style'];
$default->fck_template=$_POST['fck_template'];
$ok = $sx->asXML($xfile);
        if ($ok){
            echo "更新成功";
        } else {
            echo "更新失敗";
        } 
$back = $_SERVER['HTTP_REFERER'];
echo "<meta http-equiv=\"refresh\" content=\"1.6;URL=$back\" />";

?>