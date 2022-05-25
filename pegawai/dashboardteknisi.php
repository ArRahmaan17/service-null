<?php
session_start();
if ($_SESSION['role'] === 'teknisi') {
    include '../conn.php';
    $title = "Pesanan Jasa Service";
    $querypesanservice = "SELECT * FROM antriservice JOIN pelanggan ON antriservice.id_pelanggan = pelanggan.id_pelanggan WHERE antriservice.status = 'masuk'";
    $exec = mysqli_query($conn, $querypesanservice);
    $jumlahdata = mysqli_num_rows($exec);
    if ($jumlahdata >= 1) {
        $getAllData = mysqli_fetch_all($exec, MYSQLI_ASSOC);
    } else {
        $pesan = "Tidak Ada Service Hari ini <br> Sabar rezeki sudah ada yang ngatur";
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
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Pesanan Jasa Service") ? 'active' : ''; ?>" href="dashboardteknisi.php">Pesanan Masuk</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Service Sedang Proses") ? 'active' : ''; ?>" href="serviceberjalanteknisi.php">Service Sedang Proses</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Riwayat Service Saya") ? 'active' : ''; ?>" href="serviceselesaiteknisi.php">Riwayat Service Saya</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-sm navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary d-sm-block d-md-none d-lg-none" id="sidebarToggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
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
                    <div class="row justify-content-start">
                        <?php if ($jumlahdata > 0) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <caption>List dari Teknisi Yang Sedang Service</caption>
                                    <thead class="table-dark">
                                        <tr class="h5">
                                            <td class="col-1 text-center">Nama Pelanggan</td>
                                            <td class="col-1 text-center">Alamat Pelanggan</td>
                                            <td class="col-1 text-center">Tanggal Antri</td>
                                            <td class="col-1 text-center">Terima Service</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($getAllData as $t) : ?>
                                            <tr class="text-dark">
                                                <td class="col-1 text-center"><?= $t['nama_pelanggan'] ?></td>
                                                <td class="col-1 text-center"><?= $t['alamat_pelanggan'] ?></td>
                                                <td class="col-1 text-center"><?= $t['tanggal_antri'] ?></td>
                                                <td class="col-1 text-center">
                                                    <a class="btn btn-info" href="prosesservice.php?id=<?= $t['id_antrian'] ?>">Terima Service</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
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