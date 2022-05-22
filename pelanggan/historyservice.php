<?php
session_start();
if ($_SESSION['nama_pelanggan'] !== null) {
  include '../conn.php';
  $title = "Riwayat Service Saya";
  $id = $_SESSION['id_pelanggan'];
  $queryriwayatservice = "SELECT pegawai.nama_pegawai, pegawai.no_telpon_pegawai, pegawai.status_pegawai, service.tanggal_service, service.status_service, pegawai.status_pegawai FROM service JOIN pegawai ON service.id_pegawai = pegawai.id_pegawai JOIN pelanggan ON service.id_pelanggan = pelanggan.id_pelanggan WHERE service.status_service = 'selesai' AND service.id_pelanggan = $id ";
  $exec = mysqli_query($conn, $queryriwayatservice);
  $jumlahdata = mysqli_num_rows($exec);
  if ($jumlahdata > 0) {
    $getAllData = mysqli_fetch_all($exec, MYSQLI_ASSOC);
  } else {
    $pesan = "Wah Belum Ada Service Selesai nih, Cek Service <a class='text-decoration-none' href='serviceberjalan.php' >Sekarang </a>";
  }
}

?>

<?php if ($_SESSION['nama_pelanggan'] !== null) : ?>
  <!doctype html>
  <html>

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
          <h1 class="display-5 mb-5 fw-bold text-center">Pesan Jasa Service</h1>
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="row">
              <div class="col-md-10">
                <?php if ($jumlahdata > 0) : ?>
                  <table class="table table-responsive">
                    <caption>List dari Service Selesai</caption>
                    <thead class="table-dark">
                      <tr class="text-light h5">
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Nomer Pegawai</th>
                        <th scope="col">Tanggal Service</th>
                        <th scope="col">Status Service</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($getAllData as $t) : ?>
                        <tr class="text-dark align-middle text-capitalize">
                          <td><?= $t['nama_pegawai'] ?></td>
                          <td><?= $t['no_telpon_pegawai'] ?></td>
                          <td><?= $t['tanggal_service'] ?></td>
                          <td>
                            <h4>
                              <?= ($t['status_service'] === 'selesai') ? '<span class="badge badge-lg rounded-pill bg-success text-capitalize">Selesai</span>' : ''; ?>
                            </h4>
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
      </main>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../assets/js/sidebars.js"></script>

  </body>

  </html>
<?php endif ?>