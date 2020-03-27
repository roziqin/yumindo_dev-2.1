<?php 
session_start();
include '../../config/database.php';
include "../../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if($_GET['ket']=='submit-member'){

	$nama = $_POST['ip-nama'];
	$alamat = $_POST['ip-alamat'];
	$hp = $_POST['ip-hp'];
	$email = $_POST['ip-email'];
	$role = $_POST['ip-role'];

	$sql = "INSERT into users_lain(name,alamat,telepon,email,role)values('$nama','$alamat','$hp','$email','$role')";

	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='update-member'){

	$id = $_POST['ip-id'];
	$nama = $_POST['ip-nama'];
	$alamat = $_POST['ip-alamat'];
	$hp = $_POST['ip-hp'];
	$email = $_POST['ip-email'];

	$sql="UPDATE users_lain set name='$nama', alamat='$alamat', telepon='$hp', email='$email' where id='$id'";
	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='remove-member'){
	$array_datas = array();
	
	$id = $_POST['id'];
	$sql="DELETE from users_lain where id='$id'";
	if (!mysqli_query($con,$sql)) {
		$array_datas[] = ["gagal"];
	}else{
		$array_datas[] = ["ok"];
	}
	echo json_encode($array_datas);
	
}

?>  