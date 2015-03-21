<?php
//error_reporting(E_ALL ^ E_NOTICE);

$host = "localhost";
$username = "";
$password = "";
$database = "";

// image upload sets
$max_filesize = 524288;
$filename = $_FILES['file']['name'];
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);

$link = mysql_connect($host, $username, $password);

if (!$link) { die('Could not connect: ' . mysql_error()); }

mysql_select_db ($database);

$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$type = $_POST['type'];


$error_message = '';

//if(!is_int($id) {

if ($type == 1) { //  регистрация

  $reg_exp = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-Za-Z.](2,4)$/";

  if(!preg_match($reg_exp, $email)){ die('Valid email is required');}
  if(empty($name)){ die('Enter name');}
  if(empty($password)){ die('Enter password');}


  if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {

    $tmpName = $_FILES['file']['tmp_name'];

    $fp = fopen($tmpName, 'r');
    $data = fread($fp, filesize($tmpName));
    $data = addslashes($data);
    fclose($fp);
    $query = "INSERT INTO images ";
    $query .= "(name,image) VALUES ('$filename','$data')";
    $results = mysql_query($query, $link)or die('Could not INSERT image: ' . mysql_error());
    $photo_id = mysql_insert_id($link);
    $query = "INSERT INTO users (login,password,email,image_id) VALUES ( '$name', '$password', '$email', '$photo_id')";
    $fb = mysql_query ($query, $link)or die('Could not INSERT user: ' . mysql_error());
    if($fb) {
      echo "YOUR REGISTRATION IS COMPLETED... FULL"; 
    }
  }
  else {
    $query = "INSERT INTO users (login,password,email) VALUES ( '$name', '$password', '$email')";
    $fb = mysql_query ($query, $link)or die('Could not INSERT user: ' . mysql_error());
    if($fb) {
      echo "YOUR REGISTRATION IS COMPLETED... WITHOUT IMAGE  "; 
    }

  }
}
else { // вход

  if(empty($name)){
    $error_message .="<p>Enter name</p>";
  }
  if(empty($password)){
    $error_message .="<p>Enter password</p>";
  }

}

mysql_close($link);

?>
