<?php
include "../auth/function.php";

$id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
$role = mysqli_real_escape_string($koneksi, $_POST['role']);


$update_user = mysqli_query($koneksi, "UPDATE tb_user SET nama='$nama', username='$username', id_outlet='$id_outlet', role ='$role ' WHERE id_user='$id_user'");

if (!$update_user) {
    echo "Gagal memasukkan data obat: " . mysqli_error($koneksi);
} else {
    // Berhasil melakukan update
    echo "<script>location.href='../admin/user.php'</script>";
    exit;
}
?>
