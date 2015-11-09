<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Redirect\Tools;

/**
 * Description of LongUrl
 *
 * @author lalka
 */
class LongUrl 
{

    private $field;

    public function getLongUrl() {
        return $this->field;
    }

    public function setLongUrl($url) {
        if (empty($url)) {
            throw new \Exception("You have not entered a URL");
        }

        if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED)) {
            throw new \Exception("URL has incorrect format");
        }

        if ($this->checkUrlExist($url) == "404" ||
                $this->checkUrlExist($url) === false) {
            throw new \Exception("URL не существует");
        }

        return $this->field = $url;
    }

    private function checkUrlExist($url)
{
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
        curl_exec($ch);
	$response_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	($response_status === '404') ? false : true;
}

}
