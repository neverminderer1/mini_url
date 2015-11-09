<?php
namespace Redirect\Tools;
/**
 * Запись статистики пользователя
 *
 * @author baranov
 */
class User{
    
    private $table = 'user_data';
    protected $country;
    protected $userAgentData;
    protected $pdo;
    protected $ip;
    protected $mini;
            
    function __construct(IpAdress $country, $userAgentData, \PDO $pdo, $ip, $mini) {
        $this->country = $country;
        $this->userAgentData = $userAgentData;
        $this->pdo = $pdo;
        $this->ip = $ip;
        $this->mini = $mini;
    }
    public function userAdd(){
        $sth = $this->pdo->prepare("INSERT INTO ".$this->table." (mini, device, brouser, os, country, ip, time)"
                . "VALUES (:mini, :devise, :brouser, :os, :country, :ip, NOW())");
        
        return $retval = $sth->execute(array(':mini' => $this->mini,
                       ':devise' => $this->userAgentData->device,
                       ':brouser' => $this->userAgentData->ua->family,
                       ':os' => $this->userAgentData->os->family,
                       ':country' => $this->country->country,
                       ':ip' => $this->ip
        ));
    }
}
