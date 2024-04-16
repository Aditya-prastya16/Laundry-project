<?php
    include "../auth/function.php";
    require "../layout/navbar_kasir.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='admin'){
        echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='owner'){
        echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
    }
?>
<?= template_header('Laporan') ?>
<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>

<div class="container mx-auto p-4 mt-8">
    <div class="flex space-x-4">
            <button data-modal-target="modal-word" data-modal-toggle="modal-word" class="bg-[#4073C4] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Word
            </button>

            <button data-modal-target="modal-excel" data-modal-toggle="modal-excel" class="bg-[#10AA56] hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                Excel
            </button>
   
        <!-- Tombol PDF diubah menjadi submit -->
        <button data-modal-target="modal-pdf" data-modal-toggle="modal-pdf"  class="bg-[#E61700] hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg">
            PDF
        </button>
    </div>
</div>


<!-- Main modal laporan word -->
<div id="modal-word" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Masukan Tanggal :
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-word">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
        <form id="form-cetak" action="./word/transaksi.php" target="_blank" method="post">
        <div class="flex justify-center items-center">

            <div class="flex items-center mx-5">
                <label for="transaction-date-start" class="font-semibold mr-2">Tanggal Mulai :</label>
                <input type="date" id="transaction-date-start" name="tgl_awal" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex items-center">
                <label for="transaction-date-end" class="font-semibold mr-2">Tanggal Akhir :</label>
                <input type="date" id="transaction-date-end" name="tgl_akhir" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="modal-word" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat Laporan Word</button>
                <button data-modal-hide="modal-word" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali</button>
            </div>
            </form>
        </div>
    </div>
</div>






<!-- Main modal laporan pdf -->
<div id="modal-pdf" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Masukan Tanggal :
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-pdf">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
        <form id="form-cetak" action="./pdf/transaksi.php" target="_blank" method="post">
        <div class="flex justify-center items-center">

            <div class="flex items-center mx-5">
                <label for="transaction-date-start" class="font-semibold mr-2">Tanggal Mulai :</label>
                <input type="date" id="transaction-date-start" name="tgl_awal" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex items-center">
                <label for="transaction-date-end" class="font-semibold mr-2">Tanggal Akhir :</label>
                <input type="date" id="transaction-date-end" name="tgl_akhir" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="modal-pdf" type="submit" class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Buat Laporan PDF</button>
                <button data-modal-hide="modal-pdf" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali</button>
            </div>
            </form>
        </div>
    </div>
</div>






<!-- Main modal laporan excel -->
<div id="modal-excel" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Masukan Tanggal :
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-excel">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
        <form id="form-cetak" action="./excel/transaksi.php" target="_blank" method="post">
        <div class="flex justify-center items-center">

            <div class="flex items-center mx-5">
                <label for="transaction-date-start" class="font-semibold mr-2">Tanggal Mulai :</label>
                <input type="date" id="transaction-date-start" name="tgl_awal" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex items-center">
                <label for="transaction-date-end" class="font-semibold mr-2">Tanggal Akhir :</label>
                <input type="date" id="transaction-date-end" name="tgl_akhir" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="modal-excel" type="submit" class="text-white bg-[#10AA56] hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Buat Laporan Excel</button>
                <button data-modal-hide="modal-excel" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali</button>
            </div>
            </form>
        </div>
    </div>
</div>












<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <div class="relative flex items-center">
            <p class="font-bold text-[24px]">Data Transaksi</p>
        </div>
        <form id="form-cetak" action="" target="_blank" method="post">
        <div class="flex justify-center items-center">

            <div class="flex items-center mx-5">
                <label for="transaction-date-start" class="font-semibold mr-2">Tanggal Mulai :</label>
                <input type="date" id="transaction-date-start" name="tgl_awal" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex items-center">
                <label for="transaction-date-end" class="font-semibold mr-2">Tanggal Akhir :</label>
                <input type="date" id="transaction-date-end" name="tgl_akhir" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>
        </form>
        </div>
            <button data-modal-target="select-modal" data-modal-toggle="select-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">+ Tambah Transaksi</button>
    </div>
</div>




<div id="container">
    <table onchange="myFunction()" id="myTable" class="table-auto w-full border-collapse border-b border-gray-300">
    <thead>
        <tr>
            <th class="border px-4 py-2">Kode Invoice </th>
            <th class="border px-4 py-2">Nama Member</th>
            <th class="border px-4 py-2" style="width:400px;">Nama Produk</th>
            <th class="border px-4 py-2">
                <select id="myList" name="filter" class="input" style="width:150px; font-size: 16px;">
                    <option value="">Default</option>
                    <option value="baru">Baru</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                    <option value="diambil">Diambil</option>
                </select>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
                $queryUser = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '" . $_SESSION['username'] . "'");
                $hasilUser = mysqli_fetch_array($queryUser);
    $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
      
    $limit = 5;
    $limitStart = ($page - 1) * $limit;
