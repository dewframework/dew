<?php

/**
 * @author Ganda Wenang Sani < wenang.sani@gmail.com >
 * @copyright 2016
 */

function config( $var )
{
	global $config;
	return $config[$var];
}

function set_config( $var, $value )
{
	global $config;
	$config[$var] = $value;
}

function t( $text_key )
{
	global $trans;
	return $trans->get( $text_key );
}

function path( $path )
{
	return config( 'path.base_path' ) .'/'. $path;
}

function redirect( $url )
{
	if ( !eregi( "^http", $url ) ) {
		$url = config( 'app.base_url' ) . '/' . $url;
	}
	header( "Location:$url" );
}

function url( $url )
{
	if ( !eregi( "^http", $url ) ) {
		$url = config( 'app.base_url' ) . '/' . $url;
	}
	return $url;
}

function json( $json = array( ) )
{
	return json_encode( $json );
}

function get_rand( $length, $possible = "0123456789abcdefghijklmnopqrstuvwxyz" )
{
	srand( (double) microtime() * 1000000 );
	$str = "";
	while ( strlen( $str ) < $length ) {
		$str .= substr( $possible, rand( 0, 50 ), 1 );
	}
	return ( $str );
}

function get_date( $timeline, $type = 'time', $timezone = 0 )
{
	$settings = array(
		 'time_format' => 'g:i a',
		'date_format' => 'M jS Y',
		'date_today' => t( 'today' ),
		'date_yesterday' => t( 'yesterday' ) 
	);
	$timeline = $timeline + $timezone * 3600;
	$current  = time() + $timezone * 3600;
	$it_s     = intval( $current - $timeline );
	$it_m     = intval( $it_s / 60 );
	$it_h     = intval( $it_m / 60 );
	$it_d     = intval( $it_h / 24 );
	$it_y     = intval( $it_d / 365 );
	if ( $type == 'date' ) {
		return gmdate( $settings['date_format'], $timeline );
	} else {
		if ( gmdate( "j", $timeline ) == gmdate( "j", $current ) ) {
			return $settings['date_today'] . ', ' . gmdate( $settings['time_format'], $timeline );
		} elseif ( gmdate( "j", $timeline ) == gmdate( "j", ( $current - 3600 * 24 ) ) ) {
			return $settings['date_yesterday'] . ', ' . gmdate( $settings['time_format'], $timeline );
		}
		return gmdate( $settings['date_format'] . ', ' . $settings['time_format'], $timeline );
	}
}

function get_post( $post_list = array( ) )
{
	
	foreach ( $post_list as $post ) {
		$output[$post] = $_POST[$post];
	}
	
	$_POST = array( );
	
	return $output;
}

function tool($tool_name, $config = null)
{
    
    if( file_exists(config('path.base_path').'/app/tools/'.$tool_name.'/'.$tool_name.'.php') ) {
        
        include_once config('path.base_path').'/app/tools/'.$tool_name.'/'.$tool_name.'.php';
        $tool = '\\app\\tool\\'.$tool_name.'\\'.$tool_name;
        
        if(is_null($config)){
            $output = new $tool;
        } else {
            $output = new $tool($config);
        }
        
        return $output;
        
    } else {
        
        return false;
        
    }
    
}