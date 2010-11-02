<?php 
/* Please do not change following arguments */
define('VERSION',		'2.10');

define("INC_PATH",		SITE_ROOT. '/cms/inc');
define("LIB_PATH",		SITE_ROOT. '/cms/lib');
define('UPLOAD_PATH',	SITE_ROOT. '/cms/upload');
define('TPL_PATH',		UPLOAD_PATH. '/templates');

define('JPGRAPH_LIB',	LIB_PATH. '/jpgraph/src');
define('SMARTY_LIB',	LIB_PATH. '/smarty');
define('EZSQL_LIB',		LIB_PATH. '/ezsql');
define('PAGER_LIB',		LIB_PATH. '/pager');

//ini_set ( "memory_limit", "20M");
error_reporting(E_ALL);
?>
