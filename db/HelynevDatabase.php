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

    //DATABASE CONNECTION
    private function connect(){
        if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
        if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
        if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
        if (!defined('DB_DATABASE')) define('DB_DATABASE', 'id2643544_training_db');
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

    //HELYNEVEK
    public function getAllHelynev(){
        $this->connect();

        $query = "SELECT
            helynev.ID, 
            Standard,
            telepules.ID as telepulesId,
            telepules.nev as telepulesNev,
            tajegyseg.ID as tajegysegId,
            tajegyseg.Nev as tajegysegNev,
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
            Termeszetes,
            Mikro,
            nevszerkezettipus.Nev as nevszerkezetNev,
            nevszerkezettipus.Egyreszes as nevszerkezetEgyreszes,
            nr.Nev as R,
            nr.Kod as Rkod,
            lm.Nev as LM,
            lm.Kod as LMkod,
            t.Nev as T,
            t.Kod as Tkod,
            nar.Nev as AR,
            nar.Kod as ARkod,
            alm.Nev as ALM,
            alm.Kod as ALMkod,
            at.Nev as AT,
            at.Kod as ATkod,
            nbr.Nev as BR,
            nbr.Kod as BRkod,
            blm.Nev as BLM,
            blm.Kod as BLMkod,
            bt.Nev as BT,
            bt.Kod as BTkod,
            `nevalkotasszabaly`.Nev as nevalkotasiszabaly,	
            `nevalkotasszabaly`.Kod as nevalkotasiszabalyKod	
            FROM `helynev` 
            LEFT JOIN `telepules` ON `helynev`.Telepules=`telepules`.ID
            LEFT JOIN `tajegyseg` ON `telepules`.Tajegyseg=`tajegyseg`.ID
            LEFT JOIN `nevszerkezettipus` ON `helynev`.Nevszerkezettipus=`nevszerkezettipus`.ID
            LEFT JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            LEFT JOIN `nevresz` nr ON `helynev`.R=nr.ID
            LEFT JOIN `nevresz` nar ON `helynev`.AR=nar.ID
            LEFT JOIN `nevresz` nbr ON `helynev`.BR=nbr.ID
            LEFT JOIN `lexikalis` lm ON `helynev`.LM=lm.ID
            LEFT JOIN `lexikalis` alm ON `helynev`.ALM=alm.ID
            LEFT JOIN `lexikalis` blm ON `helynev`.BLM=blm.ID
            LEFT JOIN `toldalek` t ON `helynev`.T=t.ID
            LEFT JOIN `toldalek` at ON `helynev`.AT=at.ID
            LEFT JOIN `toldalek` bt ON `helynev`.BT=bt.ID
            LEFT JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID
            LEFT JOIN `nevalkotasszabaly` ON `helynev`.`Nevalkotasi Szabaly`=`nevalkotasszabaly`.ID
            ORDER BY Standard_Hash";

        $result=mysqli_query($this->con,$query) or die('hiba');

        while($row = mysqli_fetch_array($result)){
            $helynevek[]=array(
                "id"=>$row["ID"],
                "telepulesId"=>$row['telepulesId'],
                "telepulesNev"=>$row['telepulesNev'],
                "tajegysegId"=>$row['tajegysegId'],
                "tajegysegNev"=>$row['tajegysegNev'],
                "standard"=>$row["Standard"],
                "ejtes"=>$row["Ejtes"],
                "helyfajtaNev"=>$row["helyfajtaNev"],
                "helyfajtaKod"=>$row["helyfajtaKod"],
                "terkepszam"=>$row["Terkepszam"],
                "ragos_alak"=>$row["Ragos_Alak"],
                "nyelv"=>$row["nyelvNev"],
                "forras_adat"=>$row["Forras_Adat"],
                "forras_ev"=>$row["Forras_Ev"],
                "forras_tipus"=>$row["Forras_Tipus"],
                "objektum_info"=>$row["Objektum_Info"],
                "nev_info"=>$row["Nev_Info"],
                "nevvarians"=>$row["Nevvarians"],
                "termeszetes"=>$row["Termeszetes"],
                "mikro"=>$row["Mikro"],
                "nevszerkezetNev"=>$row["nevszerkezetNev"],
                "nevszerkezetEgyreszes"=>$row["nevszerkezetEgyreszes"],
                "r"=>$row["R"],
                "rKod"=>$row["Rkod"],
                "lm"=>$row["LM"],
                "lmKod"=>$row["LMkod"],
                "t"=>$row["T"],
                "tKod"=>$row["Tkod"],
                "ar"=>$row["AR"],
                "arKod"=>$row["ARkod"],
                "alm"=>$row["ALM"],
                "almKod"=>$row["ALMkod"],
                "at"=>$row["AT"],
                "atKod"=>$row["ATkod"],
                "br"=>$row["BR"],
                "brKod"=>$row["BRkod"],
                "blm"=>$row["BLM"],
                "blmKod"=>$row["BLMkod"],
                "bt"=>$row["BT"],
                "btKod"=>$row["BTkod"],
                "nevalkotasiszabaly"=>$row["nevalkotasiszabaly"],
                "nevalkotasiszabalyKod"=>$row["nevalkotasiszabalyKod"]
                );
        }

        $this->disconnect();

        return $helynevek;
    }
    
    public function getHelynev($id){
        $helynev=new Helynev();
        
        $this->connect();
        
        $query = "SELECT
            helynev.ID, 
            Standard,
            telepules.Nev as telepules,
            Ejtes,
            helyfajta.Nev as helyfajtaNev,
            helyfajta.Kod as helyfajtaKod,
            Terkepszam,
            Ragos_Alak,
            nyelv.Nev as joinNyelv,
            Forras_Adat,
            Forras_Ev,
            Forras_Tipus,
            Objektum_Info,
            Nev_Info,
            Nevvarians,
            Termeszetes,
            Mikro,
            Nevszerkezettipus,
            R,
            LM,
            T,
            AR,
            ALM,
            AT,
            BR,
            BLM,
            BT,
            `Nevalkotasi Szabaly` as nevalkotasiszabaly	
            FROM `helynev` 
            INNER JOIN `telepules` ON `helynev`.Telepules=`telepules`.ID
            INNER JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            INNER JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID
            WHERE `helynev`.ID=".$id;
        
        $result=mysqli_query($this->con,$query) or die('hiba');
        $row=mysqli_fetch_array($result);

        $id=$row['ID'];
        $standard=$row['Standard'];
        $ejtes=$row['Ejtes'];
        $telepules=$row['telepules'];
        $helyfajtaNev=$row['helyfajtaNev'];
        $helyfajtaKod=$row['helyfajtaKod'];
        $terkepszam=$row['Terkepszam'];
        $ragosalak=$row['Ragos_Alak'];
        $nyelv=$row['joinNyelv'];
        $forrasmunkaadat=$row['Forras_Adat'];
        $forrasmunkaev=$row['Forras_Ev'];
        $forrasmunkatipus=$row['Forras_Tipus'];
        $objektuminfo=$row['Objektum_Info'];
        $helyinfo=$row['Nev_Info'];
        $nevvaltozatok=$row['Nevvarians'];
        $termeszetes=$row['Termeszetes'];
        $mikro=$row['Mikro'];
        $nevszerkezet=$row['Nevszerkezettipus'];
        $r=$row['R'];
        $lm=$row['LM'];
        $t=$row['T'];
        $ar=$row['AR'];
        $alm=$row['ALM'];
        $at=$row['AT'];
        $br=$row['BR'];
        $blm=$row['BLM'];
        $bt=$row['BT'];
        $nevalkotasiszabaly=$row["nevalkotasiszabaly"];
        
        $helynev->setValues(
                $standard, 
                $telepules, 
                $ejtes, 
                $helyfajtaNev, 
                $helyfajtaKod, 
                $terkepszam, 
                $ragosalak, 
                $nyelv, 
                $forrasmunkaadat, 
                $forrasmunkaev, 
                $forrasmunkatipus, 
                $objektuminfo, 
                $helyinfo, 
                $nevvaltozatok, 
                $termeszetes, 
                $mikro,
                $nevszerkezet,
                $r,
                $lm,
                $t,
                $ar,
                $alm,
                $at,
                $br,
                $blm,
                $bt,
                $nevalkotasiszabaly,
                0); ///look at this later
        $helynev->id=$id;
                
        $this->disconnect();
        
        return $helynev;
    }
   
    public function addHelynev($helynev){
        $this->connect();
        
        $query = "INSERT INTO helynev(
            `Standard`,
            `Telepules`,
            `Ejtes`,
            `Helyfajta`,
            `Terkepszam`,
            `Ragos_Alak`,
            `Nyelv`,
            `Forras_Adat`,
            `Forras_Ev`,
            `Forras_Tipus`,
            `Objektum_Info`,
            `Nev_Info`,
            `Nevvarians`,
            `Termeszetes`,
            `Mikro`,
            `Nevszerkezettipus`,
            `R`,
            `LM`,
            `T`,
            `AR`,
            `ALM`,
            `AT`,
            `BR`,
            `BLM`,
            `BT`,
            `Nevalkotasi Szabaly`,
            `Standard_Hash`) 
	  VALUES (".
            "'$helynev->standard',".
            "'$helynev->telepules',".
            "'$helynev->ejtes',".
            "'$helynev->helyfajtaKod',".
            "'$helynev->terkepszam',".
            "'$helynev->ragosalak',".
            "'$helynev->nyelv',".
            "'$helynev->forrasmunkaadat',".
            "'$helynev->forrasmunkaev',".
            "'$helynev->forrasmunkatipus',".
            "'$helynev->objektuminfo',".
            "'$helynev->helyinfo',".
            "'$helynev->nevvaltozatok',".
            "'$helynev->termeszetes',".
            "'$helynev->mikro',".
            "'$helynev->nevszerkezet',".   
            "'$helynev->r',".
            "'$helynev->lm',".
            "'$helynev->t',".
            "'$helynev->ar',".
            "'$helynev->alm',".
            "'$helynev->at',".
            "'$helynev->br',".
            "'$helynev->blm',".
            "'$helynev->bt',".
            "'$helynev->nevalkotasiszabaly',".
            "'$helynev->standardhash')";

	$result=mysqli_query($this->con,$query) or die('hiba');

        $this->disconnect();
    }
    
    public function deleteHelynev($id){
        $this->connect();
        
        $query = "DELETE FROM helynev 
        WHERE ID = '$id'";

        mysqli_query($this->con, $query);
        
        $this->disconnect();
    }
    
    public function updateHelynev($helynev){
        $this->connect();
        
        $query = "UPDATE helynev 
                SET 
                Standard = '$helynev->standard',
                Ejtes = '$helynev->ejtes',
                Helyfajta = '$helynev->helyfajtaKod',
                Terkepszam = '$helynev->terkepszam',
                Ragos_Alak = '$helynev->ragosalak',
                Forras_Adat = '$helynev->forrasmunkaadat',
                Forras_Ev = '$helynev->forrasmunkaev',
                Forras_Tipus = '$helynev->forrasmunkatipus',
                Objektum_Info = '$helynev->objektuminfo',
                Nev_Info = '$helynev->helyinfo',
                Nevvarians = '$helynev->nevvaltozatok',
                Termeszetes = '$helynev->termeszetes',
                Mikro = '$helynev->mikro',
                Nevszerkezettipus = '$helynev->nevszerkezet',                                  
                R = '$helynev->r',
                LM = '$helynev->lm',
                T = '$helynev->t',
                AR = '$helynev->ar',
                ALM = '$helynev->alm',
                AT = '$helynev->at',
                BR = '$helynev->br',
                BLM = '$helynev->blm',   
                BT = '$helynev->bt',
                `Nevalkotasi Szabaly` = '$helynev->nevalkotasiszabaly',
                `Standard_Hash` = '$helynev->standardhash'
                    
                WHERE ID = '$helynev->id'";

        mysqli_query($this->con, $query) or die('hiba HelynevDatabase update');
        
        $this->disconnect();
    }
    
    //TELEPULES, TAJEGYSEG
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