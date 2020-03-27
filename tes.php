<?php

$con = mysqli_connect("localhost","root","","yumindon_new");
$tes = '';
$modelaaray = array();
$sql1="SELECT * from jenis";
$query1=mysqli_query($con,$sql1);
while($dataarray = mysqli_fetch_assoc($query1)) {
	$modelaaray = explode(":",$dataarray['jenis_listmodel']);
	if ($dataarray['jenis_listmodel']!='') {
		for ($i=0; $i < count($modelaaray); $i++) { 
			$sql1="SELECT * from model where model_id='$modelaaray[$i]'";
			$query1=mysqli_query($con,$sql1);
			$data1=mysqli_fetch_assoc($query1);
			/*
			if ($i==0) {
				$modelname = $data1['model_nama'];
			} else {
				$modelname += ", ".$data1['model_nama'];
			}
			*/
			echo $data1['model_nama'];
			echo "-";
		}
		
		//$tes = $modelname;

	} else {
		$tes = '';
	}
	echo $tes;
}


?>