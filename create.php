<?php
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $email = $_POST['email'];

    $insertQuery = "INSERT INTO siswa (nama, nis, kelas, email) VALUES ('$nama', '$nis', '$kelas', '$email')";
    
    if (mysqli_query($koneksi, $insertQuery)) {
        echo "Data berhasil ditambahkan! Dan siap dicuri <br>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body bgcolor="Red">
    <h2 class="jumbotron text-center">Form tambah data siswa</h2>
    <form action="create.php" method="post">
        <i class="bi bi-align-start"></i>
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br>
        <label>NIS:</label><br>
        <input type="text" name="nis" required><br>
        <label>Kelas:</label><br>
        <input type="text" name="kelas" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <input type="submit" value="Tambah Data">
    </form>
    <br>
    <a href="index.php">Kembali ke daftar siswa</a>
</body>
</html>