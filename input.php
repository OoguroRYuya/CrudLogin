<?php        
session_start();
if ($_SESSION["level"] != "2") {
    include "logout.php";
}

include "koneksi.php"; 

if (isset($_POST['submit'])) {   
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'] ?? ''; 
    $tgl = date('Y-m-d', strtotime($_POST['tgl_lhr']));
    $email = $_POST['email'];

    if (!empty($npm) && !empty($nama)) {
        try {
            $stmt = $conn->prepare("INSERT INTO identitas (npm, nama, alamat, jk, tgl_lhr, email) 
                                    VALUES (:npm, :nama, :alamat, :jk, :tgl_lhr, :email)");
            $stmt->bindParam(':npm', $npm);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':jk', $jk);
            $stmt->bindParam(':tgl_lhr', $tgl);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                header("Location: tampil_data.php");
                exit(); 
            } else {
                echo "Terjadi kesalahan: " . implode(" | ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "NPM dan Nama tidak boleh kosong";
    }
}

$conn = null;
?>
