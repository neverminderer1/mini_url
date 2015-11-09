<?php
namespace Redirect\Tools;
include ($_SERVER['DOCUMENT_ROOT'].'\vendor\tabgeo\country\src\TabGeo\tabgeo_country_v4.php');

class IpAdress{
    
    private $country;
            
    function __construct($ip) {
        $this->country = tabgeo_country_v4($ip);
    }
    
    public function getCountry(){
        return $this->country;
    }
}
