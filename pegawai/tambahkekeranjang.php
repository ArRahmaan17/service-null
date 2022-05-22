<?php
session_start();

include '../conn.php';
$id_barang = $_GET['id'];
$sql = "SELECT * FROM barang WHERE id_barang = $id_barang";
$execdata =  mysqli_query($conn, $sql);
$databarang = mysqli_fetch_array($execdata, MYSQLI_ASSOC);
$title = "Masukan Keranjang $databarang[nama_barang]";

?>
<?php if (isset($_SESSION['role'])) : ?>
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
    <link href="/service/assets/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class="container col-xl-12 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5 rounded px-4 py-5 shadow-sm">
        <div class="col-md-10 mx-auto col-lg-5">
          <form action="proses.php" method="post">
            <input type="hidden" name="id_barang" value="<?= $databarang['id_barang'] ?>">
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
              <input type="text" readonly disabled class="form-control" id="exampleFormControlInput1" value="<?= $databarang['nama_barang'] ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Harga Barang</label>
              <input type="text" readonly disabled class="form-control" id="exampleFormControlInput1" value="<?= $databarang['harga_barang'] ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Stok Barang</label>
              <input type="text" readonly disabled class="form-control" id="exampleFormControlInput1" value="<?= $databarang['stok_barang'] ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Berat Barang</label>
              <input type="text" readonly disabled class="form-control" id="exampleFormControlInput1" value="<?= $databarang['berat'] ?> g">
            </div>
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Jumlah Pesan Barang</label>
              <input type="number" required class="form-control" id="exampleFormControlInput1" name="jumlah_barang" min="1" value="1">
            </div>
            <div class="mb-3">
              <input type="submit" class="w-100 btn btn-lg btn-primary" name="" value="Masukan Keranjang">
            </div>
          </form>
        </div>
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="../assets/img/hero-img.svg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
      </div>
    </div>
  </body>

  </html>
<?php endif ?>