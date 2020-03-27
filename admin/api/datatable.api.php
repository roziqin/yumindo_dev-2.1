<?php
include '../../config/database.php';
session_start();
$user = $_SESSION['login_user'];
$cabang = '';
$role = $_SESSION['role'];
$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
$limit = $_POST['length']; // Ambil data limit per page
$start = $_POST['start']; // Ambil data start
$data = array();

if ($_GET['ket']=='transaksi-listbahan') {

	$sql = mysqli_query($con, "SELECT pengukuran_detail_temp_id from pengukuran_detail_temp, jenis, bahan, model where pengukuran_detail_temp_jenis=jenis_id and pengukuran_detail_temp_bahan=bahan_id and pengukuran_detail_temp_model=model_id and pengukuran_detail_temp_user='$user'"); 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * from pengukuran_detail_temp, jenis, bahan, model where pengukuran_detail_temp_jenis=jenis_id and pengukuran_detail_temp_bahan=bahan_id and pengukuran_detail_temp_model=model_id and pengukuran_detail_temp_user='$user' and (pengukuran_detail_temp_ruang LIKE '%".$search."%')";

} elseif ($_GET['ket']=='item') {

	$sql = mysqli_query($con, "SELECT bahan_id FROM bahan"); 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM bahan where (bahan_nama LIKE '%".$search."%')";

} elseif ($_GET['ket']=='jenis') {

	$sql = mysqli_query($con, "SELECT jenis_id FROM jenis"); 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM jenis where (jenis_nama LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='model') {

	$sql = mysqli_query($con, "SELECT model_id FROM model"); 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM model where (model_nama LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='user') {

	$sql = mysqli_query($con, "SELECT id FROM users_lain, roles_lain where role=roles_id and roles_nama NOT LIKE '%pelanggan%'"); 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM users_lain, roles_lain where role=roles_id and roles_nama NOT LIKE '%pelanggan%' and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='member') {

	$sql = mysqli_query($con, "SELECT id FROM users_lain, roles_lain where role=roles_id and roles_nama LIKE '%pelanggan%'"); 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM users_lain, roles_lain where role=roles_id and roles_nama LIKE '%pelanggan%' and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='booking') {

	$sql = mysqli_query($con, "SELECT id FROM users_lain, booking_pengukuran where id=booking_pengukuran_pelanggan and (booking_pengukuran_status LIKE '%Booking%' OR booking_pengukuran_status LIKE '%Follow Up%')") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM users_lain, booking_pengukuran where id=booking_pengukuran_pelanggan and (booking_pengukuran_status LIKE '%Booking%' OR booking_pengukuran_status LIKE '%Follow Up%') and (name LIKE '%".$search."%')";

} elseif ($_GET['ket']=='pengukuran') {

	$sql = mysqli_query($con, "SELECT id FROM booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id and booking_pengukuran_status='Follow Up'") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id and booking_pengukuran_status='Follow Up' and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='penawaran') {

	$sql = mysqli_query($con, "SELECT id FROM pengukuran, users_lain where pengukuran_pelanggan=id") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='order-bahan') {

	$sql = mysqli_query($con, "SELECT id FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status='Deal'") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status='Deal' and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='pemotongan') {

	$sql = mysqli_query($con, "SELECT id FROM pengukuran, users_lain where pengukuran_pelanggan=id and (pengukuran_status='Mulai Potong' OR pengukuran_status='Proses Potong' OR pengukuran_status='Selesai Potong' OR pengukuran_status='Proses Jahit' OR pengukuran_status='Selesai Jahit')") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and (pengukuran_status='Mulai Potong' OR pengukuran_status='Proses Potong' OR pengukuran_status='Selesai Potong' OR pengukuran_status='Proses Jahit' OR pengukuran_status='Selesai Jahit') and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='finishing') {

	$sql = mysqli_query($con, "SELECT id FROM pengukuran, users_lain where pengukuran_pelanggan=id and (pengukuran_status='Selesai Jahit' OR pengukuran_status='Proses Steamer' OR pengukuran_status='Selesai Steamer' OR pengukuran_status='Proses Finishing' OR pengukuran_status='Selesai Finishing')") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and (pengukuran_status='Selesai Jahit' OR pengukuran_status='Proses Steamer' OR pengukuran_status='Selesai Steamer' OR pengukuran_status='Proses Finishing' OR pengukuran_status='Selesai Finishing') and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='pemasangan') {

	$sql = mysqli_query($con, "SELECT id FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status NOT LIKE '%Deal%'") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status NOT LIKE '%Deal%' and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='penagihan') {

	$sql = mysqli_query($con, "SELECT id FROM pengukuran, users_lain where pengukuran_pelanggan=id and (pengukuran_status='Selesai Pemasangan' OR pengukuran_status='Selesai Finishing')") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and (pengukuran_status='Selesai Jahit' OR pengukuran_status='Proses Steamer' OR pengukuran_status='Selesai Pemasangan' OR pengukuran_status='Selesai Finishing') and (name LIKE '%".$search."%')";
	
} elseif ($_GET['ket']=='lunas') {

	$sql = mysqli_query($con, "SELECT id FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status='Lunas'") ; 
	$sql_count = mysqli_num_rows($sql);
	$query = "SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status='Lunas' and (name LIKE '%".$search."%')";
	
}

$order_field = $_POST['order'][0]['column']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
$order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
$sql_data = mysqli_query($con, $query.$order." LIMIT ".$limit." OFFSET ".$start); // Query untuk data yang akan di tampilkan
$sql_filter = mysqli_query($con, $query); // Query untuk count jumlah data sesuai dengan filter pada textbox pencarian
$sql_filter_count = mysqli_num_rows($sql_filter); // Hitung data yg ada pada query $sql_filter

if ($_GET['ket']=='jenis') {
	$modelaaray = array();
	$modelname = '';
	$modelaaraykain = array();
	$modelnamekain = '';
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		
		$row_array['jenis_id'] = $dataarray['jenis_id'];
		$row_array['jenis_nama'] = $dataarray['jenis_nama'];
		$row_array['jenis_ket_model'] = $dataarray['jenis_ket_model'];
		
		if ($dataarray['jenis_listmodel']!='') {
			
			$modelaaray = explode(":",$dataarray['jenis_listmodel']);
			for ($i=0; $i < count($modelaaray); $i++) { 
				$sql1="SELECT * from model where model_id='$modelaaray[$i]'";
				$query1=mysqli_query($con,$sql1);
				$data1=mysqli_fetch_assoc($query1);
				if ($i==0) {
					$modelname = $data1['model_nama'];
				} else {
					$modelname .= ", ".$data1['model_nama'];
				}
			}
			
			$row_array['jenis_listmodel'] = $modelname;

		} else {
			$row_array['jenis_listmodel'] = '';
		}

		if ($dataarray['jenis_listkain']!='') {
			
			$modelaaraykain = explode(":",$dataarray['jenis_listkain']);
			for ($i=0; $i < count($modelaaraykain); $i++) { 
				$sql1="SELECT * from bahan where bahan_id='$modelaaraykain[$i]'";
				$query1=mysqli_query($con,$sql1);
				$data1=mysqli_fetch_assoc($query1);
				if ($i==0) {
					$modelnamekain = $data1['bahan_nama'];
				} else {
					$modelnamekain .= ", ".$data1['bahan_nama'];
				}
			}
			
			$row_array['jenis_listkain'] = $modelnamekain;

		} else {
			$row_array['jenis_listkain'] = '';
		}
		

        array_push($data,$row_array);
	}
} elseif ($_GET['ket']=='booking') {
	
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		
		$row_array['booking_pengukuran_id'] = $dataarray['booking_pengukuran_id'];
		$row_array['booking_pengukuran_pelanggan'] = $dataarray['booking_pengukuran_pelanggan'];
		$row_array['booking_pengukuran_tanggal'] = $dataarray['booking_pengukuran_tanggal'];
		$row_array['booking_pengukuran_tanggal_booking'] = $dataarray['booking_pengukuran_tanggal_booking'];
		$row_array['booking_pengukuran_user'] = $dataarray['booking_pengukuran_user'];
		$row_array['booking_pengukuran_status'] = $dataarray['booking_pengukuran_status'];
		$row_array['telepon'] = $dataarray['telepon'];
		$row_array['alamat'] = $dataarray['alamat'];
		$row_array['nama_pelanggan'] = $dataarray['name'];

		$sql1="SELECT * from users_lain where id='$dataarray[booking_pengukuran_user]'";
		$query1=mysqli_query($con,$sql1);
		$data1=mysqli_fetch_assoc($query1);
		$row_array['nama_petugas'] = $data1['name'];
		
		

        array_push($data,$row_array);
	}
} elseif ($_GET['ket']=='penawaran') {
	
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		
		$row_array['pengukuran_tanggal'] = $dataarray['pengukuran_tanggal'];
		$row_array['pengukuran_total_harga'] = $dataarray['pengukuran_total_harga'];
		$row_array['pengukuran_dp'] = $dataarray['pengukuran_dp'];
		$row_array['pengukuran_id'] = $dataarray['pengukuran_id'];
		$row_array['pengukuran_status'] = $dataarray['pengukuran_status'];
		$row_array['telepon'] = $dataarray['telepon'];
		$row_array['alamat'] = $dataarray['alamat'];
		$row_array['nama_pelanggan'] = $dataarray['name'];

		$sql1="SELECT * from users_lain where id='$dataarray[pengukuran_user]'";
		$query1=mysqli_query($con,$sql1);
		$data1=mysqli_fetch_assoc($query1);
		$row_array['nama_petugas'] = $data1['name'];
		
		

        array_push($data,$row_array);
	}
} elseif ($_GET['ket']=='pemasangan') {
	
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		$tanggalpasang = date('d-m-Y', strtotime($dataarray['pengukuran_tanggal'] . ' +14 day'));
		$row_array['pengukuran_tanggal'] = $tanggalpasang;
		$row_array['pengukuran_id'] = $dataarray['pengukuran_id'];
		$row_array['pengukuran_status'] = $dataarray['pengukuran_status'];
		$row_array['name'] = $dataarray['name'];		

        array_push($data,$row_array);
	}
} elseif ($_GET['ket']=='penagihan') {
	
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		
		$row_array['pengukuran_tanggal'] = $dataarray['pengukuran_tanggal'];
		$row_array['pengukuran_tagihan'] = $dataarray['pengukuran_total_harga']-$dataarray['pengukuran_dp'];
		$row_array['pengukuran_id'] = $dataarray['pengukuran_id'];
		$row_array['pengukuran_status'] = $dataarray['pengukuran_status'];
		$row_array['telepon'] = $dataarray['telepon'];
		$row_array['alamat'] = $dataarray['alamat'];
		$row_array['nama_pelanggan'] = $dataarray['name'];

		$sql1="SELECT * from users_lain where id='$dataarray[pengukuran_user]'";
		$query1=mysqli_query($con,$sql1);
		$data1=mysqli_fetch_assoc($query1);
		$row_array['nama_petugas'] = $data1['name'];
		
		

        array_push($data,$row_array);
	}

} elseif ($_GET['ket']=='lunas') {
	
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		
		$row_array['pengukuran_tanggal'] = $dataarray['pengukuran_tanggal'];
		$row_array['pengukuran_tagihan'] = $dataarray['pengukuran_total_harga']-$dataarray['pengukuran_dp'];
		$row_array['pengukuran_id'] = $dataarray['pengukuran_id'];
		$row_array['pengukuran_status'] = $dataarray['pengukuran_status'];
		$row_array['telepon'] = $dataarray['telepon'];
		$row_array['alamat'] = $dataarray['alamat'];
		$row_array['nama_pelanggan'] = $dataarray['name'];

		$sql1="SELECT * from users_lain where id='$dataarray[pengukuran_user]'";
		$query1=mysqli_query($con,$sql1);
		$data1=mysqli_fetch_assoc($query1);
		$row_array['nama_petugas'] = $data1['name'];
		
		

        array_push($data,$row_array);
	}
} /*elseif ($_GET['ket']=='batasstok') {
	$data = array();
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		if ($dataarray['barang_batas_stok'] > $dataarray['barang_stok']) {
			$row_array['barang_nama'] = $dataarray['barang_nama'];
			$row_array['subkategori_nama'] = $dataarray['subkategori_nama'];
			$row_array['barang_stok'] = $dataarray['barang_stok'];
			$row_array['barang_batas_stok'] = $dataarray['barang_batas_stok'];
		} else {

		}
		
        array_push($data,$row_array);
	}
} elseif ($_GET['ket']=='konfpesanan') {
	$data = array();
	$n = 0;
	while($dataarray = mysqli_fetch_assoc($sql_data)) {
		if ($dataarray['orderbarang_status']!="Selesai") {
			$row_array['orderbarang_tanggal'] = $dataarray['orderbarang_tanggal'];
			$row_array['orderbarang_no_pesan'] = $dataarray['orderbarang_no_pesan'];
			$row_array['cabang_nama'] = $dataarray['cabang_nama'];
			$row_array['orderbarang_status'] = $dataarray['orderbarang_status'];
			$n++;
		} else {

		}
		
        array_push($data,$row_array);
	}
	if ($n==0) {
		$row_array['orderbarang_tanggal'] = " ";
		$row_array['orderbarang_no_pesan'] = " ";
		$row_array['cabang_nama'] = "";
		$row_array['orderbarang_status'] = "";
        array_push($data,$row_array);
        $n=1;
	}
	$sql_count = $n;
}*/ else {
	while ($row = $sql_data->fetch_assoc()) {
	    $data[] = $row;
	}
	//$data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC); // Untuk mengambil data hasil query menjadi array

}
//print_r($data);
$callback = array(
    'draw'=>$_POST['draw'], // Ini dari datatablenya
    'recordsTotal'=>$sql_count,
    'recordsFiltered'=>$sql_filter_count,
    'data'=>$data
);
header('Content-Type: application/json');
echo json_encode($callback); // Convert array $callback ke j