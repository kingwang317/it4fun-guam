<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include($_SERVER['SRVROOT'].'/cms/inc/header_meta.inc.php'); ?>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/contactus.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
		<script type="text/javascript" src="js/jquery.flash.js"></script>
		<script type="text/javascript" src="<?php echo WEBROOT.'/cms/lib/jquery/jquery.validate.js' ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.menu').flash({ 
					src: '<?php echo $_SERVER['WEBROOT'].'/cms/template/cervival/'; ?>cervial_header.swf',
					width:970,
					height:127
				});
				$("#contact_form").validate();
			});
		</script>
</head>
	<body>
		<div id="wrap">
		    <div id="header">
                <div id="menu" class="menu">
                </div>
		    </div>
<?php include('navi.php'); ?><!-- navi_wrap -->
		    <div id="content_wrap">
                <div class="content contactus_bg">
                   <div class="breadcrumb"><?php include($_SERVER['SRVROOT'].'/cms/inc/breadcrumb.inc.php'); ?></div>
                  
				  <div id="contactus">
					<?php include($_SERVER['SRVROOT'].'/cms/inc/display_content.inc.php'); ?>
                    
                    <h4>Contact Cervival<span>(* required)</span></h4> 
                    <hr/>
                    <div id="contactus_from_box">
						<form name="contact_form" id="contact_form" action="<?php echo WEBROOT."/cms/plugin/contact/action.php"?>" method="post">
                        <label>Prefix :<input name="sex" type="radio" value="Mr." class="radio"/> Mr.</label>
                        <label><input name="sex" type="radio" value="Ms." class="radio"/> Ms.</label>
                        <br clear="left"/>
                        
                        <label class="firstName">*First Name:<input type="text"  name="frist_name"  class="firstName required" /></label>    
                        <label class="lastName">*Last Name:<input type="text" name="last_name"  class="lastName required"/></label>
                        <br clear="left"/>
                        
                        <label>Phone:</label>
                        <br/>
                        <input type="text" name="phone" class="phone"/> 
                        <br clear="left"/>
                        
                        
                        <label>*Email:</label>
                        <br/>
                        <input type="text" name="email" value="" class="email required"/ > 
                        <br clear="left"/>
                        
                        <label>*Message:</label>
                        <br/>
                        <textarea name="msg" cols="" rows=""  class="required"></textarea>
                        <br clear="left"/>
						<input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                        <button type="submit" class="button">Send</button>
						</form>
                    </div>
             	</div>
             </div>
<?php include('footer.php'); ?><!-- footerDiv -->
		</div>
		</div>
	</body>
</html>
