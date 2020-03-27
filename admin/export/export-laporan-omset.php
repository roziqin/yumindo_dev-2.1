<?php 

session_start();
include '../../config/database.php';
include '../../include/format_rupiah.php';
date_default_timezone_set('Asia/jakarta');


$tgl = $_GET['date'];
$text_line = explode(":",$_GET['date']);
$tgl1=date("Y-m", strtotime($text_line[0]));
$tgl2=date("Y-m", strtotime($text_line[1]));

$filename = "laporan_omset-".$tgl.".xls";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header('Content-Disposition: attachment; filename='.$filename);


$query ="SELECT laporan_omset_bulan, sum(laporan_omset_jumlah) as total from laporan_omset where laporan_omset_bulan between '$tgl1' and '$tgl2' group by laporan_omset_bulan order by laporan_omset_bulan ASC ";

$result = mysqli_query($con,$query);
/*
?>

<?php
*/
$html ='
		
	<center>
		<h1>Data Omset</h1>
	</center>
	<table width="100%" border="1"  style="border-spacing: 0; max-width: 800px;">
		<tr>
            <th>tanggal</th>
            <th style="text-align: right;">omset</th>
		</tr>

';
$jumlah = 0;
while($data = mysqli_fetch_assoc($result)) {
	
    $jumlah += $data["total"];
	$html.='
		<tr>
			<td>'.$data['laporan_omset_bulan'].'</td>
			<td style="text-align: right;">Rp. '.format_rupiah($data["total"]).'</td>
		</tr>

	';
}

$html .='
        <tr>
            <td><b>Total</b></td>
            <td style="text-align: right;"><b>Rp. '.format_rupiah($jumlah).'</b></td>
        </tr>
	</table>
';

echo $html;

exit;

?>