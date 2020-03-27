<?php 
    include '../modals/booking.modal.php'; 
    include '../modals/followup.modal.php'; 
?>
    <button class="btn btn-primary btn-tambah-item" data-toggle="modal" data-target="#modalbooking">Booking Baru <i class="fas fa-box-open ml-1"></i></button>
    <table id="table-booking" class="table table-striped table-bordered fadeInLeft slow animated mt-3" style="width:100%">
        <thead>
            <tr>
                <th>Tanggal Booking</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Petugas</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
      
    $(document).ready(function() {
        
        $('#table-booking').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [ 0, 'desc' ],
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=booking", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "booking_pengukuran_tanggal_booking" },
                { "data": "nama_pelanggan" },
                { "data": "alamat" },
                { "data": "telepon" },
                { "data": "nama_petugas" },
                { "data": "booking_pengukuran_status" },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modalfollowup" data-id="' + full['booking_pengukuran_id'] + '" title="Follow Up"><i class="fas fa-pen"></i></a>';
                    }
                },
            ],
            "drawCallback": function( settings ) {
              $('.btn-edit').on('click',function(){
                  var booking_id = $(this).data('id');
                  console.log(booking_id)
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=followup',
                      dataType: "json",
                      data:{booking_id:booking_id},
                      success:function(data){

                        console.log(data);
                        $('#modalfollowup p.tanggal').text('Tanggal: '+data[0].booking_pengukuran_tanggal_booking);
                        $('#modalfollowup p.nama').text('Nama Pelanggan: '+data[0].name);
                        $('#modalfollowup p.alamat').text('Alamat: '+data[0].alamat);
                        $('#modalfollowup p.telepon').text('Telepon: '+data[0].telepon);
                        $('#modalfollowup p.status').text('Status: '+data[0].booking_pengukuran_status);
                        $('#modalfollowup #defaultForm-cekstatus').val(data[0].booking_pengukuran_status);
                        $('#modalfollowup #defaultForm-cektgl').val(data[0].booking_pengukuran_tanggal_booking);
                        $('#modalfollowup #defaultForm-idpengukuran').val(data[0].booking_pengukuran_id);
                        $('#modalfollowup #defaultForm-idpelanggan').val(data[0].booking_pengukuran_pelanggan);
                        
                        if (data[0].booking_pengukuran_status=="Follow Up") {
                            $("modalfollowup .btn-gantitgl").removeClass('hidden');
                            $("modalfollowup .btn-gantitgl").removeAttr("disabled").button('refresh');
                            $("#modalfollowup .btn-proses").text("Proses Pengukuran");
                        } else {
                            console.log("status");
                            $("#modalfollowup .btn-gantitgl").addClass('hidden');
                            $("#modalfollowup .btn-gantitgl").attr("disabled", "disabled").button('refresh');
                            $("#modalfollowup .btn-proses").text("Follow Up");
                        }

                      }
                  });
              });
              
            }
        } );

      
    } );
    </script>