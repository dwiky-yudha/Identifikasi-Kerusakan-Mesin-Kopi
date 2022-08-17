<?php
include 'config.php';
session_start();
$akunadmin ="";
$sqladminpage = "SELECT * FROM tabel_admin WHERE Admname = '$akunadmin'";
$hslqueryadm = mysqli_query($conn,$sqladminpage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Homepage</title>
</head>
<body class="bgadmin">
    <script src="script.js"></script>
    <nav class="navbaradmin">
            <p>Admin Page<br>Expert System</p><br>
            <a href="data_kerusakan.php" class="admdtker">Data Kerusakan</a><br><br>
            <a href="data_gejala.php" class="admdtgej">Data Gejala</a><br><br>
            <a href="bss_pengetahuan.php" class="admdtbp">Basis Pengetahuan</a><br><br>
            <button onclick="lanjut()" class="btnlogoutadmin">LOG OUT</button>
            </nav>
    <section class="kontenadmin homepage">
            <center><h1>SELAMAT DATANG <?php print_r($_SESSION['Admname'])?></h1></center>
            <center><h3>Silahkan pilih menu disamping :)</h3></center>
    </section>
</body>
</html>