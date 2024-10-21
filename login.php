<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = MD5($_POST['pass']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND pass = :pass");
    $stmt->execute([':username' => $username, ':pass' => $password]);

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['level'] = $row['level'];
        $_SESSION['npm'] = $row['npm'];

        echo "Login Berhasil! Redirecting...";
     
        header("Refresh: 2; URL=tampil_data.php"); // Redirect dengan delay untuk melihat pesan debug
    } else {
        echo "Login Gagal! Username atau password salah.";
    }
} else {
    echo "Akses tidak diizinkan!";
}
?>
