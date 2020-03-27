<!-------------- Modal tambah item -------------->

<div class="modal fade" id="modaltambahpengukuran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog orderbahan" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Tambah Pengukuran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form method="post" class="form-tambahitem">
            <input type="hidden" id="defaultForm-id" name="ip-id">
            <input type="hidden" id="defaultForm-namajenis" name="ip-namajenis">
            <input type="hidden" id="defaultForm-namabahan" name="ip-namabahan">
            <input type="hidden" id="defaultForm-namamodel" name="ip-namamodel">
            <input type="hidden" id="defaultForm-kualitas" name="ip-kualitas">
            <div class="row">
                <div class="col-md-4">
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
                <div class="col-md-4 box-namalain hidden">
                    <div class="md-form mb-0">
                        <input type="text" id="defaultForm-nama" class="form-control" name="ip-namalain">
                        <label for="defaultForm-nama">Nama Item</label>
                    </div>
                </div>
                <div class="col-md-4 box-model hidden">
                    <div class="md-form mb-0">
                      <select class="mdb-select select-model md-form" id="defaultForm-model" name="ip-model">
                        <!--<option value="0">Pilih Model</option>-->
                      </select>
                    </div>
                </div>
                <div class="col-md-4 box-bahan hidden">
                    <div class="md-form mb-0">
                      <select class="mdb-select select-bahan md-form" id="defaultForm-bahan" name="ip-bahan">
                        <!--<option value="0">Pilih Bahan</option>-->
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
                        <button class="btn btn-primary btn-proses" disabled="" data-dismiss="modal" aria-label="Close">&nbsp;&nbsp;Input&nbsp;&nbsp;</button>
                    </div>
                </div>
            </div>  
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-center">
      </div>
    </div>
  </div>
</div>

