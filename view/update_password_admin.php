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

    $id_user = $_GET['id_user'];

    $query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user ='$id_user'");
    $user_row = mysqli_fetch_assoc($query_user);
?>
<?= template_header('Home') ?>

<div class="flex items-center justify-center h-fit my-10">
    <div class="bg-[#d1d1d1] rounded-md shadow-lg max-w-xl">
        <h2 class="text-2xl font-bold my-3 mx-10">Edit User <?= $user_row['nama'] ?> Password</h2>
        <form action="../update/update_user_password_admin.php" method="post">
            <div class="mb-4">
                <label for="user_id" class="block mx-3 text-gray-700 font-semibold">User ID:</label>
                <input type="text" name="user_id" value="<?= $user_row['id_user'] ?>" class="mt-1 mx-3 focus:ring-indigo-500 focus:border-indigo-500 block w-[90%] shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="new_password" class="block mx-3 text-gray-700 font-semibold">New Password:</label>
                <input type="password" name="new_password" required class="mt-1 mx-3 focus:ring-indigo-500 focus:border-indigo-500 block w-[90%] shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="confirm_new_password" class="block mx-3 text-gray-700 font-semibold">Confirm New Password:</label>
                <input type="password" name="confirm_new_password" required class="mt-1 mx-3 focus:ring-indigo-500 focus:border-indigo-500 block w-[90%] shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <button type="submit" class="w-[90%] mx-3 my-2 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">Update User Password</button>
        </form>
    </div>
</div>

<?= template_footer() ?>
