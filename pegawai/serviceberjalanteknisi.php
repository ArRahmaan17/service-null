<?php
session_start();
if ($_SESSION['role'] === 'teknisi') {
  include '../conn.php';
  $title = "Service Sedang Proses";
  $queryserviceberjalan = "SELECT pelanggan.id_pelanggan, service.id_service, pegawai.id_pegawai, pelanggan.nama_pelanggan, pelanggan.alamat_pelanggan, pelanggan.no_telpon_pelanggan, pegawai.nama_pegawai, pegawai.no_telpon_pegawai, service.tanggal_service FROM service JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan JOIN pegawai ON service.id_pegawai = pegawai.id_pegawai WHERE service.status_service = 'proses'";
  $exec = mysqli_query($conn, $queryserviceberjalan);
  $jumlahdata = mysqli_num_rows($exec);
  if ($jumlahdata > 0) {
    $getAllData = mysqli_fetch_all($exec, MYSQLI_ASSOC);
  } else {
    $pesan = "Wah Belom Ada service yang anda kerjakan hari ini, Cek <a href='dashboardteknisi.php' class='text-decoration-none' > Service yang baru masuk </a>";
  }
} else {
  header("location:index.php");
}

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


    <!-- Custom styles for this template -->
    <link href="../assets/css/sidebars.css" rel="stylesheet">
    <link href="../assets/css/heroes.css" rel="stylesheet">
    <link href="../assets/css/pricing.css" rel="stylesheet">
  </head>

  <body>

    <main class="container-fluid">
      <?php include '../assets/components/sidebarpegawai.php' ?>
      <main class="container-fluid">
        <div class="col-12 px-4 py-5 my-5 border rounded shadow">
          <?php if (isset($_GET['pesan'])) : ?>
            <?php if ($_GET['pesan'] === "berhasil") : ?>
              <div class="alert alert-success" role="alert">
                <?= "Berhasil Memproses Pesanan Service" ?>
              </div>
            <?php else : ?>
              <div class="alert alert-danger" role="alert">
                <?= "Gagal Menyelesaikan Pesanan Service" ?>
              </div>
            <?php endif ?>
          <?php endif ?>
          <h1 class="display-5 mb-5 fw-bold text-center">Service Yang Sedang Anda Kerjakan</h1>
          <div class="col-lg-10 mx-auto">
            <div class="row mb-3 text-center">
              <?php if ($jumlahdata > 0) : ?>
                <table class="table table-responsive">
                  <caption>List dari Teknisi Yang Sedang Service</caption>
                  <thead class="table-dark">
                    <tr class="h5">
                      <th scope="col">Nama Pelanggan</th>
                      <th scope="col">Alamat Pelanggan</th>
                      <th scope="col">Nomer Pelanggan</th>
                      <th scope="col">Nama Teknisi</th>
                      <th scope="col">Nomer Teknisi</th>
                      <th scope="col">Tanggal Service</th>
                      <th scope="col">Wa Pelanggan</th>
                      <th scope="col">Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($getAllData as $t) : ?>
                      <tr class="text-dark fw-bold">
                        <td><?= $t['nama_pelanggan'] ?></td>
                        <td><?= $t['alamat_pelanggan'] ?></td>
                        <td><?= $t['no_telpon_pelanggan'] ?></td>
                        <td><?= $t['nama_pegawai'] ?></td>
                        <td><?= $t['no_telpon_pegawai'] ?></td>
                        <td><?= $t['tanggal_service'] ?></td>
                        <td style="display:none ;"><?php $pesanwa = "Service Bp/Ibu" . $t['nama_pelanggan'] . " Sudah Selesai,terima Kasih Telah menggunakan Jasa Service Kami"; ?></td>
                        <td><a class="text-success" href="https://wa.me/<?= $t['no_telpon_pelanggan'] ?>?text=<?= $pesanwa ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-chat-dots-fill" role="img" viewBox="0 0 16 16">
                              <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg></a></td>
                        <td>
                          <form action="proses.php" method="post">
                            <input type="hidden" name="id_service" value="<?= $t['id_service'] ?>">
                            <input type="hidden" name="id_pegawai" value="<?= $t['id_pegawai'] ?>">
                            <input type="hidden" name="id_pelanggan" value="<?= $t['id_pelanggan'] ?>">
                            <input type="submit" name="selesaijasa" class="btn btn-warning" value="Selesai">
                          </form>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else : ?>
                <h1> <?= $pesan; ?> </h1>
              <?php endif ?>
            </div>
          </div>
        </div>
      </main>
    </main>

    <script src="../assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


  </body>
<?php endif ?>