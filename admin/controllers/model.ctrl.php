<?php 
session_start();
include '../../config/database.php';
include "../../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if($_GET['ket']=='submit-model'){

	$nama = $_POST['ip-nama'];

	$sql = "INSERT into model(model_nama)values('$nama')";

	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='update-model'){


	$id = $_POST['ip-id'];
	$nama = $_POST['ip-nama'];

	$sql="UPDATE model set model_nama='$nama' where model_id='$id'";
	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='remove-model'){
	$array_datas = array();
	
	$id = $_POST['model_id'];
	$sql="DELETE from model where model_id='$id'";
	if (!mysqli_query($con,$sql)) {
		$array_datas[] = ["gagal"];
	}else{
		$array_datas[] = ["ok"];
	}
	echo json_encode($array_datas);
	
}

?>  