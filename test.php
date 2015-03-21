<?php
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'digital360_ru');
  define('DB_USER','starman');
  define('DB_PASSWORD','starman');
  $error="Не удалось подключиться к MySQL";
  $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die($error . mysql_error());
  $db=mysql_select_db(DB_NAME,$con) or die($error . mysql_error());
  if (mysqli_connect_errno($con)) { echo $error . mysqli_connect_error(); }
  else { echo "Успешное подключение к базе данных ..."; }
?>
