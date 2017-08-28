<?php
session_start();
include('adminonly.php');
include('connection.php');
include('functionlibrary.php');

if(isset($_POST['FOLDER']))
{

	$id = $_POST['FOLDER'];
	$path_to_save = '../img/slider images/' . $id . '/';	                
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
	        if(move_uploaded_file($temp_name, $location.$name)){
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