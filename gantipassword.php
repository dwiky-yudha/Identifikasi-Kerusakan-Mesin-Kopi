<?php 
include 'config.php';
session_start();

$akunubhpw = $_SESSION['Username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login User</title>
</head>
<body class=bg1>
    <div class="boxlogin">
        <h1 class="logintext">GANTI PASSWORD</h1>
        <h1 class="logintext"><?php print_r($_SESSION['Username']); ?></h1>
        <br>
        <form action="" method="post">
            <div class="boxinput">
                <input type="password" name="pwlama" placeholder="OLD PASSWORD">
            </div>
            <div class="boxinput">
                <input type="password" name="pwbaru" placeholder="NEW PASSWORD">
            </div>
            <div class="boxinput">
                <input type="password" name="cpwbaru" placeholder="CONFIRM PASSWORD">
            </div>
            <br>
            <div class="boxinput">
                <button name="submitubhpw">CHANGE</button>
            </div>
        </form>
<?php
if(isset($_POST['submitubhpw'])){
    $akunuser = $_SESSION['Username'];
    $password_lama = $_POST['pwlama'];
    $password_baru = $_POST['pwbaru'];
    $konfirmasi_password = $_POST['cpwbaru'];
    $cek_password = "SELECT * FROM tabel_pengguna WHERE Kata_Kunci='$password_lama'";
    $sqlpw = mysqli_query($conn,$cek_password);
    $baris_data = mysqli_num_rows($sqlpw);
    if(!$baris_data >=1){
        echo "<script>alert('Password lama tidak sesuai!!!')</script>";
    }else if(empty($_POST['pwbaru'])||empty($_POST['cpwbaru'])){
        echo "<script>alert('Masukkkan Password Baru')</script>";
    }else if(($_POST['pwbaru'])!=($_POST['cpwbaru'])){
        echo "<script>alert('Password Baru dan Konfirmasi Password Tidak Sama!!!')</script>";
    }else{
        $ubah_password ="UPDATE tabel_pengguna SET Kata_Kunci='$password_baru' WHERE Username='$akunuser'";
        $sqlubhpw = mysqli_query($conn,$ubah_password);
        if($sqlubhpw){
            echo "<script>alert('Ganti Password Berhasil')</script>";
            echo "<script>document.location='profil.php'</script>";
        }else{
            echo "<script>alert('Ganti Password Gagal')</script>";
        }
    }
}
?>
    </div>
</body>
</html>