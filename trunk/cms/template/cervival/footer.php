<?php
$id = $_GET["cmsid"];
?>
<div id="footer">
	<?php include(SRVROOT."/cms/resource/contents/p-1-1.htm");?>
	<ul>
		<li <?php if($id==2)'class="first"'?> ><a href="<?php echo WEBROOT ?>/index.php?cmsid=2">Products</a></li>
		<li><a href="<?php echo WEBROOT ?>/index.php?cmsid=3">About Us</a></li>
		<li><a href="<?php echo WEBROOT ?>/index.php?cmsid=4">News/Events</a></li>
		<li><a href="<?php echo WEBROOT ?>/index.php?cmsid=5">Distributor</a></li>
		<li><a href="<?php echo WEBROOT ?>/index.php?cmsid=6">Sponsors</a></li>
		<li><a href="<?php echo WEBROOT ?>/index.php?cmsid=7">Sightings</a></li>
		<li><a href="<?php echo WEBROOT ?>/index.php?cmsid=8">Contact Us</a></li>
   </ul>
</div>