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
    $query = "SELECT * FROM `tb_member` 
    where
    id_member like '%$keyword%' or
          nama like '%$keyword%' or
          alamat like '%$keyword%' or
          jenis_kelamin like '%$keyword%' or
          tlp like '%$keyword%' 
   ";
  
   return query($query);
  
} 
?>