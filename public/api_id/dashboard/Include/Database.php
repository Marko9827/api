<?php
# include_once ROOT . "Include/c_db_ins/config.php";
$con;
$server = $this->getServer();
$username = $this->getUsername();
$password = $this->getPassword();
$db = $this->getDb();
$date_conf = date('m/d/Y h:i:s A', time());
try {

   $con = mysqli_connect($server, $username, $password, $db) or die("FAIL");
} catch (\Exception $e) {

   # error_log("TIME : $date_conf. Message : " . $e->getMessage() . " \n", 3, ROOT . "/Include/logs/log_index_info.txt");
}
/*
$con;
$date_conf = date('m/d/Y h:i:s A', time());
try {
   $con = mysqli_connect(DB_SERVER, DB_username, DB_password, DB_DBname) or die(error_log("TIME : $date_conf. Message : Error to connect database : $db_name \n", 3, $_SERVER['DOCUMENT_ROOT'] . "/Include/logs/log_index_info.txt"));
} catch (Exception $e) {

   error_log("TIME : $date_conf. Message : " . $e->getMessage() . " \n", 3, $_SERVER['DOCUMENT_ROOT'] . "/Include/logs/log_index_info.txt");
}
*/