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
                    <th class="px-4 py-2" >Aksi</th>
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
                    <th class="border-t border-gray-300 px-4 py-2">
                        <a href="../view/update_paket_admin.php?id_paket=<?= $row['id_paket'] ?>">
                            <button class="bg-[#2685CA] hover:bg-blue-700 text-white font-bold py-3 px-3 rounded-lg">
                                <img src="../img/edit.png" alt="Edit" class="w-4 h-4">
                            </button>
                        </a> 
                        <?php
  $id = $row['id_paket'];
  $hide_delete = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_detail_transaksi WHERE id_paket='$id' "));
  if ($hide_delete[0] == '0') {
                        ?>
<a href="../delete/delete_paket_admin.php?id_paket=<?= $row['id_paket'] ?>" onclick="return confirm('Anda yakin ingin menghapus Data ini?')">
    <button class="bg-[#E61700] hover:bg-red-700 text-white font-bold py-3 px-3 rounded-lg ml-2" type="button">
        <img src="/Project-uk/img/delete.png" alt="Delete" class="w-4 h-4">
    </button>
</a>

                        <?php
                            } else {
                                echo "</th>";
                            }
                        ?>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>