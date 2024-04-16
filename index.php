<?php
    include "./auth/function.php";
    
    $outlet = mysqli_query($koneksi, "SELECT * FROM tb_outlet ORDER BY id_outlet ASC");

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
</head>
<body>
<nav class="py-4">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <a href="#" class="text-3xl font-semibold">E-Laundry</a>
        </div>
        <div>
            <ul class="flex space-x-8 items-center justify-evenly ">
                <li><a href="#home" class="text-[#414141] text-lg hover:text-[#237ED9]">Beranda</a></li>
                <li><a href="#paket" class="text-[#414141] text-lg hover:text-[#237ED9]">Daftar Harga</a></li>
                <li><a href="#cabang" class="text-[#414141] text-lg hover:text-[#237ED9]">Cabang</a></li>
                <li><a href="#contact" class="text-[#414141] text-lg hover:text-[#237ED9]">Kontak</a></li>
                <li>
                    <a href="./auth/login.php" class="rounded-2xl bg-[#237ED9] py-[7%] px-10 text-white hover:bg-blue-500 ">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="home" class="grid grid-cols-2  mt-7 mb-[10%]">
  <div class="text-left flex flex-col items-left justify-center ml-32">
    <div class="text-[22px] font-semibold text-[#237ED9] mx-7 my-3">Cuci Cepat, Hemat Waktu! </div>
    <div class="text-[34px] font-bold mx-7 my-">Hallo, Selamat Datang Di  </div>
    <div class="text-[34px] font-bold mx-7 ">E-Laundry </div>
    <div class="text-[18px] font-semibold mx-7 my-5">Bersihkan Pakaian Bersihkan Hati </div>
    <div class="my-6">
    <a href="#paket" class="rounded-2xl bg-[#237ED9] py-3 px-10 mx-6 font-semibold text-white hover:bg-blue-700 ">Daftar Harga</a>
    <a href="#cabang" class="rounded-2xl border-2 border-[#414141] py-3 px-10 font-semibold hover:bg-blue-500 hover:border-[#237ED9] hover:text-white">Cabang</a></div>
    </div>
  <div class=" w-fit h-fit text-center flex items-center justify-center">
    <img src="./img/Indeximg.png" class="w-100% mr-36" alt="" srcset="">
  </div>
</div>



<div id="paket" class="flex flex-wrap justify-center space-x-12 mb-[10%]">
    <div class="text-center justify-center w-full mb-10">
        <p class="font-bold text-[42px]">Rekomendasi Buat Kamu</p>
    </div>
    <!-- Card 1 -->
    <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
        <img class="w-full h-full" src="./img/card1.png" alt="">
    </div>

    <!-- Card 2 -->
    <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
        <img class="w-full h-full" src="./img/card2.png" alt="">
    </div>

    <!-- Card 3 -->
    <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
        <img class="w-full h-full" src="./img/card3.png" alt="">
    </div>

    <!-- Card 4 -->
    <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
        <img class="w-full h-full" src="./img/Card4.png" alt="">
    </div>

    <!-- Card 5 -->
    <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
        <img class="w-full h-full" src="./img/card5.png" alt="">
    </div> 
</div>



<div id="cabang" class="flex flex-col justify-center items-center h-full mb-[10%]">
  <p class="font-bold text-3xl mb-10">Daftar Cabang Kami</p>
  <div class="border-2 border-black rounded-lg">
    <table class="min-w-fit divide-y mx-20 divide-gray-200">
      <thead >
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-[16px] font-semibold  uppercase tracking-wider">
            No
          </th>
          <th scope="col" class="px-6 py-3 text-left text-[16px] font-semibold  uppercase tracking-wider">
            Cabang
          </th>
          <th scope="col" class="px-6 py-3 text-left text-[16px] font-semibold  uppercase tracking-wider">
            Nama Cabang
          </th>
          <th scope="col" class="px-6 py-3 text-left text-[16px] font-semibold  uppercase tracking-wider">
            Alamat
          </th>
          <th scope="col" class="px-6 py-3 text-left text-[16px] font-semibold  uppercase tracking-wider">
            Kontak
          </th>
        </tr>
      </thead>
      <?php
      $no=1;
      while($row = mysqli_fetch_assoc($outlet)){
      ?>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="text-sm font-medium text-gray-900">
                <?=$no++?>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">Cabang <?=$no++?></div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900"><?=$row['nama']?></div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="text-sm text-gray-900"><?=$row['alamat']?></span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="text-sm text-gray-900"><?=$row['tlp']?></span>
          </td>
        </tr>
      </tbody>
      <?php
      }
      ?>
    </table>
  </div>
</div>



<div id="contact" class="grid grid-cols-2  mt-7">
<div class=" w-fit h-fit text-center flex items-center justify-center">
    <img src="./img/contact.png" class="w-100% ml-36" alt="" srcset="">
  </div>
  <div class="text-left flex flex-col items-left justify-center ml-32">
    <div class="text-[44px] font-bold mx-7 my-3 text-[#237ED9]">Hubungi Kami  </div>
    <div class="text-[16px] mx-7 ">Kami siap melayani keluhan anda !</div>
    <div class="text-[16px] mx-7 ">Silakan Hubungi kami dengan menggunakan berbagai</div>
    <div class="text-[16px] mx-7 ">platform media sosial di bawah ini.</div>
    <div class="my-6 flex flex-row space-x-4">
      <a href="">
        <img src="./img/whatsapp.png" alt="" srcset="">
      </a>
      <a href="">
        <img src="./img/telephone.png" alt="" srcset="">
      </a>
      <a href="">
        <img src="./img/email.png" alt="" srcset="">
      </a>
      <a href="">
        <img src="./img/instagram.png" alt="" srcset="">
      </a>
      <a href="">
        <img src="./img/facebook.png" alt="" srcset="">
      </a>
    </div>

</div>




<script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
</script>

</body>
</html>