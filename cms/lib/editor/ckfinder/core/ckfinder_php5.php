<?php

define( 'CKFINDER_DEFAULT_BASEPATH', '/ckfinder/' ) ;

class CKFinder
{
	public $BasePath ;
	public $Width ;
	public $Height ;
	public $SelectFunction ;
	public $ClassName ;

	// PHP 5 Contructor
	function __construct( $basePath = CKFINDER_DEFAULT_BASEPATH, $width = '100%', $height = 400, $selectFunction = null )
	{
		$this->BasePath			= $basePath ;
		$this->Width			= $width ;
		$this->Height			= $height ;
		$this->SelectFunction	= $selectFunction ;
		$this->ClassName		= '' ;
	}

	// Renders CKFinder in the current page.
	public function Create()
	{
			echo $this->CreateHtml() ;
	}

	// Gets the HTML needed to create a CKFinder instance.
	public function CreateHtml()
	{
		$className = $this->ClassName ;
		if ( !empty( $className ) )
			$className = ' class="' . $className . '"' ;

		return '<iframe src="' . $this->_BuildUrl() . '" width="' . $this->Width . '" ' .
			'height="' . $this->Height . '"' . $className . ' frameborder="0" scrolling="no"></iframe>' ;
	}

	private function _BuildUrl()
	{
		$url = $this->BasePath ;

		if ( empty( $url ) )
			$url = CKFINDER_DEFAULT_BASEPATH ;

		if ( $url[ strlen( $url ) - 1 ] != '/' )
			$url = $url . '/' ;

		$url .= 'ckfinder.html' ;

		if ( !empty( $this->SelectFunction ) )
			$url .= '?action=js&amp;func=' . $this->SelectFunction ;

		return $url ;
	}

	// Static "Create".
	public static function CreateStatic( $basePath = CKFINDER_DEFAULT_BASEPATH, $width = '100%', $height = 400, $selectFunction = null )
	{
		$finder = new CKFinder( $basePath, $width, $height, $selectFunction ) ;
		$finder->Create() ;
	}

	// Static "SetupFCKeditor".
	public static function SetupFCKeditor( &$editorObj, $basePath = CKFINDER_DEFAULT_BASEPATH, $imageType = null, $flashType = null )
	{
		if ( empty( $basePath ) )
			$basePath = CKFINDER_DEFAULT_BASEPATH ;

		// If it is a path relative to the current page.
		if ( $basePath[0] != '/' )
		{
			$basePath = substr( $_SERVER[ 'REQUEST_URI' ], 0, strrpos( $_SERVER[ 'REQUEST_URI' ], '/' ) + 1 ) .
				$basePath ;
		}

		$ckfinder = new CKFinder( $basePath ) ;
		$url = $ckfinder->_BuildUrl() ;

		$editorObj->Config['LinkBrowserURL']= $url ;
		$editorObj->Config['ImageBrowserURL'] = $url . '?type=' . ( empty( $imageType ) ? 'Images' : $imageType ) ;
		$editorObj->Config['FlashBrowserURL'] = $url . '?type=' . ( empty( $flashType ) ? 'Flash' : $flashType ) ;
	}
}

?>