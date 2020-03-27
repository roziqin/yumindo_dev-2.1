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
  
$sql3="SELECT * from  users_lain where id='$idpelanggan' ";
$query3=mysqli_query($con,$sql3);
$data3=mysqli_fetch_assoc($query3);

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
  $catatan = $data['pengukuran_keterangan']."<br>".$data['pengukuran_catatan_jahit'];
  $sisa = $totalharga - $dp;
  $tanggal = date('d-m-Y', strtotime($data["pengukuran_tanggal"] . ' +0 day'));
  $ket = "";
  if ($data['pengukuran_status']=='Deal') {
  	# code...
  	$ket = "Invoice";
  } elseif ($data['pengukuran_status']=='Penawaran') {
  	# code...
  	$ket = "Penawaran";
  } else {
  	$ket = "Invoice";
  	
  }

	$aid = $data['pengukuran_user'];
	$aa = "SELECT * from users_lain where id='$aid'";
	$bb = mysqli_query($con,$aa);
	$cc = mysqli_fetch_assoc($bb);
	$id=$cc['name'];
	$iduser=$cc['id'];

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
	    <td width="10%">Tanggal</td>
	    <td width="3%">:</td>
	    <td width="42%">'.$tanggal.'</td>
	    <td  align="right" width="45%" style="font-size:16px; font-weight: 700;">Form '.$ket.'</td>
	  </tr>
	  <tr>
	    <td>Customer</td>
	    <td>:</td>
	    <td>'.$pelanggan.'</td>
	    <td  align="right" >Petugas : '.$_SESSION['name'].'</td>
	  </tr>
	  <tr>
	    <td>Alamat</td>
	    <td>:</td>
	    <td>'.$alamat.'</td>
	    <td align="right" ></td>
	  </tr>
	  <tr>
	    <td>No Telp</td>
	    <td>:</td>
	    <td>'.$notelp.'</td>
	    <td align="right" ></td>
	  </tr>
	  <tr>
	    <td>Email</td>
	    <td>:</td>
	    <td>'.$email.'</td>
	    <td align="right" ></td>
	  </tr>
	</table>

	<table width="100%"  style="font-size: 13px;border-spacing: 0;" class="print">
	  <tr style="text-align: center;">
	    <th  width="100px">Ruang</th>
	    <th >Jumlah</th>
	    <th >Jenis<br>G/V/BL</th>
	    <th >Kode<br>Bahan</th>
	    <th  width="150px">model</th>
	    <th width="100px">Harga</th>
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

		$tot+=$datatea["pengukuran_detail_harga"];
		
		$html.='
			<tr>
				<td style="text-align: left;">'.$datatea["pengukuran_detail_ruang"].'</td>
				<td style="text-align: center;">'.$datatea["pengukuran_detail_jumlah"].'</td>
				<td>'.$datatea["jenis_nama"].' '.$jenislain.'</td>
				<td>'.$datatea["pengukuran_detail_kode_bahan"].''.$kode1.'</td>
				<td>'.$datatea["model_nama"].'</td>
				<td style="text-align:right;">Rp '.format_rupiah($datatea["pengukuran_detail_harga"]).'</td>
			</tr>

		';
	}
	if ($dp==0) {
		# code...
		
		if ($diskon==0) {
			# code...
			$html.='
				<tr>
					<td colspan="5" style="border-top:2px solid #000;">Total</td>
					<td style="text-align:right;border-top:2px solid #000;">Rp '.format_rupiah($tot).'</td>
				</tr>';
		} else {
			# code...
			$html.='
				<tr>
					<td colspan="5" style="border-top:2px solid #000;">Subtotal</td>
					<td style="text-align:right;border-top:2px solid #000;">Rp '.format_rupiah($tot).'</td>
				</tr>
				<tr>
					<td colspan="5">Diskon</td>
					<td style="text-align:right;">Rp '.format_rupiah($diskon).'</td>
				</tr>
				<tr>
					<td colspan="5">Total</td>
					<td style="text-align:right;">Rp '.format_rupiah($totalharga).'</td>
				</tr>';
		
		}

		
		$html.='
		</table>
		<table style="font-size: 13px;width: 100%;">
		  <tr>
		    <td width="50%">Saya telah memahami dan menyetujui ukuran, bahan, dan model tersebut di atas</td>
		    <td rowspan="3" width="5px"><hr style="border: 0px;width: 1px;height: 300px;background-color: #000000;"></td>
		    <td width="45%">Keterangan</td>
		  </tr>
		  <tr>
		    <td>Pemesan<br><br><br><br><br><br></td>
		    <td style="vertical-align: top;">'.$catatan.'</td>
		  </tr>
		  ';

	  	if ($ppn=='ya') {
			# code...
			$html.='
				<tr>
				    <td>
				      Keterangan<br>
				      1. Harga belum termasuk PPN 10%<br>
				      2. Proses 14 hari kerja setelah DP<br>
				      3. DP Minimal 50%<br>
				      4. Harga sdh termasuk biaya survey dan pemasangan di dalam kota Malang<br><br>

				      Demikian surat penawaran ini, semoga bisa terjalin kerjasama yang saling menguntungkan<br>
				      Hormat Kami,
				      <br><br><br><br><br>
				      Achmad Shodiq<br>
				      Direktur CV. Senyum Indonesia<br>
				      Yumindo Gorden dan Interior

				    </td>
				    <td></td>
				</tr>
			';
		} else {
			# code...
			$html.='
				<tr>
				    <td>
				      Keterangan<br>
				      1. Proses 14 hari kerja setelah DP<br>
				      2. DP Minimal 50%<br>
				      3. Harga sdh termasuk biaya survey dan pemasangan di dalam kota Malang<br><br>

				      Demikian surat penawaran ini, semoga bisa terjalin kerjasama yang saling menguntungkan<br>
				      Hormat Kami,
				      <br><br><br><br><br>
				      Achmad Shodiq<br>
				      Direktur CV. Senyum Indonesia<br>
				      Yumindo Gorden dan Interior

				    </td>
				    <td></td>
				</tr>
		
			';
		}
			
		$html.='
		  
		</table>
		';
	} else {
		# code...
		$html.='
			<tr>
				<td colspan="5" style="border-top:2px solid #000;">Subtotal</td>
				<td style="text-align:right; border-top:2px solid #000;">Rp '.format_rupiah($tot).'</td>
			</tr>
			<tr>
				<td colspan="5">Diskon</td>
				<td style="text-align:right;">Rp '.format_rupiah($diskon).'</td>
			</tr>
			<tr>
				<td colspan="5">Total</td>
				<td style="text-align:right;">Rp '.format_rupiah($totalharga).'</td>
			</tr>
			<tr>
				<td colspan="5">DP</td>
				<td style="text-align:right;">Rp '.format_rupiah($dp).'</td>
			</tr>
			<tr>
				<td colspan="5">Sisa</td>
				<td style="text-align:right;">Rp '.format_rupiah($sisa).'</td>
			</tr>
		</table>
		<table style="font-size: 13px;width: 100%;">
		  <tr>
		    <td width="50%"></td>
		    <td rowspan="3" width="5px"><hr style="border: 0px;width: 1px;height: 200px;background-color: #000000;"></td>
		    <td  width="45%">Keterangan</td>
		  </tr>
		  <tr>
		    <td>Pemesan<br><br><br><br><br><br></td>
		    <td style="vertical-align: top;">'.$catatan.'</td>
		  </tr>
		  <tr>
		    <td>
		      Catatan<br>
		      *Biaya pengukuran kota Malang Rp 50.000 yang dibayarkan saat pengukuran (luar kota penyesuaian)
		      *Biaya tersebut dipotongkan jika ada DP
		      *hasil pengukuran adalah hak dari Yumindo Garden
		    </td>
		    <td></td>
		  </tr>
		</table>
		';
	}
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
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("formpengukuran-".$tanggal."-".$pelanggan.".pdf", array("Attachment"=>0));

?>
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>