$query = "SELECT * FROM tb_transaksi ORDER BY id_transaksi DESC LIMIT ".$limitStart.", ".$limit;
$no = $limitStart + 1;

$sql_rm = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
while ($data = mysqli_fetch_array($sql_rm)) {
    $querymember = mysqli_query($koneksi, "SELECT * from tb_member WHERE id_member = '" . $data['id_member'] . "'");
    $hasilmember = mysqli_fetch_array($querymember);
    if ($data['status'] == "baru") {
                        ?>
                        <tr class="bg-[#74A9F0]">
                            <th class="border-t border-gray-300 px-4 py-2">
                                Batas Pengambilan :
                                <?= substr($data['batas_waktu'], 0, -8) ?>
                                <br>
                                Jam :
                                <?= substr($data['batas_waktu'], -8, 5) ?>
                                <br><br>
                                <b>
                                    <?= $data['kode_invoice'] ?>
                                </b>
                            </th>
                            <th>
                                <?= $hasilmember['nama'] ?>
                            </th>
                            <th>
                                <?php
                                $idTransaksi = $data['id_transaksi'];
                                $queryDetail = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                                $totalHarga = 0;
                                $biaya_tambahan = $data['biaya_tambahan'];
                                while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                    $totalHarga += $hasilDetail['total_harga'];
                                    ?>
                                    <?= $hasilDetail['nama_paket'] ?>
                                    <br>
                                    <?php
                                }
                                $totalHarga += $biaya_tambahan;
                                if($data['diskon'] > 0){
                                    $diskon = $totalHarga * $data['diskon']/100;
                                    $totalHarga -= $diskon;
                                }
                                $pajak = $totalHarga * $data['pajak'];
                                $totalHarga += $pajak;
                                ?>
                                <br><br>
                                Total Harga : <b>
                                    <?= rupiah($totalHarga) ?>
                                </b>
                            </th>
                            <th align="center">
                                <form id="status-form" action="../update/process_update_status_kasir.php" method="post">
                                    <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                    <input type="text" name="page" value="laporan" hidden>
                                    <select  id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input"
                                        style="width: 150px; font-size:16px;">
                                        <option value="baru" <?php if ($data['status'] == 'baru')
                                            echo "selected='selected'"; ?>>
                                            Baru</option>
                                        <option value="proses" <?php if ($data['status'] == 'proses')
                                            echo "selected='selected'"; ?>>Proses</option>
                                        <option value="selesai" <?php if ($data['status'] == 'selesai')
                                            echo "selected='selected'"; ?>>Selesai</option>
                                        <option value="diambil" <?php if ($data['status'] == 'diambil')
                                            echo "selected='selected'"; ?>>Diambil</option>
                                    </select>
                                </form>
                                <br>
                                <?php
                                if ($data['dibayar'] == 'belum_dibayar') {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-primary mb-1 text-[17px] p-2 text-white rounded-lg bg-[#10AA56]">Lanjutkan</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-success mb-1 text-[17px] p-2 text-white rounded-lg bg-[#4073C4]">Lihat Detail</a>
                                    <?php
                                }
                                ?>
                            </th>
                        </tr>
                        <?php
                    } else if ($data['status'] == "proses") {
                        ?>
                            <tr class="bg-[#E4C65B]">
                            <th>
                                Batas Pengambilan :
                                <?= substr($data['batas_waktu'], 0, -8) ?>
                                <br>
                                Jam :
                                <?= substr($data['batas_waktu'], -8, 5) ?>
                                <br><br>
                                <b>
                                    <?= $data['kode_invoice'] ?>
                                </b>
                            </th>
                            <th>
                                <?= $hasilmember['nama'] ?>
                            </th>
                            <th>
                                <?php
                                $idTransaksi = $data['id_transaksi'];
                                $queryDetail = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                                $totalHarga = 0;
                                $biaya_tambahan = $data['biaya_tambahan'];
                                while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                    $totalHarga += $hasilDetail['total_harga'];
                                    ?>
                                    <?= $hasilDetail['nama_paket'] ?>
                                    <br>
                                    <?php
                                }
                                $totalHarga += $biaya_tambahan;
                                if($data['diskon'] > 0){
                                    $diskon = $totalHarga * $data['diskon']/100;
                                    $totalHarga -= $diskon;
                                }
                                $pajak = $totalHarga * $data['pajak'];
                                $totalHarga += $pajak;
                                ?>
                                <br><br>
                                Total Harga : <b>
                                    <?= rupiah($totalHarga) ?>
                                </b>
                            </th>
                            <th align="center">
                                <form id="status-form" action="../update/process_update_status_kasir.php" method="post">
                                    <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                    <input type="text" name="page" value="laporan" hidden>
                                    <select  id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input"
                                        style="width: 150px; font-size:16px;">
                                        <option value="baru" <?php if ($data['status'] == 'baru')
                                            echo "selected='selected'"; ?>>
                                            Baru</option>
                                        <option value="proses" <?php if ($data['status'] == 'proses')
                                            echo "selected='selected'"; ?>>Proses</option>
                                        <option value="selesai" <?php if ($data['status'] == 'selesai')
                                            echo "selected='selected'"; ?>>Selesai</option>
                                        <option value="diambil" <?php if ($data['status'] == 'diambil')
                                            echo "selected='selected'"; ?>>Diambil</option>
                                    </select>
                                </form>
                                <br>
                                <?php
                                if ($data['dibayar'] == 'belum_dibayar') {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-primary mb-1 text-[17px] p-2 text-white rounded-lg bg-[#10AA56]">Lanjutkan</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-success mb-1 text-[17px] p-2 text-white rounded-lg bg-[#4073C4]">Lihat Detail</a>
                                    <?php
                                }
                                ?>
                            </th>
                        </tr>
                        <?php
                    } else if ($data['status'] == "selesai") {
                        ?>
                                <tr class="bg-[#53D258]">
                            <th>
                                Batas Pengambilan :
                                <?= substr($data['batas_waktu'], 0, -8) ?>
                                <br>
                                Jam :
                                <?= substr($data['batas_waktu'], -8, 5) ?>
                                <br><br>
                                <b>
                                    <?= $data['kode_invoice'] ?>
                                </b>
                            </th>
                            <th>
                                <?= $hasilmember['nama'] ?>
                            </th>
                            <th>
                                <?php
                                $idTransaksi = $data['id_transaksi'];
                                $queryDetail = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                                $totalHarga = 0;
                                $biaya_tambahan = $data['biaya_tambahan'];
                                while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                    $totalHarga += $hasilDetail['total_harga'];
                                    ?>
                                    <?= $hasilDetail['nama_paket'] ?>
                                    <br>
                                    <?php
                                }
                                $totalHarga += $biaya_tambahan;
                                if($data['diskon'] > 0){
                                    $diskon = $totalHarga * $data['diskon']/100;
                                    $totalHarga -= $diskon;
                                }
                                $pajak = $totalHarga * $data['pajak'];
                                $totalHarga += $pajak;
                                ?>
                                <br><br>
                                Total Harga : <b>
                                    <?= rupiah($totalHarga) ?>
                                </b>
                            </th>
                            <th align="center">
                                <form id="status-form" action="../update/process_update_status_kasir.php" method="post">
                                    <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                    <input type="text" name="page" value="laporan" hidden>
                                    <select  id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input"
                                        style="width: 150px; font-size:16px;">
                                        <option value="baru" <?php if ($data['status'] == 'baru')
                                            echo "selected='selected'"; ?>>
                                            Baru</option>
                                        <option value="proses" <?php if ($data['status'] == 'proses')
                                            echo "selected='selected'"; ?>>Proses</option>
                                        <option value="selesai" <?php if ($data['status'] == 'selesai')
                                            echo "selected='selected'"; ?>>Selesai</option>
                                        <option value="diambil" <?php if ($data['status'] == 'diambil')
                                            echo "selected='selected'"; ?>>Diambil</option>
                                    </select>
                                </form>
                                <br>
                                <?php
                                if ($data['dibayar'] == 'belum_dibayar') {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-primary mb-1 text-[17px] p-2 text-white rounded-lg bg-[#10AA56]">Lanjutkan</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-success mb-1 text-[17px] p-2 text-white rounded-lg bg-[#4073C4]">Lihat Detail</a>
                                    <?php
                                }
                                ?>
                            </th>
                        </tr>
                        <?php
                    } else if ($data['status'] == "diambil") {
                        ?>
                                    <tr class="bg-[#F66E46]">
                            <th>
                                Batas Pengambilan :
                                <?= substr($data['batas_waktu'], 0, -8) ?>
                                <br>
                                Jam :
                                <?= substr($data['batas_waktu'], -8, 5) ?>
                                <br><br>
                                <b>
                                    <?= $data['kode_invoice'] ?>
                                </b>
                            </th>
                            <th>
                                <?= $hasilmember['nama'] ?>
                            </th>
                            <th>
                                <?php
                                $idTransaksi = $data['id_transaksi'];
                                $queryDetail = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                                $totalHarga = 0;
                                $biaya_tambahan = $data['biaya_tambahan'];
                                while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                    $totalHarga += $hasilDetail['total_harga'];
                                    ?>
                                    <?= $hasilDetail['nama_paket'] ?>
                                    <br>
                                    <?php
                                }
                                $totalHarga += $biaya_tambahan;
                                if($data['diskon'] > 0){
                                    $diskon = $totalHarga * $data['diskon']/100;
                                    $totalHarga -= $diskon;
                                }
                                $pajak = $totalHarga * $data['pajak'];
                                $totalHarga += $pajak;
                                ?>
                                <br><br>
                                Total Harga : <b>
                                    <?= rupiah($totalHarga) ?>
                                </b>
                            </th>
                            <th align="center">
                                <form id="status-form" action="../update/process_update_status_kasir.php" method="post">
                                    <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                    <input type="text" name="page" value="laporan" hidden>
                                    <select  id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input"
                                        style="width: 150px; font-size:16px;">
                                        <option value="baru" <?php if ($data['status'] == 'baru')
                                            echo "selected='selected'"; ?>>
                                            Baru</option>
                                        <option value="proses" <?php if ($data['status'] == 'proses')
                                            echo "selected='selected'"; ?>>Proses</option>
                                        <option value="selesai" <?php if ($data['status'] == 'selesai')
                                            echo "selected='selected'"; ?>>Selesai</option>
                                        <option value="diambil" <?php if ($data['status'] == 'diambil')
                                            echo "selected='selected'"; ?>>Diambil</option>
                                    </select>
                                </form>
                                <br>
                                <?php
                                if ($data['dibayar'] == 'belum_dibayar') {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-primary mb-1 text-[17px] p-2 text-white rounded-lg bg-[#10AA56]">Lanjutkan</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>"
                                    class="btn btn-success mb-1 text-[17px] p-2 text-white rounded-lg bg-[#4073C4]">Lihat Detail</a>
                                    <?php
                                }
                                ?>
                            </th>
                        </tr>
                        <?php
                    }
                }
                ?>    </tbody>
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
      <a href="transaksi.php?page=<?php echo $LinkPrev;?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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
      $SqlQuery = mysqli_query($koneksi, "SELECT * FROM tb_transaksi");        
      
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
      <a href="transaksi.php?page=<?php echo $page; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?php echo $page; ?></a>
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
    <a href="transaksi.php?page=<?php echo $linkNext; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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


