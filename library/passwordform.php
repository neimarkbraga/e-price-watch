<?php
session_start();
include('connection.php');
include('functionlibrary.php');

if(isset($_POST['EMAIL']))
{
	$email = $_POST['EMAIL'];
	$password;
	$sql = 'SELECT * FROM user_account WHERE EMAIL = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $email) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
	$result = mysqli_query( $con, $sql);
	$total = mysqli_num_rows($result);
	if($total < 1)
	{
		echo 'noexist';
	}
	else
	{
		if($row = mysqli_fetch_array($result))
		{
			$password = $row['PASSWORD'];
			$name = $row['NAME'];
			$title = "Retrieve Password";
			$message = '<h1>Retrieve Password in E-Price Watch</h1><br /> <p>Your password is: <b>' . $password . '</b></p> <br /><p>Please change your password immediately. Someone may have an access to your email, they can see this message.</p>';
			if(send_a_mail($title, $email, $name, $message))
			{
				echo 'success';
			}
			else
			{
				echo 'error';
			}
		}
	}
}
?>