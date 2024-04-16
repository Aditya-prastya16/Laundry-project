<?php

include "../auth/function.php";

session_start();

extract($_POST);

$username = $_SESSION['username'];

$queryOutlet = "SELECT * FROM tb_user WHERE username = '$username'";
$hasilQueryOutlet = mysqli_query($koneksi,$queryOutlet);
$rowQuery = mysqli_fetch_array($hasilQueryOutlet);

$id_user = $rowQuery['id_user'];
$id_outlet = $_SESSION['id_outlet'];

@$kode_invoice_terakhir = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT kode_invoice FROM tb_transaksi ORDER BY id_transaksi DESC LIMIT 1"));
        if (!$kode_invoice_terakhir) {
            $kodeInvoice =  "INV/".date("Y/m/d")."/1";
        }else {
            $pecah_string = explode("/", $kode_invoice_terakhir['kode_invoice']);
            $bulan_sebelum = $pecah_string[2];
            $bulan_saat_ini = date('m');
            if ($bulan_saat_ini !=$bulan_sebelum) {
                $number_urut = 1;
            }else {
                $number_urut = $pecah_string[4];
                $number_urut++;
            }
            $kodeInvoice = "INV/".date("Y/m/d")."/".$number_urut;
        }

date_default_timezone_set('Asia/Makassar');
$todayDate = new DateTime();
$tgl = $todayDate->format('Y-m-d H:i:s');
$batasTgl = Date('Y-m-d H:i:s', strtotime('+3 days'));

$tglBayar = '0000-00-00 00:00:00';

$queryMember = "SELECT COUNT(*) as total FROM tb_member INNER JOIN tb_transaksi USING(id_member) WHERE id_member = $id_member";
$hasilQueryMember = mysqli_query($koneksi,$queryMember);
$rowQuery = mysqli_fetch_array($hasilQueryMember)[0];
$rowQuery++;

if(fmod($rowQuery,8) == 0){
    $diskon = 20;
}else if(fmod($rowQuery,4) == 0){
    $diskon = 10;
}else{
    $diskon = 0;
}

$statusBayar = "belum_dibayar";
$biayaTambahan = 0;
$pajak = 0.0075;

$query = "INSERT INTO tb_transaksi (id_outlet, kode_invoice, id_member, tgl, batas_waktu, tgl_bayar, biaya_tambahan, diskon, pajak, status, dibayar, id_user) values ('$id_outlet','$kodeInvoice', '$id_member','$tgl','$batasTgl','$tglBayar','$biayaTambahan','$diskon','$pajak','baru', '$statusBayar', $id_user)";
$hasil = mysqli_query($koneksi, $query);

if (!$hasil && !$hasilDetail) {
    die("QUERY GAGAL DIJALANKAN:" . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
} else {
    echo "<script>alert('data Berhasil Disimpan');window.location='../admin/detail_transaksi.php';</script>";
}
?>