<div class="modal fade" id="modalorderbahan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog orderbahan" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Detail Order Bahan</h4>
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
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Kualitas: <span class="kualitas"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0 mb-4">
              <a href="" target="_blank" class="btn btn-default btn-order">Download Form Order</a>
              <button class="btn btn-primary btn-proses" data-dismiss="modal" aria-label="Close">Mulai Potong</button>
            </div>
            <div class="col-md-12">
              <table id="listbarangorder" class="table table-bordered table-striped">
                <thead>
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
          var status = $("#defaultForm-cekstatus").val();
          console.log(status)
          
          $.ajax({
            type: 'POST',
            url: "controllers/transaksi.ctrl.php?ket=orderbahan",
            data: {
              id:id,
              status:status
            },
            success: function(data) {
                $("#modalorderbahan .btn-proses").addClass('hidden');
                $("#modalorderbahan .status").text('Mulai Potong');
                $('#table-orderbahan').DataTable().ajax.reload();
            }
          });
          
      });
       
  });
</script>