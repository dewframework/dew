<?php

include '/../server.php';

$CONFIG = array(
    'base_path' => $SERVER_PATH,
    'app'       => $SERVER_PATH.'/app',
    'config'    => $SERVER_PATH.'/config',
    'modules'   => $SERVER_PATH.'/modules',
    'vendor'    => $SERVER_PATH.'/vendor',
    'themes'    => $SERVER_PATH.'/themes',
    'storages'  => $SERVER_PATH.'/storages'
);

$SERVER_PATH = '';