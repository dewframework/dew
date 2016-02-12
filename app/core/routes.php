<?php
namespace App\Core;

class LoadRoutes
{
	
	/**
	 * set module path
	 */
	public function __construct( $path )
	{
		$this->module_path = $path;
	}
	
	/**
	 * include all module routes.php in folder modules
	 */
	public function all( )
	{
		
		global $router;
		
		$modules = scandir( $this->module_path );
		
		foreach ( $modules as $module ) {
			
			if ( $module != '.' || $modules != '..' ) {
				if ( is_dir( $this->module_path . '/' . $module ) && file_exists( $this->module_path . '/' . $module . '/routes.php' ) ) {
					include_once $this->module_path . '/' . $module . '/routes.php';
				}
			}
			
		}
		
		
	}
	
	
	/**
	 * include module routes.php in folder modules
	 * @param Array $modules
	 */
	public function load( $modules = array( ) )
	{
		
		global $router;
		
		foreach ( $modules as $module ) {
			if ( file_exists( $this->module_path . '/' . $module . '/routes.php' ) ) {
				include_once $this->module_path . '/' . $module . '/routes.php';
			}
		}
	}
}