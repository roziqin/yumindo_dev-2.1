<?php

function hitungHarga($idjenis,$namajenis,$idmodel,$namamodel,$idbahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahankain,$hargabox,$pilihkualitas) {
	$con = mysqli_connect("localhost","root","","yumindon_new");
	$harga = 0;
	$hasilhitung = 0;
	$bahan_lembar = 0;
	$tinggiasli = $tinggi;
	$lebarasli = $lebar;

	$q= "SELECT * FROM pengaturan_perusahaan where pengaturan_id='1'";
	$r=mysqli_query($con, $q);
	$d=mysqli_fetch_assoc($r);

	if ($pilihkualitas=="Premium") {
		$kualitas = $d['pengaturan_kualitas_premium'];
		$kualitas_vitras = $d['pengaturan_kualitas_vitras_premium'];
	} elseif ($pilihkualitas=="Gold") {
		$kualitas = $d['pengaturan_kualitas_gold'];
		$kualitas_vitras = $d['pengaturan_kualitas_vitras_gold'];

	} else {
		$kualitas = $d['pengaturan_kualitas_silver'];
		$kualitas_vitras = $d['pengaturan_kualitas_vitras_silver'];

	}

	

	if ($tinggi < 100) {
		$tinggi = 100;
		# code...
	} 
	if ($lebar < 100) {
		$lebar = 100;
		# code...
	} 
	$luas = $tinggi * $lebar;
	$luasasli = $tinggiasli * $lebarasli;

    $bahan_kain = ($lebar * $kualitas)/100;
    $bahan_kain_vitras = ($lebar * $kualitas_vitras)/100;


	if ($namamodel=='Triplet' && $namabahan=='Kain Blackout') {
		# code...
        $bahan_kain = ($lebar * 2.6)/100;
	
	} elseif ($namabahan == 'Kain Lokal') {
		$bahan_lembar = ceil($lebar/50);
		$bahan_kain = $bahan_lembar * (($tinggi+50)/100);
	} else {
		# code...
	}
	

    $bahan_rel = $lebar / 100;

    if ($namamodel=='Minimalis/ Smoke Ring' && $namabahan=='Kain Lokal') {
		# code...
        $bahan_ring = $bahan_lembar*8;
	} else {
        $bahan_ring = $bahan_kain*8;
	}

    
    $bahan_hook = 1;
    $bahan_tali = 1;


    $sqlvittali="SELECT * from bahan WHERE bahan_nama LIKE '%tali%'";
	$queryvittali=mysqli_query($con,$sqlvittali);
	$datavittali=mysqli_fetch_assoc($queryvittali);
	
	if ($namajenis == 'Poni Motif') {

		if ($namamodel=='Minimalis/ Smoke Ring') {
			$namabahan1 = 'Poni Motif Minimalis';

		} elseif ($namamodel=='Papan') {
			$namabahan1 = 'Poni Motif Papan';

		} elseif ($namamodel=='Drappery') {
			$namabahan1 = 'Poni Motif Drappery';

		} 
		$sqlbahan="SELECT * from bahan WHERE bahan_nama LIKE '%$namabahan1%'";
		$querybahan=mysqli_query($con,$sqlbahan);
		$databahan=mysqli_fetch_assoc($querybahan);
		$hasilhitung += $bahan_rel * $databahan['bahan_harga'];
		$hasilhitung += $bahan_rel * $hargabox;

	} elseif ($namajenis == 'Poni Polos') {

		if ($namamodel=='Minimalis/ Smoke Ring') {
			$namabahan1 = 'Poni Polos Minimalis';

		} elseif ($namamodel=='Papan') {
			$namabahan1 = 'Poni Polos Papan';

		} elseif ($namamodel=='Drappery') {
			$namabahan1 = 'Poni Polos Drappery';

		} 
		$sqlbahan="SELECT * from bahan WHERE bahan_nama LIKE '%$namabahan1%'";
		$querybahan=mysqli_query($con,$sqlbahan);
		$databahan=mysqli_fetch_assoc($querybahan);
		$hasilhitung += $bahan_rel * $databahan['bahan_harga'];
		$hasilhitung += $bahan_rel * $hargabox;

	} elseif ($namajenis == 'Kaca Film') {

		$sqlte="SELECT * from bahan WHERE bahan_id='$idbahan'";
		$queryte=mysqli_query($con,$sqlte);
		$databarang=mysqli_fetch_assoc($queryte);
		
        $hasilhitung = $tinggi/100 * $databarang['bahan_harga'];
        //echo $hasilhitung;
        
	} elseif ($namajenis == 'Vitras') {
		
		# code...
		$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
		$querytea=mysqli_query($con,$sqltea);
		$datavitras=mysqli_fetch_assoc($querytea);
		
		if ($namamodel=='Minimalis/ Smoke Ring' && $namabahan=='Kain Blackout') {
			# code...
			$nn = 'minimalis vitras rel';
		} elseif ($namamodel=='jam Pasir') {
			if ($lebarasli < 40) {
				$lebar = 40;
			}
	        $bahan_rel = $lebar / 100;
			$nn = 'jam pasir vitras rel';
		} else {
			# code...
			$nn = 'triplet vitras rel';
		}

        $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];

        $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];



		$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
		$queryvitrel=mysqli_query($con,$sqlvitrel);
		$datavitrel=mysqli_fetch_assoc($queryvitrel);

        $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
			
        //echo $hasilhitung." - ";
	
		
    } elseif ($namajenis == 'Gorden') { 

		$sqlkain="SELECT * from bahan WHERE bahan_id='$idbahan'";
		$querykain=mysqli_query($con,$sqlkain);
		$datakain=mysqli_fetch_assoc($querykain);

        $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
        //echo $hasilhitung." - ";
        $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

        if ($namamodel=='Minimalis/ Smoke Ring') {
			# code...
			$nn = 'minimalis rel';

			$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
			$queryring=mysqli_query($con,$sqlring);
			$dataring=mysqli_fetch_assoc($queryring);

            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

		} else {
			# code...
			if ($namabahan == 'Kain Lokal') {
				# code...
				$nn = 'triplet rel lokal';
			} else {
				# code...
				$nn = 'triplet rel blackout';
			}
			
		}

		$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
		$queryvitrel=mysqli_query($con,$sqlvitrel);
		$datavitrel=mysqli_fetch_assoc($queryvitrel);

        $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
        //echo $hasilhitung." - ";


		$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
		$queryhook=mysqli_query($con,$sqlhook);
		$datahook=mysqli_fetch_assoc($queryhook);

        //$hasilhitung += $bahan_hook * $datahook['bahan_harga'];
        //echo $hasilhitung." - ";
       
    
    } elseif ($namajenis == 'Gorden & Vitras') {

    	$sqlkain="SELECT * from bahan WHERE bahan_id='$idbahan'";
		$querykain=mysqli_query($con,$sqlkain);
		$datakain=mysqli_fetch_assoc($querykain);

        $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
        $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];
        

        if ($namamodel=='Minimalis/ Smoke Ring') {
			# code...
			$nn = 'minimalis rel';

			$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
			$queryring=mysqli_query($con,$sqlring);
			$dataring=mysqli_fetch_assoc($queryring);

            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];
            //echo $hasilhitung.'<br>';

		} else {
			# code...
			if ($namabahan == 'Kain Lokal') {
				# code...
				$nn = 'triplet rel lokal';
			} else {
				# code...
				$nn = 'triplet rel blackout';
			}
		}


		$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
		$queryvitrel=mysqli_query($con,$sqlvitrel);
		$datavitrel=mysqli_fetch_assoc($queryvitrel);

        $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
   

        /*
		$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
		$queryhook=mysqli_query($con,$sqlhook);
		$datahook=mysqli_fetch_assoc($queryhook);

        $hasilhitung += $bahan_hook * $datahook['bahan_harga'];
		*/

        

        # code...
		$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
		$querytea=mysqli_query($con,$sqltea);
		$datavitras=mysqli_fetch_assoc($querytea);
        $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];
   
        
        $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

		if ($namamodel=='Minimalis/ Smoke Ring' && $namabahan=='Kain Blackout') {
			# code...
			$nnn = 'minimalis vitras rel';
		} else {
			# code...
			$nnn = 'triplet vitras rel';

		}

		$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nnn'";
		$queryvitrel=mysqli_query($con,$sqlvitrel);
		$datavitrel=mysqli_fetch_assoc($queryvitrel);

        $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
			
     


	} elseif ($namajenis == 'Lain-lain') {

        $hasilhitung = $volume * $hargabahankain;
        $modelid = 0;

	} else {
    	$sqlte="SELECT * from bahan WHERE bahan_id='$idbahan'";
		$queryte=mysqli_query($con,$sqlte);
		$databarang=mysqli_fetch_assoc($queryte);
		
        $hasilhitung = ($luas / 10000) * $hargabahankain;
        $modelid = 0;

    }

    $h = $hasilhitung * $jumlah;
    return $h;
}

?>