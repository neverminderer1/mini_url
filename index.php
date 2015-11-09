<?php

require_once 'vendor/autoload.php';

define("MINI_URL", $_POST['miniUrl']);
define("LONG_URL", $_POST['longUrl']);
define("LIFE_TIME", $_POST['lifetime']);
define("URI", $_SERVER['REQUEST_URI']);
define("IP_ADDRESS", $_SERVER['REMOTE_ADDR']);
define("USER_AGENT", $_SERVER['HTTP_USER_AGENT']);

$pdo = new Redirect\Tools\Connect();
$res = new Redirect\Tools\DbQueries($pdo);
try {
    if(isset($_POST['longUrl']) && isset($_POST['miniUrl'])){
        $res->setLongUrl(LONG_URL);
        $res->setMiniUrl(MINI_URL);
        isset($_POST['lifetime']) ? $res->Insert(LIFE_TIME) : $res->Insert(NULL);
        echo 'Добавлено!';
    }
} catch (Exception $e) {
    echo $e->getMessage();
    
}
try{
    if(stripos(URI, '.') === false){
        $direct = new Redirect\Tools\Redirect($res->Select(str_replace("/", "", URI)));
        if(isset($direct->longUrl)){
            $country = new Redirect\Tools\IpAdress(IP_ADDRESS);       
            $statistic = new Redirect\Tools\Statistic(USER_AGENT);
            $user = new Redirect\Tools\User($country, $statistic->parseUaData(),
                    $pdo, IP_ADDRESS, str_replace("/", "", URI));
            $user->userAdd();
        }
        
        $direct->redirect();    
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}





