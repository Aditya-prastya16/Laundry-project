<?php
session_start();

include "../auth/function.php";

if (!isset($_SESSION['username'])) {
    header('Location:../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminUsername = $_SESSION['username'];
    $adminRole = @$_SESSION['role'];

    // Validasi buat admin 
    if ($adminRole !== 'admin') {
        echo "Anda tidak memiliki izin untuk mengakses halaman ini.";
        exit();
    }

    $userId = $_POST['user_id'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    // Validasi password baru biar sesuai konfirmasi
    if ($newPassword !== $confirmNewPassword) {
        echo "Password baru dan konfirmasi password tidak sesuai.";
        exit();
    }

    // Validasi user ID yang dimasukkan valid
    $query = "SELECT * FROM tb_user WHERE id_user='$userId'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // User ID valid,  update password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateQuery = "UPDATE tb_user SET password='$hashedNewPassword' WHERE id_user='$userId'";
            $updateResult = mysqli_query($koneksi, $updateQuery);

            if ($updateResult) {
                echo "<script>alert('Password Berhasil Diperbarui !');window.location='../admin/user.php';</script>";
            } else {
                echo "Gagal memperbarui password user. Silakan coba lagi.";
            }
        } else {
            echo "User ID tidak ditemukan.";
        }
    } else {
        echo "Gagal mengambil data user.";
    }
}
?>
