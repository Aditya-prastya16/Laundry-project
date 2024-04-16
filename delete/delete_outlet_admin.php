<?php
   include "../auth/function.php";
   $id_outlet = $_GET['id_outlet'];

   $query = mysqli_query($koneksi, "DELETE FROM tb_outlet WHERE id_outlet='$id_outlet'");

   if(!$query){
        echo "Gagal Menghapus Data Outlet" . mysqli_error($koneksi);
   }else{
    echo "<script>alert('Data outlet berhasil dihapus');location.href='../admin/outlet.php'</script>";
        exit;
   }
?>