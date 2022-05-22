<?php
session_start();
include '../conn.php' ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Jasa Service</title>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <link href="../assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <main class="form-signin">
    <div class="p-5 mb-4 bg-light rounded-3">
      <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] === "gagal") : ?>
          <div class="alert alert-danger" role="alert">
            <?= "Tambah Pegawai Gagal" ?>
          </div>
        <?php endif ?>
      <?php endif ?>
      <div class="container-fluid py-5">
        <form autocomplete="off" action="proses.php" method="POST">
          <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="logo perusahaan" width="72" height="57">
          <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
          <div class="form-floating mb-2">
            <input value="<?= (isset($_SESSION['nama'])) ? $_SESSION['nama'] : ''; ?>" required type="text" class="form-control" id="floatingInput" name="nama" placeholder="Nama User">
            <label for="floatingInput">Nama Pegawai</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= (isset($_SESSION['username'])) ? $_SESSION['username'] : ''; ?>" required type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
            <label for="floatingInput">Username Pegawai</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= (isset($_SESSION['password'])) ? $_SESSION['password'] : ''; ?>" required type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password Pegawai</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= (isset($_SESSION['nomer'])) ? $_SESSION['nomer'] : ''; ?>" required type="number" class="form-control" id="floatingInput" name="nomer" placeholder="Nomer Telpon">
            <label for="floatingInput">Nomer Telpon Pegawia</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= (isset($_SESSION['alamat'])) ? $_SESSION['alamat'] : ''; ?>" required type="text" class="form-control" id="floatingInput" name="alamat" placeholder="Alamat">
            <label for="floatingInput">Alamat Pegawai</label>
          </div>
          <div class=" form-floating mb-2">
            <select id="floatingInput" name="role" class="form-select">
              <option value="<?= (isset($_SESSION['role'])) ? $_SESSION['role'] : 'admin'; ?>">Admin</option>
              <option value="<?= (isset($_SESSION['role'])) ? $_SESSION['role'] : 'teknisi'; ?>">Teknisi</option>
            </select>
            <label for="floatingInput">Role Pegawai</label>
          </div>
          <div class="form-floating mb-2">
            <select id="floatingInput" name="status" class="form-select">
              <option value="<?= (isset($_SESSION['status'])) ? $_SESSION['status'] : 'longgar'; ?>">Longgar</option>
              <option value="<?= (isset($_SESSION['status'])) ? $_SESSION['status'] : 'kerja'; ?>">Kerja</option>
              <option value="<?= (isset($_SESSION['status'])) ? $_SESSION['status'] : 'admin'; ?>">Admin</option>
            </select><label for="floatingInput">Status Pegawai</label>
          </div>
          <input class="w-100 btn btn-lg btn-primary" type="submit" name="register" value="Sign UP">
        </form>
      </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>