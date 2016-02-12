<?php

/**
* Session Service
* @global Object $session
*/
    
class SessionService
{
	
	/**
	 * start session
	 */
	public function start_session( )
	{
		session_start();
		session_regenerate_id( true );
		header( "Cache-control: private" );
	}
	
	/**
	 * set session name
	 * @param string $name
	 */
	public function name( $name )
	{
		$this->session_name = $name;
		return $this;
	}
	
	/**
	 * set session
	 * @param string $value
	 * @param int $expired
	 */
	public function set( $value, $expired = '' )
	{
		$_SESSION[$this->session_name] = $value;
		if ( $expired ) {
			//expired time
			$_SESSION['expired_' . $this->session_name] = $expired;
		}
	}
	
	/**
	 * destroy session
	 */
	public function destroy( )
	{
		$_SESSION[$this->session_name]              = '';
		$_SESSION['expired_' . $this->session_name] = '';
	}
	
	/**
	 * check session
	 */
	public function check( )
	{
		if ( $_SESSION['expired_' . $this->session_name] && $_SESSION['expired_' . $this->session_name] > time() ) {
			return true;
		} else {
			$_SESSION[$this->session_name]              = '';
			$_SESSION['expired_' . $this->session_name] = '';
			return false;
		}
	}
	
	/**
	 * get session value
	 */
	public function get( )
	{
		return $_SESSION[$this->session_name];
	}
	
	/**
	 * get session expired time
	 */
	public function get_expired( )
	{
		return $_SESSION['expired_' . $this->session_name];
	}
	
	/**
	 * refresh session
	 * @param int $add_time, time addition in second
	 */
	public function refresh( $add_time = '' )
	{
		if ( $add_time ) {
			if ( $_SESSION['expired_' . $this->session_name] && $_SESSION['expired_' . $this->session_name] > time() ) {
				$_SESSION['expired_' . $this->session_name] = time() + $add_time;
			} else {
				$this->destroy();
			}
		}
	}
}


    /**
    * start session class
    * @var object $session
    */
    $session = new SessionService;
    
    /**
    * start session
    */
    $session->start_session();