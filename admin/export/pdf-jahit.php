<?php
session_start();
include '../../config/database.php';
include '../../include/format_rupiah.php';
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-d');
$wkt=date('G:i:s');

$t = $_GET['id'];
$sql="SELECT * from pengukuran, users_lain where pengukuran_user=id and pengukuran_id='$t' ";
$query=mysqli_query($con,$sql);
while ($data=mysqli_fetch_assoc($query)) {
  $idpelanggan=$data['pengukuran_pelanggan'];
  $userjahit=$data['pengukuran_user_potong'];
  
	$sql3="SELECT * from  users_lain where id='$idpelanggan' ";
	$query3=mysqli_query($con,$sql3);
	$data3=mysqli_fetch_assoc($query3);

	$sql4="SELECT * from  users_lain where id='$userjahit' ";
	$query4=mysqli_query($con,$sql4);
	$data4=mysqli_fetch_assoc($query4);

	$ketkualitas = $data["pengukuran_kualitas"];
  $pelanggan=$data3['name'];
  $alamat=$data3['alamat'];
  $email=$data3['email'];
  $notelp=$data3['telepon'];
  $user=$data['name'];
  $id=$data['id'];
  $diskon = $data['pengukuran_diskon'];
  $totalharga = $data['pengukuran_total_harga'];
  $dp = $data['pengukuran_dp'];
  $ppn = $data['pengukuran_ppn'];
  $catatan = $data['pengukuran_catatan_jahit'];
  $sisa = $totalharga - $dp;
  $tanggal = date('d-m-Y', strtotime($data["pengukuran_tanggal"] . ' +0 day'));
  $tanggaldeal = $data["pengukuran_tanggal_deal"];

  $tanggaldeal = date('Y-m-d', strtotime($tanggaldeal . ' +10 day'));
  $ket = "";
  if ($data['pengukuran_status']=='Deal') {
  	# code...
  	$ket = "Invoice";
  } elseif ($data['pengukuran_status']=='Penawaran') {
  	# code...
  	$ket = "Penawaran";
  } else {
  	$ket = "Jahit";
  	
  }

	$aid = $data['pengukuran_user'];
	$aa = "SELECT * from users_lain where id='$aid'";
	$bb = mysqli_query($con,$aa);
	$cc = mysqli_fetch_assoc($bb);
	$id=$cc['name'];
	$iduser=$cc['id'];

}

$sql2="SELECT * FROM pengaturan_perusahaan where pengaturan_id=1 ";
$query2=mysqli_query($con,$sql2);
$d=mysqli_fetch_assoc($query2);

$pilihkualitas = $ketkualitas;
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
$html = '
	<style>
table.print {
    border-collapse: collapse;
}

