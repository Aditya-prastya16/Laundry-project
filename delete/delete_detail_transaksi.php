<?php
   include "../auth/function.php";

$idDetail = $_GET["id_detail_transaksi"];
$idTransaksi = $_GET["id_transaksi"];

$query = "DELETE FROM tb_detail_transaksi WHERE id_detail_transaksi='$idDetail' ";
$hasil_query = mysqli_query($koneksi, $query);


if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>window.location='../admin/detail_transaksi.php?id_transaksi=$idTransaksi';</script>";
}