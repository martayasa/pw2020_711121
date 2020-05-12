<?php
require('function.php');

// Cek apakah tombol tambah sudah ditekan
if (isset($_POST['tambah'])) {
  // var_dump($_POST);
  if (tambah($_POST) > 0) {
    echo "<script>
          alert ('Data Berhasil Ditambahkan!');
          document.location.href = 'latihan3.php';
          </script>";
  } else {
    echo "Data gagal ditambahkan!";
  }
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mahasiswa</title>
</head>

<body>

  <h3>Form Tambah Data Mahasiswa</h3>
  <form action="" method="POST">

    <ul>
      <li>
        <label for="nama">Nama :
          <input type="text" name="nama" id="nama" autofocus required>
        </label>
      </li>
      <li>
        <label for="nrp">NRP :
          <input type="text" name="nrp" id="nrp" required>
        </label>
      </li>
      <li>
        <label for="email">Email :
          <input type="email" name="email" id="email" required>
        </label>
      </li>
      <li>
        <label for="jurusan">Jurusan :
          <input type="text" name="jurusan" id="jurusan" required>
        </label>
      </li>
      <li>
        <label for="gambar">Gambar :
          <input type="text" name="gambar" id="gambar" required>
        </label>
      </li>
      <li>
        <button type="submit" name="tambah">Tambah Data</button>
      </li>
    </ul>

  </form>

</body>

</html>