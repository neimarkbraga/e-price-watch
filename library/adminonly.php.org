<?php
	if(!isset($_SESSION['USER']))
	{
		header('Location: index.php');
	}
	else
	{
		if($_SESSION['USER'] > 0)
		{
			header('Location: index.php');
		}
	}
?>