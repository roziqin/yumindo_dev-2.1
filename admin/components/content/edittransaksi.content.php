<?php $con = mysqli_connect("localhost","root","","yumindon_new"); ?>
<!-------------- Modal tambah jenis -------------->

<div class="modal fade" id="modaledittransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Pengukuran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-jenis">
        <div class="modal-body mx-3">
            <input type="hidden" id="defaultForm-id" name="ip-id">
            <input type="hidden" id="defaultForm-idjenis" name="ip-idjenis">
            <div class="row">
              <div class="col-md-4 box-model hidden">
                  <div class="md-form mb-0">
                    <select class="mdb-select select-model md-form" id="defaultForm-model" name="ip-model">
                      <option value="0">Pilih Model</option>
                    </select>
                  </div>
              </div>
              <div class="col-md-4 box-bahan hidden">
                  <div class="md-form mb-0">
                    <select class="mdb-select select-bahan md-form" id="defaultForm-bahan" name="ip-bahan">
                      <option value="0">Pilih Bahan</option>
                    </select>
                  </div>
              </div>
            </div>
            <div class="md-form mb-0">
              <input type="text" id="defaultForm-nama" class="form-control validate mb-3" name="ip-nama">
              <label for="defaultForm-nama">Nama Jenis</label>
            </div>
            <div class="md-form mb-0">
                <select class="mdb-select md-form" id="defaultForm-model" name="ip-model">
                    <option value="" disabled selected>Set Model</option>
                    <option value="0">Tidak</option>
                    <option value="1">Ya</option>
                </select>
            </div>
            <div class="md-form mb-0 form-listmodel hidden">
              <select class="mdb-select md-form" id="defaultForm-listmodel" name="ip-listmodel[]" multiple>
                <option value="" disabled>List Model</option>
                <?php
                  $sql="SELECT * from model";
                  $result=mysqli_query($con,$sql);
                  while ($data1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      if ($data1['model_id']==0) {
                        
                      } else {
                        echo "<option value='$data1[model_id]'>$data1[model_nama]</option>";
                      }
                  }
                ?>
              </select>
              <button class="btn-save btn btn-primary btn-sm">Pilih</button>
            </div>
            <div class="md-form mb-0 form-listkain">
              <select class="mdb-select md-form" id="defaultForm-listkain" name="ip-listkain[]" multiple>
                <option value="" disabled>List Kain</option>
                <?php
                  $sql="SELECT * from bahan WHERE bahan_keterangan='kain'";
                  $result=mysqli_query($con,$sql);
                  while ($data1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      if ($data1['bahan_id']==0) {
                        
                      } else {
                        echo "<option value='$data1[bahan_id]'>$data1[bahan_nama]</option>";
                      }
                  }
                ?>
              </select>
              <button class="btn-save btn btn-primary btn-sm">Pilih</button>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" id="submit-jenis" data-dismiss="modal" aria-label="Close">Proses</button>
          <button class="btn btn-primary" id="update-jenis" data-dismiss="modal" aria-label="Close">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------- End modal tambah jenis -------------->

  <script type="text/javascript">
    $(document).ready(function(){

      $('#modaledittransaksi').on('shown.bs.modal', function () {
        if ($('#defaultForm-idlistmodel')!='') {
          var idlistarray = $('#defaultForm-idlistmodel').val().split(":");
          $('#defaultForm-listmodel').val(idlistarray);
        }
        if ($('#defaultForm-idlistkain')!='') {
          var idlistarraykain = $('#defaultForm-idlistkain').val().split(":");
          $('#defaultForm-listkain').val(idlistarraykain);
        }
      })
      $("#defaultForm-model").change(function(){
        if ($(this).val()=="0") {               
                $(".form-listmodel").addClass('hidden');
                $("#modaledittransaksi #defaultForm-listmodel").val('');
        } else if ($(this).val()=="1") {
                $(".form-listmodel").removeClass('hidden');
        }
      });
      $(".btn-save").click(function(e){
        e.preventDefault();
      });
      $("#submit-jenis").click(function(){
        var data = $('#modaledittransaksi .form-jenis').serialize();
        
        $.ajax({
          type: 'POST',
          url: "controllers/jenis.ctrl.php?ket=submit-jenis",
          data: data,
          success: function(data) {
            console.log("sukses")
            $('#table-jenis').DataTable().ajax.reload();
            $("#modaledittransaksi #defaultForm-nama").val('');
            $("#modaledittransaksi #defaultForm-model").val('');
            $("#modaledittransaksi #defaultForm-listmodel").val('');
            $("#modaledittransaksi #defaultForm-listkain").val('');
          }
        });
        
      });   


      $("#update-jenis").click(function(){
        var data = $('#modaledittransaksi .form-jenis').serialize();
        $.ajax({
          type: 'POST',
          url: "controllers/jenis.ctrl.php?ket=update-jenis",
          data: data,
          success: function() {
            console.log("sukses edit")
            $('#table-jenis').DataTable().ajax.reload();
            $("#modaledittransaksi #defaultForm-nama").val('');
            $("#modaledittransaksi #defaultForm-model").val('');
            $("#modaledittransaksi #defaultForm-listmodel").val('');
            $("#modaledittransaksi #defaultForm-listkain").val('');
          }
        });
      }); 

      $("#modaledittransaksi .close").click(function(){
          //$('.container__load').load('components/content/jenis.content.php'); 
      }); 

      $('.mdb-select').materialSelect();
      
    });
  </script> 