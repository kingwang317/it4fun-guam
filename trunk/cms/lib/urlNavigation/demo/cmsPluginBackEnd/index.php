<?php 
include('../../urlNavigation.class.php');
$nav = new urlNavigation('navigation.xml');
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
<?php $nav->iframePage();?>
</div>