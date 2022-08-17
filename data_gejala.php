<?php
include 'config.php';
session_start();

$dt_gjl = "SELECT * FROM tabel_gejala";
$hslck_gjl = mysqli_query($conn,$dt_gjl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Gejala</title>
</head>
<body class="bgadmin">
    <script src="script.js"></script>
    <nav class="navbaradmin">
            <p>Admin Page<br>Expert System</p><br>
            <a href="data_kerusakan.php" class="admdtker">Data Kerusakan</a><br><br>
            <a href="#" class="admdtgej aktifnavadm">Data Gejala</a><br><br>
            <a href="bss_pengetahuan.php" class="admdtbp">Basis Pengetahuan</a><br><br>
            <button onclick="lanjut()" class="btnlogoutadmin">LOG OUT</button>
            </nav>
    <section class="kontenadmin lytgejala">
            <center><h1>DATA GEJALA</h1></center>
            <a href="tambahgjl.php" class="tmbhgejala">+ DATA GEJALA</a>
            <table class="tblgejala">
                <tr>
                    <td width="20px">ID Gejala</td>
                    <td width="350px">Nama Gejala</td>
                    <td colspan="2">Edit Data</td>
                </tr>
            <?php while($dat = mysqli_fetch_array($hslck_gjl)){?>
                <tr>
                    <td width="20px"><?php echo $dat['ID_Gejala']; ?></td>
                    <td width="350px"><?php echo $dat['Nama_Gejala']; ?></td>
                    <td><a href="editgjl.php?id=<?php echo $dat['ID_Gejala'] ?>">EDIT</a></td>
                    <td><a href="hapusgjl.php?id=<?php echo $dat['ID_Gejala'] ?>">HAPUS</a></td>
                </tr>
            <?php } ?>
            </table>
        </section>
</body>
</html>