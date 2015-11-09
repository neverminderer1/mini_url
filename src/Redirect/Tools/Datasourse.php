<?php
require_once 'Connect.php';

class Datasource {
    
    private $pdo;
    protected $data = array();
    private $table = 'user_data';
            
    function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    
   public function getDataForChart($needRow, $mini){
        $sth = $this->pdo->prepare("SELECT ".$needRow.", count(:mini) FROM ".$this->table." WHERE mini = :mini"
              . " GROUP BY ".$needRow);
        $sth->execute(array(":mini" => $mini));
        $res = $sth->fetchAll(\PDO::FETCH_ASSOC);
        
        $column_chart_data[] = array($needRow, "Clicks");
        foreach($res as $result)
         {
          $column_chart_data[] = array($result[$needRow], (int)$result["count('f')"]);
         }  
         
        return json_encode($column_chart_data);
    }        
}
$pdo = new Redirect\Tools\Connect();
$lil = new Datasource($pdo);
$browser = $lil->getDataForChart('browser', 'miniurl');
$device = $lil->getDataForChart('device', 'miniurl');
$geo = $lil->getDataForChart('country', 'miniurl');
$os = $lil->getDataForChart('os', 'miniurl');





