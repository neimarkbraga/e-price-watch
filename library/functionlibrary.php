<?php

function getpricestatus($id, $theprice)
{
  include('connection.php');
  $srp;
  $belowsrp = array();
  $abovesrp = array();
  $belowaverage;
  $aboveaverage;
  $range;
  $underprice;
  $overprice;
  $addsub;
  $sql = 'SELECT * FROM product_table WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
  $result = mysqli_query( $con, $sql);
  if($row = mysqli_fetch_array($result))
  {
    $srp = $row['SRP'];
  }
  $sql = 'SELECT * FROM encoded_products WHERE PRODUCT = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
  $result = mysqli_query( $con, $sql);
  while($row = mysqli_fetch_array($result))
  {
    if($row['PRICE'] >= $srp)
    {
      array_push($abovesrp, $row['PRICE']);
    }
    if($row['PRICE'] <= $srp)
    {
     array_push($belowsrp, $row['PRICE']); 
    }
  }

  //My Revision...
  //array_push($abovesrp, $srp);
  //array_push($belowsrp, $srp);

  if(count($belowsrp) < 1)
  {
    $belowaverage = $srp;
  }
  else
  {
    $belowaverage = 0;
    foreach ($belowsrp as $price) {
      $belowaverage += $price;
    }
    $belowaverage = $belowaverage/count($belowsrp);
  }
    if(count($abovesrp) < 1)
  {
    $aboveaverage = $srp;
  }
  else
  {
    $aboveaverage = 0;
    foreach ($abovesrp as $price) {
      $aboveaverage += $price;
    }
    $aboveaverage = $aboveaverage/count($abovesrp);
  }
  $range = $aboveaverage - $belowaverage;
  $addsub = $range * 0.1; //10%
  $underprice = $belowaverage - $addsub;
  $overprice = $aboveaverage + $addsub;

  if($theprice < $underprice)
  {
    return 'under';
  }
  else
  {
    if($theprice > $overprice)
    {
      return 'over';
    }
    else
    {
      return 'average';
    }
  }
}

function send_a_mail($title, $to, $name, $message){
  date_default_timezone_set('Etc/UTC');
  require '../PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPDebug = 2;
  $mail->Debugoutput = 'html';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $mail->Username = "consumerguide2016@gmail.com";
  $mail->Password = "guideme.com";
  $mail->setFrom('consumerguide2016@gmail.com', 'Consumer\'s Guide');
  $mail->addReplyTo('consumerguide2016@gmail.com', 'Consumer\'s Guide');
  $mail->addAddress($to, $name);//email
  $mail->Subject = $title;//title
  $mail->msgHTML($message);//message
  $mail->AltBody = 'This is a plain-text message body';
  if (!$mail->send()) {
      ob_end_clean();
      return false;
  } else {
      ob_end_clean();
      return true;
  }
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getcategorypic($id){
  	$dir    = 'img/site images/categoryimages/' . $id;
  	if(file_exists($dir))
  	{
  	    $files1 = array_diff(scandir($dir), array('..', '.'));
  	    foreach ($files1 as $key) {
        	return 'img/site images/categoryimages/' . $id . '/' . $key;                
        }
  	}
  	else
  	{
  	   return 'img/site images/categoryimages/default.jpg';
  	}
}

function getproductpic($id){
    $dir    = 'img/site images/productimages/' . $id;
    if(file_exists($dir))
    {
        $files1 = array_diff(scandir($dir), array('..', '.'));
        foreach ($files1 as $key) {
          return 'img/site images/productimages/' . $id . '/' . $key;                
        }
    }
    else
    {
       return 'img/site images/productimages/default.jpg';
    }
}

function getsliderimagelink($folder){
    $dir    = 'img/slider images/' . $folder;
    if(file_exists($dir))
    {
        $files1 = array_diff(scandir($dir), array('..', '.'));
        foreach ($files1 as $key) {
          return $dir . '/' . $key;                
        }
    }
}

function categoryexists($catname){
		include('connection.php');
		$sql = 'SELECT * FROM product_category WHERE NAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $catname) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
        $result = mysqli_query( $con, $sql);
        $total_posts = mysqli_num_rows($result);
        if($total_posts > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
}

function categoryidexists($catid){
    include('connection.php');
    $sql = 'SELECT * FROM product_category WHERE ID = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $catid) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
        $result = mysqli_query( $con, $sql);
        $total_posts = mysqli_num_rows($result);
        if($total_posts > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
}

function deleteDir($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            deleteDir(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}
?>