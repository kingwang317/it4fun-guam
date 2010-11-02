<?php
$id = $_GET["cmsid"];
?>
<div id="navi_wrap">
	<div id="navi">
		<ul>
		  <li><?php if($id==2){?><span><a href="<?php echo WEBROOT ?>/index.php?cmsid=2">Products</a></span><?php }else{ ?><a href="<?php echo WEBROOT ?>/index.php?cmsid=2">Products</a><?php } ?></li>
		  <li><?php if($id==3){?><span><a href="<?php echo WEBROOT ?>/index.php?cmsid=3">About Us</a></span><?php }else{ ?><a href="<?php echo WEBROOT ?>/index.php?cmsid=3">About Us</a><?php } ?></li>
		  <li><?php if($id==4){?><span><a href="<?php echo WEBROOT ?>/index.php?cmsid=4">News/Events</a></span><?php }else{ ?><a href="<?php echo WEBROOT ?>/index.php?cmsid=4">News/Events</a><?php } ?></li>
		  <li><?php if($id==5){?><span><a href="<?php echo WEBROOT ?>/index.php?cmsid=5">Distributor</a></span><?php }else{ ?><a href="<?php echo WEBROOT ?>/index.php?cmsid=5">Distributor</a><?php } ?></li>
		  <li><?php if($id==6){?><span><a href="<?php echo WEBROOT ?>/index.php?cmsid=6">Sponsors</a></span><?php }else{ ?><a href="<?php echo WEBROOT ?>/index.php?cmsid=6">Sponsors</a><?php } ?></li>
		  <li><?php if($id==7){?><span><a href="<?php echo WEBROOT ?>/index.php?cmsid=7">Sightings</a></span><?php }else{ ?><a href="<?php echo WEBROOT ?>/index.php?cmsid=7">Sightings</a><?php } ?></li>
		  <li><?php if($id==8){?><span><a href="<?php echo WEBROOT ?>/index.php?cmsid=8">Contact Us</a></span><?php }else{ ?><a href="<?php echo WEBROOT ?>/index.php?cmsid=8">Contact Us</a><?php } ?></li>
		</ul>
	</div>
</div>