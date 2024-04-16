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
    $peket = mysqli_query($koneksi, "SELECT * FROM tb_paket ORDER BY id_paket DESC");

    $id_paket = $_GET['id_paket'];

    $query_paket = mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE id_paket ='$id_paket'");
    $paket_row = mysqli_fetch_assoc($query_paket);
?>
<?= template_header('Home') ?>

<div class="container mx-auto p-8">
    <h2 class="text-[28px] font-semibold pb-2 border-b-2 border-[#A5A5A5] mb-[5%]">Edit Data Paket <?= $paket_row['nama_paket'] ?></h2>
    <form action="../update/process_update_paket_admin.php" method="post">
    <div class="flex mb-4">
    <div> 
                <input type="text" hidden name="id_paket" value="<?= $paket_row['id_paket'] ?>">
            </div> 
                <label for="id_outlet" class="w-1/5 text-left pr-4 pt-1">Nama Outlet :</label>
                <select name="id_outlet" id="id_outlet" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
                <?php
    $query = "SELECT * FROM tb_outlet";
    $data = mysqli_query($koneksi, $query);
    $cek = mysqli_num_rows($data);
    while ($row = mysqli_fetch_assoc($data)) {
        ?>
        <option value="<?= $row['id_outlet']; ?>" <?php if ($row['id_outlet'] == $paket_row['id_outlet']) echo "selected"; ?>>
            <?= $row['nama']; ?>
        </option>
        <?php
    }
    ?>
            <?= $paket_row['nama']; ?>
                </select>
            </div>
            <div class="flex mb-4">
                <label for="jenis" class="w-1/5 text-left pr-4 pt-1">Jenis :</label>
                <select name="jenis" id="jenis" class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
                    <option value="<?= $paket_row['jenis'] ?>"><?= $paket_row['jenis']; ?></option>
                    <option value="kiloan">Kiloan</option>'
                    <option value="selimut">Selimut</option>
                    <option value="bed_cover">Bed cover</option>
                    <option value="kaos">Kaos</option>
                    <option value="lain">lain</option>             
                </select>
            </div>
            <div class="flex mb-4">
                <label for="nama_paket" class="w-1/5 text-left pr-4 pt-1" >Nama Paket :</label>
                <input type="text" id="nama_paket" name="nama_paket" value="<?= $paket_row['nama_paket'] ?>" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
            <div class="flex mb-4">
                <label for="harga" class="w-1/5 text-left pr-4 pt-1" >Harga Paket :</label>
                <input type="text" id="harga" name="harga" value="<?= $paket_row['harga'] ?>" required class="w-3/4 px-3 py-2 border rounded-xl border-gray-300">
            </div>
      
            <div class="flex justify-end my-[2%]">
            <a href="../admin/paket.php">
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
