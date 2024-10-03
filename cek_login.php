<?php
// $pass = password_hash('admin123', PASSWORD_DEFAULT); 
// var_dump($pass);
// die;
include('assets/admin/template/config_query.php');
$db = new database();
//inisialisasi session
session_start();
//Cek Session aktif?
if (isset($_SESSION['username']) || isset($_SESSION['id_users'])) {
    header('location: assets/admin/index.php');
} else {
    //Cek apakah form disubmit? 
    if (isset($_POST['submit'])) {
        //menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);
        //Cek Nilai username password apakah kosong?
        if (!empty(trim($username)) && !empty(trim($password))) {
            //select data tb_users berdasarkan username
            $query = $db->get_data_users($username);
            if ($query) {
                $rows = mysqli_num_rows($query);
            } else {
                $rows = 0;
            }
            //Cek ketersediaan data username
            if ($rows != 0) {
                $getData = $query->fetch_assoc();
                if (password_verify($password, $getData['password'])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['id_users'] = $getData['id_users'];
                    header('location: assets/admin/index.php');
                } else {
                    header("location:./login.php?pesan=gagal");
                }
            } else {
                header("location:./login.php?pesan=notfound");
            }
        } else {
            header("location:./login.php?pesan=empty");
        }
    } else {
        header("location:./login.php?pesan=empty");
    }
}
