<?php
session_start();
if ($_SESSION['nama_pelanggan'] !== null) {
  include '../conn.php';
  $title = "Pesan Jasa Service";
  $id_pelanggan = $_SESSION['id_pelanggan'];
  $querypesanservice = "SELECT * FROM antriservice JOIN pelanggan WHERE antriservice.status = 'masuk' AND pelanggan.id_pelanggan = $id_pelanggan";
  $queryservice = "SELECT * FROM antriservice WHERE antriservice.status = 'masuk'";
  $exec = mysqli_query($conn, $querypesanservice);
  $execservice = mysqli_query($conn, $queryservice);
  $jumlahdata = mysqli_num_rows($exec);
  $jumlahdatasemua = mysqli_num_rows($execservice);
  if ($jumlahdata > 1) {
    $pesan =  "$jumlahdata Orang Sedang mengantri dan $jumlahdatasemua Orang yang belum di proses";
  }
}

?>

<?php if ($_SESSION['nama_pelanggan'] !== null) : ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?= $title ?></title>


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
          <?php if (isset($_GET['pesan'])) : ?>
            <?php if ($_GET['pesan'] === "berhasil") : ?>
              <div class="alert alert-success" role="alert">
                Sukses Menambah Antrian, Silahkan Coba Antri Kembali
              </div>
            <?php elseif ($_GET['pesan'] === "gagal") : ?>
              <div class="alert alert-danger" role="alert">
                Gagal Menambah Antrian, Silahkan Coba Antri Kembali
              </div>
            <?php endif ?>
          <?php endif ?>
          <h1 class="display-5 mb-5 fw-bold text-center">Pesan Jasa Service</h1>
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="row">
              <div class="col-md-10">
                <?php if (isset($pesan)) : ?>
                  <p class="display-4 mb-4"><?= $pesan ?></p>
                  <div class="col-8">
                    <form action="proses.php" method="post">
                      <input type="hidden" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?>">
                      <input class="w-100 text-truncate btn btn-lg btn-primary" type="submit" name="antri" value="Antri Jasa">
                    </form>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </main>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../assets/js/sidebars.js"></script>
  </body>

  </html>
<?php endif ?>