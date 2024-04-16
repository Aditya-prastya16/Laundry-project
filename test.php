<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Profile and Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Search and Add Data</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <!-- Search and Add Data -->
        <div class="flex justify-between mb-4">
        <div class="relative flex">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
            <!-- <input type="text" placeholder="Search..." class="block py-2 px-4 w-full border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500"> -->
            <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
        </div>
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add Data
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table-auto border-collapse border-b border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-t border-gray-300 px-4 py-2">1</td>
                        <td class="border-t border-gray-300 px-4 py-2">John Doe</td>
                        <td class="border-t border-gray-300 px-4 py-2">john@example.com</td>
                        <td class="border-t border-gray-300 px-4 py-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div class="container mx-auto p-8">
        <h2 class="text-2xl font-semibold mb-4">Form Input</h2>
        <form>
            <div class="flex mb-4">
                <label for="name" class="w-1/3 text-right pr-4 pt-1">Nama</label>
                <input type="text" id="name" name="name" class="w-2/3 px-3 py-2 border rounded-md border-gray-300">
            </div>
            <div class="flex mb-4">
                <label for="email" class="w-1/3 text-right pr-4 pt-1">Email</label>
                <input type="email" id="email" name="email" class="w-2/3 px-3 py-2 border rounded-md border-gray-300">
            </div>
            <div class="flex mb-4">
                <label for="message" class="w-1/3 text-right pr-4 pt-1">Pesan</label>
                <textarea id="message" name="message" rows="4" class="w-2/3 px-3 py-2 border rounded-md border-gray-300"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kirim
                </button>
            </div>
        </form>
    </div> -->



    <div class="max-w-md mx-auto bg-white rounded-md shadow-md p-8">
        <h1 class="text-3xl font-semibold mb-6">Judul Utama</h1>
        <h2 class="text-lg font-semibold mb-4 pb-2 border-b border-gray-300">Subjudul dengan Garis Bawah Full</h2>
        <form>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="name" name="name"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                <textarea id="message" name="message" rows="4"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            <div>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kirim
                </button>
            </div>
        </form>
    </div>








    <?php
    include "../auth/function.php";
    require "../layout/navbar_admin.php";
    session_start();

    if(!@$_SESSION['username']){
        header('Location:../auth/login.php');
    }else if(@$_SESSION['role']=='kasir'){
        echo "<script>alert('anda kasir');window.location.href='../auth/login.php';</script>";
    }else if(@$_SESSION['role']=='owner'){
        echo "<script>alert('anda owner');window.location.href='../auth/login.php';</script>";
    }

?>
<?= template_header('Home') ?>


    <center><a href="../view/add_paket_admin.php"> Tambah  +</a></center>
    <table border="1" align="center" width="90%">
    <?php
    $paket = mysqli_query($koneksi, "SELECT tb_paket.id as id, tb_outlet.id as id_outlet ,nama,jenis,nama_paket,harga FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id ORDER BY tb_outlet.id");
    $last_outlet_id = null;
    $no = 1;
    while ($row = mysqli_fetch_assoc($paket)) {
        if ($last_outlet_id !== null && $last_outlet_id != $row['id_outlet']) {
            $no =1;
?>
<tr>
        <th>No</th>
        <th>Nama Outlet</th>
        <th>AJenis Paket</th>
        <th>Nama Paket</th>
        <th>Harga</th>
        <th colspan="2">Action</th>
</tr>

<?php
            }
        ?>
<tr>
<td><?=$no++?></td>
<td><?=$row['nama']?></td>
<td><?=$row['jenis']?></td>
<td><?=$row['nama_paket']?></td>
<td><?=$row['harga']?></td>
<td>
    <a href="../view/update_paket_admin.php?id=<?= $row['id'] ?>" class="edit">Edit</a>

    <?php
    $id = $row['id'];
    $hide_delete = mysqli_fetch_row(mysqli_query($koneksi,"SELECT COUNT(*) as total FROM tb_paket INNER JOIN tb_detail_transaksi ON tb_paket.id = tb_detail_transaksi.id WHERE tb_paket.id='$id' "));
    if ($hide_delete[0]=='0') { 

    ?>
             <a onclick="return confirm('apakah anda ingin menghapus data ?')"
            href="../delete/delete_paket_admin.php?id=<?= $row['id'] ?>" class="trash">Hapus</a> 

</td>
<?php
    }else{
        echo "</td>";
    }
?>
</tr>
<?php
            $last_outlet_id = $row['id_outlet'];
}
?>
    </table>



    
    <?= template_footer() ?>













<!-- <center><a href="../view/add_member_kasir.php"> Tambah  +</a></center>
    <table border="1" align="center" width="90%">
<tr>
<th>Id Member</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>No Telp</th>
        <th colspan="2">Action</th>
</tr>

<?php
            while($row = mysqli_fetch_assoc($member)){
        ?>
<tr>
<td><?=$row['id']?></td>
<td><?=$row['nama']?></td>
<td><?=$row['alamat']?></td>
<td><?=$row['jenis_kelamin']?></td>
<td><?=$row['tlp']?></td>
<td>
    <a href="../view/update_member_kasir.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
    <a href="../delete/delete_member_kasir.php?id=<?= $row['id'] ?>" class="trash">Hapus</a>
</td>
</tr>
<?php
            }
?>
    </table> -->





</body>
<script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
</html>
