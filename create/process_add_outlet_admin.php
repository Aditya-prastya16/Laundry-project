<?php
    include "../auth/function.php";

    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);
    

    $add_outlet = mysqli_query($koneksi, "INSERT INTO tb_outlet VALUES(0, '$nama', '$alamat', '$tlp')");

    if(!$add_outlet){
        echo "Gagal memasukkan data obat" . mysqli_error($koneksi);
    }else{
       echo "<script>location.href='../admin/outlet.php'</script>";
        exit;
    }
?>