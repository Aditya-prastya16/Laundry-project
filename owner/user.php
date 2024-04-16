<?php

include "./live-src/function/functionuser.php";
require "../koneksi.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='admin'){
        echo "<script>alert('anda admin');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='kasir'){
        echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
    }
    $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      
    // Jumlah data per halaman
    $limit = 5;
    $limitStart = ($page - 1) * $limit;

    $user = mysqli_query($koneksi, "SELECT * FROM tb_user INNER JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id_outlet ORDER BY id_user ASC LIMIT ".$limitStart.", ".$limit);
    $nomor = 1;
    $no = $limitStart + 1;

    if( isset($_POST["cari"]) ) {
        $user = cari($_POST["keyword"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../src/output.css" rel="stylesheet">
    
</head>
<script src="../node_modules/chart.js/dist/chart.umd.js"></script>

<body>
<div class="absolute bg-[#F1F7FD] w-[90%] h-[100%] top-0 left-0 ml-32 rounded-lg ">
        <nav class="dark:bg-gray-900 mx-5 mb-4 w-[95%] h-fit">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Laundry</span>
                </a>
                <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
                    <button type="button"  class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        <img src="../img/user.png" alt="" class="mx-2" srcset="">
                        <p class="font-semibold text-base "><?= $_SESSION['username'] ?></p>
                    </button>
                    
                    <button data-collapse-toggle="navbar-language" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-language" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>

            </div>
        </nav>
        <div class="relative">

            <div class="container mx-auto my-10 flex justify-center">


            <?php
// Assuming $koneksi is your database connection
$sql = "SELECT id_outlet, COUNT(id_user) AS total_user
        FROM tb_user
        GROUP BY id_outlet
        ORDER BY total_user DESC";
$result = mysqli_query($koneksi, $sql);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = "Outlet " . $row['id_outlet'];
    $data[] = $row['total_user'];
}
?>
            
                <!-- Card 1 -->
                <div class="w-[45%] h-fit bg-white shadow-md rounded-lg mx-7 p-4">
                    <h2 class="text-lg font-bold mb-2">Bar Chart</h2>
                    <div class="relative">
                        <canvas id="usersPerOutletChart1" width="500" height="130"></canvas>
                    </div>
                </div>                  
        
 <!-- Card 2 -->
<div class="w-[45%] h-fit bg-white shadow-md rounded-lg mx-7 p-4">
    <h2 class="text-lg font-bold mb-2">Line Chart</h2>
    <div class="relative">
        <canvas id="usersPerOutletChart2" width="500" height="150"></canvas>
    </div>
</div>

<script>
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($data); ?>;

    // Configuration for the first chart
    const config1 = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'User per Outlet',
                data: data,
                backgroundColor: [
                    'rgba(290, 99, 132, 0.2)',
                    'rgba(100, 162, 235, 0.2)',
                    'rgba(300, 206, 86, 0.2)',
                    'rgba(175, 192, 192, 0.2)',
                    'rgba(253, 102, 255, 0.2)',
                    'rgba(355, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,

                // Other chart options...
            }]
        },
        // Other chart options...
    };

    // Configuration for the second chart
    const config2 = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'User per Outlet',
                data: data,
                backgroundColor: [
                    'rgba(290, 99, 132, 0.2)',
                    'rgba(100, 162, 235, 0.2)',
                    'rgba(300, 206, 86, 0.2)',
                    'rgba(175, 192, 192, 0.2)',
                    'rgba(253, 102, 255, 0.2)',
                    'rgba(355, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,

                // Other chart options...
            }]
        },
        // Other chart options...
    };

    // Initialize the first chart
    const myBarChart = new Chart(
        document.getElementById('usersPerOutletChart1'),
        config1
    );

    // Initialize the second chart
    const myLineChart = new Chart(
        document.getElementById('usersPerOutletChart2'),
        config2
    );
</script>


        
        </div>


            <div class="container mx-5 p-4 mt-[2%]">
        <div class="flex  space-x-4">
        <a href="./word/user.php">
            <button class="bg-[#4073C4] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Word
            </button>
        </a>
        <a href="./excel/user.php">
            <button class="bg-[#10AA56] hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                Excel
            </button>
        </a>
        <a href="./pdf/user.php">
            <button class="bg-[#E61700] hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg">
                PDF
            </button>
        </a>
        </div>
    </div>
    <div class="relative w-[95%] h-full mx-8 my-2 rounded-xl flex items-center justify-between">
    <!-- Logo -->
    <div class="flex items-center">
        <p class="font-semibold text-[20px]">Data User</p>
    </div>

    <!-- Search -->
    <div class="relative">
        <form method="post">
            <div class="absolute inset-y-0 left-4 flex items-center pr-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input class="block w-48 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="search" placeholder="Cari Data User" name="keyword" id="keyword">
        </form>
    </div>
</div>

</div>
<div class="relative w-[95%] h-fit  mb-[4%] mx-8 bg-white  rounded-xl">
    <div class="flex-col ml-6 mt-3 ">
    <div id="container">
    <table class="container table-auto border-collapse border-b border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2">No</th>
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
                    <th class="border-t border-gray-300 px-4 py-2"><?= $nomor++ ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['nama'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['username'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['id_outlet'] ?></th>
                    <th class="border-t border-gray-300 px-4 py-2"><?= $row['role'] ?></th>
                    </tr>
                    
                </tbody>
                <?php endforeach; ?>
            </table>
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
      <a href="user.php?page=<?php echo $LinkPrev;?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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
      $SqlQuery = mysqli_query($koneksi, "SELECT * FROM tb_user");        
      
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
      <a href="user.php?page=<?php echo $page; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?php echo $page; ?></a>
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
    <a href="user.php?page=<?php echo $linkNext; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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

                  
            </div>

    </div>
    <div class="mx-[1%] my-5 w-fit h-fit">
        <img src="../img/sidebarlogo.png" alt="">
    </div>

    <aside class="flex mx-10 mt-[5%]  w-fit h-fit bg-white rounded-lg "> 
        <div >
            <ul>
                <li class="flex">
                    <a href="../owner/index.php">
                    <img src="../img/sidebar1.png" alt="" class="p-3">
                    </a>
                </li>
                <li class="flex mt-5 ">
                    <a href="../owner/member.php">
                    <img src="../img/sidebar2.png" alt="" class="p-3">
                    </a>
                </li>
                <li class="mt-5 flex ">
                <a href="../owner/outlet.php">
                    <img src="../img/sidebar3.png" alt="" class="p-3">
                </a>
                </li>
                </li>
                <li class="mt-5 flex ">
                <a href="../owner/user.php">
                    <img src="../img/sidebar4.png" alt="" class="p-3">
                </a>
                </li>
                <li class="mt-5 flex ">
                <a href="../owner/paket.php">
                    <img src="../img/sidebar5.png" alt="" class="p-3">
                </a>
                </li>
                <li class="mt-5 flex ">
                <a href="../owner/transaksi.php">
                    <img src="../img/sidebar6.png" alt="" class="p-3">
                </a>
                </li>
                <li class="mt-5 flex ">
                    <a href="../auth/logout.php">
                    <img src="../img/sidebar7.png" alt="" class="p-3">
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    

</body>
<script src="./live-src/js/ajaxuser.js"></script>
<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</html>