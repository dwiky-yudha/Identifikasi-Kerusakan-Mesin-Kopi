<?php
include 'config.php';
error_reporting(0);
session_start();

$dt_basis = "SELECT * FROM tabel_pengetahuan ORDER BY ID_Kerusakan";
$query_basis = mysqli_query($conn,$dt_basis);
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Konsultasi</title>
</head>
<body class="bg1">
    <script src="script.js"></script>
    <nav class="navbaruser" >
        <h1>Experts System</h1>
        <a href="profil.php" class="navprofil">Profil</a>
        <a href="#" class="navkonsul aktif">Konsultasi</a>
        <a href="riwayat.php" class="navriwayat">Riwayat</a>
        <button onclick="lanjut()" class="btnlogout">LOGOUT</button>
    </nav>
    <section class="kontenuser">
        <div class="kontenkonsultasi">
        <form action="" method="post">
        <center><h1>Konsultasi</h1></center>
        <p>Pilih gejala kerusakan yang terdapat pada mesin anda  !!!</p>
        <center><table class="tabelkonsultasi">
            <tr><th width="10px">No</th><th width="400px">Gejala</th><th width="100px">Ya/Tidak</th></tr>
            <?php while($datanya = mysqli_fetch_array($query_basis)){
                   ?>
            <tr>
                <td><?php echo $no ;?></td>
                <td><?php 
                    echo $datanya['ID_Gejala']." --> ". $datanya['Nama_Gejala'];
                    ?>
                </td>
                <td><center><input type="checkbox" name="gejala[]" value="<?php echo $datanya['ID_Gejala'] ?>"></center></td>
            </tr>
            <?php $no = $no + 1; } ?>
        </table></center>
        <center><button name="konsul" class="konsul">PROSES IDENTIFIKASI</button></center>
        </form>
        <h3>
            <?php
            if(isset($_POST['konsul'])){ 
                if(isset($_POST['gejala'])){
                    $gejala_x = $_POST['gejala'];
                    $t_gejala = "";//penampung kumpulan gejala
                    $cf_sebelumnya = 0;// penampung cf sebelumya
                    $t_kerusakan = "";// penampung kerusakan
                    $t_hitung = 1;// penampung banyak data
                    $mncri_nilaicf = mysqli_query($conn,"SELECT * FROM tabel_pengetahuan ORDER BY ID_Kerusakan");
                    while($cx_nilaicf = mysqli_fetch_array($mncri_nilaicf)){ // Menghitung CF berdasarkan kerusakan dan menggolongkannya
                        for($i=0; $i < count($gejala_x); $i++){
                            if($cx_nilaicf['ID_Gejala'] == $gejala_x[$i]){
                                $t_gejala .= $cx_nilaicf['ID_Gejala'].","; //menyimpan untuk gejala terpilih
                                if(($t_kerusakan == "")AND($t_hitung < count($gejala_x))AND($t_kerusakan <> $cx_nilaicf['ID_Kerusakan'])){
                                    $cf_opr = $cf_sebelumnya + $cx_nilaicf['Nilai_CF'] * (1 - $cf_sebelumnya);
                                    $t_kerusakan = $cx_nilaicf['ID_Kerusakan'];
                                    $cf_sebelumnya = $cf_opr;
                                    $t_hitung++;
                                }else if(($t_kerusakan == "")AND($t_hitung == count($gejala_x))AND($t_kerusakan <> $cx_nilaicf['ID_Kerusakan'])){
                                    $cf_opr = $cf_sebelumnya + $cx_nilaicf['Nilai_CF'] * (1 - $cf_sebelumnya);
                                    $k_cf[] = $cf_opr;
                                    $k_krskn[] = $cx_nilaicf['ID_Kerusakan'];
                                }else if(($t_kerusakan <> "")AND($t_hitung < count($gejala_x))AND($t_kerusakan == $cx_nilaicf['ID_Kerusakan'])){
                                    $cf_opr = $cf_sebelumnya + $cx_nilaicf['Nilai_CF'] * (1 - $cf_sebelumnya);
                                    $t_kerusakan = $cx_nilaicf['ID_Kerusakan'];
                                    $cf_sebelumnya = $cf_opr;
                                    $t_hitung++;
                                }else if(($t_kerusakan <> "")AND($t_hitung < count($gejala_x))AND($t_kerusakan <> $cx_nilaicf['ID_Kerusakan'])){
                                    $k_cf[] = $cf_opr;
                                    $k_krskn[] = $t_kerusakan;
                                    $cf_sebelumnya = 0;
                                    $cf_opr = $cf_sebelumnya + $cx_nilaicf['Nilai_CF'] * (1 - $cf_sebelumnya);
                                    $t_kerusakan = $cx_nilaicf['ID_Kerusakan'];
                                    $cf_sebelumnya = $cf_opr;
                                    $t_hitung++;
                                }else if(($t_kerusakan <> "")AND($t_hitung == count($gejala_x))AND($t_kerusakan == $cx_nilaicf['ID_Kerusakan'])){
                                    $cf_opr = $cf_sebelumnya + $cx_nilaicf['Nilai_CF'] * (1 - $cf_sebelumnya);
                                    $k_cf[] = $cf_opr;
                                    $k_krskn[] = $cx_nilaicf['ID_Kerusakan'];
                                }else if(($t_kerusakan <> "")AND($t_hitung == count($gejala_x))AND($t_kerusakan <> $cx_nilaicf['ID_Kerusakan'])){
                                    $k_cf[] = $cf_opr;
                                    $k_krskn[] = $t_kerusakan;
                                    $cf_sebelumnya = 0;
                                    $cf_opr = $cf_sebelumnya + $cx_nilaicf['Nilai_CF'] * (1 - $cf_sebelumnya);
                                    $k_cf[] = $cf_opr;
                                    $k_krskn[] = $cx_nilaicf['ID_Kerusakan'];
                                }
                            }
                        }
                    }
                }else{
                    echo "<script>alert('Anda Belum Memilih Gejala, silahkan pilih gejala kerusakan mesin anda')</script>";
                }
               

                $ubahid_nama = mysqli_query($conn,"SELECT * FROM tabel_kerusakan");//Mengubah ID Kerusakan menjadi Nama Kerusakan
                if(isset($k_krskn)){
                    while( $konvidkenama = mysqli_fetch_array($ubahid_nama)){
                        for($i = 0;$i < count($k_krskn);$i++){
                            if($konvidkenama['ID_Kerusakan'] == $k_krskn[$i]){
                            $k_idkr[] = $konvidkenama['ID_Kerusakan'];
                            $k_krskn[$i] = $konvidkenama['Nama_Kerusakan'];
                            }
                        }
                    }
                }
                
                if((isset($k_cf))AND(isset($k_krskn))AND(isset($k_idkr))AND(count($k_cf)==count($k_krskn))AND(count($k_cf)==count($k_idkr))){ // Coding Untuk Menampilkan Hasil dan memasukkannya ke dalam database
                    echo "<hr>"."Kemungkinan kerusakan-kerusakan pada mesin Anda"."<br>";
                    $bts_hitung = count($k_cf);
                    for($i=0;$i < $bts_hitung;$i++){
                        echo $k_krskn[$i]." => ".$k_cf[$i];
                        echo "<br>";
                    }
                    echo "<hr>";
                    $nilaicf_terpilih = 0;
                    $kerusakan_terpilih = "";
                    $idkerusakan_terpilih = "";
                    for($i=0;$i<$bts_hitung;$i++){
                        if($k_cf[$i] > $nilaicf_terpilih){
                            $nilaicf_terpilih = $k_cf[$i];
                            $kerusakan_terpilih = $k_krskn[$i];
                            $idkerusakan_terpilih = $k_idkr[$i];
                        }
                    }
                    echo "<hr>";
                    $tampilhslcf = mysqli_query($conn,"SELECT * FROM tabel_kerusakan");
                    while($tampilkan = mysqli_fetch_array($tampilhslcf)){
                        if($tampilkan['Nama_Kerusakan'] == $kerusakan_terpilih){
                            echo "Jadi Kerusakan yang kemungkinan terjadi pada mesin anda merupakan :";
                            echo "<br>".$kerusakan_terpilih."<br>";
                            echo "Dengan nilai CF = ".$nilaicf_terpilih."<br>";
                            echo "Solusi untuk kerusakan ini adalah : <br>".$tampilkan['Solusi']."<br>";
                            echo "Perkiraan Harga : <br>".$tampilkan['Keterangan']."<hr>";

                        }
                    } 
                }

                $query_kode = mysqli_query($conn, "SELECT max(ID_Identifikasi) as kode FROM tabel_identifikasi");//Membuat ID Identifikasi
                $mate = mysqli_fetch_array($query_kode);
                $kodeiden = $mate['kode'];
                $urutan_kode = (int) substr($kodeiden,1,2);
                $urutan_kode++;
                $huruf_kode = "D";
                $kodeiden = $huruf_kode.sprintf("%02s",$urutan_kode);

                date_default_timezone_set('Asia/Jakarta');
                $tgliden = date('Y-m-d H:i:s');
                $useriden = $_SESSION['Username'];
                
                $addriwayat = mysqli_query($conn,"INSERT INTO tabel_identifikasi VALUES ('$kodeiden','$useriden','$idkerusakan_terpilih','$tgliden','$nilaicf_terpilih','$t_gejala')");
                

            } 
            ?>
        </h3>
        </div>
    </section>
</body>
</html>