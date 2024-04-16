<?php
    include "../auth/function.php";

    $id_paket = mysqli_real_escape_string($koneksi, $_POST['id_paket']);
    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $nama_paket = mysqli_real_escape_string($koneksi, $_POST['nama_paket']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    

    $add_paket = mysqli_query($koneksi, "INSERT INTO tb_paket VALUES(0, '$id_outlet', '$jenis', '$nama_paket', '$harga')");

    if(!$add_paket){
        echo "Gagal memasukkan data obat" . mysqli_error($koneksi);
    }else{
       echo "<script>location.href='../admin/paket.php'</script>";
        exit;
    }
?>