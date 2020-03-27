<?php 
session_start();
include '../../config/database.php';
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if($_GET['ket']=='update-setting'){

	$id = 1;
	$nama = $_POST['ip-nama'];
	$alamat = $_POST['ip-alamat'];
	$telp = $_POST['ip-telp'];
	$service = $_POST['ip-service'];
	$pajak = $_POST['ip-pajak'];
	$kualitaspremium = $_POST['ip-kualitas-premium'];
	$kualitasgold = $_POST['ip-kualitas-gold'];
	$kualitassilver = $_POST['ip-kualitas-silver'];
	$kualitasvitraspremium = $_POST['ip-kualitas-vitraspremium'];
	$kualitasvitrasgold = $_POST['ip-kualitas-vitrasgold'];
	$kualitasvitrassilver = $_POST['ip-kualitas-vitrassilver'];

	if (isset($_FILES['inputfile'])) {
		$logo = $_FILES['inputfile']['name'];

		$file_tmp = $_FILES['inputfile']['tmp_name'];
		move_uploaded_file($file_tmp, '../../assets/img/'.$logo);


		$sql="UPDATE pengaturan_perusahaan set pengaturan_nama='$nama',pengaturan_alamat='$alamat',pengaturan_telp='$telp',pengaturan_service='$service',pengaturan_pajak='$pajak',pengaturan_kualitas_premium='$kualitaspremium',pengaturan_kualitas_gold='$kualitasgold',pengaturan_kualitas_silver='$kualitassilver',pengaturan_kualitas_vitras_premium='$kualitasvitraspremium',pengaturan_kualitas_vitras_gold='$kualitasvitrasgold',pengaturan_kualitas_vitras_silver='$kualitasvitrassilver',pengaturan_logo='$logo' where pengaturan_id='$id'";

		echo $logo;
	} else {
		$sql="UPDATE pengaturan_perusahaan set pengaturan_nama='$nama',pengaturan_alamat='$alamat',pengaturan_telp='$telp',pengaturan_service='$service',pengaturan_pajak='$pajak',pengaturan_kualitas_premium='$kualitaspremium',pengaturan_kualitas_gold='$kualitasgold',pengaturan_kualitas_silver='$kualitassilver',pengaturan_kualitas_vitras_premium='$kualitasvitraspremium',pengaturan_kualitas_vitras_gold='$kualitasvitrasgold',pengaturan_kualitas_vitras_silver='$kualitasvitrassilver' where pengaturan_id='$id'";
		echo "noupload";

	}


	
	mysqli_query($con,$sql);

		

} 

?>  