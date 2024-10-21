<?php
session_start();
include "koneksi.php";

$npm = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM identitas WHERE npm = :npm");
$stmt->execute([':npm' => $npm]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data tidak ditemukan, redirect ke tampil_data.php
if (!$data) {
    header("Location: tampil_data.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap-datepicker.min.js"></script>
    <link href="vendor/bootstrap/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>

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
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h6>EDIT BIODATA</h6>
        </div>
        <div class="card-body">
            <form action="action.php" method="post">
                <input type="hidden" name="npm" value="<?= $data['npm'] ?>">
                
                <div class="form-group">
                    <label>NAMA :</label>
                    <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Alamat :</label>
                    <textarea class="form-control" rows="3" name="alamat" required><?= $data['alamat'] ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Jenis Kelamin :</label><br/>
                    <label class="radio-inline"><input type="radio" name="jk" value="L" <?= ($data['jk'] == 'L') ? 'checked' : '' ?>> Laki-Laki</label>
                    <label class="radio-inline"><input type="radio" name="jk" value="P" <?= ($data['jk'] == 'P') ? 'checked' : '' ?>> Perempuan</label>
                </div>
                
                <div class="form-group">
                    <label>Tanggal Lahir :</label>
                    <input class="form-control datepicker" name="tgl_lhr" placeholder="DD-MM-YYYY" type="text" value="<?= date('d-m-Y', strtotime($data['tgl_lhr'])) ?>" required>
                </div>
                
                <div class="form-group">
                    <label>ALAMAT EMAIL :</label>
                    <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="tampil_data.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>

</body>
</html>
