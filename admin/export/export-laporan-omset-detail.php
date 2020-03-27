<?php 

session_start();
include '../../config/database.php';
include '../../include/format_rupiah.php';
date_default_timezone_set('Asia/jakarta');


$bln = $_GET['bulan'];

$filename = "laporan_omset_detail-".$bln.".xls";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header('Content-Disposition: attachment; filename='.$filename);

$query ="SELECT * from pengukuran, users_lain, laporan_omset WHERE pengukuran_pelanggan=id and pengukuran_id=laporan_omset_pengukuran_id and laporan_omset_bulan='$bln'";

$result = mysqli_query($con,$query);

$html ='
		
	<center>
		<h1>Data Omset</h1>
	</center>
	<table border="1"  style="border-spacing: 0;">
		<tr>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Bank</th>
            <th class="text-right">Jumlah</th>
		</tr>

';
$jumlah = 0;
while($data = mysqli_fetch_assoc($result)) {
	
    $jumlah += $data["laporan_omset_jumlah"];
	$html.='
		<tr>
			<td>'.$data['laporan_omset_tanggal'].'</td>
			<td>'.$data['name'].'</td>
			<td>'.$data['pengukuran_bank'].'</td>
			<td style="text-align: right;">Rp. '.format_rupiah($data["laporan_omset_jumlah"]).'</td>
		</tr>

	';
}

$html .='
        <tr>
            <td colspan="3"><b>Total</b></td>
            <td style="text-align: right;"><b>Rp. '.format_rupiah($jumlah).'</b></td>
        </tr>
	</table>
';

echo $html;

exit;

?>