<!-------------- End modal tambah item -------------->

  <script type="text/javascript">
    $(document).ready(function(){

      $('#modaltambahpengukuran').on('shown.bs.modal', function () {
        console.log("show");
          $("#defaultForm-jenis").change(function(){
            console.log("jenis");
              $('.select-other').materialSelect({destroy:true});
              $(".box-other").children().children().children().attr("disabled", "disabled");
              $(".btn-openmodal").removeAttr("disabled");
              $('.select-other').materialSelect();
              var idjenis = $(this).val();
              var namajenis = $( "select#defaultForm-jenis option:selected" ).text();
              //console.log(idjenis);
              $('#modaltambahpengukuran select#defaultForm-model').children('option').remove();
              $('#modaltambahpengukuran select#defaultForm-bahan').children('option').remove();
              $.ajax({
                  type:'POST',
                  url:'api/view.api.php?func=cekmodel',
                  dataType: "json",
                  data:{idjenis:idjenis},
                  success: function(data) {
                      console.log(namajenis)
                      $("#defaultForm-namajenis").val(namajenis);
                      if(data[0].lengthdata!=0) {
                          $(".box-model").removeClass('hidden');
                          $("select#defaultForm-model").append('<option value="0">Pilih Model</option>');
                          $("select#defaultForm-model").change(function(){
                              $("#modaltambahpengukuran #defaultForm-namamodel").val($("select#defaultForm-model option:selected").text());
                          });
                      } else {
                          $(".box-model").addClass('hidden');

                      }
                      for (var i = 0; i < data[0].lengthdata; i++) {
                          $("select#defaultForm-model").append('<option value="'+data[0].idmodel[i]+'">'+data[0].namamodel[i]+'</option>');
                      }

                      if(data[0].lengthdatabahan!=0) {
                          $(".box-bahan").removeClass('hidden');
                          $("select#defaultForm-bahan").append('<option value="0">Pilih Bahan</option>');
                          $("select#defaultForm-bahan").change(function(){
                              $("#modaltambahpengukuran #defaultForm-namabahan").val($("select#defaultForm-bahan option:selected").text());
                              removeDisabled(namajenis);
                          });
                      } else {
                          $("select#defaultForm-model").change(function(){
                              $("#modaltambahpengukuran #defaultForm-namamodel").val($("select#defaultForm-model option:selected").text());
                              removeDisabled(namajenis);
                          });
                          $(".box-bahan").addClass('hidden');

                      }
                      for (var i = 0; i < data[0].lengthdatabahan; i++) {
                          $("select#defaultForm-bahan").append('<option value="'+data[0].idbahan[i]+'">'+data[0].namabahan[i]+'</option>');
                      }
                      $('#modaltambahpengukuran .select-model').materialSelect({destroy:true});
                      $('#modaltambahpengukuran .select-bahan').materialSelect({destroy:true});
                      $('#modaltambahpengukuran .select-bahan').materialSelect();
                      $('#modaltambahpengukuran .select-model').materialSelect();
                      
                      if ($( "#defaultForm-jenis option:selected" ).text()=='Lain-lain') {
                          $(".box-namalain").removeClass('hidden');
                          removeDisabled(namajenis);
                      } else {
                          $(".box-namalain").addClass('hidden');

                      }
                  }
              });
          });
      });

      function removeDisabled(namajenis) {
        console.log("ok "+namajenis)
        $('#modaltambahpengukuran .select-other').materialSelect({destroy:true});
        $("#modaltambahpengukuran .box-other").children().children().children().removeAttr("disabled");

        if (namajenis=="Gorden & Vitras") {
            $("#modaltambahpengukuran #defaultForm-kodebahan1").removeAttr("disabled");
        } else {
            $("#modaltambahpengukuran #defaultForm-kodebahan1").attr("disabled", "disabled");
        }
        if (namajenis=='Gorden & Vitras'||namajenis=='Vitras'||namajenis=='Gorden'||namajenis=='Poni Polos'||namajenis=='Poni Motif'||namajenis=='Kaca Film') {
            $("#modaltambahpengukuran #defaultForm-hargabahan").attr("disabled", "disabled");
        } else {
            $("#modaltambahpengukuran #defaultForm-hargabahan").removeAttr("disabled");
        }
        if (namajenis=="Lain-lain") {
            $("#modaltambahpengukuran #defaultForm-volume").removeAttr("disabled");
        } else {
            $("#modaltambahpengukuran #defaultForm-volume").attr("disabled", "disabled");
        }
        if (namajenis=="Poni Motif" || namajenis=="Poni Polos") {
            $("#modaltambahpengukuran #defaultForm-hargabox").removeAttr("disabled");
        } else {
            $("#modaltambahpengukuran #defaultForm-hargabox").attr("disabled", "disabled");
        }
        if (namajenis=='Roller Blind'||namajenis=='Vertikal Blind'||namajenis=='Horizontal Blind'||namajenis=='Wodden Blind') {
            $("#modaltambahpengukuran #defaultForm-tarikan").removeAttr("disabled");
        } else {
            $("#modaltambahpengukuran #defaultForm-tarikan").attr("disabled", "disabled");
        }
        if (namajenis=='Gorden & Vitras'||namajenis=='Vitras'||namajenis=='Gorden'||namajenis=='Poni Polos'||namajenis=='Poni Motif') {
            $("#modaltambahpengukuran #defaultForm-kt").removeAttr("disabled");
            $("#modaltambahpengukuran #defaultForm-relalat1").removeAttr("disabled");
            $("#modaltambahpengukuran #defaultForm-relwarna").removeAttr("disabled");
            if (namajenis!='Gorden & Vitras'){
                $("#modaltambahpengukuran #defaultForm-relalat2").attr("disabled", "disabled");
                $('#modaltambahpengukuran #defaultForm-kt').children('option').remove();
                $("#modaltambahpengukuran #defaultForm-kt").append('<option value="KT">KT</option>');
                $("#modaltambahpengukuran #defaultForm-kt").append('<option value="E">E</option>');
            } else {
                $("#modaltambahpengukuran #defaultForm-relalat2").removeAttr("disabled");
                $('#modaltambahpengukuran #defaultForm-kt').children('option').remove();
                $("#modaltambahpengukuran #defaultForm-kt").append('<option value="G:KT/V:E">G:KT/V:E</option>');
                $("#modaltambahpengukuran #defaultForm-kt").append('<option value="G:KT/V:KT">G:KT/V:KT</option>');
                $("#modaltambahpengukuran #defaultForm-kt").append('<option value="G:E/V:E">G:E/V:E</option>');
                $("#modaltambahpengukuran #defaultForm-kt").append('<option value="G:E/V:KT">G:E/V:KT</option>');
            }
        } else {
            $("#modaltambahpengukuran #defaultForm-kt").attr("disabled", "disabled");
            $("#modaltambahpengukuran #defaultForm-relalat1").attr("disabled", "disabled");
            $("#modaltambahpengukuran #defaultForm-relalat2").attr("disabled", "disabled");
            $("#modaltambahpengukuran #defaultForm-relwarna").attr("disabled", "disabled");
        }

        $('.select-other').materialSelect();
      }
    });
  </script> 