<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 22.07.2019
 * Time: 17:38
 */


namespace framework\classes;

use framework\traits\Singleton;


class Buffer {

    use Singleton;

    private $buffer = [];
    
    public function set($name, $value)
    {
        $this->buffer[$name] = $value;
    }

    public function get($name)
    {
        return $this->buffer[$name] ?? null;
    }

    public function __get($name)
    {
        return $this->buffer[$name] ?? null;
    }

}
