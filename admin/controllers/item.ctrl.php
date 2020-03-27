<?php 
session_start();
include '../../config/database.php';
include "../../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if($_GET['ket']=='submit-item'){

	$nama = $_POST['ip-nama'];
	$harga = $_POST['ip-harga'];
	$ket = $_POST['ip-ket'];
	
	$sql = "INSERT into bahan(bahan_nama,bahan_harga,bahan_keterangan)values('$nama','$harga','$ket')";

	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='update-item'){


	$id = $_POST['ip-id'];
	$nama = $_POST['ip-nama'];
	$harga = $_POST['ip-harga'];
	$user = $_SESSION['login_user'];
	$ket = $_POST['ip-ket'];

	$sql="UPDATE bahan set bahan_nama='$nama', bahan_harga='$harga', bahan_keterangan='$ket' where bahan_id='$id'";

	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='remove-item'){
	$array_datas = array();
	
	$id = $_POST['item_id'];
	$sql="DELETE from bahan where bahan_id='$id'";
	if (!mysqli_query($con,$sql)) {
		$array_datas[] = ["gagal"];
	}else{
		$array_datas[] = ["ok"];
	}
	echo json_encode($array_datas);
	
}

?>  