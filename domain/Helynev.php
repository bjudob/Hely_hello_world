<?php
/**
 * Created by PhpStorm.
 * User: Botond
 * Date: 06.06.2018
 * Time: 11:25
 */

class Helynev
{
    private $telepules;
    private $standard;
    private $ejtes;
    private $helyfajta;
    private $terkepszam;
    private $ragosalak;
    private $nyelv;
    private $forrasmunkaadat;
    private $forrasmunkaev;
    private $forrasmunkatipus;
    private $objektuminfo;
    private $helyinfo;
    private $nevvaltozatok;

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