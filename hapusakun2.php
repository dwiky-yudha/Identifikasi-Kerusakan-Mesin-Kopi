<?php
    include 'config.php';
    session_start();
    $akundihapus = $_SESSION['Username'];
    $hapus = "DELETE FROM tabel_pengguna WHERE Username='$akundihapus'";
    $proses_hapus = mysqli_query($conn, $hapus);
    if($proses_hapus){
        header("Location:logout.php");}
?>




