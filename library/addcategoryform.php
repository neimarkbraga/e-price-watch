<?php
session_start();
include('adminonly.php');
include('connection.php');
include('functionlibrary.php');

if(isset($_SESSION['USER']))
{
	if($_SESSION['USER'] < 0)
	{
		if(isset($_POST['NAME']) and isset($_POST['DESCRIPTION']))
		{
		    $NAME = $_POST['NAME'];
		    $DESCRIPTION = $_POST['DESCRIPTION'];
		    if(!empty($NAME) and !empty($DESCRIPTION))
		    {
		        if(!categoryexists($NAME))
		        {
		            $sql = 'INSERT INTO product_category(NAME, DESCRIPTION) VALUES("' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $NAME) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '", "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $DESCRIPTION) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '")';
		            if(mysqli_query( $con, $sql))
		            {
		                
		                $inserted_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
		                echo $inserted_id;
		                $path_to_save = '../img/site images/categoryimages/' . $inserted_id . '/';
		                
		                    $name       = $_FILES['file']['name'];  
		                    $temp_name  = $_FILES['file']['tmp_name'];  
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
		                echo 'problem';
		            }
		        }
		        else
		        {
		            echo 'nameexists';
		        }
		    }
		}
	}
}
else
{
	echo 'error';
}

?>