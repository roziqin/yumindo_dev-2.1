<?php 
session_start();
include '../../config/database.php';
include "../../include/slug.php";
include "../../include/hitung_harga.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$bln=date('Y-m');
$wkt=date('H:i:s');
$array_datas = array();
$user = $_SESSION['login_user'];
$kualitas = 3.5;
$kualitas_vitras = 3;

if($_GET['ket']=='submit-booking'){
	$pelanggan = $_POST['ip-pelanggan'];	
	$tglbooking = date("Y-m-j", strtotime($_POST['ip-tglbooking']));

	$sql = "INSERT into booking_pengukuran(booking_pengukuran_pelanggan,booking_pengukuran_tanggal,booking_pengukuran_tanggal_booking,booking_pengukuran_user,booking_pengukuran_status)values('$pelanggan','$tgl','$tglbooking','$user','Booking')";	

	mysqli_query($con,$sql);

} elseif($_GET['ket']=='followup'){
	$idpengukuran = $_POST['ip-idpengukuran'];
	$idpelanggan = $_POST['ip-idpelanggan'];
	$status = $_POST['ip-cekstatus'];
	if ($status=="Booking") {
		$sql="UPDATE booking_pengukuran set booking_pengukuran_status='Follow Up' where booking_pengukuran_id='$idpengukuran'";
		mysqli_query($con,$sql);

	} else {
		
		$user = $_SESSION['login_user'];
		$_SESSION['id_pelanggan'] = $idpelanggan;
		$b="INSERT into pelanggan_temp(pelanggan_temp_id_pelanggan,pelanggan_temp_user)values('$idpelanggan','$user')";
		mysqli_query($con,$b);

		$a="UPDATE booking_pengukuran set booking_pengukuran_status='Pengukuran', booking_pengukuran_user='$user' where booking_pengukuran_id='$idpengukuran'";
		mysqli_query($con,$a);
	}

} elseif($_GET['ket']=='update-followup'){
	$idpengukuran = $_POST['ip-idpengukuran'];
	$tglbookingfollowup = date("Y-m-j", strtotime($_POST['ip-tglbookingfollowup']));

	$sql="UPDATE booking_pengukuran set booking_pengukuran_tanggal_booking='$tglbookingfollowup' where booking_pengukuran_id='$idpengukuran'";
	mysqli_query($con,$sql);

} elseif($_GET['ket']=='inputpengukuran') {
	$namajenis = $_POST['ip-namajenis'];
	$namabahan = $_POST['ip-namabahan'];
	$namamodel = $_POST['ip-namamodel'];
	$jenis = $_POST['ip-jenis'];
	$namalain = $_POST['ip-namalain'];
	$model = $_POST['ip-model'];
	$bahan = $_POST['ip-bahan'];
	$kodebahan = $_POST['ip-kodebahan'];
	$kodebahan1 = $_POST['ip-kodebahan1'];
	$hargabahan = $_POST['ip-hargabahan'];
	$hargabox = $_POST['ip-hargabox'];
	$tinggi = $_POST['ip-tinggi1'];
	$lebar = $_POST['ip-lebar1'];
	$volume = $_POST['ip-volume1'];
	$jumlah = $_POST['ip-jumlah'];
	$ruang = $_POST['ip-ruang'];
	$tarikan = $_POST['ip-tarikan'];
	$kt = $_POST['ip-kt'];
	$relalat1 = $_POST['ip-relalat1'];
	$relalat2 = $_POST['ip-relalat2'];
	$relwarna = $_POST['ip-relwarna'];
	$pilihkualitas = "Premium";

	$hasilhitungharga = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitas);
	$relukuranasli = $_POST['ip-lebar1'];
	$tinggiasli = $_POST['ip-tinggi1'];
	$lebarasli = $_POST['ip-lebar1'];

	$a="INSERT into pengukuran_detail_temp(pengukuran_temp_id,pengukuran_detail_temp_ruang,pengukuran_detail_temp_jenis,pengukuran_detail_temp_jenis_lain,pengukuran_detail_temp_bahan,pengukuran_detail_temp_kode_bahan,pengukuran_detail_temp_kode_bahan_1,pengukuran_detail_temp_harga_box,pengukuran_detail_temp_model,pengukuran_detail_temp_jumlah,pengukuran_detail_temp_kt,pengukuran_detail_temp_alat_1,pengukuran_detail_temp_alat_2,pengukuran_detail_temp_alat_warna,pengukuran_detail_temp_alat_ukuran,pengukuran_detail_temp_tinggi,pengukuran_detail_temp_lebar,pengukuran_detail_temp_kualitas,pengukuran_detail_temp_harga,pengukuran_detail_temp_user,pengukuran_detail_temp_harga_bahan,pengukuran_detail_temp_volume,pengukuran_detail_temp_tarikan)values(0,'$ruang','$jenis','$namalain','$bahan','$kodebahan','$kodebahan1','$hargabox','$model','$jumlah','$kt','$relalat1','$relalat2','$relwarna','$relukuranasli','$tinggiasli','$lebarasli','Premium','$hasilhitungharga','$user','$hargabahan','$volume','$tarikan')";
	mysqli_query($con,$a);


} elseif($_GET['ket']=='remove-item'){
	$array_datas = array();
	
	$id = $_POST['item_id'];
	$sql="DELETE from pengukuran_detail_temp where pengukuran_detail_temp_id='$id'";
	if (!mysqli_query($con,$sql)) {
		$array_datas[] = ["gagal"];
	}else{
		$array_datas[] = ["ok"];
	}
	echo json_encode($array_datas);
	
} elseif($_GET['ket']=='penawaran-remove-item'){
	$array_datas = array();
	
	$item_id = $_POST['item_id'];
	$id = $_POST['id'];
	
	//$item_id = 2854;
	//$id = 639;
	$sql="DELETE from pengukuran_detail where pengukuran_detail_id='$item_id'";
	//$sql="UPDATE pengukuran_detail set pengukuran_id=0 where pengukuran_detail_id='$item_id'";

	if (!mysqli_query($con,$sql)) {
		$array_datas["ket"] = ["gagal"];
	}else{
		$array_datas["ket"] = ["ok"];
	}

	$qn1= "SELECT * FROM pengukuran where pengukuran_id='$id'";
    $rn1=mysqli_query($con,$qn1);
    $dn1=mysqli_fetch_assoc($rn1);
    $diskon = $dn1['pengukuran_diskon'];
    
	$tot = 0;
	$sql1="SELECT * from pengukuran_detail where pengukuran_id='$id'";
    $query1=mysqli_query($con,$sql1);
    while ($data1=mysqli_fetch_assoc($query1)) {
    	$tot+=$data1['pengukuran_detail_harga'];
    }
    $tot = $tot-$diskon;
	$array_datas["total"] = [$tot];

	$a="UPDATE pengukuran set pengukuran_total_harga=$tot where pengukuran_id='$id'";
	mysqli_query($con,$a);
	echo json_encode($array_datas);
	
} elseif($_GET['ket']=='penawaran-edit-item'){
	$array_datas = array();

	$id = $_POST['ip-id'];
	$idpenawaran = $_POST['ip-idpenawaran'];
	$namajenis = $_POST['ip-namajenis'];
	$namabahan = $_POST['ip-namabahan'];
	$namamodel = $_POST['ip-namamodel'];
	$jenis = $_POST['ip-idjenis'];
	$namalain = $_POST['ip-namalain'];
	$model = $_POST['ip-model'];
	$bahan = $_POST['ip-bahan'];
	$kodebahan = $_POST['ip-kodebahan'];
	$kodebahan1 = isset($_POST['ip-kodebahan1']);
	$hargabahan = isset($_POST['ip-hargabahan']);
	$hargabox = isset($_POST['ip-hargabox']);
	$tinggi = $_POST['ip-tinggi1'];
	$lebar = $_POST['ip-lebar1'];
	$volume = isset($_POST['ip-volume1']);
	$jumlah = $_POST['ip-jumlah'];
	$ruang = $_POST['ip-ruang'];
	$tarikan = isset($_POST['ip-tarikan']);
	$kt = $_POST['ip-kt'];
	$relalat1 = $_POST['ip-relalat1'];
	$relalat2 = isset($_POST['ip-relalat2']);
	$relwarna = $_POST['ip-relwarna'];
	$pilihkualitas = $_POST['ip-kualitas'];

	$hasilhitungharga = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitas);
	$relukuranasli = $_POST['ip-lebar1'];
	$tinggiasli = $_POST['ip-tinggi1'];
	$lebarasli = $_POST['ip-lebar1'];


	$a="UPDATE pengukuran_detail set pengukuran_detail_ruang='$ruang', pengukuran_detail_jenis='$jenis', pengukuran_detail_jenis_lain='$namalain', pengukuran_detail_bahan='$bahan', pengukuran_detail_kode_bahan='$kodebahan', pengukuran_detail_kode_bahan_1='$kodebahan1', pengukuran_detail_harga_box='$hargabox', pengukuran_detail_model='$model', pengukuran_detail_jumlah='$jumlah', pengukuran_detail_kt='$kt', pengukuran_detail_alat_1='$relalat1', pengukuran_detail_alat_2='$relalat2', pengukuran_detail_alat_warna='$relwarna', pengukuran_detail_alat_ukuran='$relukuranasli', pengukuran_detail_tinggi='$tinggiasli', pengukuran_detail_lebar='$lebarasli', pengukuran_detail_volume='$volume', pengukuran_detail_tarikan='$tarikan', pengukuran_detail_kualitas='$pilihkualitas', pengukuran_detail_harga='$hasilhitungharga', pengukuran_detail_harga_bahan='$hargabahan' where pengukuran_detail_id='$id'";

	mysqli_query($con,$a);

	$qn1= "SELECT * FROM pengukuran where pengukuran_id='$idpenawaran'";
    $rn1=mysqli_query($con,$qn1);
    $dn1=mysqli_fetch_assoc($rn1);
    $diskon = $dn1['pengukuran_diskon'];
    
	$tot = 0;
	$sql1="SELECT * from pengukuran_detail where pengukuran_id='$idpenawaran'";
    $query1=mysqli_query($con,$sql1);
    while ($data1=mysqli_fetch_assoc($query1)) {
    	$tot+=$data1['pengukuran_detail_harga'];
    }
    $tot = $tot-$diskon;

	$a="UPDATE pengukuran set pengukuran_total_harga=$tot where pengukuran_id='$idpenawaran'";
	mysqli_query($con,$a);

	//$array_datas["total"] = $tot;
	echo $tot;
	//echo json_encode($array_datas);
	
} elseif($_GET['ket']=='penawaran-tambah-item'){
	$array_datas = array();
	
	$idpenawaran = $_POST['ip-id'];
	$jenis = $_POST['ip-jenis'];
	$namalain = isset($_POST['ip-namalain']);
	$model = $_POST['ip-model'];
	$bahan = $_POST['ip-bahan'];
	/*
	$idpenawaran = 639;
	$jenis = 1;
	$namalain = '';
	$model = 1;
	$bahan = 14;
	*/
	$qnj= "SELECT * FROM jenis where jenis_id='$jenis'";
    $rnj=mysqli_query($con,$qnj);
    $dnj=mysqli_fetch_assoc($rnj);
    $namajenis = $dnj['jenis_nama'];

	$qnb= "SELECT * FROM bahan where bahan_id='$bahan'";
    $rnb=mysqli_query($con,$qnb);
    $dnb=mysqli_fetch_assoc($rnb);
    $namabahan = $dnb['bahan_nama'];

	$qnm= "SELECT * FROM model where model_id='$model'";
    $rnm=mysqli_query($con,$qnm);
    $dnm=mysqli_fetch_assoc($rnm);
    $namamodel = $dnm['model_nama'];
    
	$kodebahan = $_POST['ip-kodebahan'];
	$kodebahan1 = isset($_POST['ip-kodebahan1']);
	$hargabahan = isset($_POST['ip-hargabahan']);
	$hargabox = isset($_POST['ip-hargabox']);
	$tinggi = $_POST['ip-tinggi1'];
	$lebar = $_POST['ip-lebar1'];
	$volume = isset($_POST['ip-volume1']);
	$jumlah = $_POST['ip-jumlah'];
	$ruang = $_POST['ip-ruang'];
	$tarikan = isset($_POST['ip-tarikan']);
	$kt = $_POST['ip-kt'];
	$relalat1 = $_POST['ip-relalat1'];
	$relalat2 = isset($_POST['ip-relalat2']);
	$relwarna = $_POST['ip-relwarna'];
	/*
	$kodebahan = 'GO.2154';
	$kodebahan1 = '';
	$hargabahan = '';
	$hargabox = '';
	$tinggi = 150;
	$lebar = 120;
	$volume = 0;
	$jumlah = 1;
	$ruang = 'Depan';
	$tarikan = '';
	$kt = 'KT';
	$relalat1 = 'Rolet';
	$relalat2 = '';
	$relwarna = 'Putih';
	*/
	//$pilihkualitas = $_POST['ip-kualitas'];

	$qn1= "SELECT * FROM pengukuran where pengukuran_id='$idpenawaran'";
    $rn1=mysqli_query($con,$qn1);
    $dn1=mysqli_fetch_assoc($rn1);
    $diskon = $dn1['pengukuran_diskon'];
	$pilihkualitas = $dn1['pengukuran_kualitas'];

	$hasilhitungharga = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitas);
	
	$relukuranasli = $_POST['ip-lebar1'];
	$tinggiasli = $_POST['ip-tinggi1'];
	$lebarasli = $_POST['ip-lebar1'];
	/*
	$relukuranasli = 120;
	$tinggiasli = 150;
	$lebarasli = 120;
	*/

	$a="INSERT into pengukuran_detail(pengukuran_id,pengukuran_detail_ruang,pengukuran_detail_jenis,pengukuran_detail_jenis_lain,pengukuran_detail_bahan,pengukuran_detail_kode_bahan,pengukuran_detail_kode_bahan_1,pengukuran_detail_harga_box,pengukuran_detail_model,pengukuran_detail_jumlah,pengukuran_detail_kt,pengukuran_detail_alat_1,pengukuran_detail_alat_2,pengukuran_detail_alat_warna,pengukuran_detail_alat_ukuran,pengukuran_detail_tinggi,pengukuran_detail_lebar,pengukuran_detail_kualitas,pengukuran_detail_harga,pengukuran_detail_user,pengukuran_detail_harga_bahan,pengukuran_detail_volume,pengukuran_detail_tarikan)values('$idpenawaran','$ruang','$jenis','$namalain','$bahan','$kodebahan','$kodebahan1','$hargabox','$model','$jumlah','$kt','$relalat1','$relalat2','$relwarna','$relukuranasli','$tinggiasli','$lebarasli','$pilihkualitas','$hasilhitungharga','$user','$hargabahan','$volume','$tarikan')";

	mysqli_query($con,$a);
    
	$tot = 0;
	$sql1="SELECT * from pengukuran_detail where pengukuran_id='$idpenawaran'";
    $query1=mysqli_query($con,$sql1);
    while ($data1=mysqli_fetch_assoc($query1)) {
    	$tot+=$data1['pengukuran_detail_harga'];
    }
    $tot = $tot-$diskon;

	$a="UPDATE pengukuran set pengukuran_total_harga='$tot' where pengukuran_id='$idpenawaran'";
	mysqli_query($con,$a);

	echo $tot;
	
} elseif($_GET['ket']=='prosesorder') {
    $_SESSION['print'] = "ya";
	$catatjahit = $_POST['catatjahit'];
	$catatukur = $_POST['catatukur'];
	$dp = $_POST['dp'];
	$total = $_POST['total'];
	$status = 'Penawaran';
	
	$qn1= "SELECT pelanggan_temp_id_pelanggan FROM pelanggan_temp where pelanggan_temp_user='$user'";
    $rn1=mysqli_query($con,$qn1);
    $dn1=mysqli_fetch_assoc($rn1);
    $idp = $dn1['pelanggan_temp_id_pelanggan'];

    $a="INSERT into pengukuran(pengukuran_tanggal,pengukuran_bulan,pengukuran_pelanggan,pengukuran_user,pengukuran_keterangan,pengukuran_catatan_jahit,pengukuran_total_harga,pengukuran_diskon,pengukuran_dp,pengukuran_dp_awal,pengukuran_status,pengukuran_kualitas)values('$tgl','$bln','$idp','$user','$catatukur','$catatjahit','$total','0','$dp','0','$status','Premium')";
	mysqli_query($con,$a);

	$qn= "SELECT MAX( pengukuran_id ) AS noid FROM pengukuran where pengukuran_user='$user'";
    $rn=mysqli_query($con,$qn);
    $dn=mysqli_fetch_assoc($rn);
    $no_not = $dn['noid'];
    $_SESSION['no-id'] = $no_not;

    $sql="SELECT * from pengukuran_detail_temp where pengukuran_detail_temp_user='$user'";
    $query=mysqli_query($con,$sql);
    while ($data1=mysqli_fetch_assoc($query)) {
    	$pengukuran_id = $no_not;
    	$pengukuran_ruang = $data1['pengukuran_detail_temp_ruang'];
    	$pengukuran_jenis = $data1['pengukuran_detail_temp_jenis'];
    	$pengukuran_jenis_lain = $data1['pengukuran_detail_temp_jenis_lain'];
    	$pengukuran_bahan = $data1['pengukuran_detail_temp_bahan'];
    	$pengukuran_kode_bahan = $data1['pengukuran_detail_temp_kode_bahan'];
    	$pengukuran_harga_bahan = $data1['pengukuran_detail_temp_harga_bahan'];
    	$pengukuran_kode_bahan_1 = $data1['pengukuran_detail_temp_kode_bahan_1'];
    	$pengukuran_harga_box = $data1['pengukuran_detail_temp_harga_box'];
    	$pengukuran_model = $data1['pengukuran_detail_temp_model'];
    	$pengukuran_jumlah = $data1['pengukuran_detail_temp_jumlah'];
    	$pengukuran_kt = $data1['pengukuran_detail_temp_kt'];
    	$pengukuran_alat_1 = $data1['pengukuran_detail_temp_alat_1'];
    	$pengukuran_alat_2 = $data1['pengukuran_detail_temp_alat_2'];
    	$pengukuran_alat_warna = $data1['pengukuran_detail_temp_alat_warna'];
    	$pengukuran_alat_ukuran = $data1['pengukuran_detail_temp_alat_ukuran'];
    	$pengukuran_panjang = $data1['pengukuran_detail_temp_tinggi'];
    	$pengukuran_lebar = $data1['pengukuran_detail_temp_lebar'];
    	$pengukuran_volume = $data1['pengukuran_detail_temp_volume'];
    	$pengukuran_tarikan = $data1['pengukuran_detail_temp_tarikan'];
    	$pengukuran_kualitas = $data1['pengukuran_detail_temp_kualitas'];
    	$pengukuran_harga = $data1['pengukuran_detail_temp_harga'];
    	$pengukuran_user = $data1['pengukuran_detail_temp_user'];
    	if ($status=="Deal") {
    		# code...
    		$deal_tanggal='$tgl';
    	} else {
			$deal_tanggal = '0000-00-00';        		
    	}

    	$a="INSERT into pengukuran_detail(pengukuran_id,pengukuran_detail_ruang,pengukuran_detail_jenis,pengukuran_detail_jenis_lain,pengukuran_detail_bahan,pengukuran_detail_kode_bahan,pengukuran_detail_harga_bahan,pengukuran_detail_kode_bahan_1,pengukuran_detail_harga_box,pengukuran_detail_model,pengukuran_detail_jumlah,pengukuran_detail_kt,pengukuran_detail_alat_1,pengukuran_detail_alat_2,pengukuran_detail_alat_warna,pengukuran_detail_alat_ukuran,pengukuran_detail_tinggi,pengukuran_detail_lebar,pengukuran_detail_volume,pengukuran_detail_tarikan,pengukuran_detail_kualitas,pengukuran_detail_harga,pengukuran_detail_user)values('$pengukuran_id','$pengukuran_ruang','$pengukuran_jenis','$pengukuran_jenis_lain','$pengukuran_bahan','$pengukuran_kode_bahan','$pengukuran_harga_bahan','$pengukuran_kode_bahan_1','$pengukuran_harga_box','$pengukuran_model','$pengukuran_jumlah','$pengukuran_kt','$pengukuran_alat_1','$pengukuran_alat_2','$pengukuran_alat_warna','$pengukuran_alat_ukuran','$pengukuran_panjang','$pengukuran_lebar','$pengukuran_volume','$pengukuran_tarikan','$pengukuran_kualitas','$pengukuran_harga','$pengukuran_user')";
    	
    	mysqli_query($con,$a);


		$b="UPDATE booking_pengukuran set booking_pengukuran_status='Penawaran' where booking_pengukuran_pelanggan='$idp' and booking_pengukuran_user='$user'";
		mysqli_query($con,$b);
        	
		mysqli_query($con,"DELETE from pengukuran_detail_temp where pengukuran_detail_temp_user='$user'");
		mysqli_query($con,"DELETE from pelanggan_temp where pelanggan_temp_user='$user'");
    }

} elseif($_GET['ket']=='negoharga') {
	$idp = $_POST['idpenawaran'];
	$diskon = $_POST['diskon'];
	$diskonket = $_POST['diskonket'];
	$kualitas = $_POST['kualitas'];
	$dp = $_POST['dp'];
	$bank = $_POST['bank'];
	$ppn = $_POST['ppn'];
	$total = 0;

	$sql="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_id='$idp'";
    $query=mysqli_query($con,$sql);
    while ($data1=mysqli_fetch_assoc($query)) {

    	$id = $data1['pengukuran_detail_id'];
    	$jenis = $data1['pengukuran_detail_jenis'];
		$namajenis = $data1['jenis_nama'];
		$bahan = $data1['pengukuran_detail_bahan'];
		$namabahan = $data1['bahan_nama'];
		$model = $data1['pengukuran_detail_model'];
		$namamodel = $data1['model_nama'];
		$tinggi = $data1['pengukuran_detail_tinggi'];
		$lebar = $data1['pengukuran_detail_lebar'];
		$volume = $data1['pengukuran_detail_volume'];
		$jumlah = $data1['pengukuran_detail_jumlah'];
		$hargabahan = $data1['pengukuran_detail_harga_bahan'];
		$hargabox = $data1['pengukuran_detail_harga_box'];
		$hasilhitungharga = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$kualitas);

		$total += $hasilhitungharga;
		$sql="UPDATE pengukuran_detail set pengukuran_detail_kualitas='$kualitas', pengukuran_detail_harga='$hasilhitungharga' where pengukuran_detail_id='$id'";
		mysqli_query($con,$sql);

    }


    if ($diskonket=="Prosentase") {
		$diskon = ($total*$diskon/100);
    } elseif ($diskonket=="Tunai") {
		$diskon = $diskon;
    } else {
    	$diskon=0;
    }
    $totaljumlah = $total - $diskon;
    $jumlahppn = 0;
    if ($ppn=='ya') {
	    $jumlahppn = $totaljumlah*0.1;

	    $totaljumlah = $totaljumlah + $jumlahppn;
    }
    if ($dp>0) {
		$status = "Deal";
		$tanggaldeal = $tgl;
		$b="INSERT into laporan_omset(laporan_omset_tanggal,laporan_omset_bulan,laporan_omset_pengukuran_id,laporan_omset_jumlah)values('$tgl','$bln','$idp','$dp')";
		mysqli_query($con,$b);
	} else {
		$status = "Penawaran";
		$tanggaldeal = '0000-00-00';

	}

	$sql="UPDATE pengukuran set pengukuran_diskon='$diskon', pengukuran_kualitas='$kualitas', pengukuran_total_harga='$totaljumlah', pengukuran_dp='$dp', pengukuran_dp_awal='$dp', pengukuran_status='$status', pengukuran_tanggal_deal='$tanggaldeal', pengukuran_bank='$bank', pengukuran_ppn='$ppn', pengukuran_ppn_jumlah='$jumlahppn', pengukuran_ket_diskon='$diskonket' where pengukuran_id='$idp'";
	mysqli_query($con,$sql);

	$dataarray = array();
	$row_array['idp'] = $idp;
	$row_array['diskon'] = $diskon;
	$row_array['diskonket'] = $diskonket;
	$row_array['kualitas'] = $kualitas;
	$row_array['dp'] = $dp;
	$row_array['bank'] = $bank;
	$row_array['ppn'] = $ppn;
	$row_array['total'] = $totaljumlah;
	$row_array['status'] = $status;
    array_push($dataarray,$row_array);

	echo json_encode($dataarray);


} elseif($_GET['ket']=='cekorderbahan') {
	$dataarray = array();
	$idp = $_POST['idp'];
	$id = $_POST['id'];
	$jumlah = $_POST['jumlah'];
	$bahan = $_POST['bahan'];
	$bahan1 = $_POST['bahan1'];
	$namabahan = $_POST['namabahan'];
	$namabahan1 = $_POST['namabahan1'];
	$relalat1 = $_POST['relalat1'];
	$jmlrelalat1 = $_POST['jmlrelalat1'];
	$relalat2 = $_POST['relalat2'];
	$jmlrelalat2 = $_POST['jmlrelalat2'];

	$b="INSERT into order_bahan (order_bahan_detail_pengukuran_id,order_bahan_kode_bahan_1,order_bahan_jumlah_kode_bahan_1,order_bahan_kode_bahan_2,order_bahan_jumlah_kode_bahan_2,order_bahan_rel_alat_1,order_bahan_jumlah_rel_alat_1,order_bahan_rel_alat_2,order_bahan_jumlah_rel_alat_2,order_bahan_user)values('$id','$namabahan','$bahan','$namabahan1','$bahan1','$relalat1','$jmlrelalat1','$relalat2','$jmlrelalat2','$user')";
	mysqli_query($con,$b);
	$i = 0;
	$j = 0;

	$sql="SELECT * from pengukuran_detail where pengukuran_id='$idp'";
    $query=mysqli_query($con,$sql);
    while ($data=mysqli_fetch_assoc($query)) {
    	$idpd = $data['pengukuran_detail_id'];
		$sql1="SELECT COUNT(*) as jumlah from order_bahan where order_bahan_detail_pengukuran_id='$idpd'";
	    $query1=mysqli_query($con,$sql1);
	    $data1=mysqli_fetch_assoc($query1);
	    if ($data1['jumlah']==1) {
	    	$j++;
	    }
    	$i++;
    }


	$row_array['status'] = 'cek';
	$row_array['jumlahdetail'] = $i;
	$row_array['jumlahorder'] = $j;
    array_push($dataarray,$row_array);

	echo json_encode($dataarray);

} elseif($_GET['ket']=='orderbahan'){
	$id = $_POST['id'];
	$status='Mulai Potong';

	$a="UPDATE pengukuran set pengukuran_status='$status' where pengukuran_id='$id'";
	
	mysqli_query($con,$a);	

	$row_array['status'] = $status;
    array_push($dataarray,$row_array);

	echo json_encode($dataarray);

		
} elseif($_GET['ket']=='pemotongan'){
	$id = $_POST['id'];
	$status = $_POST['status'];
	if ($status=='Mulai Potong') {
		$status = 'Selesai Jahit';
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_tanggal_potong='$tgl', pengukuran_user_potong='$user' where pengukuran_id='$id'";
	} elseif ($status=='Selesai Jahit') {
		$status = 'Selesai Finishing';
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_tanggal_jahit='$tgl', pengukuran_user_jahit='$user' where pengukuran_id='$id'";
	} elseif ($status=='Selesai Finishing') {
		$status = 'Selesai Pemasangan';
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_tanggal_pasang='$tgl', pengukuran_user_pasang='$user' where pengukuran_id='$id'";
	} elseif ($status=='Selesai Pemasangan') {

		$data_uri = $_POST['signature'];
		$pelanggan = $_POST['pelanggan'];
		$encoded_image = explode(",", $data_uri)[1];
		$decoded_image = base64_decode($encoded_image);
		file_put_contents("../../assets/img/".$pelanggan."_".$id."_".$tgl."-ttd.png", $decoded_image);
		$nama = $pelanggan."_".$id."_".$tgl."-ttd.png";

		$a="UPDATE pengukuran set pengukuran_konfirmasi='$nama' where pengukuran_id='$id'";
	}

	mysqli_query($con,$a);	

	$row_array['status'] = $status;
    array_push($dataarray,$row_array);

	echo json_encode($dataarray);

		
} elseif($_GET['ket']=='penagihan'){
	$id = $_POST['id'];

	$sql1="SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$id ";
    $query1=mysqli_query($con,$sql1);
    $data1=mysqli_fetch_assoc($query1);

    $totalharga = $data1['pengukuran_total_harga'];
    $dp = $data1['pengukuran_dp_awal'];
    $diskon = $data1['pengukuran_diskon'];
    $sisa = $totalharga - $dp;

	$status = 'Lunas';
	$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_dp='$totalharga', pengukuran_pelunasan='$sisa', pengukuran_tanggal_lunas='$tgl' where pengukuran_id='$id'";
	
	mysqli_query($con,$a);	

	$b="INSERT into laporan_omset(laporan_omset_tanggal,laporan_omset_bulan,laporan_omset_pengukuran_id,laporan_omset_jumlah)values('$tgl','$bln','$id','$sisa')";
	mysqli_query($con,$b);

} elseif($_GET['ket']=='cekharga') {
	$namajenis = $_POST['namajenis'];
	$namabahan = $_POST['namabahan'];
	$namamodel = $_POST['namamodel'];
	$jenis = $_POST['jenis']; 
	$model = $_POST['model'];
	$bahan =  $_POST['bahan'];
	$hargabahan = 0;
	$hargabox = 0; 
	$tinggi = $_POST['tinggi'];
	$lebar = $_POST['lebar'];
	$volume = 0;
	$jumlah = 1;
	$pilihkualitas = "Premium";

	$hasilhitungharga = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitas);
	

	$dataarray = array();
	$row_array['harga'] = $hasilhitungharga;
    array_push($dataarray,$row_array);

	echo json_encode($dataarray);

} elseif($_GET['ket']=='tes') {
	$namajenis = 'Roller Blind';
	$namabahan = 'Superior Dim Out';
	$namamodel = '';
	$jenis = 4; 
	$model = 0;
	$bahan = 16 ;
	$hargabahan = 250000;
	$hargabox = 0; 
	$tinggi = 150;
	$lebar = 150;
	$volume = 0;
	$jumlah = 2;
	$pilihkualitas = "Premium";

	$hasilhitungharga = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitas);
	echo $hasilhitungharga;
}


		
?>