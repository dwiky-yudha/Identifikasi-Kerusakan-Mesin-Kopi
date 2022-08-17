<?php
include 'config.php';
session_start();
if(isset($_POST['btneditgjl'])){
    $id = $_GET['id'];
    $idgejala = $_POST['inpidgjl'];
    $nmgejala = $_POST['inpnmgjl'];
    $confirmnama = 0;

    $sqltambah_gejala = "SELECT * FROM tabel_gejala ";
    $untukcek = mysqli_query($conn,$sqltambah_gejala);
    while($cekada = mysqli_fetch_array($untukcek)){
        if($nmgejala == $cekada['Nama_Gejala']){
            $confirmnama = $confirmnama + 1;
        }
    }
    if($confirmnama == 0){
        header("Location:data_gejala.php");
        $sqltambah = "UPDATE tabel_gejala SET Nama_Gejala='$nmgejala' WHERE ID_Gejala='$id'";
        $completedatatambah = mysqli_query($conn,$sqltambah);
    }else if($confirmnama <> 0){
        echo "<script>alert('Nama gejala telah terdaftar, masukkan nama gejala lain')</script>";
    }
}
$idgejala = $_GET['id'];
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
            <a href="data_gejala.php" class="admdtgej aktifnavadm">Data Gejala</a><br><br>
            <a href="bss_pengetahuan.php" class="admdtbp">Basis Pengetahuan</a><br><br>
            <button onclick="lanjut()" class="btnlogoutadmin">LOG OUT</button>
            </nav>
    <section class="lytgejala">
            <center><h1>UPDATE DATA GEJALA</h1></center>
            <form action="" method="post">
                <center><table class="tbltbhgjl">
                    <tr>
                        <td>ID Gejala</td><td>:</td>
                        <td><input width="100px" type="text" name="inpidgjl" maxlength="5" placeholder="<?php echo $idgejala ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Nama Gejala</td><td>:</td>
                        <td><input width="200px" type="text" name="inpnmgjl" placeholder="Masukkan Nama Gejala" required></td>
                    </tr>
                </table></center>
                <center><button name="btneditgjl" class="btndtgjl">UPDATE GEJALA</button></center>
            </form>  
        </section>
</body>
</html>