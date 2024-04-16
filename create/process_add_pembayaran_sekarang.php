<?php
    include "../auth/function.php";

extract($_POST);
$id_transaksi = trim(mysqli_real_escape_string($koneksi, $_POST['id_transaksi']));

if($bayar < $totalBayar){
    echo "<script>
    alert('Jumlah Bayar tidak boleh kurang');
    window.location='../admin/transaksi.php?id_transaksi=$id_transaksi';
    </script>";
}

date_default_timezone_set('Asia/Makassar');
$todayDate = new DateTime();
$tglBayar = $todayDate->format('Y-m-d H:i:s');

$statusBayar = "dibayar";

$kembalian = $bayar - $totalBayar;

$updateTransaksi = "UPDATE tb_transaksi SET dibayar='$statusBayar',tgl_bayar='$tglBayar' WHERE id_transaksi='$id_transaksi'";
$queryUpdate = mysqli_query($koneksi,$updateTransaksi);
if($queryUpdate){
echo "<script>
    alert('Kembalian : $kembalian');
    window.location='../admin/transaksi.php';
    </script>";
} else {
    echo "Gagal mengedit data transaksi: " . mysqli_error($koneksi);
}

?>