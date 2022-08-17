<?php
include 'config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profil</title>
</head>
<body class="bg1">
    <script src="script.js"></script>
    <nav class="navbaruser" >
        <h1>Experts System</h1>
        <a href="#" class="navprofil aktif">Profil</a>
        <a href="konsultasi.php" class="navkonsul">Konsultasi</a>
        <a href="riwayat.php" class="navriwayat">Riwayat</a>
        <button onclick="lanjut()" class="btnlogout">LOGOUT</button>
    </nav>
    <section class="kontenuser">
        <div class="isikontenprofil">
        <form action="" method="post">
        <center><h1>PROFIL <?php print_r($_SESSION['Username'])?></h1></center>
        <table class="tabel_profil">
            <?php 
            $profil = $_SESSION['Username'];
            $query_profil = "SELECT * FROM tabel_pengguna WHERE Username= '$profil'";
            $hasil_profil = mysqli_query($conn,$query_profil);
            while($x = mysqli_fetch_array($hasil_profil)){
                echo "<tr> <td>Username</td> <td>:</td> <td>".$x['Username']."</td> </tr>";
                echo "<tr> <td>Email</td> <td>:</td> <td>".$x['Email']."</td> </tr>";
                echo "<tr> <td>Umur</td> <td>:</td> <td>".$x['Umur']."</td> </tr>";
                echo "<tr> <td>Alamat</td> <td>:</td> <td>".$x['Alamat']."</td> </tr>";
            }
            ?>
        </table>
        <br>
        <div class="btnprofil">    
            <a href="gantipassword.php">GANTI PASSWORD</a>
        </div>
        <br>
        <div class="btnprofil">    
            <a onclick="delakun()">HAPUS AKUN</a>
        </div>
        <br>
        </form>
        </div>
    </section>
</body>
</html>