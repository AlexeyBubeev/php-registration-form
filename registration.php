<?php

$host = "localhost";
$username = "MyLogin";
$password = "MyPassword";
$database = "MyDatabase";

header('Content-Type: text/html; charset=utf-8');

$max_filesize = 524288;
$filename = $_FILES['file']['name'];
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);

$link = mysql_connect($host, $username, $password);

if (!$link) { die('Не удалось подключиться к базе данных: ' . mysql_error()); }

mysql_select_db ($database);

$name = $_POST['name'];
$pass = $_POST['password'];
$email = $_POST['email'];
$type = $_POST['type'];

if(empty($name)){ die('Укажите ваше имя');}
if(empty($password)){ die('Укажите пароль');}

if ($type == 1) { //  регистрация

  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email)){ die('Несуществующий адрес электронной почты');}

  $p_hash = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
  $c_pass =  $pass . $p_hash;
  $h_pass = hash('sha256', $c_pass);


  if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) { // если есть картинка

    $tmpName = $_FILES['file']['tmp_name'];

    if ($_FILES["file"]["size"] > $max_filesize){die('Размер файла не должен превышать 500Кб');}

    $fp = fopen($tmpName, 'r');
    $data = fread($fp, filesize($tmpName));
    $data = addslashes($data);
    fclose($fp);
    $query = "INSERT INTO images ";
    $query .= "(name,image) VALUES ('$filename','$data')";
    $results = mysql_query($query, $link)or die('Could not INSERT image: ' . mysql_error());
    $photo_id = mysql_insert_id($link);
    $query = "INSERT INTO users (login,password,email,image_id,p_hash) VALUES ( '$name', '$h_pass', '$email', '$photo_id', '$p_hash')";
    $fb = mysql_query($query, $link)or die('Could not INSERT user: ' . mysql_error());
    if($fb) {
      redirect('profile.php?ph='.$p_hash);
    }
  }
  else {
    $query = "INSERT INTO users (login,password,email,p_hash) VALUES ( '$name', '$h_pass', '$email', '$p_hash')";
    $fb = mysql_query($query, $link)or die('Could not INSERT user: ' . mysql_error());
    if($fb) {
      redirect('profile.php?ph='.$p_hash);
    }
  }
}
else { // вход

  $hash_query = "SELECT p_hash FROM users WHERE login = '$name' ";
  $h_fb = mysql_query($hash_query);
  $h_row = mysql_fetch_assoc($h_fb);
  $nh_hash = $h_row['p_hash'];
  $hc_pass =  $pass . $nh_hash;
  $nh_pass = hash('sha256', $hc_pass);
  $query = "SELECT * FROM users WHERE login = '$name' AND password = '$nh_pass' ";
  $fb = mysql_query($query, $link) or die('Could not SELECT user: ' . mysql_error());
  $row = mysql_fetch_assoc($fb);
  if($row){
    redirect('profile.php?ph='.$nh_hash);
  }
  else {
    echo 'Ошибка авторизации проверьте ваше имя и пароль';
  };

}

function redirect($url, $statusCode = 303) {
   header('Location: ' . $url, true, $statusCode);
   die();
}

mysql_close($link);

?>
