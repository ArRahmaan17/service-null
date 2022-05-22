<?php
session_start();
if ($_SESSION['nama_pelanggan'] !== null) {
  include '../conn.php';
  $title = "Pesan Barang";
  $querypesanservice = "SELECT * FROM barang WHERE stok_barang > 0";
  $exec = mysqli_query($conn, $querypesanservice);
  $jumlahdata = mysqli_num_rows($exec);
  if ($jumlahdata >= 1) {
    $getAllData = mysqli_fetch_all($exec, MYSQLI_ASSOC);
  } else {
    $pesan = "Barang Masih Out Of Stock nih, Tunggu Yaa";
  }
}

?>

<?php if ($_SESSION['nama_pelanggan'] !== null) : ?>
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


    <!-- Custom styles for this template -->
    <link href="css/sidebars.css" rel="stylesheet">
    <link href="css/heroes.css" rel="stylesheet">
    <link href="css/pricing.css" rel="stylesheet">
  </head>

  <body>

    <main class="container-fluid">
      <?php include '../assets/components/sidebar.php' ?>
      <main class="container-fluid">
        <div class="col-12 px-4 py-5 my-5 border rounded shadow">
          <h1 class="display-5 mb-5 fw-bold text-center">Pesan Jasa Service</h1>
          <div class="col-lg-10 mx-auto">
            <div class="row mb-3 text-center">
              <?php if ($jumlahdata >= 1) : ?>
                <?php foreach ($getAllData as $t) : ?>
                  <div class="col-3">
                    <div class="card mb-4 rounded-3 shadow border-success">
                      <div class="card-header py-3 text-white bg-success border-success">
                        <h4 class="my-0 fw-normal"><?= $t['nama_barang'] ?></h4>
                      </div>
                      <div class="card-body">
                        <h1 class="card-title pricing-card-title">Rp.<?= $t['harga_barang'] ?><small class="text-muted fw-light">/buah</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                          <li>free pasang</li>
                          <li>Pelayanan di jam kerja</li>
                        </ul>
                        <form action="proses.php" method="post">
                          <div class="mb-3 text-start">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah Barang</label>
                            <input type="number" name="jumlah_barang" class="form-control border-success" id="exampleFormControlInput1" value="1">
                          </div>
                          <input type="hidden" name="id_barang" value="<?= $t['id_barang'] ?>">
                          <input type="submit" name="addtocart" class="w-100 btn btn-lg btn-success" value="Masukan Keranjang">
                        </form>
                        <?php
                        ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              <?php else : ?>
                <h1><?= $pesan; ?></h1>
              <?php endif ?>
            </div>
          </div>
        </div>
      </main>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  </body>
<?php endif ?>