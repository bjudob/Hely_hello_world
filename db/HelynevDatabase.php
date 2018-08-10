<?php
/**
 * Created by PhpStorm.
 * User: Botond
 * Date: 06.06.2018
 * Time: 12:41
 */

require ("domain/Tajegyseg.php");
require ("domain/Telepules.php");
require ("domain/Helynev.php");

class HelynevDatabase
{
    private static $instance;
    private $conn;

    public function __construct()
    {
    }

    private function connect(){
        if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
        if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
        if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
        if (!defined('DB_DATABASE')) define('DB_DATABASE', 'helynevek_db_2');
        $this->con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        if(!$this->con){
            die('Az adatbázis nem elérhető!');
        }
        mysqli_query($this->con,"SET NAMES utf8");
        mysqli_set_charset($this->con,"UTF8");
    }

    private function disconnect(){
        mysqli_close($this->con);
    }

    
    public function getAllHelynev(){
        $helynevek = array();
        //$array[$key] = "item"

        $this->connect();
        
        $query = "SELECT
            helynev.ID, 
            Standard,
            Telepules,
            Ejtes,
            helyfajta.Nev as helyfajtaNev,
            helyfajta.Kod as helyfajtaKod,
            Terkepszam,
            Ragos_Alak,
            nyelv.Nev as nyelvNev,
            Forras_Adat,
            Forras_Ev,
            Forras_Tipus,
            Objektum_Info,
            Nev_Info,
            Nevvarians,
            Is_Active
            FROM `helynev` 
            INNER JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            INNER JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID";
        $result=mysqli_query($this->con,$query) or die('Hiba tortent');
        
        while($row=mysqli_fetch_array($result)){
            $standard=$row['Standard'];
            $telepules=$row['Telepules'];
            $ejtes=$row['Ejtes'];
            $helyfajtaNev=$row['helyfajtaNev'];
            $helyfajtaKod=$row['helyfajtaKod'];
            $terkepszam=$row['Terkepszam'];
            $ragosalak=$row['Ragos_Alak'];
            $nyelv=$row['nyelvNev'];
            $forrasmunkaadat=$row['Forras_Adat'];
            $forrasmunkaev=$row['Forras_Ev'];
            $forrasmunkatipus=$row['Forras_Tipus'];
            $objektuminfo=$row['Objektum_Info'];
            $helyinfo=$row['Nev_Info'];
            $nevvaltozatok=$row['Nevvarians'];
            $isactive=$row['Is_Active'];

            $helynev=new Helynev();
            $helynev->setValues($standard, $telepules, $ejtes, $helyfajtaNev, $helyfajtaKod, $terkepszam, $ragosalak, $nyelv, $forrasmunkaadat, $forrasmunkaev, $forrasmunkatipus, $objektuminfo, $helyinfo, $nevvaltozatok, $isactive);

            $helynevek[] = $helynev;

        }

        $this->disconnect();
        return $helynevek;
    }
    
    public function getAllTelepules(){
        $telepulesek = array();
        //$array[$key] = "item"

        $this->connect();

        $query="SELECT 
                    telepules.ID as id,
                    telepules.Nev as nev,
                    megye.Nev as megye,
                    tajegyseg.Nev as tajegyseg,
                    telepulestipus.Nev as telepulestipus,
                    nyelv.Nev as nyelv,
                    telepules.Is_Active as isactive

                    FROM telepules
                    INNER JOIN megye ON megye.ID=telepules.Megye
                    INNER JOIN tajegyseg ON tajegyseg.ID=telepules.Tajegyseg
                    INNER JOIN telepulestipus ON telepulestipus.ID=telepules.Telepules_Tipus
                    INNER JOIN nyelv ON nyelv.ID=telepules.Nyelv";
        $result=mysqli_query($this->con,$query) or die('Hiba tortent');
        
        while($row=mysqli_fetch_array($result)){
            $id=$row['id'];
            $nev=$row['nev'];
            $megye=$row['megye'];
            $tajegyseg=$row['tajegyseg'];
            $telepulestipus=$row['telepulestipus'];
            $nyelv=$row['nyelv'];
            $isactive=$row['isactive'];

            $telepules=new Telepules();
            $telepules->setValues($id, $nev, $megye, $tajegyseg, $telepulestipus, $nyelv, $isactive);

            $telepulesek[] = $telepules;

        }

        $this->disconnect();
        return $telepulesek;
    }
    
    public function getAllTajegyseg(){
        $tajegysegek = array();
        //$array[$key] = "item"

        $this->connect();

        $query="SELECT * FROM tajegyseg";
        $result=mysqli_query($this->con,$query) or die('Hiba tortent');

        while($row=mysqli_fetch_array($result)){
            $id=$row['ID'];
            $nev=$row['Nev'];
            $isactive=$row['Is_Active'];

            $tajegyseg=new Tajegyseg();
            $tajegyseg->setValues($id, $nev, $isactive);

            $tajegysegek[] = $tajegyseg;

        }

        $this->disconnect();
        return $tajegysegek;
    }
        
    public function getTelepulesByTajegyseg(){
        $telepulesek = array();

        $this->connect();

        $query="SELECT 
                    telepules.ID as id,
                    telepules.Nev as nev,
                    megye.Nev as megye,
                    tajegyseg.Nev as tajegyseg,
                    telepulestipus.Nev as telepulestipus,
                    nyelv.Nev as nyelv,
                    telepules.Is_Active as isactive

                    FROM telepules
                    INNER JOIN megye ON megye.ID=telepules.Megye
                    INNER JOIN tajegyseg ON tajegyseg.ID=telepules.Tajegyseg
                    INNER JOIN telepulestipus ON telepulestipus.ID=telepules.Telepules_Tipus
                    INNER JOIN nyelv ON nyelv.ID=telepules.Nyelv";
        $result=mysqli_query($this->con,$query) or die('Hiba tortent');
        
        while($row=mysqli_fetch_array($result)){
            $id=$row['id'];
            $nev=$row['nev'];
            $megye=$row['megye'];
            $tajegyseg=$row['tajegyseg'];
            $telepulestipus=$row['telepulestipus'];
            $nyelv=$row['nyelv'];
            $isactive=$row['isactive'];

            $telepules=new Telepules();
            $telepules->setValues($id, $nev, $megye, $tajegyseg, $telepulestipus, $nyelv, $isactive);

            $telepulesek[$tajegyseg] = $telepules;

        }

        $this->disconnect();
        return $telepulesek;
    }
}