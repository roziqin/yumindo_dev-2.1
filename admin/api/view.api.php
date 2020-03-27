<?php
include '../../config/database.php';
include "../../include/hitung_harga.php";
session_start();
date_default_timezone_set('Asia/jakarta');
$bln=date('Y-m');
$user = $_SESSION['login_user'];
$cabang = '';
$role = $_SESSION['role'];

$func = $_GET['func'];

if ($func=='omset-grafik-dashboard') {

    $query = "SELECT pengukuran_tanggal, sum(pengukuran_total_harga) as total FROM pengukuran where pengukuran_bulan = '$bln' and pengukuran_status NOT LIKE '%penawaran%' GROUP BY pengukuran_tanggal";

} elseif ($func=='transaksi-grafik-dashboard') {

    $query = "SELECT pengukuran_tanggal, COUNT(pengukuran_id) as jumlah FROM pengukuran where pengukuran_bulan = '$bln' and pengukuran_status NOT LIKE '%penawaran%' GROUP BY pengukuran_tanggal";

} elseif ($func=='edititem') {
	$id = $_POST['item_id'];
	$query = "SELECT * from bahan where bahan_id='$id'";

} elseif ($func=='text-dashboard') {

    $query = "SELECT SUM(pengukuran_total_harga) as total FROM pengukuran where pengukuran_bulan='$bln' and pengukuran_status NOT LIKE '%penawaran%' ";

} elseif ($func=='editjenis') {
	$id = $_POST['jenis_id'];
	$query = "SELECT * from jenis where jenis_id='$id'";

} elseif ($func=='editmodel') {
    $id = $_POST['model_id'];
    $query = "SELECT * from model where model_id='$id'";

} elseif ($func=='edituser') {
	$id = $_POST['id'];
	$query = "SELECT * from users_lain where id='$id'";

} elseif ($func=='editmember') {
    $id = $_POST['id'];
    $query = "SELECT * from users_lain where id='$id'";

} elseif ($func=='editsetting') {
	$id = 1;
	$query = "SELECT * from pengaturan_perusahaan where pengaturan_id='$id'";

} elseif ($func=='laporan-nota') {
       
    $ket = "transaksi_tanggal"; 
    $tgl11 = date("Y-m-j", strtotime($_POST['start']));
    $tgl22 = date("Y-m-j", strtotime($_POST['end']));
    

    $query ="SELECT * from transaksi, users WHERE transaksi_user=id and transaksi_tanggal BETWEEN '$tgl11' AND '$tgl22'";

} elseif ($func=='laporan-omset') {
    
        $tgl1 = date("Y-m", strtotime($_POST['start']));
        $tgl2 = date("Y-m", strtotime($_POST['end']));

    $query ="SELECT laporan_omset_bulan, sum(laporan_omset_jumlah) as total from laporan_omset where laporan_omset_bulan between '$tgl1' and '$tgl2' group by laporan_omset_bulan order by laporan_omset_bulan ASC";

} elseif ($func=='detail-laporan') {
	     
	$bln = $_POST['bulan'];

	$query ="SELECT * from pengukuran, users_lain, laporan_omset WHERE pengukuran_pelanggan=id and pengukuran_id=laporan_omset_pengukuran_id and laporan_omset_bulan='$bln' ";

}  elseif ($func=='laporan-kasir') {
	
    $kasir = $_POST['kasir'];

    if ($kasir==0) {
        $text1 = '';
        $text2 = ', transaksi_user';
    } else {
        $text1 = 'transaksi_user='.$kasir.' and ';
        $text2 = '';

    }

    if ($_POST['daterange']=="harian") {
        $ket = "transaksi_tanggal"; 
		$tgl11 = date("Y-m-j", strtotime($_POST['start']));
	    $tgl22 = date("Y-m-j", strtotime($_POST['end']));
    } elseif ($_POST['daterange']=="bulanan") {
        $ket = "transaksi_bulan";     
		$tgl11 = date("Y-m", strtotime($_POST['start']));
	    $tgl22 = date("Y-m", strtotime($_POST['end']));
    }

	$query ="SELECT transaksi_tanggal, transaksi_bulan, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon, transaksi_user, id, name from transaksi, users WHERE transaksi_user=id and $text1 $ket BETWEEN '$tgl11' AND '$tgl22' GROUP BY $ket $text2 ";

} elseif ($func=='followup') {
    $id = $_POST['booking_id'];
    //$id = 955;
    $query = "SELECT * from booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id and booking_pengukuran_id='$id'";

} elseif ($func=='detailpenawaran') {
         
    $id = $_POST['id'];
    //$id = 638;

    $query ="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$id ";

} elseif ($func=='hitungpenawaran') {
         
    $id = $_POST['id'];
    //$id = 639;

    $query ="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_id=$id ";

} elseif ($func=='listpengukuran') {
         
    $id = $_POST['id'];
    //$id = 638;

    $query ="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_id=$id ";

} elseif ($func=='edititempenawaran') {
    $id = $_POST['id'];
    //$id = 638;

    $query ="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_detail_id=$id ";

} elseif ($func=='orderbahan') {
         
    $id = $_POST['id'];
    //$id = 631;

    $query ="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_id=$id ";

} elseif ($func=='pemotongan') {
         
    $id = $_POST['id'];
    //$id = 638;

    $query ="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_id=$id ";

} elseif ($func=='cekmodel') {
    $id = $_POST['idjenis'];
    //$id = 8;
    $query = "SELECT * from jenis where jenis_id='$id'";

} elseif ($func=='detailorder') {
    $query = "SELECT * FROM pengukuran_detail_temp, jenis where pengukuran_detail_temp_jenis=jenis_id and pengukuran_detail_temp_user='$user'";

}


