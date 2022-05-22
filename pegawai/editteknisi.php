<?php
session_start();
if ($_SESSION['role'] === 'admin') {
  include '../conn.php';
  $title = "Update Teknisi";
  $querypesanservice = "SELECT * FROM pegawai WHERE role = 'teknisi'";
  $exec = mysqli_query($conn, $querypesanservice);
  $jumlahdata = mysqli_num_rows($exec);
  if ($jumlahdata >= 1) {
    $getAllData = mysqli_fetch_all($exec, MYSQLI_ASSOC);
  } else {
    $pesan = "Tidak Ada Service Hari ini <br> Sabar rezeki sudah ada yang ngatur";
  }
}

?>

<?php if ($_SESSION['role'] === 'admin') : ?>
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
      <?php include '../assets/components/sidebaradmin.php' ?>
      <main class="container-fluid">
        <div class="col-12 px-4 py-5 my-5 border rounded shadow">
          <?php if (isset($_GET['pesan'])) : ?>
            <?php if ($_GET['pesan'] === "berhasil") : ?>
              <div class="alert alert-success" role="alert">
                <?= "Tambah Pegawai Berhasil" ?>
              </div>
            <?php endif ?>
          <?php endif ?>
          <h1 class="display-5 mb-5 fw-bold text-center">Pesanan Jasa Service</h1>
          <div class="col-lg-10 mx-auto">
            <div class="row mb-3 text-center">
              <?php if (isset($pesan)) : ?>
                <h1> <?= $pesan; ?> </h1>
              <?php else : ?>
                <table class="table table-hover">
                  <a href="tambahteknisi.php" class="btn col-3 mb-2 btn-success">Tambah Teknisi</a>
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">Nama Pegawai</th>
                      <th scope="col">Nomer Pegawai</th>
                      <th scope="col">Alamat Pegawai</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($getAllData as $s) : ?>
                      <tr>
                        <td class="table-success"><?= $s['nama_pegawai'] ?></td>
                        <td class="table-success"><?= $s['no_telpon_pegawai'] ?></td>
                        <td class="table-success"><?= $s['alamat_pegawai'] ?></td>
                        <td class="table-success"><?= $s['status_pegawai'] ?></td>
                        <td class="table-success"><a href="updateuser.php?id=<?= $s['id_pegawai'] ?>">Edit</a></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php endif ?>
            </div>
          </div>
        </div>
      </main>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../assets/js/sidebars.js"></script>
  </body>
<?php endif ?>