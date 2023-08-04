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
            unset($_SESSION['MONEYFLOWSEARCH']);
        }
    }
}
$branchid = $_SESSION['branch'];
if(isset($_REQUEST['btnSubmit']))
{
    $array= array('date' =>array('fromdate'=>$_REQUEST['txtFromdate'],
'todate'=>$_REQUEST['txtTodate']));

    $_SESSION['MONEYFLOWSEARCH']=$array;
    if($array['date']['fromdate'])
    {
        $array['date']['fromdate']= date('Y-m-d',strtotime($array['date']['fromdate']));
        $array['date']['todate']= date('Y-m-d',strtotime($array['date']['todate']));

    }
    $getdetails=$classvariable->moneyflowdata($array);
}
if(isset($_REQUEST['MONEYFLOWSEARCH']))
{
    $array= array('date' =>array('fromdate'=>$_REQUEST['txtFromdate'],
'todate'=>$_REQUEST['txtTodate']));

    $_SESSION['MONEYFLOWSEARCH']=$array;
    if($array['date']['fromdate'])
    {
        $array['date']['fromdate']= date('Y-m-d',strtotime($array['date']['fromdate']));
        $array['date']['todate']= date('Y-m-d',strtotime($array['date']['todate']));

    }
    $getdetails=$classvariable->moneyflowdata($array);
}
else
{
    $date = date('Y-m-d');
    $getdetails=$classvariable->moneyflowdatatoday($array,$date);
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

<h2>Money Flow Data</h2>

<!-- <div class="table-wrapper">
<table class="fl-table">
</td>
</table>
</div> -->
<div class="table-wrapper">
     <table>
        <thead>
            <tr>
                <td>From Date :</td>
                <td><input type="text" name="txtFromdate" id="txtFromdate" value="<?php if($_SESSION['MONEYFLOWSEARCH']['date']['fromdate']!=''){echo $_SESSION['MONEYFLOWSEARCH']['date']['fromdate'];} else if($_SESSION['MONEYFLOWSEARCH']) {echo "";} else{echo date('d-m-Y');} ?>"></td>
                <td>To Date :</td>
                <td><input type="text" name="txtTodate" id="txtTodate" value="<?php if($_SESSION['MONEYFLOWSEARCH']['date']['todate']!=''){echo $_SESSION['MONEYFLOWSEARCH']['date']['todate'];} else if($_SESSION['MONEYFLOWSEARCH']) {echo "";} else{echo date('d-m-Y');} ?>"></td>
                <td>
                    <input type="submit" name="btnSubmit" id="btnSubmit" value="Load">
                </td>
            </tr>
        </thead>
     </table>
</div>


<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>Category</th>
            <th>Money Flow</th>
            <th>Narration</th>
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
                <td><?php echo date('d-m-Y',strtotime($getarray['mf_date'])); ?></td>
                 <td><?php echo $getarray['cd_name'] ?></td>
                  <td><?php echo $getarray['mf_moneyflow'] ?></td>
                   <td><?php echo $getarray['mf_narration'] ?></td>
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