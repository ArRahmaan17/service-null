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
  <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light"><?= $title ?></div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Pesanan Jasa Service") ? 'active' : '' ; ?>" href="dashboardteknisi.php">Pesanan Masuk</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Service Sedang Proses") ? 'active' : '' ; ?>" href="serviceberjalanteknisi.php">Service Sedang Proses</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Riwayat Service Saya") ? 'active' : '' ; ?>" href="serviceselesaiteknisi.php">Riwayat Service Saya</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                      <button class="btn btn-primary d-sm-block d-md-none d-lg-none" id="sidebarToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                      </button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['nama_pegawai'] ?></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="updateuser.php?id=<?= $_SESSION['id_pegawai'] ?>">Update Account</a>
                                        <a class="dropdown-item" href="../logout.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container">
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
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="../assets/js/sidebars.js"></script>
    </body>
</html>
<?php endif ?>