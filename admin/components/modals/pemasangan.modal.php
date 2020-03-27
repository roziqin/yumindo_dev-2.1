<div class="modal fade" id="modalpemasangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog orderbahan" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Detail Pemasangan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-orderbahan">
        <input type="hidden" id="defaultForm-idpengukuran" name="ip-idpengukuran">
        <input type="hidden" id="defaultForm-cekstatus" name="ip-cekstatus">
        <input type="hidden" id="defaultForm-pelanggan" name="ip-pelanggan">
        <div class="modal-body mt-3 mb-3 ml-0 mr-0">
          <div class="row">
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Nama: <span class="nama"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Alamat: <span class="alamat"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Telepon: <span class="telepon"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Status: <span class="status"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Tanggal Selesai: <span class="tgl"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0 box-ttd hidden">
              <canvas class="canvas" style="background: #fff;border: 1px solid #000; margin: 10px auto;"></canvas>
            </div>
            <div class="col-md-12 col-md-offset-0 box-image-ttd hidden">
              <img class="image-ttd" src="" width="">
            </div>
            <div class="col-md-12 col-md-offset-0 mb-4">
              <a href="" target="_blank" class="btn btn-default btn-invoice">Download Invoice</a>
              <a href="" target="_blank" class="btn btn-default btn-pasang">Download Form Pasang</a>
              <button class="btn btn-primary btn-proses hidden">Selesai Pemasangan</button>
            </div>
            <div class="col-md-12 col-table">
              <table id="listbarang" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Ruang</th>
                    <th>Jenis</th>
                    <th>Kode Bahan</th>
                    <th>Model</th>
                    <th>Tarikan</th>
                    <th>Tinggi</th>
                    <th>Lebar</th>
                    <th>Jumlah</th>
                    <th>KT/E</th>
                    <th>Warna</th>
                    <th>Ukuran Rel</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------- End modal -------------->
<script type="text/javascript">
  
  $(document).ready(function(){
    var canvas = document.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas);

    $(".btn-proses").click(function(e){
        e.preventDefault();

        var id = $("#defaultForm-idpengukuran").val();
        var status = $("#defaultForm-cekstatus").val();
        var pelanggan = $("#defaultForm-pelanggan").val();
        var signature = signaturePad.toDataURL(); 
        console.log(status)
        
        $.ajax({
          type: 'POST',
          url: "controllers/transaksi.ctrl.php?ket=pemotongan",
          data: {
            id:id,
            status:status,
            pelanggan:pelanggan,
            signature,signature
          },
          success: function(data) {

              if (status=='Selesai Pemasangan') {
                $("#modalpemasangan .btn-proses").addClass('hidden');
                $("#modalpemasangan .box-ttd").addClass('hidden');

              } else {
                $("#modalpemasangan .btn-proses").text('Konfirmasi');
                $("#modalpemasangan .status").text('Selesai Pemasangan');
                $("defaultForm-cekstatus").val('Selesai Pemasangan');
                $("#modalpemasangan .box-ttd").removeClass('hidden');
              }
              $('#table-pemasangan').DataTable().ajax.reload();

          }
        });
        
    });
       
  });
</script> 