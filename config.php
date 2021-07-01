<?php
   if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
   if (!defined('DB_USERNAME')) define('DB_USERNAME', 'u420354970_boti');
   if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '32tr56prS');
   if (!defined('DB_DATABASE')) define('DB_DATABASE', 'u420354970_training_db');
   $con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   mysqli_query($con,"SET NAMES utf8");
   mysqli_set_charset($con,"UTF8");
?>