<?php
session_start();
include "koneksi.php";

$level = $_SESSION['level'];
$npm = $_SESSION['npm'];

if ($level == "1") {
    $stmt = $conn->prepare("SELECT * FROM identitas WHERE npm = :npm");
    $stmt->execute([':npm' => $npm]);
} else {
    $stmt = $conn->prepare("SELECT * FROM identitas");
    $stmt->execute();
}

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">DATA MAHASISWA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button class="btn btn-warning" onClick="document.location.href='logout.php'">LOGOUT</button>
    </div>
</nav>

<div class="container mt-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>JK</th>
                <th>Tgl Lahir</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['npm'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['jk'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tgl_lhr'])) ?></td>
                    <td><?= $row['email'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['npm'] ?>" class="btn btn-success btn-sm">Edit</a>
                        <?php if ($level == "2"): ?>
                            <a href="hapus.php?id=<?= $row['npm'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($level == "2"): ?>
        <a href="input_data.php" class="btn btn-success btn-sm">Input Data Baru</a>
    <?php endif; ?>
</div>
</body>
</html>
