<div class="modal fade" id="modalpenagihan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog orderbahan" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Detail Pelanggan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-orderbahan">
        <input type="hidden" id="defaultForm-idpengukuran" name="ip-idpengukuran">
        <input type="hidden" id="defaultForm-cekstatus" name="ip-cekstatus">
        <div class="modal-body mx-3">
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
            <div class="box-tagihan">
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">Total Harga: <span class="harga"></span></p>
              </div>
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">Diskon: <span class="diskon"></span></p>
              </div>
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">DP: <span class="dp"></span></p>
              </div>
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">Sisa: <span class="sisa"></span></p>
              </div>
            </div>
            <div class="box-lunas">
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">SubTotal Harga: <span class="subtotal"></span></p>
              </div>
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">Diskon: <span class="diskon"></span></p>
              </div>
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">PPN: <span class="ppn"></span></p>
              </div>
              <div class="col-md-12 col-md-offset-0">
                <p class="mb-0">Total Harga: <span class="harga"></span></p>
              </div>
            </div>
            <div class="col-md-12 col-md-offset-0 md-form mb-0 mt-1 hidden">
              <input type="text" id="defaultForm-bayar" class="form-control validate mb-3" name="ip-bayar" style="max-width: 150px;">
              <label for="defaultForm-nama" style="left: 15px;">Bayar</label>
            </div>
            <div class="col-md-12 col-md-offset-0 mb-4">
              <a href="" target="_blank" class="btn btn-default btn-invoice">Download Invoice</a>
              <button class="btn btn-primary btn-proses">Proses Lunas</button>
            </div>
            <div class="col-md-12">
              <table id="listbarang" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Ruang</th>
                    <th>Jenis</th>
                    <th>Kode Bahan</th>
                    <th>Model</th>
                    <th>Tarikan</th>
                    <th>Jumlah</th>
                    <th>KT/E</th>
                    <th>Warna</th>
                    <th>Ukuran Rel</th>
                    <th>Tinggi</th>
                    <th>Lebar</th>
                    <th>Vol</th>
                    <th>Harga</th>
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
      $(".btn-proses").click(function(e){
          e.preventDefault();
          var id = $("#defaultForm-idpengukuran").val();
          
          $.ajax({
            type: 'POST',
            url: "controllers/transaksi.ctrl.php?ket=penagihan",
            data: {
              id:id
            },
            success: function(data) {
                $("#modalorderbahan .btn-proses").addClass('hidden');
                $("#modalorderbahan .status").text('Lunas');
                $('#table-penagihan').DataTable().ajax.reload();
            }
          });
          
      });
       
  });
</script> 