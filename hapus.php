<?php
session_start();
include "koneksi.php";

$npm = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM identitas WHERE npm = :npm");
$stmt->execute([':npm' => $npm]);

header("Location: tampil_data.php");
?>
