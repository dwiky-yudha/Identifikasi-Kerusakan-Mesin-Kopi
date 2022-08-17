<?php
                $gejala = $_POST['gejala'];
                $query_bss = "SELECT * FROM tabel_pengetahuan ORDER BY ID_Kerusakan";
                $query_krs = "SELECT * FROM tabel_kerusakan";
                $querycek_krs = mysqli_query($conn,$query_krs);
                $jumlah_baris = mysqli_num_rows($querycek_krs);
                
                //membuat array untuk setiap kerusakan 

                for($x=0; $x < count($gejala) ; $x++){
                    $query_cekkr = mysqli_query($conn,$query_bss);
                    while ($hsl = mysqli_fetch_array($query_cekkr)){
                        if($hsl['ID_Gejala'] == $gejala[$x]){
                            echo $hsl['ID_Kerusakan'];
                        }}
                    }    
?>