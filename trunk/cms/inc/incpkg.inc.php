<?php 
function include_db_pkg()
{
require_once($_SERVER['SRVROOT']."/cms/inc/config.inc.php");
require_once($_SERVER['SRVROOT']."/cms/inc/default.inc.php");
require_once($_SERVER['SRVROOT']."/cms/inc/database.inc.php");
require_once($_SERVER['SRVROOT']."/cms/inc/std.inc.php");
require_once($_SERVER['SRVROOT']."/cms/inc/auth.inc.php");
require_once($_SERVER['SRVROOT']."/cms/inc/pager.inc.php");
require_once($_SERVER['SRVROOT']."/cms/inc/template.inc.php");
}
?>