<?php
$koneksi = mysqli_connect("localhost","root","","Myloundry");
session_start();
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
?>
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
            }
        }
    </style>
</head>

<body>
    <h2 class="align-center">LAPORAN TRANSAKSI</h2>
    <h3>Periode:
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
              AND tb_transaksi.dibayar='dibayar' AND tb_transaksi.id_outlet='$id_outlet'
              GROUP BY nama_paket ORDER BY jumlah DESC";
        $namaPaket = mysqli_fetch_array(mysqli_query($koneksi, $query));
    }
    ?>


    <hr style="width:100%;" , size="3" , color="black">
    <hr>

    <?php
    if (@$_SESSION['role'] == 'admin' or @$_SESSION['role'] == 'owner') {
        $query = "SELECT tb_outlet.id_outlet as id_outlet, tb_outlet.nama as nama_outlet FROM tb_detail_transaksi 
              INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id_transaksi
              INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id_outlet
              WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND tb_transaksi.dibayar='dibayar'
              GROUP BY tb_outlet.id_outlet";
        $query_outlet = mysqli_query($koneksi, $query);
    } else {
        $id_outlet = $_SESSION['id_outlet'];
        $query = "SELECT tb_outlet.id_outlet as id_outlet, tb_outlet.nama as nama_outlet FROM tb_detail_transaksi 
              INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id_transaksi
              INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id_outlet
              WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND tb_transaksi.dibayar='dibayar' AND tb_outlet.id_outlet='$id_outlet'
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
                    <td align="left" class="outlet" colspan="3">Nama Outlet :
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
                            $diskon = $grand_total['0'] * $baris['diskon'] / 100;
                            $total_keseluruhan = ($grand_total['0'] + $baris['biaya_tambahan'] + $pajak) - $diskon;
                            $total_keseluruhan = round($total_keseluruhan);
                            $tampil_total = number_format($total_keseluruhan, 0, ',', '.');
                            echo "Total Harga : <b>Rp " . $tampil_total . "<b>";
                            $total_semua += $tampil_total;
                            ?>
                        </td>
                    </tr>

            <?php
                }
            }
            ?>
            <tr align="right">
                <td colspan="3"><b>Total Pendapatan</b>
                    <br>
                    <?= "Dari Tanggal : " . $tgl_awal . " Sampai Tanggal " . $tgl_akhir ?>
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