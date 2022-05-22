<?php
session_start();
if (isset($_SESSION['role'])) {
  include '../conn.php';
  $id_antrian = $_GET['id'];
  $sql = "SELECT * FROM antriservice JOIN pelanggan WHERE id_antrian = $id_antrian";
  $execdata =  mysqli_query($conn, $sql);
  $dataantri = mysqli_fetch_array($execdata, MYSQLI_ASSOC);
  $nama = $dataantri['nama_pelanggan'];
  $nomer = $dataantri['no_telpon_pelanggan'];
  $title = "Terima Service $nama";
  $pesan = "Dikarenakan Service Bp/Ibu $nama akan di proses Kami akan segera Menuju rumah Bp/Ibu, Mohon dengan hormat mengirim Share Lokasi";
} else {
  header("location:index.php");
}
?>
<?php if (isset($_SESSION['role'])) : ?>
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
    <link href="../assets/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <main class="form-signin">
      <div class="p-5 mb-4 bg-light shadow rounded-3">
        <div id="kotaklogin" class="container-fluid py-5">
          <form action="proses.php" method="post">
            <input type="hidden" name="id_antrian" value="<?= $dataantri['id_antrian'] ?>">
            <input type="hidden" name="id_pegawai" value="<?= $_SESSION['id_pegawai'] ?>">
            <input type="hidden" name="id_pelanggan" value="<?= $dataantri['id_pelanggan'] ?>">
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Nama Pelanggan</label>
              <input type="text" readonly disabled class="form-control" id="exampleFormControlInput1" value="<?= $dataantri['nama_pelanggan'] ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Nomer Pelanggan</label>
              <input type="text" readonly disabled class="form-control" id="exampleFormControlInput1" value="<?= $dataantri['no_telpon_pelanggan'] ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="exampleFormControlInput1" class="form-label">Alamat Pelanggan</label>
              <input type="text" readonly disabled class="form-control" id="exampleFormControlInput1" value="<?= $dataantri['alamat_pelanggan'] ?>">
            </div>
            <div class="mb-3">
              <input type="submit" class="w-100 btn btn-lg btn-primary" name="terimaservice" value="Terima Service">
            </div>
            <div class="col-12 d-flex p-2">
              <div class="mb-3 col-6 p-1">
                <a class="w-100 btn btn-lg btn-success" href="https://wa.me/<?= $nomer ?>?text=<?= $pesan ?>">Wa pelanggan</a>
              </div>
              <div class="mb-3 col-6 p-1">
                <a class="w-100 btn btn-lg btn-danger" href="dashboardteknisi.php">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
  </body>

  </html>
<?php endif ?>