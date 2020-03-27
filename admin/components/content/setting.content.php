<form method="post" class="form-setting">
  <div class="modal-body mx-3">
      <input type="hidden" id="defaultForm-id" name="ip-id">
      <div class="row">
          <div class="col-md-8">
            <div class="md-form mb-0">
              <input type="text" id="defaultForm-nama" class="form-control validate mb-3" name="ip-nama">
              <label for="defaultForm-nama">Nama Perusahaan</label>
            </div>
            <div class="md-form mb-0">
              <input type="text" id="defaultForm-alamat" class="form-control validate mb-3" name="ip-alamat">
              <label for="defaultForm-alamat">Alamat Perusahaan</label>
            </div>
            <div class="md-form mb-0">
              <input type="text" id="defaultForm-telp" class="form-control validate mb-3" name="ip-telp">
              <label for="defaultForm-telp">Telp Perusahaan</label>
            </div>
            <div class="md-form mb-0">
              <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                  <span>Choose file</span>
                  <input type="file" name="ip-logo" id="logo">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload logo" name="ip-textlogo" id="textlogo">
                </div>
              </div>
            </div>
            <div class="md-form mb-0">
              <div class="row">
                <div class="col-md-4">
                  <div class="md-form mb-0">
                    <input type="text" id="defaultForm-kualitas-premium" class="form-control validate mb-3" name="ip-kualitas-premium">
                    <label for="defaultForm-kualitas-premium">Premium</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="md-form mb-0">
                    <input type="text" id="defaultForm-kualitas-gold" class="form-control validate mb-3" name="ip-kualitas-gold">
                    <label for="defaultForm-kualitas-gold">Gold</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="md-form mb-0">
                    <input type="text" id="defaultForm-kualitas-silver" class="form-control validate mb-3" name="ip-kualitas-silver">
                    <label for="defaultForm-kualitas-silver">Silver</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="md-form mb-0">
                    <input type="text" id="defaultForm-kualitas-vitraspremium" class="form-control validate mb-3" name="ip-kualitas-vitraspremium">
                    <label for="defaultForm-kualitas-vitraspremium">Vitras Premium</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="md-form mb-0">
                    <input type="text" id="defaultForm-kualitas-vitrasgold" class="form-control validate mb-3" name="ip-kualitas-vitrasgold">
                    <label for="defaultForm-kualitas-vitrasgold">Vitras Gold</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="md-form mb-0">
                    <input type="text" id="defaultForm-kualitas-vitrassilver" class="form-control validate mb-3" name="ip-kualitas-vitrassilver">
                    <label for="defaultForm-kualitas-vitrassilver">Vitras Silver</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <img src="" class="img-fluid img-logo" alt="Responsive image">
          </div>
      </div>
  </div>
  <div class="modal-footer d-flex justify-content-center">
    <button class="btn btn-primary" id="update-setting" data-dismiss="modal" aria-label="Close">Edit</button>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
      $('.mdb-select').materialSelect();
      $.ajax({
          type:'POST',
          url:'api/view.api.php?func=editsetting',
          dataType: "json",
          success:function(data){
              
              $("label").addClass("active");
              $("#defaultForm-nama").val(data[0].pengaturan_nama);
              $("#defaultForm-alamat").val(data[0].pengaturan_alamat);
              $("#defaultForm-telp").val(data[0].pengaturan_telp);
              $(".img-logo").attr("src", "../assets/img/"+data[0].pengaturan_logo);
              $("#defaultForm-service").val(data[0].pengaturan_service);
              $("#pajak10").val(data[0].pengaturan_pajak);
              $("#defaultForm-kualitas-premium").val(data[0].pengaturan_kualitas_premium);
              $("#defaultForm-kualitas-gold").val(data[0].pengaturan_kualitas_gold);
              $("#defaultForm-kualitas-silver").val(data[0].pengaturan_kualitas_silver);
              $("#defaultForm-kualitas-vitraspremium").val(data[0].pengaturan_kualitas_vitras_premium);
              $("#defaultForm-kualitas-vitrasgold").val(data[0].pengaturan_kualitas_vitras_gold);
              $("#defaultForm-kualitas-vitrassilver").val(data[0].pengaturan_kualitas_vitras_silver);

          }
      });

      $("#update-setting").click(function(e){
        e.preventDefault();
        //var data = $('.form-setting').serialize();
        var data = new FormData();
        data.append('ip-nama', $("#defaultForm-nama").val());
        data.append('ip-alamat', $("#defaultForm-alamat").val());
        data.append('ip-telp', $("#defaultForm-telp").val());
        data.append('ip-service', $("#defaultForm-service").val());
        data.append('ip-textlogo', $("#textlogo").val());
        data.append('ip-pajak', $("#pajak10").val());
        data.append('ip-kualitas-premium', $("#defaultForm-kualitas-premium").val());
        data.append('ip-kualitas-gold', $("#defaultForm-kualitas-gold").val());
        data.append('ip-kualitas-silver', $("#defaultForm-kualitas-silver").val());
        data.append('ip-kualitas-vitraspremium', $("#defaultForm-kualitas-vitraspremium").val());
        data.append('ip-kualitas-vitrasgold', $("#defaultForm-kualitas-vitrasgold").val());
        data.append('ip-kualitas-vitrassilver', $("#defaultForm-kualitas-vitrassilver").val());
        data.append('inputfile', $("#logo")[0].files[0]);
        console.log(data);
     
        $.ajax({
          type: 'POST',
          url: "controllers/setting.ctrl.php?ket=update-setting",
          data: data,
          cache: false,
        processData: false,
        contentType: false,
          success: function(data) {
            console.log(data)
            if (data!="noupload  ") {
              $(".img-logo").attr("src", "../assets/img/"+data);
            }
            alert("Data berhasil dirubah");
          }
        });
        
      }); 
  })
</script>