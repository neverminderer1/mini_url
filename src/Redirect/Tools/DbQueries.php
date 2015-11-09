<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Redirect\Tools;
use Exception;
/**
 * Description of DbQueries
 *
 * @author lalka
 */
class DbQueries 
{

    private $table = "temp_test";
    public $mini;
    public $long;
    protected $dbh;
    protected $time;

    function __construct(\PDO $pdo) {
        $this->long = new LongUrl;
        $this->mini = new MiniUrl;
        $this->time = date("Y-m-d G:i:s");
        $this->dbh = $pdo;
    }

    private function urlIsTemp($life_time) {
        if (!is_null($life_time)) {
            return true;
        }
        return false;
    }

    private function tempUrlIsEnd($selectResult, $miniUrl) {
        if ((strtotime($selectResult['life_time']) < strtotime($this->time)) === true) {
            $sth = $this->dbh->prepare("DELETE FROM ". $this->table ." WHERE mini = :name");
            return $sth->execute(array(':name' => $miniUrl));
        }
        return false;
    }

    public function Select($miniUrl) {

        $sth = $this->dbh->prepare("SELECT long_url, life_time FROM ".$this->table." WHERE mini = :name");
        $sth->execute(array(':name' => $miniUrl));
        $urlLifeTimeInDb = $sth->fetch(\PDO::FETCH_ASSOC);
        
        if ($this->urlIsTemp($urlLifeTimeInDb['life_time'])) {
            if ($this->tempUrlIsEnd($urlLifeTimeInDb, $miniUrl)) {
                throw new Exception("Времменая ссылка была удалена");
            }
        }
        
        return $urlLifeTimeInDb['long_url'];
    }

    public function Insert($lifeTime) {
        
        if (self::Select($this->mini->getMiniUrl()) != "") {
            throw new Exception("Вы ввели существующее значение мини-URL");
        }       
        if($lifeTime === ""){
            $lifeTime = null;
        }
        
        $sth = $this->dbh->prepare("INSERT INTO ".$this->table." (long_url, mini, create_time, life_time) "
                . "VALUES (:url, :name, :create_time, DATE_ADD(:create_time, INTERVAL :lifetime HOUR))");       
        return $sth->execute(array(':name'  => $this->mini->getMiniUrl(),
                            ':url'          => $this->long->getLongUrl(),
                            ':create_time'  => $this->time,
                            ':lifetime'     => $lifeTime
        ));
    }
       
    public function __call($method, $arguments) {
        if (method_exists($this->mini, $method)) {
            return call_user_func_array(array($this->mini, $method), $arguments);
        }
        if (method_exists($this->long, $method)) {
            return call_user_func_array(array($this->long, $method), $arguments);
        }
    }

}
