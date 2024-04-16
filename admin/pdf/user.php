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
                    <th >Nama</th>
                    <th >Username</th>
                    <th >Outlet</th>
                    <th >Role</th>


        </tr>
 <?php 
 // koneksi database
 $koneksi = mysqli_connect("localhost","root","","Myloundry");
 $nomor =1;
 // menampilkan data
 $data =  mysqli_query($koneksi, "SELECT * FROM tb_user");
 while($row = mysqli_fetch_array($data)){
 ?>
         <tr class="borderbot">
         <th ><?= $nomor++ ?></th>
                    <th ><?= $row['nama'] ?></th>
                    <th ><?= $row['username'] ?></th>
                    <th ><?= $row['id_outlet'] ?></th>
                    <th ><?= $row['role'] ?></th>
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