table.print , table.print td, table.print th {
    border: 1px solid black;
}
</style>
	<div style="width: 100%; display: inline-block;"><img src="../../assets/img/logoyumindo.png" width="100px" height="auto" style="float: left;display: inline-block;"><div style="float: left; display: inline-block; width: 205px; padding-top: 20px;">Jalan Semanggi Timur Kav 1A, Jalan Soekarno Hatta, Jatimulyo, Kec. Lowokwaru, Kota Malang</div></div>
	<div style="clear: both;"></div>
	<table  width="100%" border="0"  style="font-size: 13px;"">
	  <tr>
	    <td>Nama Customer</td>
	    <td>:</td>
	    <td>'.$pelanggan.'</td>
	    <td  align="right" ></td>
	  </tr>
	  <tr>
	    <td>Nama Penjahit</td>
	    <td>:</td>
	    <td>'.$data4["name"].'</td>
	    <td  align="right" ></td>
	  </tr>
	  <tr>
	    <td>Kualitas</td>
	    <td>:</td>
	    <td>'.$ketkualitas.'</td>
	    <td  align="right" ></td>
	  </tr>
	  <tr>
	    <td width="10%">Tanggal Selesai</td>
	    <td width="3%">:</td>
	    <td width="42%">'.$tanggaldeal.'</td>
	    <td  align="right" width="45%" style="font-size:24px; font-weight: 700;">Form '.$ket.'</td>
	  </tr>
	</table>

	<table width="100%" border="1"  style="font-size: 13px;border-spacing: 0;" class="print">
	   <tr style="text-align: center;">
	    <th rowspan="2" width="80px">Ruang</th>
	    <th rowspan="2" width="100px">Jenis<br>G/V/BL</th>
	    <th rowspan="2" width="110px">Kode Bahan</th>
	    <th rowspan="2" width="110px">model</th>
	    <th rowspan="2" width="50px">Tarikan</th>
	    <th rowspan="2" width="60px">KT/E</th>
	    <th colspan="2">Ukuran</th>
	    <th colspan="2">Pot/Jahit</th>
	    <th rowspan="2" width="30px">Vol</th>
	    <th rowspan="2" width="30px">Jml</th>
	  </tr>
	  <tr>
	    <th width="40px" style="text-align:center;">T</th>
	    <th width="40px" style="text-align:center;">L</th>
	    <th width="40px" style="text-align:center;">T</th>
	    <th width="40px" style="text-align:center;">L</th>
	  </tr>
	';
	$tot = 0;
	$sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$t' ORDER BY pengukuran_detail_id ASC";
	$queryte1=mysqli_query($con,$sqlte1);
	while ($datatea=mysqli_fetch_assoc($queryte1)) {
		$kode1="";
		if ($datatea["pengukuran_detail_kode_bahan_1"]!="") {
			# code...
			$kode1 = "/".$datatea["pengukuran_detail_kode_bahan_1"];
		}

		$jenislain = "";
		if ($datatea["pengukuran_detail_jenis_lain"]!="") {
			$jenislain = "(".$datatea["pengukuran_detail_jenis_lain"].")";
		}

		if ($datatea["jenis_nama"]=='Vitras') {
			$tinggi = $datatea["pengukuran_detail_tinggi"]*$kualitas_vitras;
			$lebar = $datatea["pengukuran_detail_lebar"]*$kualitas_vitras;
		} elseif ($datatea["jenis_nama"]=='Gorden & Vitras') {
			$tinggi1 = $datatea["pengukuran_detail_tinggi"]*$kualitas_vitras;
			$lebar1 = $datatea["pengukuran_detail_lebar"]*$kualitas_vitras;

			$tinggi2 = $datatea["pengukuran_detail_tinggi"]*$kualitas;
			$lebar2 = $datatea["pengukuran_detail_lebar"]*$kualitas;
			
			$tinggi = 'G:'.$tinggi2.'<br>V:'.$tinggi1;
			$lebar = 'G:'.$lebar2.'<br>V:'.$lebar1;			
		} else {
			$tinggi = $datatea["pengukuran_detail_tinggi"]*$kualitas;
			$lebar = $datatea["pengukuran_detail_lebar"]*$kualitas;

		}
		$tot+=$datatea["pengukuran_detail_harga"];
		
		$html.='
			<tr>
				<td style="text-align: left;">'.$datatea["pengukuran_detail_ruang"].'</td>
				<td>'.$datatea["jenis_nama"].' '.$jenislain.'</td>
				<td>'.$datatea["pengukuran_detail_kode_bahan"].''.$kode1.'</td>
				<td>'.$datatea["model_nama"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_tarikan"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_kt"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_tinggi"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_lebar"].'</td>
				<td style="text-align:center;">'.$tinggi.'</td>
				<td style="text-align:center;">'.$lebar.'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_volume"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_jumlah"].'</td>
			</tr>

		';
	}
	
	$html.='
		</table>
		<table style="font-size: 13px;" width="100%">
		  <tr>
		    <td width="50%">
		    	<br>
		      *Vitras smokring dikurangi 6 cm<br>
		      **Vitras Triplet dikurangi 2cm
		    	Semua gorden E tali 1, KT tali 2
		    </td>
		    <td rowspan="3" width="5px"><hr style="border: 0px;width: 1px;height: 70px;background-color: #000000;"></td>
		    <td width="45%" >Catatan Khusus<br>'.$catatan.'</td>
		  </tr>
		</table>
	';
	//echo $html;

require_once '../../include/dompdf/lib/html5lib/Parser.php';
require_once '../../include/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once '../../include/dompdf/lib/php-svg-lib/src/autoload.php';
require_once '../../include/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("formjahit-".$tanggal."-".$pelanggan.".pdf", array("Attachment"=>0));

?>
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
