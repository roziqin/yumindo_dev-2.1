<?php 
$con = mysqli_connect("localhost","root","","yumindon_new"); 
$sql="SELECT * from roles_lain where roles_nama LIKE '%pelanggan%'";
$result=mysqli_query($con,$sql);
$data1=mysqli_fetch_assoc($result);
?>
<!-------------- Modal member -------------->

<div class="modal fade" id="modalmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Tambah Member</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-member">
        <div class="modal-body mx-3">
            <input type="hidden" id="defaultForm-id" name="ip-id">
            <input type="hidden" id="defaultForm-role" name="ip-role" value="<?php echo $data1['roles_id']; ?>">
            <div class="md-form mb-0">
              <input type="text" id="defaultForm-nama" class="form-control validate mb-3" name="ip-nama">
              <label for="defaultForm-nama">Nama</label>
            </div>
            <div class="md-form mb-0">
              <textarea id="defaultForm-alamat" class="md-textarea form-control" rows="3" name="ip-alamat"></textarea>
              <label for="defaultForm-alamat">Alamat</label>
            </div>
            <div class="md-form mb-0">
              <input type="text" id="defaultForm-hp" class="form-control validate mb-3" name="ip-hp">
              <label for="defaultForm-hp">No. HP</label>
            </div>
            <div class="md-form mb-0">
              <input type="email" id="defaultForm-email" class="form-control validate mb-3" name="ip-email">
              <label for="defaultForm-email">Email</label>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" id="submit-member" data-dismiss="modal" aria-label="Close">Proses</button>
          <button class="btn btn-primary" id="update-member" data-dismiss="modal" aria-label="Close">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------- End modal member -------------->




  <script type="text/javascript">
    $(document).ready(function(){

      $('.mdb-select').materialSelect();

      $('.datepicker').pickadate({
        weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        showMonthsShort: true
      })
      $("#submit-member").click(function(){
        var data = $('#modalmember .form-member').serialize();
        $.ajax({
          type: 'POST',
          url: "controllers/member.ctrl.php?ket=submit-member",
          data: data,
          success: function() {
            console.log("sukses")
            $('#table-member').DataTable().ajax.reload();
            $("#modalmember #defaultForm-id").val('');
            $("#modalmember #defaultForm-no").val('');
            $("#modalmember #defaultForm-nama").val('');
            $("#modalmember #defaultForm-alamat").val('');
            $("#modalmember #defaultForm-hp").val('');
            $("#modalmember #defaultForm-gender").val('');
            $("#modalmember #defaultForm-tgl-lahir").val('');
          }
        });
      });   


      $("#update-member").click(function(){
        var data = $('#modalmember .form-member').serialize();
        $.ajax({
          type: 'POST',
          url: "controllers/member.ctrl.php?ket=update-member",
          data: data,
          success: function() {
            console.log("sukses edit")
            $('#table-member').DataTable().ajax.reload();
            $("#modalmember #defaultForm-id").val('');
            $("#modalmember #defaultForm-no").val('');
            $("#modalmember #defaultForm-nama").val('');
            $("#modalmember #defaultForm-alamat").val('');
            $("#modalmember #defaultForm-hp").val('');
            $("#modalmember #defaultForm-gender").val('');
            $("#modalmember #defaultForm-tgl-lahir").val('');
          }
        });
      }); 
      
    });
  </script> 