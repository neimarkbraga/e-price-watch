<?php
	session_start();
	include('adminonly.php');
	include('connection.php');
	include('functionlibrary.php');

	if(isset($_POST['EMAIL']) && isset($_POST['ADDRESS']) && isset($_POST['CONTACT']) && isset($_POST['FACEBOOK']) && isset($_POST['INSTAGRAM']) && isset($_POST['TWITTER']))
	{
		$email = $_POST['EMAIL'];
		$address = $_POST['ADDRESS'];
		$contact = $_POST['CONTACT'];
		$facebook = $_POST['FACEBOOK'];
		$instagram = $_POST['INSTAGRAM'];
		$twitter = $_POST['TWITTER'];

		$sql = 'UPDATE contact_us SET EMAIL = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $email) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", ADDRESS = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $address) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", CONTACT = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $contact) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", FACEBOOK = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $facebook) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", INSTAGRAM = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $instagram) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", TWITTER = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $twitter) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" WHERE ID = 1';
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