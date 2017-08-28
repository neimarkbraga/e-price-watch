<?php
	session_start();
	include('adminonly.php');
	include('connection.php');
	include('functionlibrary.php');

	if(isset($_POST['DELETEID']))
	{
		$ID = $_POST['DELETEID'];
		$sql = 'SELECT * FROM encoded_products WHERE PRODUCT = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $ID) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
		$result = mysqli_query( $con, $sql);
		$total = mysqli_num_rows($result);

		if($total < 1)
		{
			$sql = 'DELETE FROM product_table WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $ID) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
			if(mysqli_query( $con, $sql))
			{
				echo 'success';
				try
                {
                    deleteDir('../img/site images/productimages/' . $ID);
                }
			    catch(Exception $e)
			    {
			    	//
			    }
			}
			else
			{
				echo 'error';
			}
		}
		else
		{
			echo 'exists';
		}
	}
?>