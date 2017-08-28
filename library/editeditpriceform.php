<?php
	session_start();
	include('useronly.php');
  	include('connection.php');
  	include('functionlibrary.php');

  	if(isset($_POST['ID']) and isset($_POST['NAME']) and isset($_POST['ADDRESS']) and isset($_POST['LATITUDE']) and isset($_POST['LONGITUDE']) and isset($_POST['PRICE']))
  	{
  		$the_id = $_POST['ID'];
  		$newstorename = $_POST['NAME'];
  		$newaddress = $_POST['ADDRESS'];
  		$newlat = $_POST['LATITUDE'];
  		$newlng = $_POST['LONGITUDE'];
  		$newprice = $_POST['PRICE'];
  		
  		$oldprice;
  		$product;
  		$sql = 'SELECT PRODUCT, PRICE, DATECREATED FROM encoded_products WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ID']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
  		$result = mysqli_query( $con, $sql);
  		if($row = mysqli_fetch_array($result))
  		{
  			$olddate = $row['DATECREATED'];
  			$oldprice = $row['PRICE'];
  			$product =  $row['PRODUCT'];
  		} 

  		if($_POST['ADDRESS'] == "Getting location..." or $_POST['ADDRESS'] == "")
  		{
  			echo 'errorloc';
  		}
  		else
  		{
	  		$sql = 'SELECT * FROM encoded_products WHERE PRODUCT = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $product) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ' AND STORENAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['NAME']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" AND ADDRESS = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ADDRESS']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" AND PRICE = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['PRICE']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
	  		$result = mysqli_query( $con, $sql);
	  		$total = mysqli_num_rows($result);

	  		if($total > 0)
	  		{
		  		echo 'exists';
			}
			else
			{
				$sql = 'UPDATE encoded_products SET STORENAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['NAME']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", DATECREATED = CURRENT_TIMESTAMP, ADDRESS = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ADDRESS']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", LAT = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['LATITUDE']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ', LNG = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['LONGITUDE']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ', PRICE = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['PRICE']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ' WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ID']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
		  		if(mysqli_query( $con, $sql))
				{
					if($oldprice != $newprice)
					{
						$sql = 'INSERT INTO price_history(ENCODED_ID, PRICE, DATECREATED) VALUES(' . $the_id . ', ' . $oldprice . ', \'' . $olddate . '\')';
						mysqli_query( $con, $sql);
					}
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