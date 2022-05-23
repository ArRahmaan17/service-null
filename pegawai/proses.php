<?php
session_start();
include '../conn.php';
// if (isset($_GET['addtocart'])) {
//   $id_pegawai = $_SESSION['id_pegawai'];
//   $id_barang = $_GET['id_barang'];
//   $jumlah_barang = $_GET['jumlah_barang'];
//   $sqlambil = "SELECT barang.id_barang, nama_barang, jumlah_barang FROM keranjangservice JOIN barang WHERE EXISTS (SELECT id_barang FROM barang WHERE barang.id_barang = keranjangservice.id_barang)";
//   $execambil = mysqli_query($conn, $sqlambil);
//   $jumlahdatakeranjang = mysqli_num_rows($execambil);

//   if ($dataambil > 0) {
//     $jumlahlama = $dataambil['jumlah_barang'];
//     $jumlahbaru = $jumlahlama + $jumlah_barang;
//     $sqlupdate = "UPDATE keranjangservice SET jumlah_barang = $jumlahbaru WHERE id_barang = $id_barang";
//     $execupdate = mysqli_query($conn, $sqlupdate);
//     if ($execupdate) {
//       header('Location:barangtoko.php?pesan="berhasil"');
//     } else {
//       header('Location:barangtoko.php?pesan="gagal"');
//     }
//   } else {
//     $sqlmasuk = "INSERT INTO keranjangservice VALUES (null, '$id_pegawai', $id_barang, $jumlah_barang)";
//     $exec = mysqli_query($conn, $sqlmasuk);
//     if ($exec) {
//       header('Location:barangtoko.php?pesan="berhasil"');
//     } else {
//       header('Location:barangtoko.php?pesan="gagal"');
//     }
//   }
// }

if (isset($_POST['update'])) {
  $id = $_POST['id_pegawai'];
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nomer = $_POST['nomer'];
  $alamat = $_POST['alamat'];
  $queryupdatepegawai = "UPDATE pegawai SET nama_pegawai = '$nama', username = '$username', password = '$password', no_telpon_pegawai = $nomer, alamat_pegawai = '$alamat' WHERE id_pegawai = $id";
  $exec = mysqli_query($conn, $queryupdatepegawai);
  if ($exec) {
    $_SESSION['nama_pegawai'] = $nama;
    header("Location:index.php");
  } else {
    $_SESSION['nama_pegawai'] = $_POST['nama'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['nomer'] = $_POST['nomer'];
    $_SESSION['alamat'] = $_POST['alamat'];
    header("Location:updateuser.php?pesan=gagal");
  }
}

if (isset($_POST['selesaijasa'])) {
  $id_service = $_SESSION['id_service'] = $_POST['id_service'];
  $id_pegawai = $_SESSION['id_pegawai'] = $_POST['id_pegawai'];
  $id_pelanggan = $_SESSION['id_pelanggan'] = $_POST['id_pelanggan'];
  $queryprosesjasa = "UPDATE service SET status_service = 'selesai' where service.id_pegawai = $id_pegawai AND service.id_service = $id_service";
  $queryupdatepegawai = "UPDATE pegawai SET status_pegawai = 'longgar' WHERE id_pegawai = $id_pegawai";

  $execproses = mysqli_query($conn, $queryprosesjasa);
  $execpegawai = mysqli_query($conn, $queryupdatepegawai);
  if ($execproses && $execpegawai) {
    header('Location:serviceselesaiteknisi.php?pesan=berhasil');
  } else {
    header('Location:serviceberjalanteknisi.php?pesan=gagal');
  }
}
if (isset($_POST['terimaservice'])) {
  $id_antrian = $_POST['id_antrian'];
  $id_pegawai = $_POST['id_pegawai'];
  $id_pelanggan = $_POST['id_pelanggan'];
  $tanggal = date('Y-m-d');
  $queryterimaservice = "INSERT INTO service VALUES (null, $id_pelanggan, $id_pegawai, '$tanggal', 'proses')";
  $queryprosesjasa = "UPDATE antriservice SET status = 'proses' where id_antrian = $id_antrian";
  $queryupdatepegawai = "UPDATE pegawai SET status_pegawai = 'kerja' WHERE id_pegawai = $id_pegawai";
  $execproses = mysqli_query($conn, $queryprosesjasa);
  $execpegawai = mysqli_query($conn, $queryupdatepegawai);
  $execterima = mysqli_query($conn, $queryterimaservice);
  if ($execproses && $execpegawai && $execterima) {
    header('Location:serviceberjalanteknisi.php?pesan=berhasil');
  } else {
    header('Location:dashboardteknisi.php?pesan=gagal');
  }
}

if (isset($_POST['register'])) {
  $name = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nomer = "62" . $_POST['nomer'];
  $alamat = $_POST['alamat'];
  $role = $_POST['role'];
  $status = $_POST['status'];
  $query = "INSERT INTO pegawai VALUES (null, '$name', '$username', '$password', $nomer, '$alamat', '$role', '$status')";
  $exec = mysqli_query($conn, $query);
  if ($exec) {
    header("location:editteknisi.php?pesan=berhasil");
  } else {
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['nomer'] = $_POST['nomer'];
    $_SESSION['alamat'] = $_POST['alamat'];
    header("Location:tambahteknisi.php?pesan=gagal");
  }
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM pegawai WHERE username = '$username' AND password = '$password'";
  $exec = mysqli_query($conn, $query);

  $data = mysqli_fetch_array($exec, MYSQLI_ASSOC);
  $_SESSION['nama_pegawai'] = $data["nama_pegawai"];
  $jumlahdata = mysqli_num_rows($exec);
  if ($jumlahdata === 1) {
    $_SESSION['role'] = $data["role"];
    $_SESSION['id_pegawai'] = $data["id_pegawai"];
    if ($_SESSION['role'] === 'admin') {
      header("Location:dashboardadmin.php");
    } else {
      header("Location:dashboardteknisi.php");
    }
  } else {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    header("Location:index.php?pesan=gagal");
  }
}
