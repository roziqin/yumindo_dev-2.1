<?php 
session_start();
include '../../config/database.php';
include "../../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if($_GET['ket']=='submit-jenis'){

	$nama = $_POST['ip-nama'];
	$model = $_POST['ip-model'];
	$listmodel = $_POST['ip-listmodel'];
	$textlist = '';
	$n = 0;
	foreach ($listmodel as $list) {
		if ($n==0) {
			$textlist = $list;
		} else {
			$textlist = $textlist.':'.$list;
		}
		$n++;
	}

	$listkain = $_POST['ip-listkain'];
	$textlistkain = '';
	$n = 0;
	foreach ($listkain as $list1) {
		if ($n==0) {
			$textlistkain = $list1;
		} else {
			$textlistkain = $textlistkain.':'.$list1;
		}
		$n++;
	}

	$sql = "INSERT into jenis(jenis_nama,jenis_ket_model,jenis_listmodel,jenis_listKain)values('$nama','$model','$textlist','$textlistkain')";

	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='update-jenis'){


	$id = $_POST['ip-id'];
	$nama = $_POST['ip-nama'];
	$model = $_POST['ip-model'];
	$listmodel = $_POST['ip-listmodel'];
	$textlist = '';
	$n = 0;
	foreach ($listmodel as $list) {
		if ($n==0) {
			$textlist = $list;
		} else {
			$textlist = $textlist.':'.$list;
		}
		$n++;
	}

	$listkain = $_POST['ip-listkain'];
	$textlistkain = '';
	$n = 0;
	foreach ($listkain as $list1) {
		if ($n==0) {
			$textlistkain = $list1;
		} else {
			$textlistkain = $textlistkain.':'.$list1;
		}
		$n++;
	}

	$sql="UPDATE jenis set jenis_nama='$nama', jenis_ket_model='$model', jenis_listmodel='$textlist', jenis_listkain='$textlistkain' where jenis_id='$id'";
	mysqli_query($con,$sql);
	
} elseif($_GET['ket']=='remove-jenis'){
	$array_datas = array();
	
	$id = $_POST['jenis_id'];
	$sql="DELETE from jenis where jenis_id='$id'";
	if (!mysqli_query($con,$sql)) {
		$array_datas[] = ["gagal"];
	}else{
		$array_datas[] = ["ok"];
	}
	echo json_encode($array_datas);
	
}

?>  