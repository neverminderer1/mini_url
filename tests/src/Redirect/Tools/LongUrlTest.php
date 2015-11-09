<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '..\src\Redirect\Tools\LongUrl.php';

/**
 * Description of LongUrlTests
 *
 * @author e.baranov    
 */
class LongUrlTest extends PHPUnit_Framework_TestCase {

    private $longUrl;

    function setUp() {
        $this->longUrl = new Redirect\Tools\LongUrl();
    }
    
    public function addDataProvider() {
        return array(
            array('http://bugscatcher.net/archives/1103', 'http://bugscatcher.net/archives/1103'),
            array('http://habrahabr.ru/post/56289/','http://habrahabr.ru/post/56289/'),
            array('http://php.net/manual/ru/class.pdo.php', 'http://php.net/manual/ru/class.pdo.php')
        );
    }
    /**
     * @dataProvider addDataProvider
     */
    function testGet($url, $expected) {
        $this->longUrl->field = $url;
        $this->assertEquals($expected, $this->longUrl->getLongUrl());
    }
    /**
     * @dataProvider addDataProvider
     */
    function testSet($url, $expected) {
        $this->longUrl->setLongUrl($url);
        $this->assertEquals($expected, $this->longUrl->field);

        $this->setExpectedException(Exception);
        $this->longUrl->setLongUrl("");
        
        $this->setExpectedException(Exception);
        $this->longUrl->setLongUrl(NULL);

        $this->setExpectedException(Exception);
        $this->longUrl->setLongUrl("1111");

        $this->setExpectedException(Exception);
        $this->longUrl->setLongUrl("file:///C.pdf");
    }
}
