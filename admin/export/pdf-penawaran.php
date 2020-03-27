<?php 
session_start();
include '../../config/database.php';
include '../../include/format_rupiah.php';
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-d');
$wkt=date('G:i:s');

$aid = $_SESSION['login_user'];
//$aid = 2;
$aa = "SELECT * from users_lain where id='$aid'";
$bb = mysqli_query($con,$aa);
$cc = mysqli_fetch_assoc($bb);
$id=$cc['name'];
$iduser=$cc['id'];



$t = $_SESSION['no-id'];
//$t = 636;
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
  $catatan = $data['pengukuran_keterangan']."<br>".$data['pengukuran_catatan_jahit'];
  $sisa = $totalharga - $dp;
  $tanggal = $data['pengukuran_tanggal'];
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
}
$html = '
    
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
        <td  align="right" >Petugas : '.$user.'</td>
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

    <table width="100%" border="1"  style="font-size: 13px;border-spacing: 0;" class="print">
      <tr style="text-align: center;">
        <th  width="200px">Ruang</th>
        <th >Jml</th>
        <th >Jenis<br>G/V/BL</th>
        <th >Kode<br>Bahan</th>
        <th  width="150px">model</th>
        <th width="90px">Harga</th>
      </tr>
    ';
    $tot = 0;
    $sqlte1="SELECT * from pengukuran_detail, jenis, model, bahan where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=bahan_id and pengukuran_detail_model=model_id and pengukuran_id=$t ORDER BY pengukuran_detail_id ASC";
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
    $html.='
            <tr>
                <td colspan="5">Subtotal</td>
                <td style="text-align:right;">Rp '.format_rupiah($tot).'</td>
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
        <table style="font-size: 13px;">
          <tr>
            <td width="50%">Saya telah memahami dan menyetujui ukuran, bahan, dan model tersebut di atas</td>
            <td rowspan="3" width="5px"><hr style="border: 0px;width: 1px;height: 200px;background-color: #000000;"></td>
            <td >Keterangan</td>
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
$dompdf->stream("formpenawaran-".$tgl."-".$pelanggan.".pdf", array("Attachment"=>0));

?>

<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
