<?php
session_start();
if (isset($_SESSION['role'])) {
  include '../conn.php';
  $queryudpateuser = "SELECT * FROM pegawai WHERE id_pegawai = '" . $_GET['id'] . "'";
  $exec = mysqli_query($conn, $queryudpateuser);
  $jumlahdata = mysqli_num_rows($exec);
  $getAllData = mysqli_fetch_array($exec);
} else {
  header("location:index.php");
}
?>
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
      <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="../assets/img/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Company
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../pegawai/">Back</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] === "gagal") : ?>
          <div class="alert alert-danger" role="alert">
            <?= "Gagal Update Account, Silahkan Cek Kembali" ?>
          </div>
        <?php endif ?>
      <?php endif ?>
      <div class="container-fluid py-5">
        <form autocomplete="off" action="proses.php" method="POST">
          <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="logo perusahaan" width="72" height="57">
          <h1 class="h3 mb-3 fw-normal">Update Pegawai Account</h1>
          <input type="hidden" name="id_pegawai" value="<?= $getAllData['id_pegawai'] ?>">
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['nama_pegawai'] ?>" required type="text" class="form-control" id="floatingInput" name="nama" placeholder="Nama User">
            <label for="floatingInput">Nama User</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['username'] ?>" required type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['password'] ?>" required type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['no_telpon_pegawai'] ?>" required type="number" class="form-control" id="floatingInput" name="nomer" placeholder="Nomer Telpon">
            <label for="floatingInput">Nomer Telpon</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['alamat_pegawai'] ?>" required type="text" class="form-control" id="floatingInput" name="alamat" placeholder="Alamat">
            <label for="floatingInput">Alamat</label>
          </div>
          <input class="w-100 btn btn-lg btn-primary" type="submit" name="update" value="Update User">
        </form>
      </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>