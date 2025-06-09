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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet" >
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Update Data Siswa</h2>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $nama; ?>">
            </div>
            
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="text" class="form-control" id="nis" name="nis" required value="<?php echo $nis; ?>">
            </div>
            
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" class="form-control" id="kelas" name="kelas" required value="<?php echo $kelas; ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Perbarui Data</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>