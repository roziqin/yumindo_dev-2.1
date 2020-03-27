<!-------------- Modal tambah item -------------->

<div class="modal fade" id="modalitem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Tambah item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form method="post" class="form-item">
          <input type="hidden" id="defaultForm-id" name="ip-id">
          <div class="md-form mb-0">
            <input type="text" id="defaultForm-nama" class="form-control validate mb-3" name="ip-nama">
            <label for="defaultForm-nama">Nama Item</label>
          </div>
          <div class="md-form mb-0">
              <select class="mdb-select md-form" id="defaultForm-ket" name="ip-ket">
                  <option value="" selected>Pilih Keterangan</option>
                  <option value="Kain">Kain</option>
              </select>
          </div>
          <div class="md-form mb-0 mt-0">
            <input type="text" id="defaultForm-harga" class="form-control validate mb-3" name="ip-harga">
            <label for="defaultForm-harga">Harga Jual</label>
          </div>
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary" id="submit-item" data-dismiss="modal" aria-label="Close">Proses</button>
        <button class="btn btn-primary" id="update-item" data-dismiss="modal" aria-label="Close">Edit</button>
      </div>
    </div>
  </div>
</div>

<!-------------- End modal tambah item -------------->

  <script type="text/javascript">
    $(document).ready(function(){

      $('.mdb-select').materialSelect();

      $("#submit-item").click(function(){
        var data = new FormData();
        data.append('ip-id', $("#defaultForm-id").val());
        data.append('ip-nama', $("#defaultForm-nama").val());
        data.append('ip-harga', $("#defaultForm-harga").val());
        data.append('ip-ket', $("#defaultForm-ket").val());

        console.log(data);

        $.ajax({
          type: 'POST',
          url: "controllers/item.ctrl.php?ket=submit-item",
          data: data,
          cache: false,
          processData: false,
          contentType: false,
          success: function() {
            console.log("sukses")
            $('#example').DataTable().ajax.reload();
          }
        });
      });   


      $("#update-item").click(function(){
        
        var data = new FormData();
        data.append('ip-id', $("#defaultForm-id").val());
        data.append('ip-nama', $("#defaultForm-nama").val());
        data.append('ip-harga', $("#defaultForm-harga").val());
        data.append('ip-ket', $("#defaultForm-ket").val());

        console.log(data);

        $.ajax({
          type: 'POST',
          url: "controllers/item.ctrl.php?ket=update-item",
          data: data,
          cache: false,
          processData: false,
          contentType: false,
          success: function(data) {
            console.log("sukses edit")
            console.log(data)
            $('#example').DataTable().ajax.reload();
          }
        });
      }); 
      
    });
  </script> 