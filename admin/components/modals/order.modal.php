<!-------------- Modal Transaksi -------------->

<div class="modal fade" id="modalorder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title w-100 font-weight-bold">Cek Pengukuran</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <input type="hidden" name="ip-total" id="defaultForm-total">
        <input type="hidden" name="ip-dp" id="defaultForm-dp" value="0">
        <input type="hidden" name="ip-kualitas" id="defaultForm-kualitas" value="Premium">
        <div class="row">
          <div class="col-md-6 col-md-offset-0">
            <p class="nama"></p>
          </div>
          <div class="col-md-6 col-md-offset-0">
            <p class="alamat"></p>
          </div>
        </div>
        <table id="listbarang" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Ruang</th>
            <th>Jenis</th>
            <th>Harga</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div class="md-form">
          <textarea id="defaultForm-catatukur" class="md-textarea form-control" rows="2" name="defaultForm-catatukur"></textarea>
          <label for="defaultForm-catatukur">Catatan Ukur</label>
        </div>
        <div class="md-form">
          <textarea id="defaultForm-catatjahit" class="md-textarea form-control" rows="2" name="defaultForm-catatjahit"></textarea>
          <label for="defaultForm-catatjahit">Catatan Jahit</label>
        </div>
        
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary" id="submit-order" data-dismiss="modal" aria-label="Close">Proses</button>
      </div>
    </div>
  </div>
</div>

<!-------------- End modal transaksi -------------->





  <script type="text/javascript">
      
      
      $("#submit-order").click(function(e){
          e.preventDefault();
          var catatjahit = $("#defaultForm-catatjahit").val();
          var catatukur = $("#defaultForm-catatukur").val();
          var kualitas = $("#defaultForm-kualitas").val();
          var dp = $("#defaultForm-dp").val();
          var total = $("#defaultForm-total").val();
          $.ajax({
            type: 'POST',
            url: "controllers/transaksi.ctrl.php?ket=prosesorder",
            data: {
              catatjahit:catatjahit,
              catatukur:catatukur,
              kualitas:kualitas,
              dp:dp,
              total:total,
            },
            success: function(data) {
                console.log(data);              
                $('.container__load').load('components/content/order.content.php?kond=home');
                $('#listitem table').empty();              
            }
          });
      }); 
    
  </script> 