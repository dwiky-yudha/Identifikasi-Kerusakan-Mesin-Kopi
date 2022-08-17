<?php
include 'config.php';
session_start();

$query_kodegejala = mysqli_query($conn, "SELECT max(ID_Gejala) as kodeid FROM tabel_gejala");
$mgejala = mysqli_fetch_array($query_kodegejala);
$kodegejala  = $mgejala['kodeid'];
$sort_kode = (int) substr($kodegejala,1,2);
$sort_kode++;
$hurufkode_gejala = "G";
$kodegejala = $hurufkode_gejala.sprintf("%02s",$sort_kode);

if(isset($_POST['btntbhgjl'])){
    $idgejala = $kodegejala;
    $nmgejala = $_POST['inpnmgjl'];
    $confirmid = 0;
    $confirmnama = 0;

    $sqltambah_gejala = "SELECT * FROM tabel_gejala ";
    $untukcek = mysqli_query($conn,$sqltambah_gejala);
    while($cekada = mysqli_fetch_array($untukcek)){
        if($idgejala == $cekada['ID_Gejala']){
            $confirmid = $confirmid + 1;
        }else if($nmgejala == $cekada['Nama_Gejala']){
            $confirmnama = $confirmnama + 1;
        }
    }
    if(($confirmid == 0) AND ($confirmnama == 0)){
        header("Location:data_gejala.php");
        $sqltambah = "INSERT INTO tabel_gejala VALUES ('$idgejala','$nmgejala')";
        $completedatatambah = mysqli_query($conn,$sqltambah);
    }else if($confirmid <> 0){
        echo "<script>alert('ID gejala telah terdaftar, masukkan id gejala lain')</script>";
    }else if($confirmnama <> 0){
        echo "<script>alert('Nama gejala telah terdaftar, masukkan nama gejala lain')</script>";
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
            <center><h1>TAMBAH DATA GEJALA</h1></center>
            <form action="" method="post">
                <center><table class="tbltbhgjl">
                    <tr>
                        <td>ID Gejala</td><td>:</td>
                        <td><input width="100px" type="text" name="inpidgjl" maxlength="5" placeholder="<?php echo $kodegejala ?>" required disabled></td>
                    </tr>
                    <tr>
                        <td>Nama Gejala</td><td>:</td>
                        <td><input width="200px"type="text" name="inpnmgjl" placeholder="NAMA GEJALA" required></td>
                    </tr>
                </table></center>
                <center><button name="btntbhgjl" class="btndtgjl">TAMBAH GEJALA</button></center>
            </form>  
        </section>
</body>
</html>