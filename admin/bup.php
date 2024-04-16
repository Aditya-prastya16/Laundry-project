<?php
    include "../auth/function.php";
    require "../layout/navbar_admin.php";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
<section class="main">


<h2 align="center">Detail Transaksi</h2>
<div id="modaltambah" class="modal">
    <!-- ... (konten modal) ... -->
    <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <span class="close" style="cursor: pointer;" onclick="closeModal('<?php echo $modal_id ?>')">&times;</span>
    </div>
    <div class="modal-body">
        <form action="./proses/outlet/proses-tambah-outlet.php" class="login-form" method="post">
            <div class="form-group">
                <label for="nama">Nama Outlet</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Outlet" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Outlet" required>
            </div>
            <div class="form-group">
                <label for="tlp">Nomor Telephone</label>
                <input type="text" name="tlp" placeholder="Masukan Nomor Telephone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<div class="flex" style="display: flex;
    justify-content: space-between;" ">
    <table border=" 1" style="  width:  45%; /* Anda dapat menyesuaikan lebar sesuai kebutuhan */
    border-collapse: collapse;
">
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

    <tr>
        <td style="background-color: #87CBB9;">Kode Invoice</td>
        <td><?= $rowTransaksi['kode_invoice'] ?></td>
    </tr>
    <tr>
        <td style="background-color: #87CBB9;">Nama Pelanggan</td>
        <td><?= $rowMember['nama'] ?></td>
    </tr>
    <tr>
        <td style="background-color: #87CBB9;">No. Telp</td>
        <td><?= $rowMember['tlp'] ?></td>
    </tr>
    <tr>
        <td style="background-color: #87CBB9;">Alamat Pelanggan</td>
        <td><?= $rowMember['alamat'] ?></td>
    </tr>
    <tr>
        <td style="background-color: #87CBB9;">Nama Kasir</td>
        <td><?= $rowUser['nama'] ?></td>
    </tr>
    <tr>
        <td style="background-color: #87CBB9;">Ambil Sebelum</td>
        <td><?= $rowTransaksi['batas_waktu'] ?></td>
    </tr>
    </table>
    <table style="  width:  45%; /* Anda dapat menyesuaikan lebar sesuai kebutuhan */
    border-collapse: collapse;">
        <tr style="background-color: #569DAA;">
            <td>Nama Product</td>
            <td>Keterangan</td>
            <td>Qty</td>
            <td>Harga</td>
            <td>Total Harga</td>
        </tr>
        <?php
        function rupiah($angka)
        {
            $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
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
            <tr>
                <td>
                    <?= @$hasilProduct['nama_paket'] ?>
                    <br>
                    <a style="font-size: 14px; color:#577D86;"><?= @$hasilProduct['jenis'] ?></a>
                </td>
                <td><?= @$rowDetailProduct['keterangan'] ?></td>
                <td><?= @$rowDetailProduct['qty'] ?></td>
                <td><?= rupiah(@$hasilProduct['harga']) ?></td>
                <td align="right"><?= rupiah(@$totalHargaPerItem) ?></td>
                <td><a href="../delete/delete_detail_transaksi.php?id_detail_transaksi=<?= @$rowDetailProduct['id_detail_transaksi'] ?>&id_transaksi=<?= $id_transaksi ?>">X</a></td>
            </tr>
        <?php
        }
        if ($rowTransaksi['biaya_tambahan'] > 0) {
        ?>
            <tr>
                <td>Biaya Tambahan</td>
                <td colspan="4" align="right"><?= rupiah(@$rowTransaksi['biaya_tambahan']) ?></td>
            </tr>
        <?php
        }
        ?>
        <tr style="background-color: #87CBB9;">
            <td>Total Keseluruhan</td>
            <td colspan="4" align="right"><?= rupiah(@$totalHarga) ?></td>
        </tr>
        <?php
        if ($rowTransaksi['diskon'] > 0) {
        ?>
            <tr>
                <td>Discount</td>
                <td colspan="4" align="right"><?= $rowTransaksi['diskon'] ?>%</td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td>Tax</td>
            <td colspan="4" align="right"><?= $rowTransaksi['pajak'] * 100 ?></td>
        </tr>
        <tr style="background-color: #87CBB9;">
            <td>Total</td>
            <td colspan="4" align="right"><?= rupiah(round(@$total));
                                            ?></td>
        </tr>
    </table>
</div>

<div style="margin-top: 20px;">

    <button type="button" style="width: 15%;" class="custom-btn btn-1" onclick="openModal('modaltambahpaket')">
        Tambah Paket
    </button>
    <button type="button" class="custom-btn btn-1" style="width: 15%;" onclick="openModal('modalbayar')">
        Pay Now
    </button>
    <a href="transaksi.php" style="width: 15%;" class="btn-1 custom-btn">Pay Later</a>
</div>

<div id="modaltambahpaket" class="modal">
    <!-- ... (konten modal) ... -->
    <div class="modal-header">
        <h5 class="modal-title">Tambah Paket</h5>
        <span class="close" style="cursor: pointer;" onclick="closeModal()">&times;</span>
    </div>
    <div class="modal-body">
        <form action="../create/process_add_detail_transaksi_admin.php" class="login-form" method="post">
            <div class="form-group">
                <input type="hidden" value="<?= $rowTransaksi['id_transaksi'] ?>" name="id_transaksi" class="form-control" required>
                <input type="hidden" name="id_outlet" value="<?=$id_outlet?>">

            </div>
            <div class="form-group">
                <label for="id_paket">Nama Paket</label>
                <select name="id_paket" class="form-control">
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
            <div class="form-group">
                <label for="tlp">Qty</label>
                <input type="number" min=0 name="qty" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" placeholder="Masukan Keterangan" class="form-control">
            </div>
            <div class="form-group">
                <label for="biaya">Biaya Tambahan</label>
                <input type="number" min=0 name="biaya" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<div id="modalbayar" class="modal">
    <!-- ... (konten modal) ... -->
    <div class="modal-header">
        <h5 class="modal-title">bayar</h5>
        <span class="close" style="cursor: pointer;" onclick="closeModal()">&times;</span>
    </div>
    <div class="modal-body">
        <form action="../create/process_add_pembayaran_sekarang.php" class="login-form" method="post">
            <div class="form-group">
                <input type="text" name="id_transaksi" value="<?= $id_transaksi; ?>" hidden class="form-control" placeholder="Masukan Nama Outlet" required>
            </div>
            <div class="form-group">
                <input type="text" name="totalBayar" hidden value="<?= round($total) ?>" class="form-control" placeholder="Masukan Alamat Member" required>
            </div>
            <div class="form-group">
                <input type="text" name="bayar" class="form-control" placeholder="Masukan Pembayara" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

</section>
</body>
<script>
    const body = document.querySelector("body");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));



