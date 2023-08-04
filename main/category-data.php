<?php
ini_set('session.gc_maxlifetime', 36000);
session_set_cookie_params(36000);
ob_start();
session_start();
error_reporting(E_ERROR | E_PARSE);

include_once("../config/dbconfig.php");
include_once("../config/class.php");
date_default_timezone_set("Asia/Calcutta");

if(!isset($_SESSION['username']) || $_SESSION['CATEGORY']=='N')
header("location:../index.php");

$getdetails=$classvariable->categorydata();

// only for session ---fromdate and todate

if(isset($_SERVER['HTTP_REFERER']))
{
	$currentfile=parse_url($_SERVER['REQUEST_URI']);
	$parts=explode("/", $currentfile['path']);
	$currentfilename=$parts[count($parts)-1];
	$prevfile=parse_url($_SERVER['HTTP_REFERER']);
	$parts2=explode("/", $prevfile['path']);
	$prevfilename = $parts2[count($parts2)-1];

	if($currentfilename!=$prevfilename)
	{
		$prevpagearray=array('category.php','category-data.php');
		if(!in_array($prevfilename, $prevpagearray))
		{
			unset($_SESSION['OPVIEWSEARCH']);
		}
	}

}
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<link rel="stylesheet" type="text/css" href="../css/styleforlist.css">
</head>
<body>

	<?php
  	include_once("menu.php");
  	?>

<h2>Category Data</h2>

<!-- <div class="table-wrapper">
<table class="fl-table">
</td>
</table>
</div> -->



<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
        	<th>S.No</th>
            <th>Category</th>
            <th>Action</th>
            
        </tr>
        </thead>

        <?php
        $i=1;
        while($getarray= mysqli_fetch_assoc($getdetails))
        {
        ?>
        	<tbody>
	        <tr>
	        	<td><?php echo $i; ?></td>
	            <td><?php echo $getarray['cd_name'] ?></td>
	            <td></td>
	            
	        </tr>
	       
	        <tbody>

        <?php
        $i=$i+1;
        }

        ?>

        
    </table>
</div>

</body>
</html>