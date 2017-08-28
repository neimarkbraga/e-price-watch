<?php
	session_start();
	include('useronly.php');
	include('connection.php');
	include('functionlibrary.php');
	$logged_in_id = $_SESSION['USER'];

	if(isset($_POST['EMAIL']))
	{
		$email = $_POST['EMAIL'];
		$sql = 'SELECT * FROM user_account WHERE EMAIL = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $email) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
		$result = mysqli_query( $con, $sql);
		$total = mysqli_num_rows($result);
		if($total > 0)
		{
			echo 'exists';
		}
		else
		{
			$sql = 'UPDATE user_account SET EMAIL = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $email) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $logged_in_id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
			if(mysqli_query( $con, $sql))
			{
				echo 'success';
			}
			else
			{
				echo 'error';
			}
		}
	}
?>