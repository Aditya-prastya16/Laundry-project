<?php
include "../function/functionpaket.php";


session_start();

if(!@$_SESSION['username']){
    header('Location:../auth/login.php');
}else if(@$_SESSION['role']=='kasir'){
    echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
}else if(@$_SESSION['role']=='owner'){
    echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
}
$paket = mysqli_query($koneksi, "SELECT tb_paket.id_paket as id_paket, tb_outlet.id_outlet as id_outlet ,nama,jenis,nama_paket,harga FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id_outlet ORDER BY tb_outlet.id_outlet");
$no = 1;

$keyword = $_GET["keyword"];


$query = "SELECT tb_paket.id_paket as id_paket, tb_outlet.id_outlet as id_outlet ,nama,jenis,nama_paket,harga FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id_outlet
          WHERE
          id_paket LIKE '%$keyword%' OR
          nama LIKE '%$keyword%' OR
          jenis LIKE '%$keyword%' OR
          nama_paket LIKE '%$keyword%' OR
          harga LIKE '%$keyword%'
   ";
$paket = query($query);
?>
      <div id="container">
        <table class="container table-auto border-collapse border-b border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Outlet</th>
                    <th class="px-4 py-2">Jenis Paket</th>
                    <th class="px-4 py-2">Nama Paket</th>
                    <th class="px-4 py-2">Harga</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach( $paket as $row ) :
            
        ?>
                <tr>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $no++ ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['nama'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['jenis'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['nama_paket'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['harga'] ?></th>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>