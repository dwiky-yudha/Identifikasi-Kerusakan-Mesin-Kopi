<?php
include 'config.php';
error_reporting(0);
session_start();

if(isset($_SESSION['Username'])){
    header("Location:loginuser.php");
}

if(isset($_POST['registrasi'])){
    $username = $_POST['userreg'];
    $email = $_POST['emailuser'];
    $age = $_POST['umuruser'];
    $address = $_POST['alamatuser'];
    $password = $_POST['pwuserreg'];
    $cppassword = $_POST['cpwuserreg'];

    if($password == $cppassword){
        $sqlreg = "SELECT * FROM tabel_pengguna WHERE Email='$email' AND Username='$username'";
        $hslreg = mysqli_query($conn,$sqlreg);
        if(!$hslreg->num_rows > 0){
            $sqlreg = "INSERT INTO tabel_pengguna (Username, Email, Umur, Alamat, Kata_Kunci) VALUES ('$username','$email','$age','$address','$password')";
            $hslreg = mysqli_query($conn,$sqlreg);
            if($hslreg){
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $email = "";
                $age = "";
                $address = "";
                $password = "";
                $cppassword = "";
            } else {
                echo "<script>alert('Terjadi Kesalahan')</script>";
            }
        } else {
            echo "<script>alert('Email atau Username sudah terdaftar')</script>";
        }
    } else {
        echo "<script>alert('Password tidak sesuai')</script>";
    }
}
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
        <h1 class="logintext">Register</h1>
        <form action="" method="post">
            <input type="hidden" name="tujuan" value="LOGIN">

            <div class="boxinput">
                <input type="text" name="userreg" placeholder="USERNAME" value="<?php echo $username; ?>" required>
            </div>
            <div class="boxinput">
                <input type="email" name="emailuser" placeholder="EMAIL" value="<?php echo $email; ?>" required>
            </div>
            <div class="boxinput">
                <input type="number" name="umuruser" placeholder="AGE" value="<?php echo $age; ?>" required>
            </div>
            <div class="boxinput">
                <input type="text" name="alamatuser" placeholder="ADDRESS" value="<?php echo $address; ?>" required>
            </div>
            <div class="boxinput">
                <input type="password" name="pwuserreg" placeholder="PASSWORD" value="<?php echo $password; ?>" required>
            </div>
            <div class="boxinput">
                <input type="password" name="cpwuserreg" placeholder="CONFIRM PASSWORD" value="<?php echo $cppassword; ?>" required>
            </div>
            <br>
            <div class="boxinput">
                <button name="registrasi">REGIST</button>
            </div>
            <br>
            </form>
            <div class="teksbacklogin">
                <p>Sudah Punya Akun ? Silahkan Klik <a href="loginuser.php">di sini</a></p>
            </div>
    </div>
</body>
</html>