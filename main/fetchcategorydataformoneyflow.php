<?php
ini_set('session.gc_maxlifetime', 36000);
session_set_cookie_params(36000);
ob_start();
session_start();
error_reporting(E_ERROR | E_PARSE);

include_once("../config/dbconfig.php");
include_once("../config/class.php");
date_default_timezone_set("Asia/Calcutta");

$searchTerm = $_GET['term']; 

$selquery = "SELECT `cd_recno`, `cd_name` FROM `category` WHERE `cd_name` like '%".$searchTerm."%'";
$exequery = mysqli_query($con,$selquery);

$skillData = array(); 

while($row= mysqli_fetch_assoc($exequery))
{
    //$data['id'] = $row['id']; 
    $data['value'] = $row['cd_name']; 
    array_push($skillData, $data); 

}
echo json_encode($skillData); 
?>