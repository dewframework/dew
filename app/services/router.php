<?php

    require_once config('path.base_path').'/app/core/routes.php';
    
    /**
     * Create Route
     * for add routes use $router in every modules
     * @global object $router
     */
    $router = new AltoRouter();
    
    /**
    * set router base path
    */
    $router->setBasePath('/');
    
    /**
     * Load Module Path for router
     * @global object $loadroutes
     */
    $loadroutes = new \App\Core\LoadRoutes( config('path.modules') );
    
    /**
     * use $loadroutes->all(); for load all
     * $loadroutes->load([array]); for load only you need
     */
    $loadroutes->all();