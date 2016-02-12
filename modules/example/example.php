<?php

namespace example;

class example{
    
    public function home(){
        global $db, $cache, $view;
        
        echo $view->make('ex', array('title' => 'EXAMPLE MODULE') );
        
    }
}