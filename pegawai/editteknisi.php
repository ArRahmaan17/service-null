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
  <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light"><?= $title?></div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "History Pesanan Service") ? 'active' : '' ; ?>" href="dashboardadmin.php">History Pesanan Service</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Update Teknisi") ? 'active' : '' ; ?>" href="editteknisi.php">Edit Pegawai</a>
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
              <?php if (isset($pesan)) : ?>
                <h1> <?= $pesan; ?> </h1>
              <?php else : ?>
                <h1 class="my-3"><?= $title ?></h1>
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
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="../assets/js/sidebars.js"></script>
    </body>
</html>
<?php endif ?>