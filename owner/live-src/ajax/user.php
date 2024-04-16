<?php
include "../function/functionuser.php";


session_start();

if(!@$_SESSION['username']){
    header('Location:../auth/login.php');
}else if(@$_SESSION['role']=='kasir'){
    echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
}else if(@$_SESSION['role']=='owner'){
    echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
}
$user = mysqli_query($koneksi, "SELECT * FROM tb_user ORDER BY id_user ASC ");

$keyword = $_GET["keyword"];


$query = "SELECT * FROM tb_user
          where
          id_user like '%$keyword%' or
          nama like '%$keyword%' or
          username like '%$keyword%' or
          id_outlet like '%$keyword%' or
          role like '%$keyword%'  
   ";
$user = query($query);
?>
   <div id="container">
        <table class="container table-auto border-collapse border-b border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2">Id User</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Outlet</th>
                    <th class="px-4 py-2">Role</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach( $user as $row ) :
            
        ?>
                <tr>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['id_user'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['nama'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['username'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['id_outlet'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['role'] ?></th>
                   
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        
