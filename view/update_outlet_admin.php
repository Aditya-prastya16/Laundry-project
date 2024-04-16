<?php
    include "../auth/function.php";
    require "../layout/navbar_admin.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='kasir'){
        echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='owner'){
        echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
    }
    $outlet = mysqli_query($koneksi, "SELECT * FROM tb_outlet ORDER BY id_outlet DESC");

    $id_outlet = $_GET['id_outlet'];

    $query_outlet = mysqli_query($koneksi, "SELECT * FROM tb_outlet WHERE id_outlet ='$id_outlet'");
    $outlet_row = mysqli_fetch_assoc($query_outlet);
?>
<?= template_header('Home') ?>

<div class="container mx-auto p-8">
    <h2 class="text-[28px] font-semibold pb-2 border-b-2 border-[#A5A5A5] mb-[5%]">Edit Data <?= $outlet_row['nama'] ?> </h2>
    <form action="../update/process_update_outlet_admin.php" method="post">
            <div> 
                <input type="text" hidden name="id_outlet" value="<?= $outlet_row['id_outlet'] ?>">
            </div>        
            <div class="flex mb-4">
                <label for="nama" class="w-1/5 text-left pr-4 pt-1" >Nama :</label>
                <input type="text" id="nama" name="nama" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300" value="<?= $outlet_row['nama'] ?>">
            </div>
            <div class="flex mb-4">
                <label for="alamat" class="w-1/5 text-left pr-4 pt-1">Alamat :</label>
                <textarea id="alamat" name="alamat" rows="4" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300" ><?= $outlet_row['alamat'] ?></textarea>
            </div>

            <div class="flex mb-4">
                <label for="tlp" class="w-1/5 text-left pr-4 pt-1">No Telp :</label>
                <input type="text" id="tlp" name="tlp" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300" value="<?= $outlet_row['tlp'] ?>">
            </div>
            
            <div class="flex justify-end my-[2%]">
            <a href="../admin/outlet.php">
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
