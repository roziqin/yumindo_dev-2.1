<?php
$con = mysqli_connect("localhost","root","","yumindon_new");

if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>