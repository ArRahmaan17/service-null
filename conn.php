<?php
$user = 'root';
$password = '';
$host = 'localhost';
$db = 'service';

$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
  echo 'tidak konek';
}
