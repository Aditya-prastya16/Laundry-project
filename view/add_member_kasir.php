<?php
    include "../auth/function.php";
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



    <div class="container mx-auto p-8">
    <h2 class="text-[28px] font-semibold pb-2 border-b-2 border-[#A5A5A5] mb-[5%]">Tambah Data Pelanggan</h2>
    <form action="../create/process_add_member_kasir.php" method="post">
            <div class="flex mb-4">
                <label for="nama" class="w-1/5 text-left pr-4 pt-1" >Nama :</label>
                <input type="text" id="nama" name="nama" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
            <div class="flex mb-4">
                <label for="alamat" class="w-1/5 text-left pr-4 pt-1">Alamat :</label>
                <textarea id="alamat" name="alamat" rows="4" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300"></textarea>
            </div>
            <div class="flex mb-4">
                <label for="jenis_kelamin" class="w-1/5 text-left pr-4 pt-1">Jenis Kelamin :</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
                    <option disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="L">Laki Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="flex mb-4">
                <label for="tlp" class="w-1/5 text-left pr-4 pt-1">No Telp :</label>
                <input type="text" id="tlp" name="tlp" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
            
            <div class="flex justify-end my-[2%]">
            <a href="../kasir/member.php">
                <button type="button" class="inline-flex justify-center py-2 px-10 border border-transparent shadow-sm text-sm  rounded-xl text-white bg-[#E61700] font-semibold hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                    Kembali
                </button>
            </a>
                <button type="submit" class="inline-flex justify-center py-2 px-10 mx-5 border border-transparent shadow-sm text-sm  rounded-xl text-white bg-[#53D258] font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= template_footer() ?>