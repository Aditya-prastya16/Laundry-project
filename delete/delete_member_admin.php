<?php
   include "../auth/function.php";
   $id_member = $_GET['id_member'];

   $query = mysqli_query($koneksi, "DELETE FROM tb_member WHERE id_member='$id_member'");

   if(!$query){
        echo "Gagal Menghapus Data Member" . mysqli_error($koneksi);
   }else{
    echo "<script>alert('Data Member berhasil dihapus');location.href='../admin/member.php'</script>";
        exit;
   }
?>