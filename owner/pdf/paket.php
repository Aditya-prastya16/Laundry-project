<!DOCTYPE html>
<html>
<head>
 <title>pdf</title>
</head>
<body>
 <style type="text/css">
 body{
 font-family: sans-serif;
 }
 table{
 margin: 20px auto;
 border-collapse: collapse;
 }
 table th,
 table td{
 border: 1px solid #3c3c3c;
 padding: 3px 8px;

 }
 a{
 background: blue;
 color: #fff;
 padding: 8px 10px;
 text-decoration: none;
 border-radius: 2px;
 }
 </style>


 <table border="1">
 <tr>
 <th >No</th>
                    <th >Nama Outlet</th>
                    <th >Jenis Paket</th>
                    <th >Nama Paket</th>
                    <th >Harga</th>


        </tr>
 <?php 
 // koneksi database
 $koneksi = mysqli_connect("localhost","root","","Myloundry");
 $nomor =1;
 // menampilkan data
 $data =  mysqli_query($koneksi, "SELECT tb_paket.id_paket as id_paket, tb_outlet.id_outlet as id_outlet ,nama,jenis,nama_paket,harga FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id_outlet ORDER BY tb_outlet.id_outlet");
 while($row = mysqli_fetch_array($data)){
 ?>
         <tr class="borderbot">
         <th ><?= $nomor++ ?></th>
                    <th ><?= $row['nama'] ?></th>
                    <th ><?= $row['jenis'] ?></th>
                    <th ><?= $row['nama_paket'] ?></th>
                    <th ><?= $row['harga'] ?></th>
        </tr>
 <?php 
 }
 ?>
 </table>
</body>
<script>
    window.print();
</script>
</html>