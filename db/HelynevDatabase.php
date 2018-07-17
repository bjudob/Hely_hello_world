<?php
/**
 * Created by PhpStorm.
 * User: Botond
 * Date: 06.06.2018
 * Time: 12:41
 */

require ("domain/Tajegyseg.php");

class HelynevDatabase
{
    private static $instance;
    private $conn;

    public function __construct()
    {
    }

    private function connect(){
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'helynevek_db_2');
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

    
    public function getHelynev(){
        $telepulesek = array();
        //$array[$key] = "item"

        $this->connect();

        $query="SELECT * FROM tajegyseg";
        $result=mysqli_query($this->con,$query) or die('Hiba tortent');

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

            $telepules=new Tajegyseg();
            $telepules->setValues($id, $nev, $megye, $tajegyseg, $telepulestipus, $nyelv, $isactive);

            $telepulesek[] = $telepules;

        }

        $this->disconnect();
        return $telepulesek;
    }
    
    public function getAllTelepules(){
        $telepulesek = array();
        //$array[$key] = "item"

        $this->connect();

        $query="SELECT * FROM tajegyseg";
        $result=mysqli_query($this->con,$query) or die('Hiba tortent');

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

            $telepules=new Tajegyseg();
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
        
    
}