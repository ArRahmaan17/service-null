<?php
session_start();
include '../conn.php';
$title = "Biaya Service";
$queryambildatapelanggan = "SELECT pelanggan.id_pelanggan, service.id_service, pegawai.id_pegawai, pelanggan.nama_pelanggan, pelanggan.alamat as alamat_pelanggan, pelanggan.no_telpon, pegawai.nama_pegawai, pegawai.no_telpon, service.tanggal FROM `service` JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan JOIN pegawai ON service.id_pegawai = pegawai.id_pegawai WHERE service.status = 'proses'";

$querydatakeranjang = "SELECT * FROM `keranjangservice` JOIN pegawai JOIN barang ON barang.id_barang = keranjangservice.id_barang WHERE keranjangservice.id_pegawai = pegawai.id_pegawai";
$execambildata = mysqli_query($conn, $queryambildatapelanggan);
$execkeranjang = mysqli_query($conn, $querydatakeranjang);

$jumlahbarang = mysqli_num_rows($execkeranjang);
$datakeranjang = mysqli_fetch_array($execkeranjang);
$datapegawai = mysqli_fetch_array($execambildata, MYSQLI_ASSOC);

var_dump($datakeranjang);
die();
?>
<?php if ($_SESSION['role'] === 'teknisi') : ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?= $title ?></title>
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
      <div class="p-5 mb-4 bg-light shadow rounded-3">
        <div class="row g-5">
          <div class="col-md-6 col-lg-5 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Keranjang</span>
              <span class="badge bg-primary rounded-pill"><?= $jumlahbarang ?></span>
            </h4>
            <ul class="list-group mb-3">
              <?php foreach ($datakeranjang as $b) : ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                  <div>
                    <h6 class="my-0"><?= $b['jumlah_barang'] ?></h6>
                    <small class="text-muted">Brief description</small>
                  </div>
                  <span class="text-muted">$12</span>
                </li>
              <?php endforeach ?>

              <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong>$20</strong>
              </li>
            </ul>
          </div>
          <div class="col-md-6 col-lg-7">
            <h1 class="h3 my-3 fw-normal">Form <?= $title ?></h1>
            <form autocomplete="off" action="proses.php" method="POST">
              <div class="mb-3 row text-start">
                <label for="staticEmail" class="col-sm-5 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-7">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $datapegawai['nama_pelanggan'] ?>">
                </div>
              </div>
              <div class="mb-3 row text-start">
                <label for="staticEmail" class="col-sm-5 col-form-label">Nama Pegawai</label>
                <div class="col-sm-7">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $datapegawai['nama_pegawai'] ?>">
                </div>
              </div>
              <input class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="Sign In">
            </form>
          </div>
        </div>
        <div class="container-fluid py-5">

        </div>
      </div>
    </main>


    <script src="/service/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>

  </html>
<?php endif ?>