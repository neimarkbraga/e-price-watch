<?php
	session_start();
	include('useronly.php');
	include('connection.php');
	include('functionlibrary.php');


	if(isset($_GET['DELETEID']))
	{
		//echo 'disabled';

		$sql = 'SELECT DISABLED FROM encoded_products WHERE ID=' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['DELETEID']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
		$result = mysqli_query( $con, $sql);
		if($row = mysqli_fetch_array($result))
		{
			if($row['DISABLED'] == '0')
			{
				$sql = 'UPDATE encoded_products SET DISABLED = 1 WHERE ID=' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['DELETEID']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
				if(mysqli_query( $con, $sql))
				{
					echo 'disabled';
					return;
				}
			}
			else
			{
				$sql = 'UPDATE encoded_products SET DISABLED = 0 WHERE ID=' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['DELETEID']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
				if(mysqli_query( $con, $sql))
				{
					echo 'enabled';
					return;
				}
			}
			echo 'error';
		}



		/*
		//echo $_POST['DELETEID'];
		$sql = 'DELETE FROM encoded_products WHERE ID=' . mysql_escape_string($_GET['DELETEID']);
		if(mysql_query($sql, $con))
		{
			echo 'success';
		}
		else
		{
			echo 'error';
		}
		*/
	}
?>