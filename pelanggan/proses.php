<?php
session_start();
include '../conn.php';

if (isset($_POST['antri'])) {
  $id_pelanggan = $_POST['id_pelanggan'];
  $tanggal = date('Y-m-d');

  $queryantriservice = "INSERT INTO antriservice VALUES (null, $id_pelanggan, '$tanggal', 'masuk')";
  $execantriservice = mysqli_query($conn, $queryantriservice);

  if ($execantriservice) {
    $querynomerantri = "SELECT * FROM antriservice WHERE status = 'masuk'";
    $execnomerantri = mysqli_query($conn, $querynomerantri);
    $jumlahdata = mysqli_num_rows($execnomerantri);
    $_SESSION['pesan'] = "Anda Sedang dalam antrian, nomer antrian anda adalah $jumlahdata";
    header("location:dashboard.php?pesan=berhasil");
  } else {
    header("location:dashboard.php?pesan=gagal");
  }
}
if (isset($_POST['register'])) {
  $name = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nomer = "62" . $_POST['nomer'];
  $alamat = $_POST['alamat'];
  $query = "INSERT INTO pelanggan VALUES (null, '$name', '$username', '$password', $nomer, '$alamat')";
  $exec = mysqli_query($conn, $query);
  if ($exec) {
    header("Location:index.php");
  } else {
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['nomer'] = $_POST['nomer'];
    $_SESSION['alamat'] = $_POST['alamat'];
    header("Location:daftar.php?pesan=gagal");
  }
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'";
  $exec = mysqli_query($conn, $query);

  $data = mysqli_fetch_array($exec, MYSQLI_ASSOC);
  $jumlahdata = mysqli_num_rows($exec);
  if ($jumlahdata === 1) {
    $_SESSION['nama_pelanggan'] = $data["nama_pelanggan"];
    $_SESSION['id_pelanggan'] = $data["id_pelanggan"];
    header("Location:dashboard.php");
  } else {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    header("Location:index.php?pesan=gagal");
  }
}
if (isset($_POST['update'])) {
  $id = $_SESSION['id_pelanggan'];
  $name = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nomer = $_POST['nomer'];
  $alamat = $_POST['alamat'];
  $query = "UPDATE pelanggan SET nama_pelanggan = '$name', username = '$username', password = '$password', no_telpon_pelanggan = $nomer, alamat_pelanggan = '$alamat' WHERE id_pelanggan = $id";
  $exec = mysqli_query($conn, $query);
  if ($exec) {
    $_SESSION['nama_pelanggan'] = $name;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['nomer'] = $nomer;
    $_SESSION['alamat'] = $alamat;
    header("Location:dashboard.php");
  } else {
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['nomer'] = $_POST['nomer'];
    $_SESSION['alamat'] = $_POST['alamat'];
    header("Location:updateuser.php?pesan=gagal");
  }
}
