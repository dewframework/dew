<?php

    /**
    * Class for get and select database with caching
    * load this class from preload.php or before db and cache
    */
    
    class DbCacheService {
        
        /**
        * Start Connection
        * @param object $db_con, db connection class
        * @param object $cache_con, cache connection class
        * @param int $time, set cache time in second
        */
        public function connection($db_con, $cache_con, $time = 600){
            $this->conn = $db_con;
            $this->cache = $cache_con;
            $this->time = $time;
        }
        
        public function select($value = null, $value2 = null, $value3 = null, $value4 = null){
            
            //create db key
            $key = md5(serialize($value).serialize($value2).serialize($value3).serialize($value4));
            
            $result = $this->cache->get($key);
            
            if( is_null($result) ) {
                
                $result = $this->conn->select($value, $value2, $value3, $value4);
                $this->cache->set($key, $result, $this->time);
            
            } 
            
            return $result;
        }
        
        public function get($value = null, $value2 = null, $value3 = null, $value4 = null){
            
            //create db key
            $key = md5(serialize($value).serialize($value2).serialize($value3).serialize($value4));
            
            $result = $this->cache->get($key);
            
            if( is_null($result) ) {
                
                $result = $this->conn->get($value, $value2, $value3, $value4);
                $this->cache->set($key, $result, $this->time);
            
            } 
            
            return $result;
        }
        
    }