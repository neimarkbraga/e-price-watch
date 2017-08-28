<?php
	session_start();
	include('adminonly.php');
	include('connection.php');
	include('functionlibrary.php');

	if(isset($_POST['ABOUTUS']))
	{
		$aboutus = $_POST['ABOUTUS'];
		$sql = 'UPDATE about_us SET DESCRIPTION = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $aboutus) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" WHERE ID = 1';
		if(mysqli_query( $con, $sql))
		{
			echo 'success';
		}
		else
		{
			echo 'error';
		}
	}
?>