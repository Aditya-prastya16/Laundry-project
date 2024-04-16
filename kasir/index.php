<?php

require "../layout/navbar_kasir.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='admin'){
        echo "<script>alert('anda admin');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='owner'){
        echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
    }
?>
<?= template_header('Home') ?>


<div id="contact" class="grid grid-cols-2  mt-7">
<div class=" w-fit h-fit text-center flex items-center justify-center">
    <img src="../img/kasir.png" class="w-100% ml-36" alt="" srcset="">
  </div>
  <div class="text-left flex flex-col items-left justify-center ml-5">
    <div class="text-[44px] font-bold  text-[#237ED9]">Hallo,  </div>
    <div class="text-[44px] font-bold  text-[#414141]">Selamat Datang <?php echo $_SESSION['username']; ?>  </div>
    <div class="text-[44px] font-bold  text-[#414141]">Dan Selamat Beraktivitas  </div>
    <div class="text-[16px] ">Jangan Lupa Untuk Tetap Menjaga Kesehatan</div>
    <div class="my-6 flex flex-row space-x-4">
    </div>

</div>

    <?= template_footer() ?>