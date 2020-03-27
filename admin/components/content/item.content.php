<?php include '../modals/item.modal.php'; ?>

    <button class="btn btn-primary btn-tambah-item" data-toggle="modal" data-target="#modalitem">Tambah Item <i class="fas fa-box-open ml-1"></i></button>
    <table id="example" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Keterangan</th>
                <th>Harga</th>
                <th></th>
            </tr>
        </thead>
    </table>



    <script type="text/javascript">
      
    $(document).ready(function() {

        $('.btn-tambah-item').on('click',function(){

            $('#modalitem h4.modal-title').text('Tambah item');
            $("#modalitem #update-item").addClass('hidden');
            $("#modalitem #submit-item").removeClass('hidden');
            $("#modalitem #submit-item").removeAttr("disabled").button('refresh');
            $("#modalitem #update-item").attr("disabled", "disabled").button('refresh');
            $("#modalitem label").removeClass("active");
            $("#modalitem #defaultForm-id").val('');
            $("#modalitem #defaultForm-nama").val('');
            $("#modalitem #defaultForm-harga").val('');
            $("#modalitem #defaultForm-ket").val('');
        });

        $('#example').DataTable( {
            "pageLength": 100,
            "processing": true,
            "serverSide": true,
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=item", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "bahan_nama" },
                { "data": "bahan_keterangan" },
                { "render": function(data, type, full){
                   return formatRupiah(full['bahan_harga'].toString(), 'Rp. ');
                  }
                },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modalitem" data-id="' + full['bahan_id'] + '" title="Edit"><i class="fas fa-pen"></i></a> <a class="btn-floating btn-sm btn-danger btn-remove" data-id="' + full['bahan_id'] + '" title="Delete"><i class="fas fa-trash"></i></a>';
                  }
                },
            ],
            "initComplete": function( settings, json ) {
              $('.btn-edit').on('click',function(){
                  var item_id = $(this).data('id');
                  console.log(item_id)
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=edititem',
                      dataType: "json",
                      data:{item_id:item_id},
                      success:function(data){
                          console.log(data);
                          $('#modalitem h4.modal-title').text('Edit item');
                          $("#modalitem #update-item").removeClass('hidden');
                          $("#modalitem #submit-item").addClass('hidden');
                          $("#modalitem #update-item").removeAttr("disabled").button('refresh');
                          $("#modalitem #submit-item").attr("disabled", "disabled").button('refresh');
                          $("#modalitem label").addClass("active");
                          $("#modalitem #defaultForm-id").val(item_id);
                          $("#modalitem #defaultForm-nama").val(data[0].bahan_nama);
                          $("#modalitem #defaultForm-harga").val(data[0].bahan_harga);
                          $("#modalitem #defaultForm-ket").val(data[0].bahan_keterangan);
                      }
                  });
                  
              });
            },
            "drawCallback": function( settings ) {
              $('.btn-edit').on('click',function(){
                  var item_id = $(this).data('id');
                  console.log(item_id)
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=edititem',
                      dataType: "json",
                      data:{item_id:item_id},
                      success:function(data){
                          $('#modalitem h4.modal-title').text('Edit item');
                          $("#modalitem #update-item").removeClass('hidden');
                          $("#modalitem #submit-item").addClass('hidden');
                          $("#modalitem #update-item").removeAttr("disabled").button('refresh');
                          $("#modalitem #submit-item").attr("disabled", "disabled").button('refresh');
                          $("#modalitem label").addClass("active");
                          $("#modalitem #defaultForm-id").val(item_id);
                          $("#modalitem #defaultForm-nama").val(data[0].bahan_nama);
                          $("#modalitem #defaultForm-harga").val(data[0].bahan_harga);
                          $("#modalitem #defaultForm-ket").val(data[0].bahan_keterangan);

                      }
                  });
              });

              $('.btn-remove').on('click', function(){
                  var item_id = $(this).data('id');
                  $.confirm({
                      title: 'Konfirmasi Hapus item',
                      content: 'Apakah yakin menghapus item ini?',
                      buttons: {
                          confirm: {
                              text: 'Ya',
                              btnClass: 'col-md-6 btn btn-primary',
                              action: function(){
                                  console.log(item_id);
                                  
                                  $.ajax({
                                    type: 'POST',
                                    url: "controllers/item.ctrl.php?ket=remove-item",
                                    dataType: "json",
                                    data:{item_id:item_id},
                                    success: function(data) {
                                      if (data[0]=="ok") {
                                        $('#example').DataTable().ajax.reload();
                                      } else {
                                        alert('item gagal dihapus')
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