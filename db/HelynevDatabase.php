<?php
/**
 * Created by PhpStorm.
 * User: Botond
 * Date: 06.06.2018
 * Time: 12:41
 */

class HelynevDatabase
{
    private $conn;

    /**
     * HelynevDatabase constructor.
     */
    public function __construct()
    {
    }

    public function getAllTajegyseg(){
        $tajegysegek = array();
        //$array[$key] = "item"

        $this->connect();

        $query="SELECT * 
        			    FROM tajegyseg";
        $result=mysqli_query($this->con,$query) or die('Hiba tortent');

        while($row=mysqli_fetch_array($result)){
            $id=$row['ID'];
            $nev=$row['Nev'];

        }

        $this->disconnect();
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

}