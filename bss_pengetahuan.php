<?php
include 'config.php';
session_start();

$dt_bss = "SELECT * FROM tabel_pengetahuan";
$hslck_bss = mysqli_query($conn,$dt_bss);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Basis Pengetahuan</title>
</head>
<body class="bgadmin">
    <script src="script.js"></script>
    <nav class="navbaradmin">
            <p>Admin Page<br>Expert System</p><br>
            <a href="data_kerusakan.php" class="admdtker">Data Kerusakan</a><br><br>
            <a href="data_gejala.php" class="admdtgej">Data Gejala</a><br><br>
            <a href="#" class="admdtbp aktifnavadm">Basis Pengetahuan</a><br><br>
            <button onclick="lanjut()" class="btnlogoutadmin">LOG OUT</button>
            </nav>
    <section class="kontenadmin lytbasis">
            <center><h1>DATA BASIS PENGETAHUAN</h1></center>
            <a href="tambahbss.php" class="tmbhbasis">+ DATA BASIS PENGETAHUAN</a>
            <table class="tblbasis">
                <tr>
                    <td>ID Pengetahuan</td>
                    <td>ID Kerusakan</td>
                    <td>ID Gejala</td>
                    <td>Nama Gejala</td>
                    <td>Nilai CF</td>
                    <td colspan="2">Edit Data</td>
                </tr>
            <?php while($dat = mysqli_fetch_array($hslck_bss)){?>
                <tr>
                    <td width="20px"><?php echo $dat['ID_Pengetahuan']; ?></td>
                    <td width="20px"><?php echo $dat['ID_Kerusakan']; ?></td>
                    <td width="20px"><?php echo $dat['ID_Gejala']; ?></td>
                    <td width="100px"><?php echo $dat['Nama_Gejala']; ?></td>
                    <td width="20px"><?php echo $dat['Nilai_CF']; ?></td>
                    <td><a href="editbss.php?id=<?php echo $dat['ID_Pengetahuan'] ?>">EDIT</a></td>
                    <td><a href="hapusbss.php?id=<?php echo $dat['ID_Pengetahuan'] ?>">HAPUS</a></td>
                </tr>
            <?php } ?>
            </table>
        </form>
    </section>
</body>
</html>