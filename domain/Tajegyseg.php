<?php
/**
 * Created by PhpStorm.
 * User: Botond
 * Date: 06.06.2018
 * Time: 12:43
 */

class Tajegyseg
{
    private $id;
    private $nev;
    private $isactive;

    /**
     * Tajegyseg constructor.
     */
    public function __construct()
    {
    }


    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }
}