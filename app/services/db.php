<?php

    /**
    * set main connection to database
    * @var object $db
    */
    if(config('db.type')){
        $db = new medoo ( 
            array(
            	'database_type'    => config('db.type'),
            	'database_name'    => config('db.db_name'),
            	'server'           => config('db.host'),
            	'username'         => config('db.username'),
            	'password'         => config('db.password'),
            	'charset'          => config('db.charset'),
            	'port'             => config('db.port'),
            	'prefix'           => config('db.prefix'),
                'database_file'    => config('db.database_file'),
            	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            	'option'           => config('db.option')
            )
        );
    }