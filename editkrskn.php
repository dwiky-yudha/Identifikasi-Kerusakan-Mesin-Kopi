<?php
include 'config.php';
session_start();

if(isset($_POST['btneditkrskn'])){
    $id = $_GET['id'];
    $nmkerusakan = $_POST['inpnmkrskn'];
    $slskerusakan = $_POST['inpslskrskn'];
    $ktrkerusakan = $_POST['inpktrkrskn'];

    $cfrmnm = 0;

    $sqladd_kerusakan =  "SELECT * FROM tabel_kerusakan";
    $hasilcek = mysqli_query($conn,$sqladd_kerusakan);
    while($scandat = mysqli_fetch_array($hasilcek)){
        if($nmkerusakan == $scandat['Nama_Kerusakan']){
            $cfrmnm = $cfrmnm + 1;
        }
    }
    if($cfrmnm == 0){
            header("location:data_kerusakan.php");
            $updatekerusakan = "UPDATE tabel_kerusakan SET Nama_Kerusakan='$nmkerusakan', Solusi='$slskerusakan', Keterangan='$ktrkerusakan' WHERE ID_Kerusakan='$id'";
            $queryupdatekerusakan = mysqli_query($conn,$updatekerusakan);
        }else{
            echo "<script>alert('Nama Kerusakan telah terdaftar, masukkan nama kerusakan lain')</script>";
    }
}
$idkerusakan = $_GET['id'];


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
            <a href="data_kerusakan.php" class="admdtker aktifnavadm">Data Kerusakan</a><br><br>
            <a href="data_gejala.php" class="admdtgej">Data Gejala</a><br><br>
            <a href="bss_pengetahuan.php" class="admdtbp">Basis Pengetahuan</a><br><br>
            <button onclick="lanjut()" class="btnlogoutadmin">LOG OUT</button>
            </nav>
    <section class="lytkerusakan">
            <center><h1>UPDATE DATA KERUSAKAN</h1></center>
            <form action="" method="post">
                <center><table class="tbltbhkrskn">
                    <tr>
                        <td>ID Kerusakan</td><td>:</td>
                        <td><input width="100px" type="text" name="inpidkrskn" maxlength="5" placeholder="<?php echo $idkerusakan ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Nama Kerusakan</td><td>:</td>
                        <td><input width="200px" type="text" name="inpnmkrskn" placeholder="NAMA KERUSAKAN" required></td>
                    </tr>
                    <tr>
                        <td>Solusi Kerusakan</td><td>:</td>
                        <td><input type="text" name="inpslskrskn" placeholder="SOLUSI KERUSAKAN" required></td>
                    </tr>
                    <tr>
                        <td>Perkiraan Harga</td><td>:</td>
                        <td><input type="text" name="inpktrkrskn" placeholder="PERKIRAAN HARGA" required></td>
                    </tr>
                </table></center>
                <center><button name="btneditkrskn" class="btndtkrskn">UPDATE KERUSAKAN</button></center>
            </form>
            
        </section>
</body>
</html>