<?php

    /**
    * load config class and set to $config var
    * @var array $config
    */    
    if( file_exists(__DIR__.'/../config/compiled/config.php') ){  
        
        include_once __DIR__.'/../config/compiled/config.php';
        
    } else {
        
        require_once __DIR__.'/core/config.php';
        $config = new \App\Core\LoadConfig( __DIR__.'/../config' );
        $config = $config->compile( __DIR__.'/../config/compiled' );
          
    }

    //load helper function
    require_once __DIR__.'/core/helper.php';

    //load autoload.php in vendor
    require_once config('path.vendor').'/autoload.php';

    //load all services in app/services folder
    foreach (glob(__DIR__.'/services/*.php') as $service_file) {
        include_once $service_file;
    }

    /**
    * include preload.php
    * preload.php will run before your app run
    */
    include_once __DIR__.'/preload.php';


    /**
    * load match route then run it
    */
    $router_match = $router->match();
    
    if( $router_match && is_string($router_match['target']) ){
        
        /**
         * Get module folder [/] folder name or filename (with the last is class name and filename, before it is folder and namespace) [@] function
         * load function in routes
         * @var array $route_controller
         */
        $route_controller = explode('@', $router_match['target']);
        
        //add view folder from module
        $module_folder = explode('\\', $route_controller[0]);
        $view->addLocation(config('path.modules').'/'.$module_folder[0].'/view');
        
        //run controller
        include_once config('path.modules').'/'.$route_controller[0].'.php';
        $app = new $route_controller[0];
        $app->$route_controller[1]();
    
    }  elseif( $router_match && is_callable( $router_match['target'] ) ) {
        
        //call function
        call_user_func_array( $router_match['target'], $router_match['params'] );
        
    } elseif( !$router_match ){
        
        //set header and show not found page
        header("HTTP/1.0 404 Not Found");
        echo $view->make('404');
        exit();
        
    } else {
        
        //set header and show not found page
        header("HTTP/1.0 405 Method Not Allowed"); 
        echo $view->make('405');
        exit();
        
    }