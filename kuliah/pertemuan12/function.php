<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_711121');
}


function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  // Jika hasilnya hanya 1 data jalankan Perintah berikut ini :
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  // Jika hasilnya lebih dari 1 maka jalankan Perintah berikut ini :
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

// Fungsi untuk Tambah Data Mahasiswa
function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nrp  = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "INSERT INTO
            mahasiswa
            VALUES
            (null, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

// Fungsi untuk Hapus Data Mahasiswa
function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

// Fungsi untuk Ubah Data Mahasiswa
function ubah($data)
{
  $conn = koneksi();

  $id = $data['id'];
  $nama = htmlspecialchars($data['nama']);
  $nrp  = htmlspecialchars($data['nrp']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "UPDATE mahasiswa
            SET
                nama = '$nama',
                nrp  = '$nrp',
                email = '$email',
                jurusan = '$jurusan',
                gambar  = '$gambar'
            WHERE
                id = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

// Fungsi Pencarian/Searching
function cari($keyword)
{
  $conn = koneksi();
  $query = "SELECT * FROM mahasiswa
            WHERE nama LIKE '%$keyword%'
            OR    nrp  LIKE '%$keyword%'
            OR jurusan LIKE '%$keyword%'
            ";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

// Fungsi Login
function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // Cek dulu username
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {

    // Cek Password
    if (password_verify($password, $user['password'])) {
      //  Set Session
      $_SESSION['login'] = true;

      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah!'
  ];
}


// Fungsi Registrasi User Baru
function registrasi($data)
{
  $conn = koneksi();

  $username  = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // Jika Username atau Password Kosong
  if (empty($username) or empty($password1) or empty($password2)) {
    echo "<script>
    alert ('Username / Password Tidak Boleh Kosong!');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // Jika Username sudah ada dalam database
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
    alert ('Username sudah ada dalam database!');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // Jika Konfirmasi Password tidak Sesuai
  if ($password1 != $password2) {
    echo "<script>
    alert ('Konfirmasi Password tidak Sesuai!');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // Jika Username < 5 digit
  if (strlen($username) < 5) {
    echo "<script>
    alert ('Username terlalu pendek, minimal 5 huruf/angka');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // Jika Password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
    alert ('Password terlalu pendek, minimal 5 huruf/angka');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // Jika Username & Password sudah Sesuai
  // Enkripsi Password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  // Insert ke tabel user
  $query = "INSERT INTO user VALUES (null, '$username', '$password_baru')";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