$result = mysqli_query($con,$query);
$array_data = array();
$array_data1 = array();

if ($func=="text-dashboard") {

    $sql1="SELECT SUM(pengukuran_total_harga) AS total_harga, SUM(pengukuran_pelunasan) AS pelunasan, COUNT(pengukuran_id) AS jml FROM pengukuran WHERE pengukuran_bulan='$bln' and pengukuran_status NOT LIKE '%penawaran%' ";
    $query1=mysqli_query($con,$sql1);
    $data1=mysqli_fetch_assoc($query1);

    $sql2="SELECT SUM(pengukuran_detail_jumlah) AS jumlah_barang FROM pengukuran, pengukuran_detail WHERE pengukuran.pengukuran_id=pengukuran_detail.pengukuran_id and pengukuran_bulan='$bln' and pengukuran_status NOT LIKE '%penawaran%' ";
    $query2=mysqli_query($con,$sql2);
    $data2=mysqli_fetch_assoc($query2);


    $sql3 = "SELECT SUM(laporan_omset_jumlah) as uang_masuk from laporan_omset where laporan_omset_bulan='$bln'";
    $query3=mysqli_query($con,$sql3);
    $data3=mysqli_fetch_assoc($query3);

    $total_harga = 0;
    $uang_masuk = 0;
    $jml = 0;
    $jumlah_barang = 0;

    if ($data1['total_harga']!='' || $data1['total_harga']!=NULL) {
        $total_harga = $data1['total_harga'];
    }
    if ($data3['uang_masuk']!='' || $data3['uang_masuk']!=NULL) {
        $uang_masuk = $data3['uang_masuk'];
    }
    if ($data1['jml']!='' || $data1['jml']!=NULL) {
        $jml = $data1['jml'];
    }
    if ($data2['jumlah_barang']!='' || $data2['jumlah_barang']!=NULL) {
        $jumlah_barang = $data2['jumlah_barang'];
    }

    $row_array['total_harga'] = $total_harga;
    $row_array['uang_masuk'] = $uang_masuk;
    $row_array['jml'] = $jml;
    $row_array['jumlah_barang'] = $jumlah_barang;
    array_push($array_data,$row_array);
    while($data = mysqli_fetch_assoc($result))
    {
        $array_data[]=$data;
    }

} elseif ($func=="followup") {

    while($data = mysqli_fetch_assoc($result)) {

        $sql1="SELECT * from users_lain where id='$data[booking_pengukuran_user]'";
        $query1=mysqli_query($con,$sql1);
        $data1=mysqli_fetch_assoc($query1);

        $sql2="SELECT * from pengukuran where pengukuran_pelanggan='$data[booking_pengukuran_pelanggan]'";
        $query2=mysqli_query($con,$sql2);
        $data2=mysqli_fetch_assoc($query2);

        $row_array['booking_pengukuran_tanggal_booking'] = $data['booking_pengukuran_tanggal_booking'];
        $row_array['name'] = $data['name'];
        $row_array['alamat'] = $data['alamat'];
        $row_array['telepon'] = $data['telepon'];
        $row_array['booking_pengukuran_status'] = $data['booking_pengukuran_status'];
        $row_array['booking_pengukuran_id'] = $data['booking_pengukuran_id'];
        $row_array['booking_pengukuran_pelanggan'] = $data['booking_pengukuran_pelanggan'];
        $row_array['petugas'] = $data1["name"];
        $row_array['pdf_id_ukur'] = $data2['pengukuran_id'];
        array_push($array_data,$row_array);

    }
} elseif ($func=="cekmodel") {
    $arrayjenismodel = array();
    $arrayjenisbahan = array();
    $arraymodelnama = array();
    $arraymodelid = array();
    $arraybahannama = array();
    $arraybahanid = array();
    while($data = mysqli_fetch_assoc($result)) {
        if ($data["jenis_ket_model"]==1) {
            $arrayjenismodel = explode(":",$data["jenis_listmodel"]);
            
            for ($i=0; $i < count($arrayjenismodel); $i++) { 
                $sql1="SELECT * from model where model_id='$arrayjenismodel[$i]'";
                $query1=mysqli_query($con,$sql1);
                $data1=mysqli_fetch_assoc($query1);
                $arraymodelnama[$i] = $data1['model_nama'];
                $arraymodelid[$i] = $data1['model_id'];
            
            }
            $row_array['namamodel'] = $arraymodelnama;
            $row_array['idmodel'] = $arraymodelid;
            $row_array['lengthdata'] = count($arrayjenismodel);
            
        } else {
            $row_array['namamodel'] = '';
            $row_array['idmodel'] = '';
            $row_array['lengthdata'] = 0;

        }

        $arrayjenisbahan = explode(":",$data["jenis_listkain"]);
        
        if ($data["jenis_listkain"]!='') {
            for ($i=0; $i < count($arrayjenisbahan); $i++) { 
                $sql2="SELECT * from bahan where bahan_id='$arrayjenisbahan[$i]'";
                $query2=mysqli_query($con,$sql2);
                $data2=mysqli_fetch_assoc($query2);
                $arraybahannama[$i] = $data2['bahan_nama'];
                $arraybahanid[$i] = $data2['bahan_id'];
            
            }
            $row_array['namabahan'] = $arraybahannama;
            $row_array['idbahan'] = $arraybahanid;
            $row_array['lengthdatabahan'] = count($arrayjenisbahan);
        } else {
            $row_array['namabahan'] = '';
            $row_array['idbahan'] = '';
            $row_array['lengthdatabahan'] = 0;

        }
        array_push($array_data,$row_array);
        

    }
} elseif ($func=="detailorder") {

    $sql1="SELECT * FROM users_lain, pelanggan_temp WHERE pelanggan_temp_id_pelanggan=id and pelanggan_temp_user='$user' ";
    $query1=mysqli_query($con,$sql1);
    $data1=mysqli_fetch_assoc($query1);

    $row_array['nama'] = $data1['name'];
    $row_array['alamat'] = $data1['alamat'];
    array_push($array_data,$row_array);
    while($data = mysqli_fetch_assoc($result))
    {
        $array_data[]=$data;
    }

} elseif ($func=="hitungpenawaran") {
    $totalpremium = 0;
    $totalgold = 0;
    $totalsilver = 0;
    while($data = mysqli_fetch_assoc($result)) {
        $jenis = $data['pengukuran_detail_jenis'];
        $namajenis = $data['jenis_nama'];
        $model = $data['pengukuran_detail_model'];
        $namamodel = $data['model_nama'];
        $bahan = $data['pengukuran_detail_bahan'];
        $namabahan = $data['bahan_nama'];
        $tinggi = $data['pengukuran_detail_tinggi'];
        $lebar = $data['pengukuran_detail_lebar'];
        $volume = $data['pengukuran_detail_volume'];
        $jumlah = $data['pengukuran_detail_jumlah'];
        $hargabahan = $data['pengukuran_detail_harga_bahan'];
        $hargabox = $data['pengukuran_detail_harga_box'];
        
        $pilihkualitaspremium = "Premium";
        $hasilhitungharga = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitaspremium);

        $totalpremium += $hasilhitungharga;

        $pilihkualitasgold = "Gold";
        $hasilhitunghargagold = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitasgold);

        $totalgold += $hasilhitunghargagold;

        $pilihkualitassilver = "Silver";
        $hasilhitunghargasilver = hitungHarga($jenis,$namajenis,$model,$namamodel,$bahan,$namabahan,$tinggi,$lebar,$volume,$jumlah,$hargabahan,$hargabox,$pilihkualitassilver);

        $totalsilver += $hasilhitunghargasilver;
    }

    $row_array['totalpremium'] = $totalpremium;
    $row_array['totalgold'] = $totalgold;
    $row_array['totalsilver'] = $totalsilver;
    array_push($array_data,$row_array);

} elseif ($func=="orderbahan") {
    $id = $_POST['id'];
    //$id=631;

    $sql1="SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$id ";
    $query1=mysqli_query($con,$sql1);
    $data1=mysqli_fetch_assoc($query1);

    $row_array['idp'] = $id;
    $row_array['nama'] = $data1['name'];
    $row_array['alamat'] = $data1['alamat'];
    $row_array['telepon'] = $data1['telepon'];
    $row_array['status'] = $data1['pengukuran_status'];
    $row_array['kualitas'] = $data1['pengukuran_kualitas'];

    //array_push($array_data,$row_array);

    $q= "SELECT * FROM pengaturan_perusahaan where pengaturan_id='1'";
    $r=mysqli_query($con, $q);
    $d=mysqli_fetch_assoc($r);

    $row_array['premium'] = $d['pengaturan_kualitas_premium'];
    $row_array['gold'] = $d['pengaturan_kualitas_gold'];
    $row_array['silver'] = $d['pengaturan_kualitas_silver'];
    $row_array['vitraspremium'] = $d['pengaturan_kualitas_vitras_premium'];
    $row_array['vitrasgold'] = $d['pengaturan_kualitas_vitras_gold'];
    $row_array['vitrassilver'] = $d['pengaturan_kualitas_vitras_silver'];

    array_push($array_data,$row_array);


    while($data = mysqli_fetch_assoc($result))
    {
        $array_data['listbarang'][]=$data;
    }

    $sql2="SELECT pengukuran_detail_kode_bahan, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$id' GROUP BY pengukuran_detail_kode_bahan ";
    $query2=mysqli_query($con,$sql2);
    while($data2 = mysqli_fetch_assoc($query2))
    {
        if ($data2['pengukuran_detail_kode_bahan']!='') {
            $array_data['kodebahan'][]=$data2;
        }
    }
    
    $sql3="SELECT pengukuran_detail_kode_bahan_1, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$id' GROUP BY pengukuran_detail_kode_bahan_1 ";
    $query3=mysqli_query($con,$sql3);
    while($data3 = mysqli_fetch_assoc($query3))
    {
        if ($data3['pengukuran_detail_kode_bahan_1']!='') {
            $array_data['kodebahan1'][]=$data3;
        }
    }
    
    $sql4="SELECT pengukuran_detail_id, order_bahan_jumlah_kode_bahan_1, order_bahan_jumlah_kode_bahan_2, order_bahan_kode_bahan_1, order_bahan_kode_bahan_2 from pengukuran_detail,order_bahan where pengukuran_detail_id=order_bahan_detail_pengukuran_id and pengukuran_id='$id' ";
    $query4=mysqli_query($con,$sql4);
    while($data4 = mysqli_fetch_assoc($query4))
    {
        $array_data['orderbahanid'][]=$data4;
    }

    $sql5="SELECT sum(order_bahan_jumlah_kode_bahan_1) as jumlah, order_bahan_kode_bahan_1 as kode_bahan from pengukuran_detail,order_bahan where pengukuran_detail_id=order_bahan_detail_pengukuran_id and pengukuran_id='$id' GROUP BY order_bahan_kode_bahan_1 ";
    $query5=mysqli_query($con,$sql5);
    while($data5 = mysqli_fetch_assoc($query5))
    {
        $array_data['dataorderbahan'][]=$data5;
    }

    $sql6="SELECT sum(order_bahan_jumlah_kode_bahan_2) as jumlah, order_bahan_kode_bahan_2 as kode_bahan from pengukuran_detail,order_bahan where pengukuran_detail_id=order_bahan_detail_pengukuran_id and pengukuran_id='$id' GROUP BY order_bahan_kode_bahan_2 ";
    $query6=mysqli_query($con,$sql6);
    while($data6 = mysqli_fetch_assoc($query6))
    {
        $array_data['dataorderbahan'][]=$data6;
    }

    $sql7="SELECT sum(order_bahan_jumlah_rel_alat_1) as jumlah, order_bahan_rel_alat_1 as alat from pengukuran_detail,order_bahan where pengukuran_detail_id=order_bahan_detail_pengukuran_id and pengukuran_id='$id' GROUP BY order_bahan_rel_alat_1 ";
    $query7=mysqli_query($con,$sql7);
    while($data7 = mysqli_fetch_assoc($query7))
    {
        $array_data['dataorderrel'][]=$data7;
    }

    $sql8="SELECT sum(order_bahan_jumlah_rel_alat_2) as jumlah, order_bahan_rel_alat_2 as alat from pengukuran_detail,order_bahan where pengukuran_detail_id=order_bahan_detail_pengukuran_id and pengukuran_id='$id' GROUP BY order_bahan_rel_alat_2 ";
    $query8=mysqli_query($con,$sql8);
    while($data8 = mysqli_fetch_assoc($query8))
    {
        $array_data['dataorderrel1'][]=$data8;
    }

}elseif ($func=="pemotongan") {
    $id = $_POST['id'];
    //$id=638;

    $sql1="SELECT * FROM pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$id ";
    $query1=mysqli_query($con,$sql1);
    $data1=mysqli_fetch_assoc($query1);

    $totalharga = $data1['pengukuran_total_harga'];
    $dp = $data1['pengukuran_dp_awal'];
    $diskon = $data1['pengukuran_diskon'];
    $sisa = $totalharga - $dp;


    $sql2="SELECT * FROM pengaturan_perusahaan where pengaturan_id=1 ";
    $query2=mysqli_query($con,$sql2);
    $d=mysqli_fetch_assoc($query2);

    $pilihkualitas = $data1['pengukuran_kualitas'];;
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

    $row_array['id'] = $id;
    $row_array['harga'] = $totalharga;
    $row_array['dp'] = $dp;
    $row_array['diskon'] = $diskon;
    $row_array['sisa'] = $sisa;
    $row_array['nama'] = $data1['name'];
    $row_array['alamat'] = $data1['alamat'];
    $row_array['telepon'] = $data1['telepon'];
    $row_array['status'] = $data1['pengukuran_status'];
    $row_array['kualitas'] = $data1['pengukuran_kualitas'];
    $row_array['kualitaskali'] = $kualitas;
    $row_array['kualitaskalivitras'] = $kualitas_vitras;
    $row_array['catatanpotong'] = $data1['pengukuran_keterangan'];
    $row_array['catatanjahit'] = $data1['pengukuran_catatan_jahit'];
    $row_array['ppn'] = $data1['pengukuran_ppn_jumlah'];
    $row_array['konfirmasi'] = $data1['pengukuran_konfirmasi'];
    $row_array['tglselesai'] = date('d-m-Y', strtotime($data1['pengukuran_tanggal_deal'] . ' +10 day'));

    array_push($array_data,$row_array);


    while($data = mysqli_fetch_assoc($result))
    {
        $array_data['listbarang'][]=$data;
    }

} else {
	while($baris = mysqli_fetch_assoc($result))
	{
	  $array_data[]=$baris;
	}
}

echo json_encode($array_data);

?>


