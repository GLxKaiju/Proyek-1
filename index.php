<?php
include "koneksi.php";

$readQuery = "SELECT * FROM siswa";
$resultQuery = mysqli_query($koneksi, $readQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>


    <table border="1">
        <tr>
            <i class='bx  bx-user-square'></i> 
            <th>Id</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Email</th>
        </tr>

        <?php
        if (mysqli_num_rows($resultQuery) > 0) {
            while ($row = mysqli_fetch_assoc($resultQuery)) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?> </td>
                <td><?php echo htmlspecialchars($row['nama']); ?> </td>
                <td><?php echo htmlspecialchars($row['nis']); ?> </td>
                <td><?php echo htmlspecialchars($row['kelas']); ?> </td>
                <td><?php echo htmlspecialchars($row['email']); ?> </td>
                <td><button><a href="edit.php?id=<?php echo $row['id'];?>">Edit Data</a></button></td>
                <td><button onclick="confirmDelete(<?php echo $row['id']; ?>)">Hapus Data</button></td>
    
            </tr>
        <?php endwhile; } else{}?>
        
        
    </table>
    <a href="create.php">create</a>
</body>

</html>
