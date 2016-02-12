<?php

/**
* Translate Service
* @global Object $trans
*/
class TranslateService
{
	
	/**
	 * load translate file
	 */
	public function file( $file )
	{
		if ( file_exists( $file ) ) {
			include_once $file;
			foreach ( $TRANSLATE as $text_key => $val ) {
				$this->translate[$text_key] = $val;
			}
		}
	}
	
	/**
	 * set translation
	 * @param string $text_key
	 * @param string $value
	 */
	public function set( $text_key, $val )
	{
		$this->translate[$text_key] = $val;
	}
	
	/**
	 * get translation
	 * @param string $text_key
	 * @return string
	 */
	public function get( $text_key )
	{
		if ( $this->translate[$text_key] ) {
			return $this->translate[$text_key];
		} else {
			return $text_key;
		}
	}
	
}

    /**
    * load translate class
    * @var object $trans
    */
    $trans = new TranslateService;