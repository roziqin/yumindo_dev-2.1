<?php include '../modals/model.modal.php'; ?>

    <button class="btn btn-primary btn-tambah-model" data-toggle="modal" data-target="#modaltambahmodel">Tambah Model <i class="fas fa-box-open ml-1"></i></button>
    <table id="table-model" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>Nama Model</th>
                <th></th>
            </tr>
        </thead>
    </table>



    <script type="text/javascript">
      
    $(document).ready(function() {
    	
      	$('.btn-tambah-model').on('click',function(){
            $("#modaltambahmodel #defaultForm-nama").val('');
            $("#modaltambahmodel #submit-model").removeClass('hidden');
            $("#modaltambahmodel #update-model").addClass('hidden');
            $("#modaltambahmodel #submit-model").removeAttr("disabled").button('refresh');
            $("#modaltambahmodel #update-model").attr("disabled", "disabled").button('refresh');
            $('#modaltambahmodel h4.modal-title').text('Tambah Model');
      	});
      	
        $('#table-model').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=model", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "model_nama" },

                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modaltambahmodel" data-id="' + full['model_id'] + '" title="Edit"><i class="fas fa-pen"></i></a> <a class="btn-floating btn-sm btn-danger btn-remove" data-id="' + full['model_id'] + '" title="Delete"><i class="fas fa-trash"></i></a>';
                }
                },
            ],
            "initComplete": function( settings, json ) {
              $('.btn-edit').on('click',function(){
                  var model_id = $(this).data('id');
                  console.log(model_id)
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=editmodel',
                      dataType: "json",
                      data:{model_id:model_id},
                      success:function(data){
        			            $("#modaltambahmodel #update-model").removeClass('hidden');
        			            $("#modaltambahmodel #submit-model").addClass('hidden');
                          $("#modaltambahmodel #update-model").removeAttr("disabled").button('refresh');
                          $("#modaltambahmodel #submit-model").attr("disabled", "disabled").button('refresh');
        			            $('#modaltambahmodel h4.modal-title').text('Edit Model');
                          $("#modaltambahmodel label").addClass("active");
                          $("#modaltambahmodel #defaultForm-id").val(data[0].model_id);
                          $("#modaltambahmodel #defaultForm-nama").val(data[0].model_nama);

                      }
                  });
                  
              });
            },
            "drawCallback": function( settings ) {
              $('.btn-edit').on('click',function(){
                  var model_id = $(this).data('id');
                  console.log(model_id)
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=editmodel',
                      dataType: "json",
                      data:{model_id:model_id},
                      success:function(data){
        			            $("#modaltambahmodel #update-model").removeClass('hidden');
        			            $("#modaltambahmodel #submit-model").addClass('hidden');
                          $("#modaltambahmodel #update-model").removeAttr("disabled").button('refresh');
                          $("#modaltambahmodel #submit-model").attr("disabled", "disabled").button('refresh');
        			            $('#modaltambahmodel h4.modal-title').text('Edit Model');
                          $("#modaltambahmodel label").addClass("active");
                          $("#modaltambahmodel #defaultForm-id").val(data[0].model_id);
                          $("#modaltambahmodel #defaultForm-nama").val(data[0].model_nama);

                      }
                  });
              });

              $('.btn-remove').on('click', function(){
                  var model_id = $(this).data('id');
                  $.confirm({
                      title: 'Konfirmasi Hapus model',
                      content: 'Apakah yakin menghapus kateogri ini?',
                      buttons: {
                          confirm: {
                              text: 'Ya',
                              btnClass: 'col-md-6 btn btn-primary',
                              action: function(){
                                  console.log(model_id);
                                  
                                  $.ajax({
                                    type: 'POST',
                                    url: "controllers/model.ctrl.php?ket=remove-model",
                                    dataType: "json",
                                    data:{model_id:model_id},
                                    success: function(data) {
                                      if (data[0]=="ok") {
                                        $('#table-model').DataTable().ajax.reload();
                                      } else {
                                        alert('Produk gagal dihapus')
                                      }
                                    }
                                  });
                                  
                              }
                          },
                          cancel: {
                              text: 'Tidak',
                              btnClass: 'col-md-6 btn btn-danger text-white',
                              action: function(){
                                  console.log("tidak")
                                 
                              }
                              
                          }
                      }
                  });
              });
              
            }
        } );

      
    } );
    </script>