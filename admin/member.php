<?php
    include "../auth/function.php";
    include "./live-src/function/functionmember.php";
    require "../layout/navbar_admin.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='kasir'){
        echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='owner'){
        echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
    }

    $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      
    // Jumlah data per halaman
    $limit = 5;
    $limitStart = ($page - 1) * $limit;

    $member = mysqli_query($koneksi, "SELECT * FROM tb_member ORDER BY id_member ASC LIMIT ".$limitStart.", ".$limit);
    $nomor = 1;
    $no = $limitStart + 1;

    if( isset($_POST["cari"]) ) {
        $member = cari($_POST["keyword"]);
    }
?>
<?= template_header('Home') ?>
<div class="container mx-auto p-4 mt-[2%]">
        <div class="flex  space-x-4">
        <a href="./word/member.php">
            <button class="bg-[#4073C4] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Word
            </button>
        </a>
        <a href="./excel/member.php">
            <button class="bg-[#10AA56] hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                Excel
            </button>
        </a>
        <a href="./pdf/member.php">
            <button class="bg-[#E61700] hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg">
                PDF
            </button>
        </a>
        </div>
    </div>

    
    <div class="container mx-auto p-4">
        <!-- Search and Add Data -->
        <p class="font-semibold text-[22px] mb-[1%]">Data Pelanggan </p>
        <div class="flex justify-between mb-4">
        <div class="relative flex">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <form  method="post">
            <input class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="search" placeholder="Cari Data Member" name="keyword" id="keyword">
        </form>
        </div>
            <a href="../view/add_member_admin.php" class="bg-[#53D258] hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                + Tambah Data
            </a >
        </div>

        <!-- Table -->
        <div class=" overflow-x-auto">
        <div id="container">
            <table class="container table-auto border-collapse border-b border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Jenis Kelamin</th>
                        <th class="px-4 py-2">No Telp</th>
                        <th class="px-4 py-2" >Aksi</th>
                    </tr>
                </thead>
                <?php
                foreach( $member as $row ) :
            
        ?>
                <tbody id="searchResults">
                    <tr>


                        <th class="border-t border-gray-300 px-4 py-2"><?=$nomor++?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['nama']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['alamat']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['jenis_kelamin']?></th>
                        <th class="border-t border-gray-300 px-4 py-2"><?=$row['tlp']?></th>
                        <th class="border-t border-gray-300 px-4 py-2">
                           <a href="../view/update_member_admin.php?id_member=<?= $row['id_member'] ?>">
                                <button href="" class="bg-[#2685CA] hover:bg-blue-700 text-white font-bold py-3 px-3 rounded-lg">
                                    <img src="../img/edit.png" alt="Edit" class="w-4 h-4">
                                </button>
                           </a>
                            <?php
  $id = $row['id_member'];
  $hide_delete = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_detail_transaksi WHERE id_detail_transaksi='$id' "));
  if ($hide_delete[0] == '0') {
                        ?>
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="bg-[#E61700] hover:bg-red-700 text-white font-bold py-3 px-3 rounded-lg ml-2" type="button">
                            <img src="../img/delete.png" alt="Delete" class="w-4 h-4">
                            </button>
                        <?php
                            } else {
                                echo "</th>";
                            }
                        ?>

                    </tr>
                    
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>

        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Anda Yakin Ingin Menghapus Data Ini?</h3>
                <a href="../delete/delete_member_admin.php?id_member=<?= $row['id_member'] ?>">
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Ya, Hapus
                </button>
                </a>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak, Batalkan</button>
            </div>
        </div>
    </div>
</div>






            <div class="flex justify-between mb-4 my-[2%]">
        <div class="relative flex">
        <nav aria-label="Page navigation example " >
  <ul class="flex items-center -space-x-px h-8 text-sm">

    <li>
    <?php
      if($page == 1){ 

?>
      <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Previous</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
      </a>
      <?php
      }
      else{ 
        $LinkPrev = ($page > 1)? $page - 1 : 1;
      ?>
    </li>

 <li>
      <a href="member.php?page=<?php echo $LinkPrev;?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Previous</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
      </a>
    </li>
<?php
        }
      ?>


<?php
      $SqlQuery = mysqli_query($koneksi, "SELECT * FROM tb_member");        
      
      //Hitung semua jumlah data yang berada pada tabel Sisawa
      $JumlahData = mysqli_num_rows($SqlQuery);
      
      // Hitung jumlah halaman yang tersedia
      $jumlahPage = ceil($JumlahData / $limit); 
      
      // Jumlah link number 
      $jumlahNumber = 1; 

      // Untuk awal link number
      $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
      
      // Untuk akhir link number
      $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
      
      for($i = $startNumber; $i <= $startNumber; $i++){
        $linkActive = ($page == $i)? ' class="active"' : '';
      ?>
    <li <?php echo $linkActive; ?>>
      <a href="member.php?page=<?php echo $page; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?php echo $page; ?></a>
    </li>
    <?php       
      if($page == $jumlahPage){ 
      ?>
      <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Next</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
      </a>
      <?php
      }
      else{
        $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
      ?>
    </li>
    <a href="member.php?page=<?php echo $linkNext; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Next</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
      </a>
    <?php
      }
      ?>
  </ul>
</nav>        
</div>
            <p>Page <?php echo $page; ?> of <?php echo $jumlahPage ?>
                </p>
        </div>
            
        <?php
        }
      ?>         

        </div>
        
    </div>
    <script src="./live-src/js/ajaxmember.js"></script>

    <?= template_footer() ?>