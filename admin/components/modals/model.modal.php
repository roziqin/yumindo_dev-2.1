<!-------------- Modal model -------------->

<div class="modal fade" id="modaltambahmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Tambah Model</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-model">
        <div class="modal-body mx-3">
            <input type="hidden" id="defaultForm-id" name="ip-id">
            <div class="md-form mb-0">
              <input type="text" id="defaultForm-nama" class="form-control validate mb-3" name="ip-nama">
              <label for="defaultForm-nama">Nama model</label>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" id="submit-model" data-dismiss="modal" aria-label="Close">Proses</button>
          <button class="btn btn-primary" id="update-model" data-dismiss="modal" aria-label="Close">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------- End modal model -------------->




  <script type="text/javascript">
    $(document).ready(function(){

      $('.mdb-select').materialSelect();

      $("#submit-model").click(function(){
        var data = $('#modaltambahmodel .form-model').serialize();
        $.ajax({
          type: 'POST',
          url: "controllers/model.ctrl.php?ket=submit-model",
          data: data,
          success: function() {
            console.log("sukses")
            $('#table-model').DataTable().ajax.reload();
            $("#modaltambahmodel #defaultForm-nama").val('');
          }
        });
      });   


      $("#update-model").click(function(){
        var data = $('#modaltambahmodel .form-model').serialize();
        $.ajax({
          type: 'POST',
          url: "controllers/model.ctrl.php?ket=update-model",
          data: data,
          success: function() {
            console.log("sukses edit")
            $('#table-model').DataTable().ajax.reload();
            $("#modaltambahmodel #defaultForm-nama").val('');
          }
        });
      }); 
      
    });
  </script> 