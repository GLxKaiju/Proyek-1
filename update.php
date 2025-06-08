<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

$id = mysqli_real_escape_string($koneksi, $id);
$query = "SELECT * FROM siswa WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan!");
}

$row = mysqli_fetch_assoc($result);
$nama = htmlspecialchars($row['nama']);
$nis = htmlspecialchars($row['nis']);
$kelas = htmlspecialchars($row['kelas']);
$email = htmlspecialchars($row['email']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $nis = $_POST['nis'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $email = $_POST['email'] ?? '';

    // Basic sanitation
    $nama_safe = mysqli_real_escape_string($koneksi, $nama);
    $nis_safe = mysqli_real_escape_string($koneksi, $nis);
    $kelas_safe = mysqli_real_escape_string($koneksi, $kelas);
    $email_safe = mysqli_real_escape_string($koneksi, $email);

    $updateQuery = "UPDATE siswa SET nama='$nama_safe', nis='$nis_safe', kelas='$kelas_safe', email='$email_safe' WHERE id='$id'";

    if (mysqli_query($koneksi, $updateQuery)) {
        header("Location: index.php");
        exit();
    } else {
        $message = "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Siswa</title>
</head>
<body>
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
</body>
</html>
[file content end]