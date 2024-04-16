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
    $query = "SELECT * FROM `tb_user` 
    where
    id_user like '%$keyword%' or
          nama like '%$keyword%' or
          username like '%$keyword%' or
          id_outlet like '%$keyword%' or
          role like '%$keyword%'  
   ";
  
   return query($query);
  
} 
?>