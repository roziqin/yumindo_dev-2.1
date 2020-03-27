<?php $con = mysqli_connect("localhost","root","","yumindon_new"); ?>
<form method="post" class="form-hitungharga">
  <div class="modal-body mx-0 px-0">
      <input type="hidden" id="defaultForm-namajenis1" name="ip-namajenis">
      <input type="hidden" id="defaultForm-namabahan1" name="ip-namabahan">
      <input type="hidden" id="defaultForm-namamodel1" name="ip-namamodel">
      <div class="row">
          <div class="col-md-12">
              <div class="md-form mb-0">
                <select class="mdb-select select-jenis md-form" id="defaultForm-jenis" name="ip-jenis">
                  <option value="">Pilih Jenis</option>
                  <?php
                    $sql="SELECT * from jenis";
                    $result=mysqli_query($con,$sql);
                    while ($data1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                          echo "<option value='$data1[jenis_id]'>$data1[jenis_nama]</option>";
                    }
                  ?>
                </select>
              </div>
          </div>
          <div class="col-md-12 box-model hidden">
              <div class="md-form mb-0">
                <select class="mdb-select select-model md-form" id="defaultForm-model" name="ip-model">
                  <option value="0">Pilih Model</option>
                </select>
              </div>
          </div>
          <div class="col-md-12 box-bahan hidden">
              <div class="md-form mb-0">
                <select class="mdb-select select-bahan md-form" id="defaultForm-bahan" name="ip-bahan">
                  <option value="0">Pilih Bahan</option>
                </select>
              </div>
          </div>
          <div class="col-md-12">
              <div class="md-form mb-0 mb-0">
                  <input type="text" id="defaultForm-tinggi" class="form-control mb-3" name="ip-tinggi1" value="100">
                  <label for="defaultForm-tinggi" class="active">Tinggi</label>
              </div>
          </div>
          <div class="col-md-12">
              <div class="md-form mb-0 mb-0">
                  <input type="text" id="defaultForm-lebar" class="form-control mb-3" name="ip-lebar1" value="100">
                  <label for="defaultForm-lebar" class="active">Lebar</label>
              </div>
          </div>
          <div class="col-md-12 col-harga">
            <h3>Estimasi Harga: <span class="harga"></span></h3>
          </div>
      </div>
  </div>
  <div class="modal-footer d-flex justify-content-center">
    <button class="btn btn-primary" id="hitung-harga" data-dismiss="modal" aria-label="Close">Hitung</button>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
      $('.select-jenis').materialSelect();
      $("#defaultForm-jenis").change(function(){
          var idjenis = $(this).val();
          var namajenis = $( "#defaultForm-jenis option:selected" ).text();
          console.log(idjenis);
          $('#defaultForm-model').children('option:not(:first)').remove();
          $('#defaultForm-bahan').children('option:not(:first)').remove();
          $.ajax({
              type:'POST',
              url:'api/view.api.php?func=cekmodel',
              dataType: "json",
              data:{idjenis:idjenis},
              success: function(data) {
                  $("#defaultForm-namajenis1").val(namajenis);
                  if(data[0].lengthdata!=0) {
                      $(".box-model").removeClass('hidden');
                      $("#defaultForm-model").change(function(){
                          $("#defaultForm-namamodel1").val($("#defaultForm-model option:selected").text());
                      });
                  } else {
                      $(".box-model").addClass('hidden');

                  }
                  for (var i = 0; i < data[0].lengthdata; i++) {
                      $("#defaultForm-model").append('<option value="'+data[0].idmodel[i]+'">'+data[0].namamodel[i]+'</option>');
                  }

                  if(data[0].lengthdatabahan!=0) {
                      $(".box-bahan").removeClass('hidden');
                      $("#defaultForm-bahan").change(function(){
                          $("#defaultForm-namabahan1").val($("#defaultForm-bahan option:selected").text());
                          
                      });
                  } else {
                      $("#defaultForm-model").change(function(){
                          $("#defaultForm-namamodel1").val($("#defaultForm-model option:selected").text());
                          
                      });
                      $(".box-bahan").addClass('hidden');

                  }
                  for (var i = 0; i < data[0].lengthdatabahan; i++) {
                      $("#defaultForm-bahan").append('<option value="'+data[0].idbahan[i]+'">'+data[0].namabahan[i]+'</option>');
                  }
                  $('.select-model').materialSelect({destroy:true});
                  $('.select-bahan').materialSelect({destroy:true});
                  $('.select-bahan').materialSelect();
                  $('.select-model').materialSelect();
                  
              }
          });
      });

      $("#hitung-harga").click(function(e){
          e.preventDefault();
          
          var namajenis = $( "#defaultForm-namajenis1").val();
          var namabahan = $( "#defaultForm-namabahan1").val();
          var namamodel = $( "#defaultForm-namamodel1").val();
          var jenis = $( "#defaultForm-jenis").val();
          var bahan = $( "#defaultForm-bahan").val();
          var model = $( "#defaultForm-model").val();
          var tinggi = $( "#defaultForm-tinggi").val();
          var lebar = $( "#defaultForm-lebar").val();
          
          $.ajax({
            type: 'POST',
            url: "controllers/transaksi.ctrl.php?ket=cekharga",
            dataType: "json",
            data:{
                  namajenis:namajenis,
                  namabahan:namabahan,
                  namamodel:namamodel,
                  jenis:jenis,
                  bahan:bahan,
                  model:model,
                  tinggi:tinggi,
                  lebar:lebar
            },
            success: function(data) {
                  $(".box-model").addClass('hidden');
                  $(".box-bahan").addClass('hidden');
                  $(".col-harga").removeClass('hidden');
                  $("h3 span.harga").text(formatRupiah(data[0].harga.toString(), 'Rp. '));
                  $( "#defaultForm-jenis").val("");
                  $( "#defaultForm-bahan").val("");
                  $( "#defaultForm-model").val("");
                  $( "#defaultForm-tinggi").val(100);
                  $( "#defaultForm-lebar").val(100);
                  
              }
          });
      
      }); 
  })
</script>