<?php
require 'function.php';

// Jika tidak ada id di URL
if (empty($_GET['id'])) {
  header('Location: index.php');
  exit;
}

// Mengambil id dari URL
$id = $_GET['id'];

if (hapus($id) > 0) {
  echo "<script>
          alert ('Data berhasil dihapus');
          document.location.href = 'index.php';
        </script>";
} else {
  echo "<script>
          alert ('Data gagal dihapus');
          document.location.href = 'index.php';
        </script>";
}
