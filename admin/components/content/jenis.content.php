<?php include '../modals/jenis.modal.php'; ?>

    <button class="btn btn-primary btn-tambah-jenis" data-toggle="modal" data-target="#modaltambahjenis">Tambah Jenis <i class="fas fa-box-open ml-1"></i></button>
    <table id="table-jenis" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>Nama Jenis</th>
                <th>Set Model</th>
                <th>Nama Model</th>
                <th>Nama Kain</th>
                <th></th>
            </tr>
        </thead>
    </table>



    <script type="text/javascript">
      
    $(document).ready(function() {
    	
      	$('.btn-tambah-jenis').on('click',function(){
            $("#modaltambahjenis #defaultForm-nama").val('');
            $("#modaltambahjenis #defaultForm-model").val('');
            $("#modaltambahjenis #defaultForm-idlistmodel").val('');
            $("#modaltambahjenis #defaultForm-listmodel").val('');
            $("#modaltambahjenis #defaultForm-idlistkain").val('');
            $("#modaltambahjenis #defaultForm-listkain").val('');
            $("#modaltambahjenis #submit-jenis").removeClass('hidden');
            $("#modaltambahjenis #update-jenis").addClass('hidden');
            $("#modaltambahjenis #submit-jenis").removeAttr("disabled").button('refresh');
            $("#modaltambahjenis #update-jenis").attr("disabled", "disabled").button('refresh');
            $('#modaltambahjenis h4.modal-title').text('Tambah jenis');
            $(".form-listmodel").addClass('hidden');  
      	});
      	
        $('#table-jenis').DataTable( {
            "pageLength": 100,
            "processing": true,
            "serverSide": true,
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=jenis", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "jenis_nama" },
                { "width": "150px", "render": function(data, type, full){

                    if (full['jenis_ket_model']==1) {
                     return 'Ya';

                    } else {
                     return 'Tidak';
                    }
                  }
                },
                { "width": "300px", "render": function(data, type, full){
                    return full['jenis_listmodel'];
                  }
                },
                { "width": "300px", "render": function(data, type, full){
                    return full['jenis_listkain'];
                  }
                },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modaltambahjenis" data-id="' + full['jenis_id'] + '" title="Edit"><i class="fas fa-pen"></i></a> <a class="btn-floating btn-sm btn-danger btn-remove" data-id="' + full['jenis_id'] + '" title="Delete"><i class="fas fa-trash"></i></a>';
                }
                },
            ],
            "drawCallback": function( settings ) {
              $('.btn-edit').on('click',function(){
                  var jenis_id = $(this).data('id');
                  console.log(jenis_id)
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=editjenis',
                      dataType: "json",
                      data:{jenis_id:jenis_id},
                      success:function(data){
        			            $("#modaltambahjenis #update-jenis").removeClass('hidden');
        			            $("#modaltambahjenis #submit-jenis").addClass('hidden');
                          $("#modaltambahjenis #update-jenis").removeAttr("disabled").button('refresh');
                          $("#modaltambahjenis #submit-jenis").attr("disabled", "disabled").button('refresh');
        			            $('#modaltambahjenis h4.modal-title').text('Edit jenis');
                          $("#modaltambahjenis label").addClass("active");
                          $("#modaltambahjenis #defaultForm-id").val(data[0].jenis_id);
                          $("#modaltambahjenis #defaultForm-nama").val(data[0].jenis_nama);
                          $("#modaltambahjenis #defaultForm-model").val(data[0].jenis_ket_model);
                          if (data[0].jenis_ket_model==1) {
                            $(".form-listmodel").removeClass('hidden');  
                          } else {
                            $(".form-listmodel").addClass('hidden');  
                          }
                          $("#modaltambahjenis #defaultForm-idlistmodel").val(data[0].jenis_listmodel);
                          $("#modaltambahjenis #defaultForm-idlistkain").val(data[0].jenis_listkain);

                          
                      } 
                  });
              });

              $('.btn-remove').on('click', function(){
                  var jenis_id = $(this).data('id');
                  $.confirm({
                      title: 'Konfirmasi Hapus jenis',
                      content: 'Apakah yakin menghapus kateogri ini?',
                      buttons: {
                          confirm: {
                              text: 'Ya',
                              btnClass: 'col-md-6 btn btn-primary',
                              action: function(){
                                  console.log(jenis_id);
                                  
                                  $.ajax({
                                    type: 'POST',
                                    url: "controllers/jenis.ctrl.php?ket=remove-jenis",
                                    dataType: "json",
                                    data:{jenis_id:jenis_id},
                                    success: function(data) {
                                      if (data[0]=="ok") {
                                        $('#table-jenis').DataTable().ajax.reload();
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