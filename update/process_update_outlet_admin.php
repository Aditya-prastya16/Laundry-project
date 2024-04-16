<?php
include "../auth/function.php";

$id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);

$update_outlet = mysqli_query($koneksi, "UPDATE tb_outlet SET nama='$nama', alamat='$alamat', tlp='$tlp' WHERE id_outlet='$id_outlet'");

if (!$update_outlet) {
    echo "Gagal memasukkan data obat: " . mysqli_error($koneksi);
} else {
    // Berhasil melakukan update
    echo "<script>alert('Data outlet berhasil diubah ');location.href='../admin/outlet.php'</script>";
    exit;
}
?>
