<?php
namespace Redirect\Tools;
/**
 * Description of Connection
 *
 * @author baranov
 */
class Connect extends \PDO
{

    public function __construct($file = 'conf.ini')
    {
        if (!$settings = parse_ini_file(dirname(__FILE__) . '\\'.$file, TRUE)) {
            throw new \Exception('Unable to open ' . $file . '.');
        }

        $dns = $settings['database']['driver'] .
        ':host=' . $settings['database']['host'] .
        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
        ';dbname=' . $settings['database']['schema'];
        
        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }
}
