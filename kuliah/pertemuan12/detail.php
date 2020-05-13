<?php
session_start();
require 'function.php';

// Periksa apakah user sudah LOGIN?
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

// Jika tidak ada id di URL
if (empty($_GET['id'])) {
  header('Location: index.php');
  exit;
}

// Ambil id dari URL
$id = $_GET['id'];

// Query mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id");
// var_dump($m);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <ul>
    <li><img src="img/<?= $m['gambar']; ?>"></li>
    <li>NRP : <?= $m['nrp']; ?></li>
    <li>Nama : <?= $m['nama']; ?></li>
    <li>Email : <?= $m['email']; ?></li>
    <li>Jurusan : <?= $m['jurusan']; ?></li>
    <li><a href="ubah.php?id=<?= $m['id']; ?>">Ubah</a> | <a href="hapus.php?id=<?= $m['id']; ?>" onclick="return confirm('Apakah anda yakin?');">Hapus
      </a>
    </li>
    <li><a href="index.php">Kembali ke daftar mahasiswa</a></li>
  </ul>
</body>


</html>