<?php 
    include '../modals/pemotongan.modal.php'; 
?>
    <table id="table-pemotongan" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>Tanggal Mulai Proses</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
      
    $(document).ready(function() {
        
        $('#table-pemotongan').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [ 0, 'desc' ],
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=finishing", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "pengukuran_tanggal_deal" },
                { "render": function(data, type, full){
                   return '<a class="btn-edit" data-toggle="modal" data-target="#modalpemasangan" data-id="' + full['pengukuran_id'] + '" title="Detail">' + full['name'] + '</a>';
                    }
                },
                { "data": "pengukuran_status" },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modalpemotongan" data-id="' + full['pengukuran_id'] + '" title="Detail"><i class="fas fa-pen"></i></a>';
                    }
                },
            ],
            "drawCallback": function( settings ) {
                $('.btn-edit').on('click',function(){
                    var id = $(this).data('id');
                    console.log(id)
                    $.ajax({
                        type:'POST',
                        url:'api/view.api.php?func=pemotongan',
                        dataType: "json",
                        data:{id:id},
                        success:function(data){
                            
                            $('#listbarang tbody').empty();
                            $("a.btn-jahit").attr("href", "export/pdf-jahit.php?id="+data[0].id);
                            $("#modalpemotongan .nama").text(data[0].nama);
                            $("#modalpemotongan .alamat").text(data[0].alamat);
                            $("#modalpemotongan .telepon").text(data[0].telepon);
                            $("#modalpemotongan .status").text(data[0].status);
                            $("#modalpemotongan .kualitas").text(data[0].kualitas);
                            $("#modalpemotongan .catatanpotong").text(data[0].catatanpotong);
                            $("#modalpemotongan .catatanjahit").text(data[0].catatanjahit);
                            $("#modalpemotongan .tgl").text(data[0].tglselesai);
                            $("#modalpemotongan #defaultForm-idpengukuran").val(data[0].id);
                            $("#modalpemotongan #defaultForm-cekstatus").val(data[0].status);
                            $("#modalpemotongan .btn-proses").text("Selesai Steamer & Finishing");

                            if (data[0].status=='Selesai Finishing') {
                                $("#modalpemotongan .btn-proses").addClass('hidden');
                            } else {
                                $("#modalpemotongan .btn-proses").removeClass('hidden');
                            }
                            for (var i in data['listbarang']) {
                                var jenislain = '';
                                if(data['listbarang'][i].pengukuran_detail_jenis_lain!='') {
                                    jenislain = ' ('+data['listbarang'][i].pengukuran_detail_jenis_lain+')';
                                }

                                var kodebahan1 = '';
                                if(data['listbarang'][i].pengukuran_detail_kode_bahan_1!='') {
                                    kodebahan1 = ' ('+data['listbarang'][i].pengukuran_detail_kode_bahan_1+')';
                                }
                                
                                var varkualitas = ''
                                if (data['listbarang'][i].jenis_nama=='Vitras') {
                                    varkualitas = data[0].kualitaskalivitras;

                                    var tinggi = parseFloat(data['listbarang'][i].pengukuran_detail_tinggi)*parseFloat(varkualitas);
                                    var lebar = parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitas);
                                } else if (data['listbarang'][i].jenis_nama=='Gorden & Vitras') {
                                    varkualitas = data[0].kualitaskali;

                                    var tinggi1 = parseFloat(data['listbarang'][i].pengukuran_detail_tinggi)*parseFloat(varkualitas);
                                    var lebar1 = parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitas);

                                    varkualitasvitras = data[0].kualitaskalivitras;

                                    var tinggi2 = parseFloat(data['listbarang'][i].pengukuran_detail_tinggi)*parseFloat(varkualitasvitras);
                                    var lebar2 = parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitasvitras);
                                    var tinggi = 'G:'+tinggi1+' - V:'+tinggi2;
                                    var lebar = 'G:'+lebar1+' - V:'+lebar2;
                                } else {
                                    varkualitas = data[0].kualitaskali;

                                    var tinggi = parseFloat(data['listbarang'][i].pengukuran_detail_tinggi)*parseFloat(varkualitas);
                                    var lebar = parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitas);
                                }

                                $('#listbarang tbody').append("<tr><td>"+
                                data['listbarang'][i].pengukuran_detail_ruang+"</td><td>"+
                                data['listbarang'][i].jenis_nama+""+jenislain+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_kode_bahan+""+kodebahan1+"</td><td>"+
                                data['listbarang'][i].model_nama+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_tarikan+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_kt+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_jumlah+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_tinggi+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_lebar+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_volume+"</td><td>"+
                                tinggi+"</td><td>"+
                                lebar+"</td></tr>");
                            }

                        }
                    });
                });
            }
        });

      
    } );
    </script>