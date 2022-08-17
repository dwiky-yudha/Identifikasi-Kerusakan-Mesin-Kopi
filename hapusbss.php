<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM tabel_pengetahuan WHERE ID_Pengetahuan='$id'");
header("Location:bss_pengetahuan.php");
?>