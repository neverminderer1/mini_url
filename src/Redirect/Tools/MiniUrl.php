<?php
namespace Redirect\Tools;

class MiniUrl
{

    private $field;

    public function getMiniUrl() {
        return $this->field;
    }

    public function setMiniUrl($mini) {
        if (empty($mini)) {
            throw new \Exception("MiniURL field is empty");
        }
        return $this->field = $mini;
    }

}
