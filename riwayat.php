<?php
include 'config.php';
session_start();

$akunygditampil_riwayat = $_SESSION['Username'];
$ambildt_riwayat = "SELECT * FROM tabel_identifikasi";
$queryambildata_riwayat = mysqli_query($conn,$ambildt_riwayat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Riwayat</title>
</head>
<body class="bg1">
    <script src="script.js"></script>
    <nav class="navbaruser" >
        <h1>Experts System</h1>
        <a href="profil.php" class="navprofil">Profil</a>
        <a href="konsultasi.php" class="navkonsul">Konsultasi</a>
        <a href="riwayat.php" class="navriwayat aktif">Riwayat</a>
        <button onclick="lanjut()" class="btnlogout">LOGOUT</button>
    </nav>
    <section class="kontenuser">
        <div class="isikontenriwayat">
        <center><h1>Riwayat Konsultasi Akun <?php echo $_SESSION['Username'] ?></h1></center>
        <center><table class="tabelriwayatuser">
            <tr>
                <th>ID Identifikasi</th>
                <th>Username</th>
                <th>ID Kerusakan</th>
                <th>Tanggal</th>
                <th>Nilai CF</th>
                <th>Gejala Kerusakan Terpilih</th>
            </tr>
            <?php while($r = mysqli_fetch_array($queryambildata_riwayat)){?>
            <?php if($r['Username'] == $akunygditampil_riwayat){ ?>
                <tr>
                    <td><?php echo $r['ID_Identifikasi']; ?></td>
                    <td><?php echo $r['Username']; ?></td>
                    <td><?php echo $r['ID_Kerusakan']; ?></td>
                    <td><?php echo $r['Tanggal_Identifikasi']; ?></td>
                    <td><?php echo $r['Nilai_CF']; ?></td>
                    <td><?php echo $r['Gejala_Terpilih']; ?></td>    
                </tr>
            <?php } ?>
            <?php } ?>
        </table></center>
        </div>
    </section>
</body>
</html>