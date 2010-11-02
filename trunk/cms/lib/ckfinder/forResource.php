<?php
$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));
$nowWebPath = substr_replace($nowSrvPath, '', 0, strpos($nowSrvPath, $_SERVER['DOCUMENT_ROOT'])+ strlen($_SERVER['DOCUMENT_ROOT']));
?>
<script src="<?php echo $nowWebPath ?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo $nowWebPath ?>/resource_1.2.2_compact/ckfinder.js"></script>
<script type="text/javascript">
function browse(runAfterFunc)
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder() ;
	finder.BasePath = '<?php echo $nowWebPath ?>/resource_1.2.2_compact/' ;	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.SelectFunction = runAfterFunc ;
	finder.Popup() ;

	// It can also be done in a single line, calling the "static"
	// Popup( basePath, width, height, selectFunction ) function:
	// CKFinder.Popup( '../../', null, null, SetFileField ) ;
}

// This is a sample function which is called when a file is selected in CKFinder.
function pick1(fileUrl)
{
	targetUrl = fileUrl.replace('<?php echo $_SERVER['WEBROOT']; ?>','');
	document.getElementById( 'includeurl' ).value = targetUrl ;
}
function pick2( fileUrl )
{
	targetUrl = fileUrl.replace('<?php echo $_SERVER['WEBROOT']; ?>','');
	document.getElementById( 'iframeurl' ).value = targetUrl ;
}
</script>
