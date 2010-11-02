<?php
function change_lang($lang = DEFAULTLANG){
	$_SESSION['lang'] = $lang;
	return true;
}

?>