<?php
require('function.php');

// Jika tidak ada id di URL
if (empty($_GET['id'])) {
  header('Location: index.php');
  exit;
}

// Ambil id dar URL
$id = $_GET['id'];

// Query mahasiswa sesuai id yang di-ambil
$m = query("SELECT * FROM mahasiswa WHERE id = $id");

// Cek apakah tombol ubah sudah ditekan
if (isset($_POST['ubah'])) {
  // var_dump($_POST);
  if (ubah($_POST) > 0) {
    echo "<script>
          alert ('Data Berhasil di-Ubah!');
          document.location.href = 'index.php';
          </script>";
  } else {
    echo "<script>
          alert ('Data gagal di-Ubah');
          document.location.href = 'index.php';
        </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Mahasiswa</title>
</head>

<body>

  <h3>Form Ubah Data Mahasiswa</h3>
  <form action="" method="POST">
    <input type="hidden" name="id" value="<?= $m['id']; ?>">

    <ul>
      <li>
        <label for="nama">Nama :
          <input type="text" name="nama" id="nama" value="<?= $m['nama']; ?>" autofocus required>
        </label>
      </li>
      <li>
        <label for="nrp">NRP :
          <input type="text" name="nrp" id="nrp" value="<?= $m['nrp']; ?>" required>
        </label>
      </li>
      <li>
        <label for="email">Email :
          <input type="email" name="email" id="email" value="<?= $m['email']; ?>" required>
        </label>
      </li>
      <li>
        <label for="jurusan">Jurusan :
          <input type="text" name="jurusan" id="jurusan" value="<?= $m['jurusan']; ?>" required>
        </label>
      </li>
      <li>
        <label for="gambar">Gambar :
          <input type="text" name="gambar" id="gambar" value="<?= $m['gambar']; ?>" required>
        </label>
      </li>
      <li>
        <button type="submit" name="ubah" onclick="return confirm('Apakah anda yakin?');">Ubah Data</button>
      </li>
    </ul>

  </form>

</body>

</html>