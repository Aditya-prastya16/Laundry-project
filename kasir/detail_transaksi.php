<?php
    include "../auth/function.php";
    require "../layout/navbar_kasir.php";
    if (@$_GET['id_transaksi']) {
        $id_transaksi = $_GET['id_transaksi'];
    }elseif($_SESSION['id_transaksi']){
        $id_transaksi = $_SESSION['id_transaksi'];
    }
?>
<?= template_header('Home') ?>
<div class="flex justify-center  mt-[2%]">
    <div class="bg-white rounded-lg overflow-hidden shadow-md h-fit w-[50%]">
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
                      <button data-modal-target="paket-modal" data-modal-toggle="paket-modal" class="bg-[#2E3192] hover:bg-blue-950 text-white font-bold py-2 px-4 rounded-lg">
                        Tambah Paket
                      </button>
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
              <a href="../delete/delete_detail_transaksi.php?id_detail_transaksi=<?= @$rowDetailProduct['id_detail_transaksi'] ?>&id_transaksi=<?= $id_transaksi ?>">x</a>              
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

<div class="flex flex-row space-x-2 my-[4%]">
                <a href="transaksi.php">
                <button class="bg-[#E61700] hover:bg-red-900 text-white font-bold py-2 px-4 rounded-lg">
                    Bayar Nanti
                </button>
                </a>
                <button data-modal-target="bayar-modal" data-modal-toggle="bayar-modal" class="bg-[#10AA56] hover:bg-green-900 text-white font-bold py-2 px-4 rounded-lg">
                    Bayar Sekarang
                </button>
            </div>
            
            
        
         </div>
    
    
    </div>
</div>

<div id="paket-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-white">
            <!-- Form header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-300">
                <h3 class="text-lg font-semibold ">
                    Tambah Paket
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="paket-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Form body -->
            <div class="p-4 md:p-5">
                <form action="../create/process_add_detail_transaksi_kasir.php" class="login-form" method="post">
                    <div class="mb-4">
                        <input type="hidden" value="<?= $rowTransaksi['id_transaksi'] ?>" name="id_transaksi" class="form-control" required>
                        <input type="hidden" name="id_outlet" value="<?=$id_outlet?>">
                        <label for="nama-paket" class="block mb-1 text-sm font-medium">Nama Paket</label>
                        <select name="id_paket" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:border-gray-300 dark:focus:ring-blue-400 dark:focus:border-blue-400">
                        <option value="">--</option>

<?php
$queryAdd = "SELECT * FROM  tb_paket WHERE id_outlet = '$id_outlet'";
$dataAdd = mysqli_query($koneksi, $queryAdd);
while ($barisAdd = mysqli_fetch_array($dataAdd)) {
?>
    <option value="<?= $barisAdd['id_paket'] ?>"><?= $barisAdd['nama_paket'] ?></option>
<?php
}
?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="qty" class="block mb-1 text-sm font-medium">Quantity</label>
                        <input type="text" id="qty" name="qty" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none  dark:border-gray-300 dark:focus:ring-blue-400 dark:focus:border-blue-400" min="1" value="1">
                    </div>
                    <div class="mb-4">
                        <label for="keterangan" class="block mb-1 text-sm font-medium">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none  dark:border-gray-300 dark:focus:ring-blue-400 dark:focus:border-blue-400"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="biaya-tambahan" class="block mb-1 text-sm font-medium">Biaya Tambahan</label>
                        <input type="number" id="biaya-tambahan" name="biaya" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none  dark:border-gray-300 dark:focus:ring-blue-400 dark:focus:border-blue-400" min="0" step="0.01" placeholder="Rp">
                    </div>
                    <button type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

  


<div id="bayar-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-300">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Masukkan Jumlah Pembayaran
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="bayar-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="flex items-center justify-center">
                <div class="p-4 md:p-5  shadow-md rounded-lg max-w-md w-full">
                    <form action="../create/process_add_pembayaran_sekarang_kasir.php" class="login-form" method="post">       
                    <input type="text" name="id_transaksi" value="<?= $id_transaksi; ?>" hidden >
                    <input type="text" name="totalBayar" hidden value="<?= round($total) ?>" class="form-control" placeholder="Masukan Alamat Member" required>
                    <div class="mb-4">
                            <label for="jumlah-uang" class="block mb-1 text-sm font-semibold ">Jumlah Uang :</label>
                            <input type="number" name="bayar" class="peer focus:ring-blue-500  block w-full shadow-sm sm:text-sm border-gray-300 border-2 h-8 rounded-md">
                        </div>
                        <button type="submit" class="text-white inline-flex justify-center w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Bayar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= template_footer() ?>