<div class="modal fade" id="modalpemotongan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog orderbahan" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
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
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Tanggal Selesai: <span class="tgl"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Catatan Ukur: <span class="catatanpotong"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0">
              <p class="mb-0">Catatan Jahit: <span class="catatanjahit"></span></p>
            </div>
            <div class="col-md-12 col-md-offset-0 mb-4">
              <a href="" target="_blank" class="btn btn-default btn-jahit">Download Form Jahit</a>
              <button class="btn btn-primary btn-proses">Selesai Potong & Jahit</button>
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
                    <th>KT/E</th>
                    <th>Jumlah</th>
                    <th>Tinggi</th>
                    <th>Lebar</th>
                    <th>Vol</th>
                    <th>Tinggi<br>Potong/Jahit</th>
                    <th>Lebar<br>Potong/Jahit</th>
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
            url: "controllers/transaksi.ctrl.php?ket=pemotongan",
            data: {
              id:id,
              status:status
            },
            success: function(data) {
                $("#modalpemotongan .btn-proses").addClass('hidden');
                if (status=='Selesai Jahit') {
                  $("#modalpemotongan .status").text('Selesai Finishing');
                } else {
                  $("#modalpemotongan .status").text('Selesai Jahit');
                }
                $('#table-pemotongan').DataTable().ajax.reload();
            }
          });
          
      });
       
  });
</script>