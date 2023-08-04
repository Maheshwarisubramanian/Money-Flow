<?php
ini_set('session.gc_maxlifetime', 36000);
session_set_cookie_params(36000);
ob_start();
session_start();
error_reporting(E_ERROR | E_PARSE);

include_once("config/dbconfig.php");
include_once("config/class.php");
date_default_timezone_set("Asia/Calcutta");

if(isset($_REQUEST['button1']))
{
	$details =  array('um_username' =>$_REQUEST['txtusername'], 
	'um_password' =>md5($_REQUEST['txtpassword']) );

	$getdetails=$classvariable->login($details);

	// echo $getdetails;
	// exit;

	// if($getdetails='error')
	// {
	// 	echo "wrong input";
	// }
	// else 
	if($getdetails=='success')
	{
		//echo "adfsdf";
		// header("location:main/moneyflow.php");
		header("location:main/moneyflow.php");
	}

	else 
	{
		header("refresh: 3;");
	}



}




?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="post">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" name = "txtusername" id="txtusername" placeholder="User name ">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" name="txtpassword" id="txtpassword"  placeholder="Password">
				</div>
				<button >

		          
		            	<input type="submit" name="button1" class="button" id="button1" value="Log in Now"> 
		          
					
					<i class="button__icon fas fa-chevron-right"></i>
				</button>	
							
			</form>
			<div class="social-login">
				<h3>Welcome</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>

</body>
</html>