<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '..\src\Redirect\Tools\MiniUrl.php';
/**
 * Description of MiniUrlTest
 *
 * @author e.baranov
 */
class MiniUrlTest extends PHPUnit_Framework_TestCase {
    
    private $miniUrl;
    
    function setUp(){
        $this->miniUrl = new Redirect\Tools\MiniUrl();
    }
    public function addDataProvider() {
        return array(
            array(111111110, 111111110),
            array('dfjdhbfjsdbf','dfjdhbfjsdbf')
        );
    }
    /**
     * @dataProvider addDataProvider
     */
    function testGet($url, $expected){
        $this->miniUrl->setMiniUrl($url);
        $this->assertEquals($expected, $this->miniUrl->getMiniUrl());           
    }
    /**
     * @dataProvider addDataProvider
     */
    function testSet($url, $expected){
        $this->miniUrl->setMiniUrl($url);
        $this->assertEquals($expected, $this->miniUrl->field);
        
        $this->setExpectedException(Exception);
        $this->miniUrl->setMiniUrl("");
    }
    
    
}
