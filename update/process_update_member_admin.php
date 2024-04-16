<?php
include "../auth/function.php";

$id_member = mysqli_real_escape_string($koneksi, $_POST['id_member']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
$tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);

$update_member = mysqli_query($koneksi, "UPDATE tb_member SET nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', tlp='$tlp' WHERE id_member='$id_member'");

if (!$update_member) {
    echo "Gagal memasukkan data obat: " . mysqli_error($koneksi);
} else {
    // Berhasil melakukan update
    echo "<script>alert('Data Member berhasil diubah');location.href='../admin/member.php'</script>";
    exit;
}
?>
