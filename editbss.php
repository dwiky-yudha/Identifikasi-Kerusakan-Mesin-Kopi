<?php
include 'config.php';
session_start();

$hslck_krskn = mysqli_query($conn,"SELECT * FROM tabel_kerusakan");
$hslck_gjl = mysqli_query($conn,"SELECT * FROM tabel_gejala");

if(isset($_POST['btneditbss'])){
    $id = $_GET['id'];
    $idkerusakanbss = $_POST['slctidkrskn'];
    $idgejalabss = $_POST['slctidgjl'];
    $nilai_cf = $_POST['slcncf'];

    $cekbisa = mysqli_query($conn,"SELECT * FROM tabel_gejala WHERE ID_Gejala = '$idgejalabss'");
    $dat = mysqli_fetch_array($cekbisa);
    $addnamagejala = $dat['Nama_Gejala']; 

    $ubahbss = "UPDATE tabel_pengetahuan SET ID_Kerusakan='$idkerusakanbss', ID_Gejala='$idgejalabss', Nama_Gejala='$addnamagejala', Nilai_CF='$nilai_cf' WHERE ID_Pengetahuan='$id'";
    $queryubahbss = mysqli_query($conn,$ubahbss);
    header("location:bss_pengetahuan.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Basis Pengetahuan</title>
</head>
<body class="bgadmin">
    <script src="script.js"></script>
    <nav class="navbaradmin">
            <p>Admin Page<br>Expert System</p><br>
            <a href="data_kerusakan.php" class="admdtker">Data Kerusakan</a><br><br>
            <a href="data_gejala.php" class="admdtgej">Data Gejala</a><br><br>
            <a href="bss_pengetahuan.php" class="admdtbp aktifnavadm">Basis Pengetahuan</a><br><br>
            <button onclick="lanjut()" class="btnlogoutadmin">LOG OUT</button>
            </nav>
    <section class="lytbasis">
            <center><h1>UPDATE DATA BASIS PENGETAHUAN</h1></center>
            <form action="" method="post">
                <center><table class="tbltbhbss">
                    <tr>
                        <td>ID Pengetahuan</td><td>:</td>
                        <td><input width="100px" type="text" name="inpidbss" maxlength="5" placeholder="<?php $idbss = $_GET['id']; echo $idbss; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>ID Kerusakan</td><td>:</td>
                        <td>
                            <select name="slctidkrskn" >
                                <option value="0" selected>-= Pilih Kerusakan =-</option>
                                <?php while($datk = mysqli_fetch_array($hslck_krskn)){?>
                                <option value="<?php echo $datk['ID_Kerusakan'] ?>"><?php echo $datk['ID_Kerusakan']." --> ".$datk['Nama_Kerusakan'] ?></option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>ID Gejala</td><td>:</td>
                        <td>
                            <select name="slctidgjl" onchange="ubahid()" id="slctidgjl">  
                                <option value="0" selected disabled>-= Pilih Gejala =-</option>
                                <?php while($datg = mysqli_fetch_array($hslck_gjl)){?>
                                <option value="<?php echo $datg['ID_Gejala'] ?>"><?php echo $datg['ID_Gejala']." --> ".$datg['Nama_Gejala'] ?></option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    <td>Nilai Certainty Factor</td><td>:</td>
                        <td>
                            <select name="slcncf">
                                <option value="0" selected>-= Pilih Nilai CF =-</option>
                                <?php $counter_ncf = 0.1; for($i=1;$i <= 10; $i++){?>
                                <option value="<?php echo $counter_ncf; ?>"><?php echo $counter_ncf; $counter_ncf = $counter_ncf + 0.1; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table></center>
                <center><button name="btneditbss" class="btndtbss">UPDATE BASIS PENGETAHUAN</button></center>
            </form>
            
        </section>
</body>
</html>