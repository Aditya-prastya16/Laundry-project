<?php
   include "../auth/function.php";
   $id_user = $_GET['id_user'];

   $query = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user='$id_user'");

   if(!$query){
        echo "Gagal Menghapus Data user" . mysqli_error($koneksi);
   }else{
     echo "<script>alert('Data user berhasil dihapus');location.href='../admin/user.php'</script>";
     exit;
   }
?>