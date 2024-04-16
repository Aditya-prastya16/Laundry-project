<?php
include "../auth/function.php";

$id_transaksi = $_POST['id_transaksi'];
$status = $_POST['status'];
@$page = $_POST['page'];

    $updatedata = "UPDATE tb_transaksi SET status='$status' WHERE id_transaksi='$id_transaksi'";
    $queryupdate = mysqli_query($koneksi, $updatedata);

if (!$queryupdate) {
    echo "Gagal merubah status: " . mysqli_error($koneksi);
} else {
    // Berhasil melakukan update
    echo "<script>location.href='../admin/transaksi.php'</script>";
    exit;
}

?>