<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once '..\src\Redirect\Tools\DbQueries.php';
//require_once '..\src\Redirect\Tools\Connect.php';
include '..\autoloader.php';
/**
 * Description of DbQueriesTest
 *
 * @author e.baranov
 */
class DbQueriesTest extends PHPUnit_Framework_TestCase {
    
    protected $dbQuery;
    protected $pdo;
            
            
    function setUp() {
        $this->pdo = new Redirect\Tools\Connect();
        $this->dbQuery = new Redirect\Tools\DbQueries($pdo);
        $this->pdo->exec("INSERT INTO ".$this->dbQuery->table." (long_url, mini, create_time, life_time) "
                . "VALUES ('http://php.net/', 'php', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 HOUR))");
        $this->pdo->exec("INSERT INTO ".$this->dbQuery->table." (long_url, mini, create_time, life_time) "
                . "VALUES ('http://php.net/', 'old', CURDATE(), '3.11.2015 15:29')");        
    }
    
    public function dataForUrlIsTemp() {
        return array(
            array('-1', true),
            array(-2, true),
            array(0, true),
            array(NULL, false),
        );
    }
    public function dataForUrlIsEnd() {
        return array(
            array('php', false),
            array('-2', true),
            array(0, true),
            array(NULL, false),
        );
    }
    /**
     * @dataProvider dataForUrlIsTemp
     */
    public function testUrlIsTemp($lifeTime, $expected){
        $this->assertEquals($expected, $this->dbQuery->urlIsTemp($lifeTime));        
    }
    /**
     * @dataProvider dataForUrlIsEnd
     */
    public function testTempUrlIsEnd($lifeTime, $miniUrl, $expected){       
        
        $this->pdo->exec("INSERT INTO ".$this->dbQuery->table." (long_url, mini, create_time, life_time) "
                . "VALUES ('http://php.net/', 'php', CURDATE(), 5.11.2015 15:29)");        
        $this->assertEquals($expected, $this->dbQuery->tempUrlIsEnd('5.11.2015 15:29', $miniUrl));      
    }
}
