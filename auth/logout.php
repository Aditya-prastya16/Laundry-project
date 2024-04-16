<?php
session_start();

function deleteLoginCookie($username) {
    if(isset($_COOKIE[$username])) {
        unset($_COOKIE[$username]);
        setcookie($username, '', time() - 3600, '/');
    }
}

// Panggil fungsi untuk menghapus cookie
if(isset($_SESSION['username'])) {
    deleteLoginCookie($_SESSION['username']);
}

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();
echo "<script>alert('berhasil logout');window.location.href='login.php';</script>";
?>