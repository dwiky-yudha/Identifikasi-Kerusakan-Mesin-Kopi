<?php
include 'config.php';
session_start();

$query_kodekerusakan = mysqli_query($conn, "SELECT max(ID_Kerusakan) as kodeid FROM tabel_kerusakan");
$mkerusakan = mysqli_fetch_array($query_kodekerusakan);
$kodekerusakan  = $mkerusakan['kodeid'];
$sort_kode = (int) substr($kodekerusakan,1,2);
$sort_kode++;
$hurufkode_kerusakan = "K";
$kodekerusakan = $hurufkode_kerusakan.sprintf("%02s",$sort_kode);

if(isset($_POST['btntbhkrskn'])){
    $idkerusakan = $kodekerusakan;
    $nmkerusakan = $_POST['inpnmkrskn'];
    $slskerusakan = $_POST['inpslskrskn'];
    $ktrkerusakan = $_POST['inpktrkrskn'];

    $cfrmid = 0;
    $cfrmnm = 0;

    $sqladd_kerusakan =  "SELECT * FROM tabel_kerusakan";
    $hasilcek = mysqli_query($conn,$sqladd_kerusakan);
    while($scandat = mysqli_fetch_array($hasilcek)){
        if($idkerusakan == $scandat['ID_Kerusakan']){
            $cfrmid = $cfrmid + 1;
        }else if($nmkerusakan == $scandat['Nama_Kerusakan']){
            $cfrmnm = $cfrmnm + 1;
        }
    }
    if(($cfrmid == 0) AND ($cfrmnm == 0)){
        header("location:data_kerusakan.php");
        $tambah = "INSERT INTO tabel_kerusakan VALUES ('$idkerusakan', '$nmkerusakan', '$slskerusakan', '$ktrkerusakan')";
        $querytambah = mysqli_query($conn, $tambah); 
        }else if($cfrmid <> 0){
            echo "<script>alert('ID Kerusakan telah terdaftar, masukkan id kerusakan lain')</script>";
        }else if($cfrmnm <> 0){
            echo "<script>alert('Nama Kerusakan telah terdaftar, masukkan nama kerusakan lain')</script>";
    }
}


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
            <center><h1>TAMBAH DATA KERUSAKAN</h1></center>
            <form action="" method="post">
                <center><table class="tbltbhkrskn">
                    <tr>
                        <td>ID Kerusakan</td><td>:</td>
                        <td><input width="100px" type="text" name="inpidkrskn" maxlength="5" placeholder="<?php echo $kodekerusakan?>" required disabled></td>
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
                <center><button name="btntbhkrskn" class="btndtkrskn">TAMBAH KERUSAKAN</button></center>
            </form>
            
        </section>
</body>
</html>