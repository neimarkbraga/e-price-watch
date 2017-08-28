<?php

//______________________________
	$server = "localhost";
//______________________________

//____________________________________
//		Log in your account
//_________________________________________________
$username =	/* USERNAME: */	"root";
$password =	/* PASSWORD: */	"";
$database =	/* DATABASE: */	"srpdata";
//_________________________________________________


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($server,  $username,  $password)) or mysqli_error($GLOBALS["___mysqli_ston"]);
mysqli_select_db( $con, $database);


//$con = mysql_connect($server, $username, $password) or mysql_error();
?>
