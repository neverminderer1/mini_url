<?php
namespace Redirect\Tools;

class Redirect
{
    private $longUrl;
    
    function __construct( $longUrl) {
        $this->longUrl = $longUrl;
    }
    
    public function redirect(){
        if(is_null($this->longUrl)){
            return header('Location: index.html');
        }              
    return header('Location: '.$this->longUrl);        
    }
    
    
}

   

