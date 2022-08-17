<?php
include 'config.php';
session_start();

$dt_krskn = "SELECT * FROM tabel_kerusakan";
$hslck_krskn = mysqli_query($conn,$dt_krskn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Kerusakan</title>
</head>
<body class="bgadmin">
    <script src="script.js"></script>
    <nav class="navbaradmin">
            <p>Admin Page<br>Expert System</p><br>
            <a href="#" class="admdtker aktifnavadm">Data Kerusakan</a><br><br>
            <a href="data_gejala.php" class="admdtgej">Data Gejala</a><br><br>
            <a href="bss_pengetahuan.php" class="admdtbp">Basis Pengetahuan</a><br><br>
            <button onclick="lanjut()" class="btnlogoutadmin">LOG OUT</button>
    </nav>
    <section class="kontenadmin lytkerusakan">
            <center><h1>DATA KERUSAKAN</h1></center>
            <a href="tambahkrskn.php" class="tmbhkerusakan">+ DATA KERUSAKAN</a>
            <table class="tblkerusakan">
                <tr>
                    <td width="20px">ID Kerusakan</td>
                    <td width="200px">Nama Kerusakan</td>
                    <td width="400px">Solusi</td>
                    <td width="400px">Perkiraan Harga</td>
                    <td colspan="2"> Edit Data</td>
                </tr>
            <?php while($dat = mysqli_fetch_array($hslck_krskn)){?>
                <tr>
                    <td width="20px"><?php echo $dat['ID_Kerusakan']; ?></td>
                    <td width="200px"><?php echo $dat['Nama_Kerusakan']; ?></td>
                    <td width="200px"><?php echo $dat['Solusi']; ?></td>
                    <td width="200px"><?php echo $dat['Keterangan']; ?></td>
                    <td><a href="editkrskn.php?id=<?php echo $dat['ID_Kerusakan'] ?>">EDIT</a></td>
                    <td><a href="hapuskrskn.php?id=<?php echo $dat['ID_Kerusakan'] ?>">HAPUS</a></td>
                </tr>
            <?php } ?>
            </table>
        </section>
</body>
</html>