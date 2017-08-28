<?php
session_start();
include('adminonly.php');
include('connection.php');
include('functionlibrary.php');


	if(isset($_POST['ID']) && isset($_POST['NAME']) && isset($_POST['DESCRIPTION']) && isset($_POST['IMAGEACTION']))
	{
		$editid = $_POST['ID'];
		$editname = $_POST['NAME'];
		$editdesc = $_POST['DESCRIPTION'];
		$path_to_save = '../img/site images/categoryimages/' . $editid . '/';

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


		//Update database
		$sql = 'UPDATE product_category SET NAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $editname) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", DESCRIPTION = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $editdesc) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $editid) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
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