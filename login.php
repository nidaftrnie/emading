<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="assets/style/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <label for="chk" aria-hidden="true" class=""><br>Welcome to JeWePe
                <br>e-Mading, Admin!
            </label>
        </div>

        <div class="login">
            <form id="formAuthentification" action="cek_login.php" method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button name="submit" type="submit">Login</button>
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == 'gagal') {
                        echo '<i class="text-danger">Login Gagal! Username atau Password tidak sesuai!</i>';
                    } else if ($_GET['pesan'] == 'empty') {
                        echo '<i class="text-danger">Username dan Password tidak boleh kosong!</i>';
                    } else if ($_GET['pesan'] == 'notfound') {
                        echo '<i class="text-danger">Username tidak ditemukan!</i>';
                    } else if ($_GET['pesan'] == 'notlogin') {
                        echo '<i class="text-danger">Anda harus login untuk mengakses halaman admin!</i>';
                    } else if ($_GET['pesan'] == 'logout') {
                        echo '<i class="text-success">Anda telah berhasil logout!</i>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>