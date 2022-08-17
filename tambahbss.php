<?php
include 'config.php';
error_reporting(0);
session_start();

$query_kodebss = mysqli_query($conn, "SELECT max(ID_Pengetahuan) as kodeid FROM tabel_pengetahuan");
$mbss = mysqli_fetch_array($query_kodebss);
$kodebss = $mbss['kodeid'];
$sort_kode = (int) substr($kodebss,1,2);
$sort_kode++;
$hurufkode_bss = "P";
$kodebss = $hurufkode_bss.sprintf("%02s",$sort_kode);

$hslck_krskn = mysqli_query($conn,"SELECT * FROM tabel_kerusakan");
$hslck_gjl = mysqli_query($conn,"SELECT * FROM tabel_gejala");



if(isset($_POST['btntbhbss'])){
    $addidkerusakan = $_POST['slctidkrskn'];
    $addidgejala = $_POST['slctidgjl'];
    $addnilaicf = $_POST['slcncf'];
    
    if((empty($_POST['slctidkrskn']))OR(empty($_POST['slctidgjl']))OR(empty($_POST['slcncf']))){
        echo "<script>alert('Silahkan memilih input yang diperlukan dahulu !')</script>";
    }else if((isset($_POST['slctidkrskn']))AND(isset($_POST['slctidgjl']))AND(isset($_POST['slcncf']))){
        $cekgejalaganda = mysqli_query($conn,"SELECT * FROM tabel_pengetahuan");
        $countergnd = 0;
        while($cekganda = mysqli_fetch_array($cekgejalaganda)){
            if($cekganda['ID_Gejala'] == $addidgejala){
                $countergnd = $countergnd + 1;
            }
        }
        if($countergnd == 0){
            $cekbisa = mysqli_query($conn,"SELECT * FROM tabel_gejala WHERE ID_Gejala = '$addidgejala'");
            $dat = mysqli_fetch_array($cekbisa);
            $addnamagejala = $dat['Nama_Gejala'];  
        
            $sqladdbss = mysqli_query($conn,"INSERT INTO tabel_pengetahuan VALUES ('$kodebss','$addidkerusakan','$addidgejala','$addnamagejala','$addnilaicf')");
            header("location:bss_pengetahuan.php");
        }else{
            echo "<script>alert('Gejala sudah pernah dimasukkan, silahkan memilih gejala lainnya!!')</script>";
        }  
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
            <center><h1>TAMBAH DATA BASIS PENGETAHUAN</h1></center>
            <form action="" method="post" id="formid">
                <center><table class="tbltbhbss">
                    <tr>
                        <td>ID Pengetahuan</td><td>:</td>
                        <td><input width="100px" type="text" name="inpidbss" maxlength="5" placeholder="<?php echo $kodebss ?>" required disabled></td>
                    </tr>
                    <tr>
                        <td>ID Kerusakan</td><td>:</td>
                        <td>
                            <select name="slctidkrskn"  >
                                <option value="0" selected disabled>-= Pilih Kerusakan =-</option>
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
                                <option value="0" selected disabled>-= Pilih Nilai CF =-</option>
                                <?php $counter_ncf = 0.1; for($i=1;$i <= 10; $i++){?>
                                <option value="<?php echo $counter_ncf; ?>"><?php echo $counter_ncf; $counter_ncf = $counter_ncf + 0.1; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table></center>
                <center><button name="btntbhbss" class="btndtbss">TAMBAH BASIS PENGETAHUAN</button></center>
            </form> 
        </section>
</body>
</html>