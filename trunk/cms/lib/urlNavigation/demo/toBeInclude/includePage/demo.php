<?php 
include($_SERVER['SRVROOT'].'/cms/lib/urlNavigation/urlNavigation.class.php');
$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));
$xmlFile = $nowSrvPath.'/navigation.xml';
$nav = new urlNavigation($xmlFile);
?>

<style>
.current {
font-weight:bold;
color:#FF0000;
}
#content {
border: 1px solid gray;
padding:10px;
}
</style>

Menu:
<?php $nav->listMenu(); ?>
Content:
<div id="content">
<?php $nav->includePage();?>
</div>