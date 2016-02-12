<?php
namespace App\Core;

class LoadConfig
{
	
	//set config path
	public function __construct( $path )
	{
		$this->config_path = $path;
	}
	
	/**
	 * load all config in path
	 * @return array 
	 */    
    public function compile($dir){
        
        foreach ( glob( $this->config_path . '/*.php' ) as $config_file ) {
            
 			include_once $config_file;
 			$config_filename = str_replace( $this->config_path . '/', '', $config_file );
 			$config_filename = str_replace( '.php', '', $config_filename );
 			foreach ( $CONFIG as $con => $val ) {
				$config_set[$config_filename . '.' . $con] = $val;
 			}
            
  		}
            
        //save config
        $config_temp = '<?php $config = '.var_export($config_set, true).';';
        file_put_contents($dir.'/config.php', $config_temp); 
            
        return $config_set;
      
    }
}