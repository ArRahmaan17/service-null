<?php
session_start();
include '../conn.php';
$queryudpateuser = "SELECT * FROM service JOIN pegawai ON service.id_pegawai = pegawai.id_pegawai JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan WHERE id_service = '" . $_GET['id'] . "'";
$querypegawai = "SELECT * FROM pegawai";
$exec = mysqli_query($conn, $queryudpateuser);

$jumlahdata = mysqli_num_rows($exec);
$getAllData = mysqli_fetch_array($exec, MYSQLI_ASSOC);

$execpegawai = mysqli_query($conn, $querypegawai);
$dataPegawai = mysqli_fetch_all($execpegawai, MYSQLI_ASSOC);
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
  <link href="/service/assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <main class="form-signin">
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <form autocomplete="off" action="proses.php" method="POST">
          <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="logo perusahaan" width="72" height="57">
          <h1 class="h3 mb-3 fw-normal">Update Pesanan Service</h1>
          <input type="hidden" value="<?= $_GET['id'] ?>" name="id_service">
          <div class="form-floating mb-2" name="id_pegawai">
            <select class="form-select" aria-label="Default select example">
              <?php foreach ($dataPegawai as $p) : ?>
                <option value="<?= $p['id_pegawai'] ?>"><?= $p['nama_pegawai'] ?></option>
              <?php endforeach ?>
            </select>
            <label for="floatingInput">Nama Pegawai</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['no_telpon_pegawai'] ?>" readonly type="text" class="form-control" id="floatingInput" placeholder="Nomer Telpone <?= $getAllData['nama_pegawai'] ?>">
            <label for="floatingInput">Nomer Telpone <?= $getAllData['nama_pegawai'] ?></label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['nama_pelanggan'] ?>" required type="text" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Nama Pelanggan</label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['no_telpon_pelanggan'] ?>" readonly type="text" class="form-control" id="floatingInput" placeholder="Nomer Telpon">
            <label for="floatingInput">Nomer Telpon <?= $getAllData['nama_pelanggan'] ?></label>
          </div>
          <div class="form-floating mb-2">
            <input value="<?= $getAllData['alamat_pelanggan'] ?>" readonly type="text" class="form-control" id="floatingInput" placeholder="Alamat">
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