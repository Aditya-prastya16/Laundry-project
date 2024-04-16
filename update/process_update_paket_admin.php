<?php
include "../auth/function.php";

$id_paket = trim(mysqli_real_escape_string($koneksi, $_POST['id_paket']));
$id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
$jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
$nama_paket = mysqli_real_escape_string($koneksi, $_POST['nama_paket']);
$harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

$update_paket = mysqli_query($koneksi, "UPDATE tb_paket SET id_outlet='$id_outlet', jenis ='$jenis',nama_paket ='$nama_paket', harga = '$harga' WHERE id_paket='$id_paket'");

    if (!$update_paket) {
        echo "Gagal memasukkan data obat: " . mysqli_error($koneksi);
    } else {
        // Berhasil melakukan update
        echo "<script>alert('Data paket berhasil diubah ');location.href='../admin/paket.php'</script>";
        exit;
    }
?>








