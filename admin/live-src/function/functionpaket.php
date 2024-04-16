<?php
$koneksi = mysqli_connect("localhost","root","","Myloundry");
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;

    }

    return $rows;
}
function cari($keyword){
    $query = "SELECT tb_paket.id_paket as id_paket, tb_outlet.id_outlet as id_outlet ,nama,jenis,nama_paket,harga FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id_outlet
    WHERE
    id_paket LIKE '%$keyword%' OR
    nama LIKE '%$keyword%' OR
    jenis LIKE '%$keyword%' OR
    nama_paket LIKE '%$keyword%' OR
    harga LIKE '%$keyword%'
";
  
   return query($query);
  
} 
?>