submenuItems.forEach((item, index) => {
    item.addEventListener("click", () => {
        item.classList.toggle("show_submenu");
        submenuItems.forEach((item2, index2) => {
            if (index !== index2) {
                item2.classList.remove("show_submenu");
            }
        });
    });
});



function openModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'block';
    } else {
        console.error(`No modal found with id: ${modalId}`);
    }
}

function closeModal(modalId) {
    var modalElement = document.getElementById(modalId);
    if (modalElement) {
        modalElement.style.display = 'none';
    } else {
        console.error('No modal found with id: ' + modalId);
    }
}

// function closeModal(modalId) {
//     // If no ID is passed, default to the currently displayed modal
//     if (!modalId) {
//         modalId = document.querySelector('.modal.show').id;
//     }

//     var modalElement = document.getElementById(modalId);
//     if (modalElement) {
//         modalElement.style.display = 'none';
//     } else {
//         console.error('No modal found with id: ' + modalId);
//     }
// }


// Event listener for closing modal
var closeButtons = document.getElementsByClassName('close');
for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].addEventListener('click', function() {
        var modalId = this.closest('.modal').id;
        closeModal(modalId);
    });
}
</script>
</html>





<?php
    include "../auth/function.php";
    require "../layout/navbar_admin.php";
    session_start();
     
 if (@$_GET['status']=='baru') {
    $status = "WHERE status='baru'";
 }elseif (@$_GET['status']=='proses') {
    $status = "WHERE status='proses'";
 }elseif (@$_GET['status']=='selesai'){
    $status = "WHERE status='selesai'";
 }elseif (@$_GET['status']=='diambil'){
    $status = "WHERE status='diambil'";
 }else{
$status= "";
 }



 if (@$_SESSION['role']=='admin' OR @$_SESSION['role'] == 'owner') {
$query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi 
INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id
INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id
INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id
INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id $status GROUP BY Kode_invoice");
}else{
    $id_outlet = $_SESSION['id_outlet'];
        if($status!=""){
            $outlet = "AND tb_outlet.id = '$id_outlet'";
        }else{
            $outlet = "WHERE tb_outlet.id='$id_outlet'";
        }
$query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi 
INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id
INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id
INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id
INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id $status $outlet GROUP BY kode_invoice");

}

