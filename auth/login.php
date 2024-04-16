<?php
session_start();

include '../koneksi.php';


function hashCookieValue($value) {
    $salt = "s3cr3t"; 
    return hash('sha256', $value . $salt);
}


function setLoginCookie($username, $role) {
    $cookie_name = $username;
    $cookie_value = $username ;
    $hashed_value = hashCookieValue($cookie_value); 
    $expiry_time = time() + (86400 * 30);

    // Atur cookie
    setcookie($cookie_name, $hashed_value, $expiry_time, "/");
}

if(isset($_SESSION["login"])){
    header("location: ../admin/index.php");
    exit;
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM tb_user WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) === 1){
        $data = mysqli_fetch_assoc($result);
        if(password_verify($password, $data["password"])){
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $data['role'];
            $_SESSION['id_outlet'] = $data['id_outlet'];
            $_SESSION['id_user'] = $data['id_user'];

            // Panggil fungsi untuk mengatur cookie
            setLoginCookie($username, $data['role']);

            switch($data['role']){
                case 'admin':
                    echo "<script>alert('Selamat Anda Berhasil Login sebagai admin!'); window.location='../admin/index.php';</script>";
                    exit;
                case 'kasir':
                    echo "<script>alert('Selamat Anda Berhasil Login sebagai kasir!'); window.location='../kasir/index.php';</script>";
                    exit;
                case 'owner':
                    echo "<script>alert('Selamat Anda Berhasil Login sebagai owner!'); window.location='../owner/index.php';</script>";
                    exit;
            }
            
        }else{
            header("location:login.php?pesan=gagal");
            exit;
        }
    }else{
        header("location:login.php?pesan=gagal");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body>
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="gagal"){
            echo "<script>alert('Username atau password salah');window.location='../auth/login.php';</script>";
        }
    }
    ?>

    <div class="flex h-full w-full mt-10">
        <div class="w-1/2 flex items-center justify-center ">
            <div class="text-left mx-10 w-full">
                <p class="text-[28px] font-semibold">Selamat Datang !</p>
                <p class="text-[#656667] text-[18px] font-semibold mb-9">Silakan Login Ke Akun Anda</p>
                <form action="" method="POST">
                    <p class="text-[18px] font-semibold text-[#414141]">Username :</p>
                    <input type="text" name="username" class="w-[100%] bg-[#D9D9D9] py-1.5 rounded-lg mb-6">
                    <p class="text-[18px] font-semibold text-[#414141]">Password :</p>
                    <input type="password" name="password" class="w-[100%] bg-[#D9D9D9] py-1.5 rounded-lg mb-6">
                    <div class="flex items-center mb-6  font-semibold text-[#414141]">
                        <input type="checkbox" id="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out">
                        <label for="checkbox" class="ml-3">Ingatkan Saya</label>
                    </div> 
                    <button type="submit" name="login" class="w-[100%] bg-[#237ED9] text-[20px] text-white font-semibold py-1 rounded-lg">Login</button>
                </form>
            </div>
        </div>
        <div class="w-1/2 flex items-center justify-center">
            <div class="space-y-4 text-center">
                <img src="../img/loginimg.png" alt="" srcset="">
            </div>
        </div>
    </div>
</body>
</html>
