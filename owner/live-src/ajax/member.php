<?php
include "../function/functionmember.php";


session_start();

if(!@$_SESSION['username']){
    header('Location:../auth/login.php');
}else if(@$_SESSION['role']=='kasir'){
    echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
}else if(@$_SESSION['role']=='owner'){
    echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
}
$member = mysqli_query($koneksi, "SELECT * FROM tb_member ORDER BY id_member ASC");

$keyword = $_GET["keyword"];


$query = "SELECT * FROM tb_member
          where
          id_member like '%$keyword%' or
          nama like '%$keyword%' or
          alamat like '%$keyword%' or
          jenis_kelamin like '%$keyword%' or
          tlp like '%$keyword%' 
   ";
$member = query($query);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/Project-uk/src/output.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
    <div id="container">
            <table class="container table-auto border-collapse border-b border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Id member</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Jenis Kelamin</th>
                        <th class="px-4 py-2">No Telp</th>
                    </tr>
                </thead>
                <?php
                foreach( $member as $row ) :
            
        ?>
                <tbody id="searchResults">
                    <tr>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['id_member']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['nama']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['alamat']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['jenis_kelamin']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['tlp']?></th>
                    </tr>
                    
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>

    </body>
    <script src="/Project-uk/node_modules/flowbite/dist/flowbite.min.js"></script>
</html>












