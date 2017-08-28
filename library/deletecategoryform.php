<?php
session_start();
include('adminonly.php');
include('connection.php');
include('functionlibrary.php');

if(isset($_SESSION['USER']))
{
	if($_SESSION['USER'] < 0)
	{
		if(isset($_POST['delete']))
		{
		    if(!empty($_POST['delete']))
		    {
		        $valid = true;
		        $id_to_delete = -99;
		        try
		        {
		            $id_to_delete = (int)$_POST['delete'];
		        }
		        catch(Exception $e)
		        {
		            echo 'unknown';
		            $valid = false;
		        }

		        if($valid)
		        {
		            if($id_to_delete > 0)
		            {
		                $sql = 'SELECT * FROM product_category WHERE ID=' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $id_to_delete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ' AND CONSTANT = 0';
		                $result = mysqli_query( $con, $sql);
		                $total_posts = mysqli_num_rows($result);
		                if($total_posts > 0)
		                {
		                    $sql = 'SELECT * FROM product_table WHERE CATEGORY=' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $id_to_delete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
		                    $result = mysqli_query( $con, $sql);
		                    $total_posts = mysqli_num_rows($result);
		                    if($total_posts > 0)
		                    {
		                        echo 'used'; //"<h6>Category cannot be deleted because it is being used by a product you encoded. Delete the product first to delete this category.<h6><br />";
		                    }
		                    else
		                    {
		                        $sql = 'DELETE FROM product_category WHERE ID=' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $id_to_delete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ' AND CONSTANT = 0';
		                        if(mysqli_query( $con, $sql))
		                        {
		                            echo 'success'; //"<h6>You have successfully deleted the category.<h6><a href='managecategory.php'>Reload</a> page to ensure changes.<br />";
		                            try
		                            {
		                            	deleteDir('../img/site images/categoryimages/' . $id_to_delete);
		                        	}
							        catch(Exception $e)
							        {
							        	//
							        }
		                        }
		                        else
		                        {
		                            echo 'problem';
		                        }
		                    }
		                }
		                else
		                {
		                    echo 'notfound';
		                }
		            }
		            else
		            {
		                echo 'unknown';
		            }
		        }
		    }
		}
	}
}

?>