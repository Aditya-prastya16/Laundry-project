<?php

require "../koneksi.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='admin'){
        echo "<script>alert('anda admin');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='kasir'){
        echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
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
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-language">
                </div>
            </div>
        </nav>
        <div class="relative">
            <div class="relative w-[95%] h-full  mx-8 my-2 rounded-xl">
                <p class="text-[#2F88FF] font-semibold text-[22px]">Hallo, <span class="text-[#414141]"><?=$_SESSION['username'] ?></span></p>
                <p class="text-[#414141] font-semibold">Anda Dapat Melihat Aktivitas Laundry Di Dashboard Ini</p>
            </div>
            <div class="container mx-auto my-10 flex justify-center">
                
                  <?php
        $sql = "SELECT * from tb_user";

        if ($result = mysqli_query($koneksi, $sql)) {

            // Return the number of rows in result set
            $rowcount = mysqli_num_rows($result);

            // Display result

        ?>
                <!-- Card 1 -->
                <div class="w-[20%] bg-white shadow-md rounded-lg mx-7 p-4">
                    <h2 class="text-lg font-bold mb-2">Data User </h2>
                    <p>Jumlah Data : <span class="font-semibold"><?php printf(" %d\n", $rowcount); ?></span></p>
                </div>
        <?php } ?>
        



        <?php
        $sql = "SELECT * from tb_outlet";

        if ($result = mysqli_query($koneksi, $sql)) {

            // Return the number of rows in result set
            $rowcount = mysqli_num_rows($result);

            // Display result

        ?>
                <!-- Card 2 -->
                <div class="w-[20%] bg-white shadow-md rounded-lg mx-7 p-4">
                    <h2 class="text-lg font-bold mb-2">Data Outlet </h2>
                    <p>Jumlah Data : <span class="font-semibold"><?php printf(" %d\n", $rowcount); ?></span></p>
                </div>
        <?php } ?>



        <?php
        $sql = "SELECT * from tb_transaksi";

        if ($result = mysqli_query($koneksi, $sql)) {

            // Return the number of rows in result set
            $rowcount = mysqli_num_rows($result);

            // Display result

        ?>
                <!-- Card 3 -->
                <div class="w-[20%] bg-white shadow-md rounded-lg mx-7 p-4">
                    <h2 class="text-lg font-bold mb-2">Data Transaksi </h2>
                    <p>Jumlah Data : <span class="font-semibold"><?php printf(" %d\n", $rowcount); ?></span></p>
                </div>
        <?php } ?>




        <?php
// Query SQL untuk menghitung jumlah transaksi
$sql = "SELECT SUM(total_harga) AS total_transaksi FROM tb_detail_transaksi";

// Eksekusi query
$result = mysqli_query($koneksi, $sql);

// Periksa apakah query berhasil dieksekusi
if($result) {
    // Ambil nilai jumlah transaksi dari hasil query
    $row = mysqli_fetch_assoc($result);
    $total_transaksi = $row['total_transaksi'];
} else {
    // Jika query gagal dieksekusi, atur total transaksi menjadi 0
    $total_transaksi = 0;
}

        ?>
                <!-- Card 4 -->
                <div class="w-[20%] bg-white shadow-md rounded-lg mx-7 p-4">
                    <h2 class="text-lg font-bold mb-2">Jumlah Transaksi </h2>
                    <p class="font-semibold">Rp. <?= number_format($total_transaksi, 0, ',', '.'); ?></span></p>                </div>

               
            </div>
            <div class="relative w-[95%] h-full  mx-8 my-2 rounded-xl">
                <p class="font-semibold text-[20px]">Data E-Laundry</p>
            </div>
                <div class="relative w-[95%] h-full  mx-8 bg-white  rounded-xl">
                    <div class="flex-col text-[28px] font-bold ml-6 mt-3 ">
                        <!-- chart here -->
                        <div class="relative">
    <!-- Other content -->
    <div class="absolute  w-[100%] h-[20%]">
        <canvas id="myChart" width="500" height="100"></canvas>
    </div>
    <!-- Other content -->
</div>

        <?php

$sql1 = "SELECT * from tb_member";

if ($result1 = mysqli_query($koneksi, $sql1)) {

    $rowcount1 = mysqli_num_rows($result1);



$sql2 = "SELECT * from tb_outlet";

if ($result2 = mysqli_query($koneksi, $sql2)) {

$rowcount2 = mysqli_num_rows($result2);



$sql3 = "SELECT * from tb_user";

if ($result3 = mysqli_query($koneksi, $sql3)) {

    $rowcount3 = mysqli_num_rows($result3);


    $sql4 = "SELECT * from tb_paket";

    if ($result4 = mysqli_query($koneksi, $sql4)) {

        $rowcount4 = mysqli_num_rows($result4);



        $sql5 = "SELECT * from tb_transaksi";

        if ($result5 = mysqli_query($koneksi, $sql5)) {

            // Return the number of rows in result set
            $rowcount5 = mysqli_num_rows($result5);

?>


                  
<script>
                                const labels = [
                                    'Data Member ',
                                    'Data Outlet',
                                    'Data Paket',
                                    'Data User',
                                    'Data Transaksi',

                                ];
                                const data = {
                                    labels: labels,
                                    datasets: [{
                                        label: 'E-Laundry Chart ',
                                        backgroundColor: [

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
                                        data: [<?php printf(" %d\n", $rowcount1);  ?>,
                                            <?php printf(" %d\n", $rowcount2);  ?>,
                                            <?php printf(" %d\n", $rowcount3);  ?>,
                                            <?php printf(" %d\n", $rowcount4);  ?>,
                                            <?php printf(" %d\n", $rowcount5);  ?>
                                        ],
                                    }]
                                };



                                const config = {
                                    type: 'bar',
                                    data: data,
                                    options: {}
                                };

                                const myChart = new Chart(
                                    document.getElementById('myChart'),
                                    config
                                );
                            </script>
<?php }
                    }
                }
            }
        } ?>
                    </div>                   
                </div>          
        </div>

    </div>
    <div class="mx-[1%] my-5 w-fit h-fit">
        <img src="../img/sidebarlogo.png" alt="">
    </div>

    <aside class="flex mx-10 mt-[5%] w-fit h-fit bg-white rounded-lg "> 
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
<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</html>