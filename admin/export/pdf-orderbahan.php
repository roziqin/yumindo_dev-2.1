<?php
session_start();
include '../../config/database.php';
include '../../include/format_rupiah.php';
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-d');
$wkt=date('G:i:s');

$array_data = array();
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

$id = $t;
$sql="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_id=$t";
$query=mysqli_query($con,$sql);
while($data = mysqli_fetch_assoc($query))
{
    $array_data['listbarang'][]=$data;
}

$sql2="SELECT pengukuran_detail_kode_bahan as kode_bahan, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$id' GROUP BY pengukuran_detail_kode_bahan ";
$query2=mysqli_query($con,$sql2);
while($data2 = mysqli_fetch_assoc($query2))
{
    if ($data2['kode_bahan']!='') {
        $array_data['kodebahan'][]=$data2;
    }
}

$sql3="SELECT pengukuran_detail_kode_bahan_1 as kode_bahan, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$id' GROUP BY pengukuran_detail_kode_bahan_1 ";
$query3=mysqli_query($con,$sql3);
while($data3 = mysqli_fetch_assoc($query3))
{
    if ($data3['kode_bahan']!='') {
        $array_data['kodebahan'][]=$data3;
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

$thead = '';
$tfooter = '';
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
	    <td width="10%">Customer</td>
	    <td width="3%">:</td>
	    <td width="42%">'.$pelanggan.'</td>
	    <td  align="right" width="45%" style="font-size:16px; font-weight: 700;">Form Order Bahan</td>
	  </tr>
	</table>

	<table width="100%" border="1"  style="font-size: 13px;border-spacing: 0;" class="print">
	   	<tr style="text-align: center;">
          	<th rowspan="2" width="100px">Ruang</th>
          	<th colspan="2" style="text-align: center;">Ukuran</th>
          	<th rowspan="2" width="20px">Jml</th>
          	<th rowspan="2" width="40px">Tarikan</th>';
    for ($i=0; $i < count($array_data['kodebahan']) ; $i++) { 
    	$html .="<th  rowspan='2' width='30px'>".$array_data['kodebahan'][$i]['kode_bahan']."</th>";
    }
    $html .='      
	  		<th colspan="3" style="text-align: center;">Rel 1</th>
        <th colspan="3" style="text-align: center;">Rel 2</th>
    	</tr>
    	<tr>
	      	<th style="text-align: center;" width="40px">Tinggi</th>
	      	<th style="text-align: center;" width="40px">Lebar</th>
	      	<th style="text-align: center;" width="40px">R</th>
	      	<th style="text-align: center;" width="40px">D</th>
	      	<th style="text-align: center;" width="40px">L</th>
          <th style="text-align: center;" width="40px">R</th>
          <th style="text-align: center;" width="40px">D</th>
          <th style="text-align: center;" width="40px">L</th>
    	</tr>';
	for ($i=0; $i < count($array_data['listbarang']) ; $i++) { 
    	$html .=
    	"<tr><td>".$array_data['listbarang'][$i]['pengukuran_detail_ruang']
    	."</td><td>".$array_data['listbarang'][$i]['pengukuran_detail_tinggi']
    	."</td><td>".$array_data['listbarang'][$i]['pengukuran_detail_lebar']
    	."</td><td>".$array_data['listbarang'][$i]['pengukuran_detail_jumlah']
    	."</td><td>".$array_data['listbarang'][$i]['pengukuran_detail_tarikan']
    	."</td>";
    	$stat = 0;
    	for ($k=0; $k < count($array_data['orderbahanid']) ; $k++) {
    	 	if ($array_data['orderbahanid'][$k]['pengukuran_detail_id']==$array_data['listbarang'][$i]['pengukuran_detail_id']) {
    	 		$stat = 1;
    	 		$jumlahbahan1 = $array_data['orderbahanid'][$k]['order_bahan_jumlah_kode_bahan_1'];
    	 		$jumlahbahan2 = $array_data['orderbahanid'][$k]['order_bahan_jumlah_kode_bahan_2'];
    	 		$kodebahan1 = $array_data['orderbahanid'][$k]['order_bahan_kode_bahan_1'];
    	 		$kodebahan2 = $array_data['orderbahanid'][$k]['order_bahan_kode_bahan_2'];
	 		}
	 	}
 		if ($stat==1) {
 			for ($j=0; $j < count($array_data['kodebahan']) ; $j++) {
    	 		if ($array_data['kodebahan'][$j]['kode_bahan']==$kodebahan1) {
    	 			$html .="<td>".$jumlahbahan1."</td>";	
    	 		} elseif ($array_data['kodebahan'][$j]['kode_bahan']==$kodebahan2) {
    	 			$html .="<td>".$jumlahbahan2."</td>";	
    	 		} else {
    	 			$html .= "<td>0</td>";
    	 		}
    	 	}
 		}
 		if ($array_data['listbarang'][$i]['pengukuran_detail_alat_1']=="Rolet") {
 			$html .="<td>".$array_data['listbarang'][$i]['pengukuran_detail_lebar']*$array_data['listbarang'][$i]['pengukuran_detail_jumlah']."</td>";
 		} else {
 			$html .= "<td>0</td>";
 		}

 		if ($array_data['listbarang'][$i]['pengukuran_detail_alat_1']=="Delux") {
 			$html .="<td>".$array_data['listbarang'][$i]['pengukuran_detail_lebar']*$array_data['listbarang'][$i]['pengukuran_detail_jumlah']."</td>";
 		} else {
 			$html .= "<td>0</td>";
 		}

 		if ($array_data['listbarang'][$i]['pengukuran_detail_alat_1']=="Lengkung") {
 			$html .="<td>".$array_data['listbarang'][$i]['pengukuran_detail_lebar']*$array_data['listbarang'][$i]['pengukuran_detail_jumlah']."</td>";
 		} else {
 			$html .= "<td>0</td>";
 		}


    if ($array_data['listbarang'][$i]['pengukuran_detail_alat_2']=="Rolet") {
      $html .="<td>".$array_data['listbarang'][$i]['pengukuran_detail_lebar']*$array_data['listbarang'][$i]['pengukuran_detail_jumlah']."</td>";
    } else {
      $html .= "<td>0</td>";
    }

    if ($array_data['listbarang'][$i]['pengukuran_detail_alat_2']=="Delux") {
      $html .="<td>".$array_data['listbarang'][$i]['pengukuran_detail_lebar']*$array_data['listbarang'][$i]['pengukuran_detail_jumlah']."</td>";
    } else {
      $html .= "<td>0</td>";
    }

    if ($array_data['listbarang'][$i]['pengukuran_detail_alat_2']=="Lengkung") {
      $html .="<td>".$array_data['listbarang'][$i]['pengukuran_detail_lebar']*$array_data['listbarang'][$i]['pengukuran_detail_jumlah']."</td>";
    } else {
      $html .= "<td>0</td>";
    }

    	$html .="
    	</tr>";
  }
  $footer = '';
  for ($i=0; $i < count($array_data['kodebahan']) ; $i++) {
    for ($j=0; $j < count($array_data['dataorderbahan']) ; $j++) {
      if ($array_data['kodebahan'][$i]['kode_bahan']==$array_data['dataorderbahan'][$j]['kode_bahan']) {
        $footer .="<td><b>".$array_data['dataorderbahan'][$j]['jumlah']."</b></td>"; 
      }
    }
  }
  $mm = 0;
  for ($j=0; $j < count($array_data['dataorderrel']) ; $j++) {
    if ('Rolet'==$array_data['dataorderrel'][$j]['alat']) {
      $footer .="<td><b>".$array_data['dataorderrel'][$j]['jumlah']."</b></td>"; 
      $mm = 1;
    }
  }
  if ($mm==0) {
    $footer .="<td>0</td>";
  }
  $mm = 0;
  for ($j=0; $j < count($array_data['dataorderrel']) ; $j++) {
    if ('Delux'==$array_data['dataorderrel'][$j]['alat']) {
      $footer .="<td><b>".$array_data['dataorderrel'][$j]['jumlah']."</b></td>"; 
      $mm = 1;
    }
  }
  if ($mm==0) {
    $footer .="<td>0</td>";
  }
  $mm = 0;
  for ($j=0; $j < count($array_data['dataorderrel']) ; $j++) {
    if ('Lengkung'==$array_data['dataorderrel'][$j]['alat']) {
      $footer .="<td><b>".$array_data['dataorderrel'][$j]['jumlah']."</b></td>"; 
      $mm = 1;
    }
  }
  if ($mm==0) {
    $footer .="<td>0</td>";
  }


  $mm = 0;
  for ($j=0; $j < count($array_data['dataorderrel1']) ; $j++) {
    if ('Rolet'==$array_data['dataorderrel1'][$j]['alat']) {
      $footer .="<td><b>".$array_data['dataorderrel1'][$j]['jumlah']."</b></td>"; 
      $mm = 1;
    }
  }
  if ($mm==0) {
    $footer .="<td>0</td>";
  }
  $mm = 0;
  for ($j=0; $j < count($array_data['dataorderrel1']) ; $j++) {
    if ('Delux'==$array_data['dataorderrel1'][$j]['alat']) {
      $footer .="<td><b>".$array_data['dataorderrel1'][$j]['jumlah']."</b></td>"; 
      $mm = 1;
    }
  }
  if ($mm==0) {
    $footer .="<td>0</td>";
  }
  $mm = 0;
  for ($j=0; $j < count($array_data['dataorderrel1']) ; $j++) {
    if ('Lengkung'==$array_data['dataorderrel1'][$j]['alat']) {
      $footer .="<td><b>".$array_data['dataorderrel1'][$j]['jumlah']."</b></td>"; 
      $mm = 1;
    }
  }
  if ($mm==0) {
    $footer .="<td>0</td>";
  }
  $html .='
        <tr><td colspan="5">Jumlah</td>'.$footer.'</tr>
    	</table>
	';
//	echo $html;
	//print_r($array_data['dataorderbahan']);
	//echo "<br>".count($array_data['dataorderbahan']);

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
$dompdf->stream("formorderbahan-".$tanggal."-".$pelanggan.".pdf", array("Attachment"=>0));

?>
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
