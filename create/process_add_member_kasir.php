<?php
    include "../auth/function.php";

    $id_member = mysqli_real_escape_string($koneksi, $_POST['id_member']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);
    

    $add_member = mysqli_query($koneksi, "INSERT INTO tb_member VALUES(0, '$nama', '$alamat', '$jenis_kelamin', '$tlp')");

    if(!$add_member){
        echo "Gagal memasukkan data obat" . mysqli_error($koneksi);
    }else{
       echo "<script>location.href='../kasir/member.php'</script>";
        exit;
    }
?>