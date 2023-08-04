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

if(isset($_REQUEST['btnSubmit']))
{
	$details =  array('ct_category' =>$_REQUEST['txtCategory'] );



	$getdetails=$classvariable->addcategory($details);

	// echo $getdetails;
	// exit;

	if($getdetails=='success')
	{
		$msg = "Wow... You Added Category Successfully Mahi";
	}

	else if($getdetails=='error1')
	{
		$msg = "Mahi, The Category is already Saved. Kindly, Check it once Dear...";
	}

	else if($getdetails=='error')
	{
		$msg = "OOPs ... Something went wrong";
		//header("refresh: 3;");
	}

	 echo $msg;
	 header("refresh: 3;");
	// exit;

	 // echo 
	 // '<script type="text/javascript"> 
	 // window. onload = function () { alert('.$msg.'); } </script>'; 

	// echo 
	//  '<script type="text/javascript"> 
	//  window. onload = function () { alert("sdfgdsfg"); } </script>'; 


}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>  Registration Form </title>
    <link rel="stylesheet" href="../css/styleforcategory.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
   </head>
<body>

	<!--  <?php 
		//include_once("menu.php");
		?> -->
		
	
  <div class="container">
  	


    <div class="title">Category</div>
    <div class="content">

      <form action="#" method="post">

      	<table>
	  		<tr>
	  			<td style="width: 20%;">
	  				<div class="user-details">
				          <div class="input-box">

				            <span class="details">Category</span>
				            <input type="text" name="txtCategory" id="txtCategory" placeholder="" required>
				          </div>
				          <!-- <div class="input-box">
				            <span class="details">Username</span>
				            <input type="text" placeholder="Enter your username" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Email</span>
				            <input type="text" placeholder="Enter your email" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Phone Number</span>
				            <input type="text" placeholder="Enter your number" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Password</span>
				            <input type="text" placeholder="Enter your password" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Confirm Password</span>
				            <input type="text" placeholder="Confirm your password" required>
				          </div> -->
				    </div>
				        <!-- <div class="gender-details">
				          <input type="radio" name="gender" id="dot-1">
				          <input type="radio" name="gender" id="dot-2">
				          <input type="radio" name="gender" id="dot-3">
				          <span class="gender-title">Gender</span>
				          <div class="category">
				            <label for="dot-1">
				            <span class="dot one"></span>
				            <span class="gender">Male</span>
				          </label>
				          <label for="dot-2">
				            <span class="dot two"></span>
				            <span class="gender">Female</span>
				          </label>
				          <label for="dot-3">
				            <span class="dot three"></span>
				            <span class="gender">Prefer not to say</span>
				            </label>
				          </div>
				        </div> -->
			        <div class="button">
			          <input type="submit" name="btnSubmit" id="btnSubmit" value="Register">
			        </div>
	  				
	  			</td>
	  			<td style="width: 80%;">
	  				<div class="user-details">
				          <div class="input-box">

				            <span class="details">Category</span>
				            <input type="text" name="txtCategory" id="txtCategory" placeholder="" required>
				          </div>
				          <!-- <div class="input-box">
				            <span class="details">Username</span>
				            <input type="text" placeholder="Enter your username" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Email</span>
				            <input type="text" placeholder="Enter your email" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Phone Number</span>
				            <input type="text" placeholder="Enter your number" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Password</span>
				            <input type="text" placeholder="Enter your password" required>
				          </div>
				          <div class="input-box">
				            <span class="details">Confirm Password</span>
				            <input type="text" placeholder="Confirm your password" required>
				          </div> -->
				    </div>
				        <!-- <div class="gender-details">
				          <input type="radio" name="gender" id="dot-1">
				          <input type="radio" name="gender" id="dot-2">
				          <input type="radio" name="gender" id="dot-3">
				          <span class="gender-title">Gender</span>
				          <div class="category">
				            <label for="dot-1">
				            <span class="dot one"></span>
				            <span class="gender">Male</span>
				          </label>
				          <label for="dot-2">
				            <span class="dot two"></span>
				            <span class="gender">Female</span>
				          </label>
				          <label for="dot-3">
				            <span class="dot three"></span>
				            <span class="gender">Prefer not to say</span>
				            </label>
				          </div>
				        </div> -->
			        <div class="button">
			          <input type="submit" name="btnSubmit" id="btnSubmit" value="Register">
			        </div>
	  				
	  			</td>	
	  		</tr>
	  	</table>

        
      </form>
    </div>
  </div>

</body>
</html>