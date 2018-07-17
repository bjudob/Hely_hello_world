<?php
/**
 * Created by PhpStorm.
 * User: Botond
 * Date: 06.06.2018
 * Time: 11:25
 */

class Helynev
{
    private $standard;
    private $telepules;
    private $ejtes;
    private $helyfajtaNev;
    private $helyfajtaKod;
    private $terkepszam;
    private $ragosalak;
    private $nyelv;
    private $forrasmunkaadat;
    private $forrasmunkaev;
    private $forrasmunkatipus;
    private $objektuminfo;
    private $helyinfo;
    private $nevvaltozatok;
    private $isactive;

    /**
     * Helynev constructor.
     */
    public function __construct()
    {
    }

    //all args constructor
    public function setValues($standard, $telepules, $ejtes, $helyfajtaNev, $helyfajtaKod, $terkepszam, $ragosalak, $nyelv, $forrasmunkaadat, $forrasmunkaev, $forrasmunkatipus, $objektuminfo, $helyinfo, $nevvaltozatok, $isactive)
    {
        $this->standard = $standard;
        $this->telepules = $telepules;
        $this->ejtes = $ejtes;
        $this->helyfajtaNev = $helyfajtaNev;
        $this->helyfajtaKod = $helyfajtaKod;
        $this->terkepszam = $terkepszam;
        $this->ragosalak = $ragosalak;
        $this->nyelv = $nyelv;
        $this->forrasmunkaadat = $forrasmunkaadat;
        $this->forrasmunkaev = $forrasmunkaev;
        $this->forrasmunkatipus = $forrasmunkatipus;
        $this->objektuminfo = $objektuminfo;
        $this->helyinfo = $helyinfo;
        $this->nevvaltozatok = $nevvaltozatok;
        $this->isactive = $isactive;
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