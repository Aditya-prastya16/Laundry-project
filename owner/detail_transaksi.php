<?php
require "../koneksi.php";
if (@$_GET['id_transaksi']) {
    $id_transaksi = $_GET['id_transaksi'];
}elseif($_SESSION['id_transaksi']){
    $id_transaksi = $_SESSION['id_transaksi'];
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
<div class="flex justify-center h-fit mt-[2%]">
    <div class="bg-white rounded-lg overflow-hidden shadow-md w-[50%]">
    <!-- card1 -->
        <div class="bg-[#F6FAFF] shadow-inner p-6">
            <h2 class="text-2xl font-bold mb-4">Detail Transaksi</h2>
            <div class="flex flex-row mt-[4%] space-x-10">
    <?php
    @$id_transaksi = $_GET['id_transaksi'];
    if (!$id_transaksi) {
        $queryTransaksi = "SELECT * FROM tb_transaksi ORDER BY id_transaksi DESC LIMIT 1";
    } else {
        $queryTransaksi = "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
    }
    $hasilTransaksi = mysqli_query($koneksi, $queryTransaksi);
    $rowTransaksi = mysqli_fetch_array($hasilTransaksi);

    $id_member = $rowTransaksi['id_member'];
    $queryMember = "SELECT nama,alamat,tlp FROM tb_member WHERE id_member = '$id_member'";
    $hasilMember = mysqli_query($koneksi, $queryMember);
    $rowMember = mysqli_fetch_array($hasilMember);

    $id_outlet = $rowTransaksi['id_outlet'];

    $id_user = $rowTransaksi['id_user'];
    $queryUser = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
    $hasilUser = mysqli_query($koneksi, $queryUser);
    $rowUser = mysqli_fetch_array($hasilUser);
    ?>


    <div class="w-1/3">
                    <p class="text-gray-700">
                        <p class="font-semibold text-[18px]">Kode Invoice</p>
                        <p><?= $rowTransaksi['kode_invoice'] ?></p>
                    </p>
                </div>

    <div class="w-1/3">
                    <p class="text-gray-700">
                        <p class="font-semibold text-[18px]">Nama Pelanggan</p>
                        <p><?= $rowMember['nama'] ?></p>
                    </p>
                </div>

    <div class="w-1/3">
                    <p class="text-gray-700">
                        <p class="font-semibold text-[18px]">No Telp</p>
                        <p><?= $rowMember['tlp'] ?></p>
                    </p>
                </div>
                </div>  

    <div class="flex flex-row mt-[4%] space-x-10">
                <div class="w-1/3">
                    <p class="text-gray-700">
                        <p class="font-semibold text-[18px]">Alamat</p>
                        <p><?= $rowMember['alamat'] ?></p>
                    </p>
                </div>

    <div class="w-1/3">
                    <p class="text-gray-700">
                        <p class="font-semibold text-[18px]">Nama Kasir</p>
                        <p><?= $rowUser['nama'] ?></p>
                    </p>
                </div>

    <div class="w-1/3">
                    <p class="text-gray-700">
                        <p class="font-semibold text-[18px]">Ambil Sebelum</p>
                        <p><?= $rowTransaksi['batas_waktu'] ?></p>
                    </p>
                </div>
            </div> 
    
            <div class="flex flex-row mt-[10%] space-x-10">
                <div class="flex flex-col items-center">
                    <div class="flex justify-between w-full space-x-10">
                     <a href="transaksi.php">
                     <button class="bg-[#E61700] hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                        Kembali
                      </button>
                     </a>
                    </div>
                  </div>
                  
            </div> 


        </div>
    </div>

        <div class="ml-8 bg-white rounded-lg overflow-hidden shadow-lg w-[40%] mb-[5%]">
        <!-- card2 -->
        <div class="bg-[#F6FAFF] shadow-inner p-6">
            <h2 class="text-2xl font-bold mb-4">Detail Paket</h2>
        <?php
        function rupiah($angka)
        {
            $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
        }

        $id_transaksi = $rowTransaksi['id_transaksi'];
        $queryDetailProduct = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = '$id_transaksi'";
        $dataDetailProduct = mysqli_query($koneksi, $queryDetailProduct);

        @$totalHarga += $rowTransaksi['biaya_tambahan'];

        while ($rowDetailProduct = mysqli_fetch_array($dataDetailProduct)) {
            $id_paket = $rowDetailProduct['id_paket'];
            $queryProduct = "SELECT * FROM tb_paket WHERE id_paket = '$id_paket'";
            $dataProduct = mysqli_query($koneksi, $queryProduct);
            $hasilProduct = mysqli_fetch_array($dataProduct);

            @$totalHargaPerItem = $rowDetailProduct['qty'] * $hasilProduct['harga'];
            @$totalHarga += $totalHargaPerItem;

            $total = @$totalHarga;
            if ($rowTransaksi['diskon'] > 0) {
                $diskon = $total * $rowTransaksi['diskon'] / 100;
                $total -= $diskon;
            }
            $pajak = $total * $rowTransaksi['pajak'];
            $total += $pajak;
        ?>

            <div class="bg-white flex flex-row rounded-lg justify-between items-center mb-2 shadow-lg">
                <div class="flex flex-col w-2/4 mx-[2%] my-[2%] ">
                    <div class="font-semibold text-[18px]"><?= @$hasilProduct['nama_paket'] ?></div>
                    <div>Harga : <?= rupiah(@$hasilProduct['harga']) ?></div>
                    <div>Qty : <?= @$rowDetailProduct['qty'] ?></div>
                    <div>Total : <?= rupiah(@$totalHargaPerItem) ?></div>
                </div>

                <div class="flex flex-col mx-10 w-2/4 space-y-3">
                <div>Jenis : <?= @$hasilProduct['jenis'] ?></div>
                <div class="text-[#08CB0F] font-semibold"> 
                    <span class="text-black">Note :</span> <?= @$rowDetailProduct['keterangan'] ?>
                </div>
              </div>

              <div class="mx-[4%]">
              <a href="../delete/delete_detail_transaksi.php?id_detail_transaksi=<?= @$rowDetailProduct['id_detail_transaksi'] ?>&id_transaksi=<?= $id_transaksi ?>"></a>              
                </div>

            </div>   

        <?php
        }
        if ($rowTransaksi['biaya_tambahan'] > 0) {
        ?>
         <div class="flex flex-col mt-[8%]">
                <div class="font-bold text-[22px] my-[2%]">Detail Harga</div>
                <div class="font-semibold text-[18px] flex justify-between">
                    <span>Biaya Tambahan :</span>
                    <span ><?= rupiah(@$rowTransaksi['biaya_tambahan']) ?> </span>
                </div>
        <?php
        }
        ?>
        <div class="font-semibold text-[18px] flex justify-between">
                    <span>Total Keseluruhan :</span>
                    <span ><?= rupiah(@$totalHarga) ?> </span>
                </div>
        <?php
        if ($rowTransaksi['diskon'] > 0) {
        ?>
                <div class="font-semibold text-[18px] flex justify-between">
                    <span>Diskon :</span>
                    <span ><?= $rowTransaksi['diskon'] ?>% </span>
                </div>
        <?php
        }
        ?>
        <div class="font-semibold text-[18px] flex justify-between">
                    <span>Tax :</span>
                    <span ><?= $rowTransaksi['pajak'] * 100 ?> </span>
        </div>

        <div class="border-b border-black my-4"></div>
                <div class="font-bold text-[22px] my-[2%] flex justify-between">
                    <span>Total :</span>
                    <span ><?= rupiah(round(@$total));?> </span>
                </div>
            </div>

<!-- <div class="flex flex-row space-x-2 my-[4%]">
                <a href="transaksi.php">
                <button class="bg-[#E61700] hover:bg-red-900 text-white font-bold py-2 px-4 rounded-lg">
                    Bayar Nanti
                </button>
                </a>
                <button data-modal-target="bayar-modal" data-modal-toggle="bayar-modal" class="bg-[#10AA56] hover:bg-green-900 text-white font-bold py-2 px-4 rounded-lg">
                    Bayar Sekarang
                </button>
            </div> -->
            
            
        
         </div>
    
    
    </div>
</div>

</body>
<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</html>