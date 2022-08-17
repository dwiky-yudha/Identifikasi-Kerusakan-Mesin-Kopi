<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM tabel_gejala WHERE ID_Gejala='$id'");
header("Location:data_gejala.php");
?>