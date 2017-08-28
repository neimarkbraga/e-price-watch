<?php
	session_start();
	include('adminonly.php');
	include('connection.php');
	include('functionlibrary.php');

	if(isset($_POST['ID']) and isset($_POST['NAME']) and isset($_POST['DESCRIPTION']) and isset($_POST['SRP']) and isset($_POST['CATEGORY']))
	{
		$ID = $_POST['ID'];
	    $CATEGORY = $_POST['CATEGORY'];
	    $NAME = $_POST['NAME'];
	    $DESCRIPTION = $_POST['DESCRIPTION'];
	    $SRP = $_POST['SRP'];
	    $path_to_save = '../img/site images/productimages/' . $ID . '/';

		if($_POST['IMAGEACTION'] == "0")
		{
			if(isset($_FILES['FILE']['name']))
			{
				if(!$_FILES['FILE']['name'] == "")
				{
		            $name       = $_FILES['FILE']['name'];  
		            $temp_name  = $_FILES['FILE']['tmp_name'];  
		            if(isset($name))
		            {
		                if(!empty($name))
		                {
		                    if(file_exists($path_to_save))
		                    {
		                        deleteDir($path_to_save);
		                    }
		                    mkdir($path_to_save);
		                    $location = $path_to_save;      
		                    move_uploaded_file($temp_name, $location.$name);
		                }       
		            } 
				}
				else
				{
					echo 'nopicture';
					return;
				}
			}
			else
			{
				echo 'nopicture';
				return;
			}
		}
		else if($_POST['IMAGEACTION'] == "2")
		{
			if(file_exists($path_to_save))
		    {
		        deleteDir($path_to_save);
		    }
		}


	    if(!empty($CATEGORY) and !empty($NAME) and !empty($DESCRIPTION) and !empty($SRP))
	    {
	        //$sql = 'INSERT INTO product_table(NAME, DESCRIPTION, SRP, CATEGORY) VALUES("' . $NAME . '", "' . $DESCRIPTION . '", ' . $SRP . ', ' . $CATEGORY . ')';
	        $sql = 'UPDATE product_table SET NAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $NAME) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", DESCRIPTION = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $DESCRIPTION) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", SRP = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $SRP) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ', CATEGORY = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $CATEGORY) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ' WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $ID) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
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

	//$sql = 'UPDATE product_category SET NAME = "' . $editname . '", DESCRIPTION = "' . $editdesc . '" WHERE ID = ' . $editid;
?>