<div class="modal fade" id="modalfollowup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <input type="hidden" name="form-idpesanan" id="form-idpesanan">
        <h4 class="modal-title w-100 font-weight-bold">Detail Pelanggan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-booking">
        <input type="hidden" id="defaultForm-idpengukuran" name="ip-idpengukuran">
        <input type="hidden" id="defaultForm-idpelanggan" name="ip-idpelanggan">
        <input type="hidden" id="defaultForm-cektgl" name="ip-cektgl">
        <input type="hidden" id="defaultForm-cekstatus" name="ip-cekstatus">
        <div class="modal-body mx-3">
          <div class="row">
            <div class="col-md-12 col-md-offset-0">
              <p class="tanggal"></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="nama"></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="alamat"></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="telepon"></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="status"></p>
            </div>
            <div class="col-md-12 md-form mb-0">
              <input placeholder="Selected date" type="text" id="defaultForm-tglbookingfollowup" class="form-control datepicker" name="ip-tglbookingfollowup">
              <label for="defaultForm-tglbookingfollowup" class="active" style="padding-left: 15px;">Tanggal Booking</label>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary btn-proses" data-dismiss="modal" aria-label="Close">Follow Up</button>
          <button class="btn btn-default btn-gantitgl" data-dismiss="modal" aria-label="Close">Ganti Tanggal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------- End modal -------------->
<script type="text/javascript">
  
  $(document).ready(function(){

      $('#modalfollowup').on('shown.bs.modal', function () {
        if ($('#defaultForm-cektgl')!='') {
          $('#defaultForm-tglbookingfollowup').val(moment(new Date($('#defaultForm-cektgl').val())).format('D MMMM, YYYY'));

        }
      });
      $('.datepicker').pickadate();

      $(".btn-proses").click(function(){
        var data = $('#modalfollowup .form-booking').serialize();
        
        $.ajax({
          type: 'POST',
          url: "controllers/transaksi.ctrl.php?ket=followup",
          data: data,
          success: function(data) {
            $('#table-booking').DataTable().ajax.reload();
            if ($('#defaultForm-cekstatus').val()=="Follow Up") {
              location.href='?menu=order&kond=home';

            }
            
            
          }
        });
        
      });

      $(".btn-gantitgl").click(function(){
        var data = $('#modalfollowup .form-booking').serialize();
        
        $.ajax({
          type: 'POST',
          url: "controllers/transaksi.ctrl.php?ket=update-followup",
          data: data,
          success: function(data) {
            console.log("sukses")
            $('#table-booking').DataTable().ajax.reload();
          }
        });
        
      });  
  });
</script>