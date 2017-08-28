<?php
session_start();
include('connection.php');
include('functionlibrary.php');

if(isset($_POST['USERNAME']) and isset($_POST['NAME']) and isset($_POST['EMAIL']))
{
	$username = $_POST['USERNAME'];
	$name = $_POST['NAME'];
	$email = $_POST['EMAIL'];
	$password = generateRandomString(10);

	$sql = 'SELECT * FROM user_account WHERE USERNAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $username) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
	$result = mysqli_query( $con, $sql);
	$total = mysqli_num_rows($result);

	if($total > 0 or $username == 'admin')
	{
		echo 'userexists';
	}
	else
	{
		$sql = 'SELECT * FROM user_account WHERE EMAIL = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $email) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
		$result = mysqli_query( $con, $sql);
		$total = mysqli_num_rows($result);

		if($total > 0)
		{
			echo 'emailexists';
		}
		else
		{
			$sql = 'INSERT INTO user_account(USERNAME, PASSWORD, NAME, EMAIL) VALUES("' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $username) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $password) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $name) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $email) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '")';
			if(mysqli_query( $con, $sql))
			{
				$id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
				$title = "New Account Created";
				$message = '<h1>Thank you for Creating account in E-Price Watch!</h1><br /> <p>Your password is: <b>' . $password . '</b></p> <br /><p>Please change your password immediately.</p>';
				if(send_a_mail($title, $email, $name, $message))
				{
					echo 'success';
				}
				else
				{
					$sql = 'DELETE FROM user_account WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
					mysqli_query( $con, $sql);
					echo 'error';
				}
			}
			else
			{
				echo 'error';
			}
		}
	}
}
?>