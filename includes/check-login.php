<?php
function check_login()
{
if(strlen($_SESSION['id'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="logout.php";		
		$_SESSION["id"]="";
		echo "<script>location.href='https://$host$uri/$extra';</script>";
	}
}
?>