<?php $con = mysqli_connect("localhost","root","","yumindon_new"); ?>
<!-------------- Modal tambah kategori -------------->

<div class="modal fade" id="modalbooking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Booking Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-booking">
        <div class="modal-body mx-3">
            <input type="hidden" id="defaultForm-id" name="ip-id">
            <div class="md-form mb-0">
                <select class="mdb-select md-form" id="defaultForm-pelanggan" name="ip-pelanggan" searchable="Search here..">
                    <option value="" disabled selected>Pilih Pelanggan</option>
                <?php
                  $sql="SELECT * from users_lain, roles_lain where role=roles_id and roles_nama LIKE '%pelanggan%'";
                  $result=mysqli_query($con,$sql);
                  while ($data1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      echo "<option value='$data1[id]'>$data1[name] - $data1[alamat]</option>";
                  }
                ?>
                </select>
            </div>
            <div class="md-form mb-0">
              <input placeholder="Selected date" type="text" id="defaultForm-tglbooking" class="form-control datepicker" name="ip-tglbooking">
              <label for="defaultForm-tglbooking" class="active">Tanggal Booking</label>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" id="submit-booking" data-dismiss="modal" aria-label="Close">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------- End modal tambah booking -------------->





  <script type="text/javascript">
    $(document).ready(function(){

      $('.mdb-select').materialSelect();
      $('.datepicker').pickadate();
      $("#submit-booking").click(function(){
        var data = $('#modalbooking .form-booking').serialize();
        $.ajax({
          type: 'POST',
          url: "controllers/transaksi.ctrl.php?ket=submit-booking",
          data: data,
          success: function() {
            console.log("sukses")
            $('#table-booking').DataTable().ajax.reload();
            $("#modalbooking #defaultForm-tglbooking").val('');
            $("#modalbooking #defaultForm-id").val('');
            $("#modalbooking #defaultForm-pelanggan").val('');
          }
        });
      });   
      
    });
  </script> 