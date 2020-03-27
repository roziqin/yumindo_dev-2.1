<?php $con = mysqli_connect("localhost","root","","yumindon_new"); ?>
<!-------------- Modal tambah jenis -------------->

<div class="modal fade" id="modaledititem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog orderbahan" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form-edititem">
        <div class="modal-body mx-3">
            <input type="hidden" id="defaultForm-id" name="ip-id">
            <input type="hidden" id="defaultForm-idpenawaran" name="ip-idpenawaran">
            <input type="hidden" id="defaultForm-idjenis" name="ip-idjenis">
            <input type="hidden" id="defaultForm-idmodel" name="ip-idmodel">
            <input type="hidden" id="defaultForm-idbahan" name="ip-idbahan">
            <input type="hidden" id="defaultForm-namajenis" name="ip-namajenis">
            <input type="hidden" id="defaultForm-kualitas" name="ip-kualitas">
            <input type="hidden" id="defaultForm-namabahan" name="ip-namabahan">
            <input type="hidden" id="defaultForm-namamodel" name="ip-namamodel">
            <div class="row">
                <div class="col-md-4 box-namalain hidden">
                    <div class="md-form mb-0">
                        <input type="text" id="defaultForm-nama" class="form-control" name="ip-namalain">
                        <label for="defaultForm-nama">Nama Item</label>
                    </div>
                </div>
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
            <div class="clear"></div>
            <div class="row box-other">
                <div class="col-md-2">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-ruang" class="form-control mb-3" name="ip-ruang" disabled>
                        <label for="defaultForm-ruang">Ruang</label>
                    </div>                
                </div>
                <div class="col-md-2">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-kodebahan" class="form-control mb-3" name="ip-kodebahan" disabled>
                        <label for="defaultForm-kodebahan">Kode Bahan</label>
                    </div>                
                </div>
                <div class="col-md-2">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-kodebahan1" class="form-control mb-3" name="ip-kodebahan1" disabled>
                        <label for="defaultForm-kodebahan1">Kode Bahan Vitras</label>
                    </div>                
                </div>
                <div class="col-md-2">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-hargabahan" class="form-control mb-3" name="ip-hargabahan" disabled>
                        <label for="defaultForm-hargabahan">Harga Bahan</label>
                    </div>                
                </div>
                <div class="col-md-2">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-hargabox" class="form-control mb-3" name="ip-hargabox" disabled>
                        <label for="defaultForm-hargabahan">Harga Box</label>
                    </div>                
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-tinggi" class="form-control mb-3" name="ip-tinggi1" value="100" disabled>
                        <label for="defaultForm-tinggi" class="active">Tinggi</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-lebar" class="form-control mb-3" name="ip-lebar1" value="100" disabled>
                        <label for="defaultForm-lebar" class="active">Lebar</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-volume" class="form-control mb-3" name="ip-volume1" value="0" disabled>
                        <label for="defaultForm-volume" class="active">Volume(m)</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="md-form mb-0 mt-0">
                        <input type="number" id="defaultForm-jumlah" class="form-control mb-3" name="ip-jumlah" maxlength="5" value="1"  step="any" disabled>
                        <label for="defaultForm-jumlah" class="active">Jumlah</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="md-form mb-0 mt-0">
                        <input type="text" id="defaultForm-tarikan" class="form-control mb-3" name="ip-tarikan" disabled>
                        <label for="defaultForm-tarikan">Tarikan</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="md-form mb-0 mt-0">
                        <select class="mdb-select md-form select-other" id="defaultForm-kt" name="ip-kt" disabled>
                            <option value="G:KT/V:E">G:KT/V:E</option>
                            <option value="G:KT/V:KT">G:KT/V:KT</option>
                            <option value="G:E/V:E">G:E/V:E</option>
                            <option value="G:E/V:KT">G:E/V:KT</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-21">
                    <div class="md-form mb-0 mt-0">
                        <select class="mdb-select md-form select-other" id="defaultForm-relalat1" name="ip-relalat1" disabled>
                            <option value="" >Pilih Rel 1</option>
                            <option value="Rolet">Rolet</option>
                            <option value="Delux">Delux</option>
                            <option value="Lengkung">Lengkung</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-21">
                    <div class="md-form mb-0 mt-0">
                        <select class="mdb-select md-form select-other" id="defaultForm-relalat2" name="ip-relalat2" disabled>
                            <option value="" >Pilih Rel 2</option>
                            <option value="Rolet">Rolet</option>
                            <option value="Delux">Delux</option>
                            <option value="Lengkung">Lengkung</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-21">
                    <div class="md-form mb-0 mt-0">
                        <select class="mdb-select md-form select-other" id="defaultForm-relwarna" name="ip-relwarna" disabled>
                            <option value="">Pilih Warna</option>
                            <option value="Putih">Putih</option>
                            <option value="Coklat Kayu">Coklat Kayu</option>
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                            <option value="Black">Black</option>
                            <option value="Lengkuy">Lengkuy</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-21">
                    <div class="md-form mb-0 mt-0">
                        <button class="btn btn-primary btn-editpenawaran" data-dismiss="modal" aria-label="Close" >&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------- End modal tambah jenis -------------->

  <script type="text/javascript">
    $(document).ready(function(){
      
      
      $('#modaledititem').on('shown.bs.modal', function () {
          var idjenis = $("#defaultForm-idjenis").val();
          var idmodel = $("#defaultForm-idmodel").val();
          var idbahan = $("#defaultForm-idbahan").val();
          var namajenis = $("#defaultForm-namajenis").val();
          $('#defaultForm-model').children('option:not(:first)').remove();
          $('#defaultForm-bahan').children('option:not(:first)').remove();
          $('.select-other').materialSelect({destroy:true});
          $('.select-other').materialSelect();

          $.ajax({
              type:'POST',
              url:'api/view.api.php?func=cekmodel',
              dataType: "json",
              data:{idjenis:idjenis},
              success: function(data) {
                  if(data[0].lengthdata!=0) {
                      $(".box-model").removeClass('hidden');
                      $("#defaultForm-model").change(function(){
                          $("#defaultForm-namamodel").val($("#defaultForm-model option:selected").text());
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
                          $("#defaultForm-namabahan").val($("#defaultForm-bahan option:selected").text());
                          removeDisabled(namajenis);
                      });
                  } else {
                      $("#defaultForm-model").change(function(){
                          $("#defaultForm-namamodel").val($("#defaultForm-model option:selected").text());
                          removeDisabled(namajenis);
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
                  
                  if ($( "#defaultForm-jenis option:selected" ).text()=='Lain-lain') {
                      $(".box-namalain").removeClass('hidden');
                      removeDisabled(namajenis);
                  } else {
                      $(".box-namalain").addClass('hidden');

                  }

                  $("#modaledititem #defaultForm-model").val(idmodel);
                  $("#modaledititem #defaultForm-bahan").val(idbahan);
              }
          });
          removeDisabled(namajenis);
        //$('.mdb-select').materialSelect();


      });

      function removeDisabled(namajenis) {
          console.log("ok "+namajenis)
          $('.select-other').materialSelect({destroy:true});
          $(".box-other").children().children().children().removeAttr("disabled");

          if (namajenis=="Gorden & Vitras") {
              $("#defaultForm-kodebahan1").removeAttr("disabled");
          } else {
              $("#defaultForm-kodebahan1").attr("disabled", "disabled");
          }
          if (namajenis=='Gorden & Vitras'||namajenis=='Vitras'||namajenis=='Gorden'||namajenis=='Poni Polos'||namajenis=='Poni Motif'||namajenis=='Kaca Film') {
              $("#defaultForm-hargabahan").attr("disabled", "disabled");
          } else {
              $("#defaultForm-hargabahan").removeAttr("disabled");
          }
          if (namajenis=="Lain-lain") {
              $("#defaultForm-volume").removeAttr("disabled");
          } else {
              $("#defaultForm-volume").attr("disabled", "disabled");
          }
          if (namajenis=="Poni Motif" || namajenis=="Poni Polos") {
              $("#defaultForm-hargabox").removeAttr("disabled");
          } else {
              $("#defaultForm-hargabox").attr("disabled", "disabled");
          }
          if (namajenis=='Roller Blind'||namajenis=='Vertikal Blind'||namajenis=='Horizontal Blind'||namajenis=='Wodden Blind') {
              $("#defaultForm-tarikan").removeAttr("disabled");
          } else {
              $("#defaultForm-tarikan").attr("disabled", "disabled");
          }
          if (namajenis=='Gorden & Vitras'||namajenis=='Vitras'||namajenis=='Gorden'||namajenis=='Poni Polos'||namajenis=='Poni Motif') {
              $("#defaultForm-kt").removeAttr("disabled");
              $("#defaultForm-relalat1").removeAttr("disabled");
              $("#defaultForm-relwarna").removeAttr("disabled");
              if (namajenis!='Gorden & Vitras'){
                  $("#defaultForm-relalat2").attr("disabled", "disabled");
                  $('#defaultForm-kt').children('option').remove();
                  $("#defaultForm-kt").append('<option value="KT">KT</option>');
                  $("#defaultForm-kt").append('<option value="E">E</option>');
              } else {
                  $("#defaultForm-relalat2").removeAttr("disabled");
                  $('#defaultForm-kt').children('option').remove();
                  $("#defaultForm-kt").append('<option value="G:KT/V:E">G:KT/V:E</option>');
                  $("#defaultForm-kt").append('<option value="G:KT/V:KT">G:KT/V:KT</option>');
                  $("#defaultForm-kt").append('<option value="G:E/V:E">G:E/V:E</option>');
                  $("#defaultForm-kt").append('<option value="G:E/V:KT">G:E/V:KT</option>');
              }
          } else {
              $("#defaultForm-kt").attr("disabled", "disabled");
              $("#defaultForm-relalat1").attr("disabled", "disabled");
              $("#defaultForm-relalat2").attr("disabled", "disabled");
              $("#defaultForm-relwarna").attr("disabled", "disabled");
          }

          $('.select-other').materialSelect();
      }

      $("#modaledititem .close").click(function(){
          //$('.container__load').load('components/content/jenis.content.php'); 
      }); 

      
    });
  </script> 