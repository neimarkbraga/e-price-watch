<?php
session_start();
include('connection.php');

if(isset($_POST['USERNAME']) and isset($_POST['PASSWORD']))
{
    $a_username = $_POST['USERNAME'];
    $a_password = $_POST['PASSWORD'];
    if(!empty($a_username) and !empty($a_password))
    {
        $sql = 'SELECT * FROM admin_account WHERE USERNAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $a_username) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" AND PASSWORD = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $a_password) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
        $result = mysqli_query( $con, $sql);
        $total_posts = mysqli_num_rows($result);
        if($total_posts > 0)
        {
            echo 'admin';
            $_SESSION["USER"] = -99;
        }
        else
        {
            $sql = 'SELECT * FROM user_account WHERE USERNAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $a_username) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" AND PASSWORD = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $a_password) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
            $result = mysqli_query( $con, $sql);
            $total_posts = mysqli_num_rows($result);
            if($total_posts > 0)
            {
            	$row = mysqli_fetch_array($result);
                echo 'user';
                $_SESSION["USER"] = $row['ID'];
                $_SESSION["NAME"] = $row['NAME'];
            }
            else
            {
                echo 'false';
            }
        }
    }
    else
    {
        echo 'false';
    }
}

?>