<?php
require 'function.php';
$mahasiswa = query('SELECT * FROM mahasiswa');

// Ketika tombol cari di-klik
if (isset($_POST['cari'])) {
  $mahasiswa = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>

  <h3>Daftar Mahasiswa</h3>

  <!-- Tombol Tambah Data -->
  <a href="tambah.php">Tambah Data Mahasiswa</a>
  <br></br>

  <!-- Form Pencarian Data -->
  <form action="" method="post">
    <input type="text" name="keyword" size="45" placeholder="masukkan keyword pencarian *)" autocomplete="off" autofocus>
    <button type="submit" name="cari">Cari</button>
  </form>
  <br></br>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Aksi</th>
    </tr>

    <?php if (empty($mahasiswa)) : ?>
      <tr>
        <td colspan='4'>
          <p style='color:brown; font-style:italic;'>Data mahasiswa tidak ditemukan</p>
        </td>
      </tr>
    <?php endif; ?>

    <?php
    $i = 1;
    foreach ($mahasiswa as $m) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $m['gambar']; ?>" width="40px"></td>
        <td><?= $m['nama']; ?></td>
        <td>
          <a href="detail.php?id=<?= $m['id']; ?>">Lihat Detail</a>
        </td>
        </th>
      </tr>
    <?php endforeach; ?>

  </table>
</body>

</html>