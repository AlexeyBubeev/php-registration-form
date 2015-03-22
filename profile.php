<?php

if(!isset($_GET['ph']))redirect('/');

$p_hash = $_GET['ph'];

$link = mysql_connect('localhost','MyLogin','MyPassword');
mysql_select_db ('MyDatabase');

$query = "SELECT * FROM users WHERE p_hash = '$p_hash'";
$row = mysql_query($query);
$user = mysql_fetch_assoc($row);
if(isset($user['image_id'])){
  $i_id = $user['image_id'];
  $s_query = "SELECT * FROM images WHERE id = '$i_id'";
  $s_row = mysql_query($s_query);
  $img = mysql_fetch_assoc($s_row);
  $name = $img['name'];
  $ext = substr(strrchr($name, "."), 1);

}

header('Content-Type: text/html; charset=utf-8');
echo '
<!DOCTYPE html>
<html>
  <head>
    <title>Регистрация</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="/css/style.css"/>
    <script type="text/javascript" src="/js/registration.js"></script>
  </head>
  <body>
    <div class="container">
      <div id="main_list">
        <p>Имя пользователя : <b>' . $user['login'] . '</b></p>
        <p>Электронный почтовый ящик : <b>' . $user['email'] . '</b></p>';
if(isset($user['image_id'])){
  echo '
        <div><img src="data:image/' . $ext . ';base64,' . base64_encode($img['image']) . '" title="' . $name . '" class="nice-img" width="290" height="290" /></div>';
}
  echo '
      </div>
    </div>
  </body>
</html>';

function redirect($url, $statusCode = 303) {
   header('Location: ' . $url, true, $statusCode);
   die();
}

mysql_close($link);

?>