<div id="select-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Pilih Nama Member
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="select-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="flex items-center justify-center">
    <div class="p-4 md:p-5 bg-white shadow-md rounded-lg max-w-md w-full">
        <form action="../create/process_add_transaksi_kasir.php" class="login-form" method="post">
        <ul class="space-y-4 mb-4">
            <li>
                <select id="job-1" name="id_member"  class="peer focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <?php
                $queryAdd = "SELECT * FROM tb_member";
                $dataAdd = mysqli_query($koneksi, $queryAdd);
                while ($barisAdd = mysqli_fetch_array($dataAdd)) {
                    echo '<option value="' . $barisAdd['id_member'] . '">' . $barisAdd['nama'] . '</option>';
                }
                ?>
                </select>
            </li>
        </ul>
        <button type="submit" class="text-white inline-flex justify-center w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Selanjutnya
        </button>
        </form>
    </div>
</div>
<script>
    function myFunction() {
        var filter, table, tr, th, i, status;
        filter = document.getElementById("myList").value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (let i = 0; i < tr.length; i++) {
            let ths = tr[i].getElementsByTagName("th");
            let selectElement = null;
            for (let j = 0; j < ths.length; j++) {
                let select = ths[j].getElementsByTagName("select")[0];
                if (select && select.id.startsWith("status-select-")) {
                    selectElement = select;
                    break;
                }
            }
            if (selectElement) {
                status = selectElement.value;
                if (filter === "" || status === filter) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    document.querySelectorAll('select[id^="status-select-"]').forEach(function (select) {
        select.addEventListener('change', function () {
            var form = this.closest('tr').querySelector('form');
            form.submit();
        });
    });

    document.getElementById("myList").addEventListener("change", myFunction);
</script>
<?= template_footer() ?>