?>
<?= template_header('Home') ?>

<center>

<form action="cetak/cetak_laporan.php" target="_blank" method="POST">
<span>Tanggal Awal</span>
<input type="date" name="masukkan_tgl_awal" required>
<span>Tanggal Akhir</span>
<input type="date" name="masukkan_tgl_akhir" required>
<button type="submit" name="tombol_cetak_laporan">Generate Laporan</button>
</form>
<br><br>
<table border="2" cellspacing="0">
<!-- judul kolom -->
<thead>
    <tr>
        <th>Kode Invoice</th>
        <th>Nama Pelanggan</th>
        <th>Nama Paket</th>
        <th>
            <select name="pilih_status" onchange="pilihStatus (this. options [this.selectedIndex].value)"> <option value="">
                Semua Status
            </option>
            <option value="baru" <?php if (@$_GET['status']=='baru'){echo "selected";}?>> Baru
            </option>
            <option value="proses" <?php if (@$_GET['status']=='proses') { echo "selected";}?>>
                Proses
            </option>
            <option value="selesai" <?php if (@$_GET['status']=='selesai') { echo "selected"; } ?>>
                Selesai
            </option>
            <option value="diambil" <?php if (@$_GET['status'] == 'diambil') { echo "selected"; } ?>>
                Diambil
            </option>

            </select>
            <script>
            function pilihStatus(value) {
                window.location.href = 'laporan.php?status=' + value;
                }
            </script>
        </th>
    </tr>
</thead>

