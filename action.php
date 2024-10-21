<?php
session_start();
include "koneksi.php";

if ($_POST) {
    // Konversi tanggal lahir dari DD-MM-YYYY ke YYYY-MM-DD
    $tgl_lhr = DateTime::createFromFormat('d-m-Y', $_POST['tgl_lhr'])->format('Y-m-d');

    $stmt = $conn->prepare("UPDATE identitas SET nama = :nama, alamat = :alamat, jk = :jk, tgl_lhr = :tgl_lhr, email = :email WHERE npm = :npm");
    $stmt->execute([
        ':nama' => $_POST['nama'],
        ':alamat' => $_POST['alamat'],
        ':jk' => $_POST['jk'],
        ':tgl_lhr' => $tgl_lhr,
        ':email' => $_POST['email'],
        ':npm' => $_POST['npm']
    ]);
    
    header("Location: tampil_data.php");
    exit();
}
