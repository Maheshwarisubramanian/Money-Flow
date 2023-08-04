<?php
ini_set('session.gc_maxlifetime', 36000);
session_set_cookie_params(36000);
ob_start();
session_start();
error_reporting(E_ERROR | E_PARSE);

include_once("../config/dbconfig.php");
include_once("../config/class.php");
date_default_timezone_set("Asia/Calcutta");

$category =$_POST['category'];

$selquery="SELECT `cd_recno` FROM `category` WHERE `cd_name`= '$category'";
$exequery = mysqli_query($con,$selquery);
$getarray= mysqli_fetch_assoc($exequery);

if($getarray['cd_recno'])
{
	echo json_encode($getarray);
}
else
{
	echo "";
}
?>