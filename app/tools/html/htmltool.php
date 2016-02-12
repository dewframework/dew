<?php

namespace app\tool\html;

use \Mihaeu\HtmlFormatter as HtmlFormatter;

class html{
    
    public function minify_body($buffer)
    {
        
        $body = ereg_replace('(.*)<body(.*)/body>(.*)', '\2', $buffer);
        
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s',  // shorten multiple whitespace sequences
            '/\n/s',
        );
    
        $replace = array(
            '>',
            '<',
            '\\1',
            ' ',
        );
    
        $body = preg_replace($search, $replace, $body);
        
        $output = trim(preg_replace('/<body(.*)\/body>/s', '<body'.$body.'/body>', $buffer));
    
        return $output;
    }
    
    public function format($html){
        
        return HtmlFormatter::format($html);
    
    }
    
}