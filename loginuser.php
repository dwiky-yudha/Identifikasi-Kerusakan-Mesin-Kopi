<?php 
include 'config.php';
error_reporting(0);
session_start();

if(isset($_SESSION['Username'])){
    header("Location:profil.php");
}
if(isset($_POST['submitlguser'])){
    $lguser = $_POST["userlog"];
    $pwuser = $_POST["pwuser"];

    $query_sql = "SELECT * FROM tabel_pengguna WHERE Username = '$lguser' AND Kata_Kunci = '$pwuser'";
    $result = mysqli_query($conn, $query_sql);

    if($result->num_rows > 0){
        $baris = mysqli_fetch_assoc($result);
        $_SESSION['Username'] = $baris['Username'];
        header("Location:profil.php");
    } else {
        echo "<script>alert('Username atau password Anda salah')</script>";
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
        <h1 class="logintext">Login</h1>
        <div class="switchau">
            <div class="switcher front"><a href="#" class="switcher-a">USER</a></div>
            <div class="switcher back"><a href="loginadmin.php" class="switcher-a">ADMIN</a></div>
        </div>
        <form action="" method="post">

            <div class="boxinput">
                <input type="text" name="userlog" placeholder="USERNAME" value="<?php echo $lguser; ?>">
            </div>
            <div class="boxinput">
                <input type="password" name="pwuser" placeholder="PASSWORD" value="<?php echo $pwuser; ?>">
            </div>
            <br>
            <div class="boxinput">
                <button name="submitlguser">LOGIN</button>
            </div>
            <br>
            <div class="boxregister">
                <a href="register.php">Register</a>
            </div>
        </form>
    </div>
</body>
</html>