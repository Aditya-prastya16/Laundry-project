<?php
include "../function/functionoutlet.php";


session_start();

if(!@$_SESSION['username']){
    header('Location:../auth/login.php');
}else if(@$_SESSION['role']=='kasir'){
    echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
}else if(@$_SESSION['role']=='owner'){
    echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
}
$outlet = mysqli_query($koneksi, "SELECT * FROM tb_outlet ORDER BY id_outlet ASC");

$keyword = $_GET["keyword"];


$query = "SELECT * FROM tb_outlet
          where
          id_outlet like '%$keyword%' or
          nama like '%$keyword%' or
          alamat like '%$keyword%' or
          tlp like '%$keyword%' 
   ";
$outlet = query($query);
?>
        <div id="container">
            <table class="container table-auto border-collapse border-b border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Id Outlet</th>
                        <th class="px-4 py-2">Nama Outlet</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">No Telp</th>
                    </tr>
                </thead>
                <?php
                foreach( $outlet as $row ) :
            
        ?>
                <tbody>
                    <tr>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['id_outlet']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['nama']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['alamat']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['tlp']?></th>
                   
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>

        
