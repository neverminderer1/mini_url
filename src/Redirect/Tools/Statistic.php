<?php
namespace Redirect\Tools;
use UAParser\Parser;

/**
 * Класс парсит User Agent
 *
 * @author baranov
 */
class Statistic {
    /**
     *
     * @var object
     */
    private $userAgentData;
    
    function __construct($userAgentData) {
        $this->userAgentData = $userAgentData;
    }
    /**
     *
     * @return object данные из User Agent
     */
    public function parseUaData(){
        $parser = Parser::create();
        return $parser->parse($this->userAgentData);
    }
}



