<?php
	session_start();
        include('adminonly.php');
	include('connection.php');
	include('functionlibrary.php');

	if(isset($_POST['OLDPASSWORD']) && isset($_POST['NEWPASSWORD']) && isset($_POST['REPASSWORD']))
	{
		$oldpassword = $_POST['OLDPASSWORD'];
		$newpassword = $_POST['NEWPASSWORD'];
		$repassword = $_POST['REPASSWORD'];

		$sql = 'SELECT * FROM admin_account WHERE ID = 1';
                $result = mysqli_query( $con, $sql);
                if($row = mysqli_fetch_array($result))
                {
                	if($row['PASSWORD'] == $oldpassword)
                	{
                		$sql = 'UPDATE admin_account SET PASSWORD = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $newpassword) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" WHERE ID = 1';
                		if(mysqli_query( $con, $sql))
                		{
                			echo 'success';
                		}
                		else
                		{
                			echo 'error';
                		}
                	}
                	else
                	{
                		echo 'notmatch';
                	}
                }
	}

?>