<tbody>
    <?php
        while($baris = mysqli_fetch_assoc($query)) {
        if (@$_SESSION['role']=='admin' OR @$_SESSION['role'] == 'owner'){
    ?>
    <tr>
        <td align="left">Nama Outlet: <b><?=$baris ['nama_outlet']?></b></td>
    </tr>
    <?php 
        }
    ?>

    <tr>
        <td align="left"> 
        <?php
        $pecah_string_tanggal = explode(" ", $baris ['batas_waktu']);
        $pecah_string_hari = explode("-", $pecah_string_tanggal ['']); 
        $pecah_string_jam = explode(":", $pecah_string_tanggal['1']);

        echo "Batas Pengambilan: ".$pecah_string_hari['2']."-".$pecah_string_hari['1']."-".$pecah_string_hari['0'];
        echo "<br>";
        echo "Jam ".$pecah_string_jam['0'].":".$pecah_string_jam ['1']; 
        echo "<br> <br>";
        echo "<b>".$baris ['kode_invoice']."<b>";
        ?>
        </td>

            <td><?=$baris ['nama_member']?></td>



<td align="left"><?php
$id_transaksi = $baris ['id_transaksi'];
$query_paket = mysqli_query($koneksi, "SELECT nama_paket, qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'"); while($data_paket = mysqli_fetch_assoc($query_paket)){
echo $data_paket ['nama_paket'];
echo "<br>";
}

echo "<br>";
$grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'"));
$pajak = $grand_total ['0'] * $baris ['pajak'];
$diskon = $grand_total ['0'] * $baris['diskon'];
$total_keseluruhan = ($grand_total ['0']+$baris ['biaya_tambahan']+$pajak)-$diskon;
echo "Total Harga : <b>Rp.". number_format($total_keseluruhan, 0, ',', '.')."</b>";
?>
</td>

<td>
    <select onchange="pilihStatus (this.options [this.selectedIndex].value, <?=$baris['id_transaksi']?>)"> 
    <option value="baru" <?php if($baris ['status']=='baru') {echo "selected"; } ?>> 
        Baru
    </option>
    <option value="proses" <?php if($baris ['status']=='proses') { echo "selected"; } ?>>
        Proses
    </option>
    <option value="selesai" <?php if($baris['status']=='selesai'){echo "selected"; } ?>>
        Selesai
    </option>
    <option value="diambil" <?php if($baris ['status']=='diambil') {echo "selected"; } ?>>
        Diambil
    </option>
    </select>
    <script>
        function pilihStatus (value, id) {
        window.location.href = '../update/process_update_status_laporan.php?status=' + value + '&id=' +id;
            }
    </script>

<?php
if($baris ['dibayar']=='belum_dibayar') {
    $warna = "#ffbc00"; 
}else{
    $warna = "#60dd60"; 
}
?>
 <br>
    <a style="color: <?=$warna?>"
        href="detail_transaksi.php?id_transaksi=<?= $baris['id_transaksi'] ?>">Lihat
        Detail
    </a>
</td>

</tr>
<?php
}
?>
</tbody>
</table>
 </center>
 <?= template_footer() ?>


























 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Report</title>
  <style>
    .outlet {
      background-color: yellow;
    }

    @media print {
      .outlet {
        background-color: yellow !important;
        -webkit-print-color-adjust: exact;
      }
    }
  </style>
</head>

