<?php
/**
 * Created by PhpStorm.
 * User: Botond
 * Date: 06.06.2018
 * Time: 12:43
 */

class Telepules
{
    private $id;
    private $nev;
    private $megye;
    private $tajegyseg;
    private $telepulestipus;
    private $nyelv;
    private $isactive;

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