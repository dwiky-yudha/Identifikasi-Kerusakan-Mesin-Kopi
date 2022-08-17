<?php 
include 'config.php';
error_reporting(0);
session_start();
if(isset($_SESSION['Admname'])){
    header("Location:index.php");
}

if(isset($_POST['submitlgadmin'])){
    $lgadmin = $_POST["adminlog"];
    $pwadmin = $_POST["pwadmin"];

    $sqladmin = "SELECT * FROM tabel_admin WHERE Admname = '$lgadmin' AND Kata_Kunci = '$pwadmin'";
    $hsladmin = mysqli_query($conn, $sqladmin);

    if($hsladmin->num_rows > 0){
        $brsadmin = mysqli_fetch_assoc($hsladmin);
        $_SESSION['Admname'] = $brsadmin['Admname'];
        header("Location:admin_homepage.php");
    } else {
        echo "<script>alert('Adminname atau password Anda salah')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Admin</title>
</head>
<body class=bg1>
    <div class="boxlogin">
        <h1 class="logintext">Login</h1>
        <div class="switchau">
            <div class="switcher front"><a href="#" class="switcher-a">ADMIN</a></div>
            <div class="switcher back"><a href="loginuser.php" class="switcher-a">USER</a></div>
        </div>
        <form action="" method="post">

            <div class="boxinput">
                <input type="text" name="adminlog" placeholder="ADMINNAME" value="<?php echo $lgadmin; ?>">
            </div>
            <div class="boxinput">
                <input type="password" name="pwadmin" placeholder="PASSWORD" value="<?php echo $pwadmin; ?>">
            </div>
            <br>
            <div class="boxinput">
                <button name="submitlgadmin">LOGIN</button>
            </div>
        </form>
    </div>
</body>
</html>