<body>
  <h2 class="align-center">LAUNDRY TRANSACTION REPORT</h2>
  <h3>Period:
    <?= $tgl_awal . " to " . $tgl_akhir ?>
  </h3>

  <!-- Algoritma mencari nama paket yg sering terpilih -->
  <?php
  if (@$_SESSION['role'] == 'admin' or @$_SESSION['role'] == 'owner') {
    $query = "SELECT nama_paket, COUNT(nama_paket) as jumlah FROM tb_transaksi 
      INNER JOIN tb_detail_transaksi ON tb_transaksi.id_transaksi = tb_detail_transaksi.id_transaksi
      INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id_paket
      WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59'
      GROUP BY nama_paket ORDER BY jumlah DESC";
    $namaPaket = mysqli_fetch_array(mysqli_query($koneksi, $query));
  } else {
    $id_outlet = $_SESSION['id_outlet'];
    $query = "SELECT nama_paket, COUNT(nama_paket) as jumlah FROM tb_transaksi 
      INNER JOIN tb_detail_transaksi ON tb_transaksi.id_transaksi = tb_detail_transaksi.id_transaksi
      INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id_paket
      WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59'
      AND dibayar='dibayar' AND id_outlet='$id_outlet'
      GROUP BY nama_paket ORDER BY jumlah DESC";
    $namaPaket = mysqli_fetch_array(mysqli_query($koneksi, $query));
  }
  echo "Packages that customers often choose : <b>" . $namaPaket['nama_paket'] . "<b>";
  ?>

  <hr style="width:100%;" , size="3" , color="black">
  <hr>

  <?php
  if (@$_SESSION['role'] == 'admin' or @$_SESSION['role'] == 'owner') {
    $query = "SELECT tb_outlet.id_outlet as id_outlet,tb_outlet.nama as nama_outlet FROM tb_detail_transaksi 
      INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id_transaksi
      INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id_outlet
      WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar'
      GROUP BY tb_outlet.id_outlet";
    $query_outlet = mysqli_query($koneksi, $query);
  } else {
    $id_outlet = $_SESSION['id_outlet'];
    $query = "SELECT tb_outlet.id_outlet as id_outlet,tb_outlet.nama as nama_outlet FROM tb_detail_transaksi 
      INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id_transaksi
      INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id_outlet
      WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet'
      GROUP BY tb_outlet.id_outlet";
    $query_outlet = mysqli_query($koneksi, $query);
  }
  ?>

  <center>
    <table border="1" cellpadding="10" cellspacing="0">
      <?php
      $total_semua = 0;
      while ($baris_outlet = mysqli_fetch_assoc($query_outlet)) {
        if (@$_SESSION['role'] == 'admin' or @$_SESSION['role'] == 'owner') {
          $id_outlet = $baris_outlet['id_outlet'];
          $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id_outlet AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id_transaksi AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi
              INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id_transaksi
              INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id_member
              INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket
              INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id_outlet
              INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id_outlet='$id_outlet' GROUP BY kode_invoice");
        } else {
          $id_outlet = $_SESSION['id_outlet'];
          $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id_outlet AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id_transaksi AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi
              INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id_transaksi
              INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id_member
              INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket
              INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id_outlet
              INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id_outlet='$id_outlet' GROUP BY kode_invoice");
        }
        ?>
        <tr>
          <td align="left" class="outlet" colspan="3">Outlet Name :
            <b>
              <?= $baris_outlet['nama_outlet'] ?>
            </b>
          </td>
        </tr>
        <?php
        $no = 1;
        while ($baris = mysqli_fetch_assoc($query)) {
          ?>
          <tr>
            <td>
              <?= $no++ ?>
            </td>
            <td>
              <?= "Customer : " . $baris['nama_member'] ?>
            </td>
            <td align="left">
              <?php
              $id_transaksi = $baris['id_transaksi'];
              $query_paket = mysqli_query($koneksi, "SELECT nama_paket,qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id_paket WHERE id_transaksi='$id_transaksi'");
              while ($data_paket = mysqli_fetch_assoc($query_paket)) {
                echo $data_paket['nama_paket'];
                echo "<br>";
              }
              ?>
            </td>
            <td>
              <?php
              $grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id_paket WHERE id_transaksi='$id_transaksi'"));
              $pajak = $grand_total['0'] * $baris['pajak'];
              $diskon = $grand_total['0'] * $baris['diskon'];
              $total_keseluruhan = ($grand_total['0'] + $baris['biaya_tambahan'] + $pajak) - $diskon;
              $total_keseluruhan = round($total_keseluruhan);
              $tampil_total = number_format($total_keseluruhan, 0, ',', '.');
              echo "Total Price : <b>Rp " . $tampil_total . "<b>";
              $total_semua += $tampil_total;
              ?>
            </td>
          </tr>

          <?php
        }
      }
      ?>
      <tr align="right">
        <td colspan="3"><b>Total Income</b>
          <br>
          <?= "From Date : " . $tgl_awal . " to " . $tgl_akhir ?>
        </td>
        <td>
          <?php
          echo "<h2>Rp " . number_format($total_semua, 3, '.', '.') . "</h2>";
          $pajak_semua = $total_semua * 0.0075;
          echo "Tax : Rp " . number_format($pajak_semua, 3, '.', '.');
          ?>
        </td>
      </tr>
    </table>
  </center>

</body>
<script>
  window.print();
</script>

</html>