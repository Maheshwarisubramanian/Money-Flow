<?php



Class mainclass
{
	function login($details)
	{
		global $con;


		$seluserquery = "SELECT 
		`um_recno`, `um_username`, `um_password`, `um_conpassword`, `um_branch`, `um_status` 
		FROM `usermaster` 
		WHERE `um_username`='$details[um_username]' and `um_password`='$details[um_password]'";

		$exequery = mysqli_query($con,$seluserquery);
		$getarray= mysqli_fetch_assoc($exequery);

		

		// return $getarray['um_recno'];
		// exit;

		if($getarray['um_recno']!='')
		{

			$_SESSION['id']=$getarray['um_recno'];
			$_SESSION['username']=$getarray['um_username'];
			$_SESSION['branch']=$getarray['um_branch'];

			
			$seluserpermissionquery = "SELECT 
			`up_recno`, `up_menuref`, `up_userref`, `up_permission` ,`mo_menucaption`
			FROM `userpermission` 
			inner join menuoption  on up_menuref = mo_recno
			inner join usermaster  on um_recno = `up_userref`
			WHERE `up_userref`='$getarray[um_recno]'";

			// return $seluserpermissionquery;
			// exit;

			$exequeryforpermission = mysqli_query($con,$seluserpermissionquery);

			while($sesdetails=mysqli_fetch_assoc($exequeryforpermission))
			{
				if($sesdetails['mo_menucaption']=='MONEYFLOW')
				{
					$_SESSION['MONEYFLOW']=$sesdetails['up_permission'];
				}

				else if($sesdetails['mo_menucaption']=='CATEGORY')
				{
					$_SESSION['CATEGORY']=$sesdetails['up_permission'];
				}
			}

			$msg = 'success';
			return $msg;
		}
		else
		{
			$msg = 'error';
			return $msg;
		}
		

		
		


		//header("location:main/moneyflow.php");
	}

	


	function addcategory($details)
	{
		global $con;

		$c_date = date("Y-m-d h:m:s");

		$selquery = "SELECT `cd_name` FROM `category` WHERE `cd_name` = '$details[ct_category]'";
		$exeinsquery = mysqli_query($con,$selquery);
		$numrows = mysqli_num_rows($exeinsquery);

		

		if(!$numrows)
		{
			$insquery = "INSERT INTO `category`( `cd_name`, `cd_status`, `cd_createddate`, `cd_modifieddate`) VALUES ('$details[ct_category]','Y','$c_date','$c_date')";
			$exequery = mysqli_query($con,$insquery);

			if($exequery)
			{
				$msg = 'success';
				///return $msg;
				
			}
			else
			{
				$msg = 'error';
				//return $msg;
				
			}

		}
		else
		{
			$msg = 'error1';
			//return $msg;
		}



		return $msg;
		
	}

	function categorydata()
	{
		global $con;

		$selquery = "SELECT `cd_name`,`cd_recno` FROM `category` WHERE `cd_status`='Y'
		order by `cd_name`";
		$exeinsquery = mysqli_query($con,$selquery);

		return $exeinsquery;
		
	}

	function moneyflowdata($array)
	{
		global $con;

		$fromdate = $array['date']['fromdate'];
		$todate = $array['date']['todate'];


		$selquery = "SELECT `mf_recno`, `mf_date`, `mf_category`, `mf_moneyflow`, `mf_narration`, `mf_createddate`, `mf_modifieddate` FROM `moneyflowdetails` WHERE `mf_date` between ('$fromdate' and '$todate') order by  `mf_date`";
		$exeinsquery = mysqli_query($con,$selquery);

		return $exeinsquery;
		
	}
	function moneyflowdatatoday($array,$date)
	{
		global $con;

		$selquery = "SELECT `mf_recno`, `mf_date`, `mf_category`, `mf_moneyflow`, `mf_narration`, `mf_createddate`, `mf_modifieddate` , `cd_name`
		FROM `moneyflowdetails` 
		left join `category` on `cd_recno` = `mf_category`

		WHERE `mf_date`='$date' order by  `mf_date`";
		$exeinsquery = mysqli_query($con,$selquery);

		return $exeinsquery;
		
	}


}

$classvariable = new mainclass();


?>