<?php include '../modals/member.modal.php'; ?>

    <button class="btn btn-primary btn-tambah-member" data-toggle="modal" data-target="#modalmember">Tambah Pelanggan <i class="fas fa-box-open ml-1"></i></button>
    <table id="table-member" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>nama</th>
                <th>alamat</th>
                <th>email</th>
                <th>no hp</th>
                <th></th>
            </tr>
        </thead>
    </table>



    <script type="text/javascript">
      
    $(document).ready(function() {
        $('.btn-tambah-member').on('click',function(){
            $("#modalmember #defaultForm-id").val('');
            $("#modalmember #defaultForm-nama").val('');
            $("#modalmember #defaultForm-alamat").val('');
            $("#modalmember #defaultForm-hp").val('');
            $("#modalmember #defaultForm-email").val('');
            $("#modalmember #submit-member").removeClass('hidden');
            $("#modalmember #update-member").addClass('hidden');
            $('#modalmember h4.modal-title').text('Tambah Pelanggan');
        });

        $('#table-member').DataTable( {
            "pageLength": 50,
            "processing": true,
            "serverSide": true,
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=member", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "name" },
                { "data": "alamat" },
                { "data": "email" },
                { "data": "telepon" },

                { "width": "180px", "render": function(data, type, full){
                    
                      return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modalmember" data-id="' + full['id'] + '" title="Edit"><i class="fas fa-pen"></i></a> <a class="btn-floating btn-sm btn-danger btn-remove  mr-2" data-id="' + full['id'] + '" title="Delete"><i class="fas fa-trash"></i></a>';
                  }
                },
            ],
            "drawCallback": function( settings ) {
              $('.btn-edit').on('click',function(){
                  var id = $(this).data('id');
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=editmember',
                      dataType: "json",
                      data:{id:id},
                      success:function(data){
                        console.log(data+" edit");
                      $("#modalmember #update-member").removeClass('hidden');
                      $("#modalmember #submit-member").addClass('hidden');
                      $('#modalmember h4.modal-title').text('Edit Pelanggan');
                          $("#modalmember label").addClass("active");
                          $("#modalmember #defaultForm-id").val(data[0].id);
                          $("#modalmember #defaultForm-nama").val(data[0].name);
                          $("#modalmember #defaultForm-alamat").val(data[0].alamat);
                          $("#modalmember #defaultForm-hp").val(data[0].telepon);
                          $("#modalmember #defaultForm-email").val(data[0].email);

                      }
                  });
              });

              $('.btn-remove').on('click', function(){
                  var id = $(this).data('id');
                  $.confirm({
                      title: 'Konfirmasi Hapus member',
                      content: 'Apakah yakin menghapus member ini?',
                      buttons: {
                          confirm: {
                              text: 'Ya',
                              btnClass: 'col-md-6 btn btn-primary',
                              action: function(){
                                  console.log(id);
                                  
                                  $.ajax({
                                    type: 'POST',
                                    url: "controllers/member.ctrl.php?ket=remove-member",
                                    dataType: "json",
                                    data:{id:id},
                                    success: function(data) {
                                      if (data[0]=="ok") {
                                        $('#table-member').DataTable().ajax.reload();
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