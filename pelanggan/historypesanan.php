<?php
session_start();
if ($_SESSION['nama_pelanggan'] !== null) {
  include '../conn.php';
  $title = "Riwayat Pesanan";
  $querypesanservice = "SELECT * FROM barang WHERE stok_barang > 0";
  $exec = mysqli_query($conn, $querypesanservice);
  $jumlahdata = mysqli_num_rows($exec);
  if ($jumlahdata >= 1) {
    $getAllData = mysqli_fetch_all($exec, MYSQLI_ASSOC);
  } else {
    $pesan = "Belum ada Riwayat Pesanan, <a href='barang.php' class='text-decoration-none'>Pesan Sekarang</a>";
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
    <link href="../assets/css/sidebars.css" rel="stylesheet">
    <link href="../assets/css/heroes.css" rel="stylesheet">
    <link href="../assets/css/pricing.css" rel="stylesheet">
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
                    <div class="card mb-4 rounded-3 shadow border-primary">
                      <div class="card-header py-3 text-white bg-primary border-primary">
                        <h4 class="my-0 fw-normal"><?= $t['nama_pegawai'] ?></h4>
                      </div>
                      <div class="card-body">
                        <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                          <li>30 users included</li>
                          <li>15 GB of storage</li>
                          <li>Phone and email support</li>
                          <li>Help center access</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button>
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

    <script src="/service/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
<?php endif ?>