<?php
$koneksi = mysqli_connect("localhost","root","","Myloundry");

function registrasi($data)
{
    global $koneksi;

    $nama = strtolower(stripslashes($data["nama"]));
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $id_outlet = mysqli_real_escape_string($koneksi,$data["id_outlet"]);
    $role = mysqli_real_escape_string($koneksi, $data["role"]);



    //cek username sudah atau belum supaya tidak ada user yang sama 
    $result = mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username = '$username' ");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                    alert('Userame Yang Anda Masukan Sudah Terdaftar ')
                </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi Password Tidak Sesuai ');
            </script>";
        return false;
    }


    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);



    // tambahkan user baru ke dalam databse
mysqli_query($koneksi, "INSERT INTO tb_user VALUES(0,'$nama', '$username','$password','$id_outlet','$role') ");
    return mysqli_affected_rows($koneksi);
}

?>