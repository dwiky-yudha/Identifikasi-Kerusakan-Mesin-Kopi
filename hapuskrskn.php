<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM tabel_kerusakan WHERE ID_Kerusakan='$id'");
header("Location:data_kerusakan.php");
?>