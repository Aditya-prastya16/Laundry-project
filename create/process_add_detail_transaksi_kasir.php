<?php
include "../auth/function.php";




    extract($_POST);

    if($biaya > 0){
        $queryBiaya = "SELECT biaya_tambahan FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
        $hasilBiaya = mysqli_query($koneksi, $queryBiaya);
        $dataBiaya = mysqli_fetch_array($hasilBiaya);
        
        $lastBiaya = $dataBiaya['biaya_tambahan'];

        // Jika ada data di database maka update jumlah biaya
        
        $biaya += $lastBiaya;
        $updateBiaya = "UPDATE tb_transaksi SET biaya_tambahan = '$biaya' WHERE id_transaksi = '$id_transaksi'";
        $hasilUpdate = mysqli_query($koneksi, $updateBiaya);
    }

    $queryPaket = "SELECT * FROM tb_paket WHERE id_paket = '$id_paket'";
    $hasilPaket = mysqli_query($koneksi,$queryPaket);
    $rowPaket = mysqli_fetch_array($hasilPaket);
    
    $harga = $rowPaket['harga'];
    $totalHarga = $qty * $harga;

    $query = "INSERT INTO tb_detail_transaksi (id_transaksi,id_paket,qty,keterangan,harga_paket,total_harga) values ('$id_transaksi','$id_paket','$qty','$keterangan','$harga','$totalHarga')";
    $hasil = mysqli_query($koneksi, $query);

    if (!$hasil && !$hasilUpdate) {
        die("QUERY FAILED TO EXECUTE:".mysqli_errno($koneksi)."-". mysqli_error($koneksi));
    }else{
    echo"<script>window.location='../kasir/detail_transaksi.php?id_transaksi=$id_transaksi';</script>";
}
    
?>











