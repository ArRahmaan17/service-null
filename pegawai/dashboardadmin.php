<?php
session_start();
if ($_SESSION['role'] === 'admin') {
    include '../conn.php';
    $title = "History Pesanan Service";
    $querypesanservice = "SELECT * FROM service JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan JOIN pegawai ON service.id_pegawai = pegawai.id_pegawai WHERE status_service = 'selesai'";
    $exec = mysqli_query($conn, $querypesanservice);
    $tanggal = date('Y-m-d');
    $jumlahdata = mysqli_num_rows($exec);
    if ($jumlahdata >= 1) {
        $data = mysqli_fetch_all($exec, MYSQLI_ASSOC);
    } else {
        $pesan = "Tidak Ada Service Hari ini <br> Sabar rezeki sudah ada yang ngatur";
    }

    if (isset($_POST['kelola'])) {
        $bulan = $_POST['bulan'];
        $sql = "SELECT * FROM service JOIN pegawai ON pegawai.id_pegawai = service.id_pegawai JOIN pelanggan ON pelanggan.id_pelanggan = service.id_pelanggan WHERE `status_service` = 'selesai' AND MONTH(tanggal_service) = $bulan";
        $exec = mysqli_query($conn, $sql);
        $data = mysqli_fetch_all($exec, MYSQLI_ASSOC);
        if (mysqli_num_rows($exec) > 0) {
            $bulan;
        }
    }
    if (isset($_POST['print'])) {
        $awal = $_POST['awal'];
        $akhir = $_POST['akhir'];

        $sql = "SELECT * FROM service JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan JOIN pegawai ON service.id_pegawai = pegawai.id_pegawai WHERE status_service = 'selesai' AND (tanggal_service BETWEEN '$awal' AND '$akhir')";
        $execprint = mysqli_query($conn, $sql);
        $data = mysqli_fetch_all($execprint, MYSQLI_ASSOC);
        if (mysqli_num_rows($execprint) > 0) {
            $print = "print";
        }
    }
} else {
    header("location:index.php");
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
        <title><?= $title ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    </head>
    <style type="text/css">
        @media print {
            #sidebar-wrapper {
                display: none;
            }

            div.alert-info {
                display: none;
            }

            nav.navbar {
                display: none;
            }

            div#navbarSupportedContent {
                display: none;
            }

            form {
                display: none;
            }

            table {
                min-width: 100%;
            }
        }
    </style>

    <body <?= (isset($print)) ? "onload='window.print()'" : ""; ?>>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light"><?= $title ?></div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "History Pesanan Service") ? 'active' : ''; ?>" href="dashboardadmin.php">History Pesanan Service</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= ($title === "Update Teknisi") ? 'active' : ''; ?>" href="editteknisi.php">Edit Pegawai</a>
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
                    <div class="d-none d-sm-block d-md-block">
                        <div class="row">
                            <div class="col">
                                <form action="" method="post">
                                    <div class="row g-2 mx-5 px-3 my-4">
                                        <div class="col">
                                            <input type="date" class="form-control " max="<?= $tanggal ?>" name="awal" value="<?= $tanggal ?>">
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control" max="<?= $tanggal ?>" name="akhir" value="<?= $tanggal ?>">
                                        </div>
                                        <div class="col">
                                            <input class="btn btn-success" type="submit" name="print" value="Print">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <form action="" method="post">
                                    <div class="row g-2 mx-5 px-3 my-4">
                                        <select class="form-select col" name="bulan" aria-label="Default select example">
                                            <option selected value="1">Januari</option>
                                            <option value="2">Febuari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                        <div class=" col">
                                            <input class="btn btn-success" type="submit" name="kelola" value="Kelola">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="m-4 d-block d-sm-none alert alert-info" role="alert">
                        fitur print hanya bisa digunakan di laptop atau tablet
                    </div>

                    <?php if ($jumlahdata > 0) : ?>
                        <div class=" table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <caption><?= $title ?></caption>
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Nomer</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Nomer Pelanggan</th>
                                        <th scope="col">Alamat Pelanggan</th>
                                        <th scope="col">Nama Teknisi</th>
                                        <th scope="col">Tanggal Service</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data as $t) : ?>
                                        <tr class="text-dark">
                                            <td><?= $no++ ?></td>
                                            <td><?= $t['nama_pelanggan'] ?></td>
                                            <td><?= $t['no_telpon_pelanggan'] ?></td>
                                            <td><?= $t['alamat_pelanggan'] ?></td>
                                            <td><?= $t['nama_pegawai'] ?></td>
                                            <td><?= $t['tanggal_service'] ?></td>
                                            <td>
                                                <h5>
                                                    <span class="badge bagde-md bg-success"><?= $t['status_service'] ?></span>
                                                </h5>
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
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="../assets/js/sidebars.js"></script>
    </body>

    </html>

<?php endif ?>