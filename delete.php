<?php

include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $id = mysqli_real_escape_string($koneksi, $id);

    $query = "DELETE FROM siswa WHERE id = '$id'";

    if(mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
} else {
    die("ID tidak ditemukan!");
}
?>