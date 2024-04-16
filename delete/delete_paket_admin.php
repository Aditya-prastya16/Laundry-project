<?php
   include "../auth/function.php";
   $id_paket = $_GET['id_paket'];

   $query = mysqli_query($koneksi, "DELETE FROM tb_paket WHERE id_paket='$id_paket'");

   if(!$query){
        echo "Gagal Menghapus Data Outlet" . mysqli_error($koneksi);
   }else{
    echo "<script>location.href='../admin/paket.php'</script>";
        exit;
   }
?>