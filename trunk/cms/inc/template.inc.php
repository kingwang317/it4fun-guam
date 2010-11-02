<?php
function &init_tpl($tpl_path)
{
	require_once(SMARTY_LIB. "/Smarty.class.php");
	$tpl = new Smarty();
	//$tpl->debugging = true;
	$tpl->compile_dir = TPL_PATH. "/templates_c/";
	$tpl->config_dir = TPL_PATH. "/configs/";
	$tpl->force_compile = true;
	$tpl->caching = 0;
	$tpl->cache_lifetime = 0;
	$tpl->cache_dir = TPL_PATH. "/cache";
	
	$tpl->left_delimiter = '<{';
	$tpl->right_delimiter = '}>';
	$tpl->template_dir = $tpl_path;
	return $tpl;
}
?>