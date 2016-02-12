<?php

    /**
    * Preload file
    * This file loaded before app loaded
    */
    
    /**
    * start db with caching
    * @global Object $dbc
    */
    $dbc = new DbCacheService;
    $dbc->connection($db, $cache);
    
    /**
     * Add Preload Below
     */