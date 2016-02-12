<?php

/**
 * insert database info below
 * Choose Database type ( mysql, sqlite, pgsql, oci, dblib )
 * more info http://medoo.in/api/new
 */

$CONFIG = array(
    'type'          => '',
    'host'          => '',
    'username'      => '',
    'password'      => '',
    'db_name'       => '',
    'prefix'        => '',
   	'charset'       => 'utf8',
	'port'          => 3306,
    'database_file' => '', // for sqlite
    'option'        => array( PDO::ATTR_CASE => PDO::CASE_NATURAL )
);