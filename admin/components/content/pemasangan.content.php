<?php 
    include '../modals/pemasangan.modal.php'; 
?>
    <table id="table-pemasangan" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>Tanggal Mulai Pasang</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
      
    $(document).ready(function() {
        
        $('#table-pemasangan').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [ 0, 'desc' ],
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=pemasangan", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "pengukuran_tanggal" },
                { "render": function(data, type, full){
                   return '<a class="btn-edit" data-toggle="modal" data-target="#modalpemasangan" data-id="' + full['pengukuran_id'] + '" title="Detail">' + full['name'] + '</a>';
                    }
                },
                { "data": "pengukuran_status" },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modalpemasangan" data-id="' + full['pengukuran_id'] + '" title="Detail"><i class="fas fa-pen"></i></a>';
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
                            $("a.btn-invoice").attr("href", "export/pdf-invoice.php?id="+data[0].id);
                            $("a.btn-pasang").attr("href", "export/pdf-pasang.php?id="+data[0].id);
                            $("#modalpemasangan .nama").text(data[0].nama);
                            $("#modalpemasangan .alamat").text(data[0].alamat);
                            $("#modalpemasangan .telepon").text(data[0].telepon);
                            $("#modalpemasangan .status").text(data[0].status);
                            $("#modalpemasangan .kualitas").text(data[0].kualitas);
                            $("#modalpemasangan .catatanpotong").text(data[0].catatanpotong);
                            $("#modalpemasangan .catatanjahit").text(data[0].catatanjahit);
                            $("#modalpemasangan .tgl").text(data[0].tglselesai);
                            $("#modalpemasangan #defaultForm-idpengukuran").val(data[0].id);
                            $("#modalpemasangan #defaultForm-cekstatus").val(data[0].status);
                            $("#modalpemasangan #defaultForm-pelanggan").val(data[0].nama);

                            if (data[0].status=='Selesai Pemasangan') {
                                $("#modalpemasangan .btn-proses").text('Konfirmasi');
                                $("#modalpemasangan .box-ttd").removeClass('hidden');
                            } else {
                                $("#modalpemasangan .btn-proses").text('Selesai Pemasangan');
                                $("#modalpemasangan .box-ttd").addClass('hidden');
                            }

                            if (data[0].konfirmasi!='') {
                                $("#modalpemasangan .box-ttd").addClass('hidden');
                                $("#modalpemasangan .btn-proses").addClass('hidden');
                                $("#modalpemasangan .box-image-ttd").removeClass('hidden');
                                $("img.image-ttd").attr("src", "../assets/img/"+data[0].konfirmasi);
                            } else {
                                $("#modalpemasangan .box-ttd").removeClass('hidden');
                                $("#modalpemasangan .btn-proses").removeClass('hidden');
                                $("#modalpemasangan .box-image-ttd").addClass('hidden');
                                $("img.image-ttd").attr("src", "");

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

                                $('#listbarang tbody').append("<tr><td>"+
                                data['listbarang'][i].pengukuran_detail_ruang+"</td><td>"+
                                data['listbarang'][i].jenis_nama+""+jenislain+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_kode_bahan+""+kodebahan1+"</td><td>"+
                                data['listbarang'][i].model_nama+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_tarikan+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_tinggi+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_lebar+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_jumlah+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_kt+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_alat_warna+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_alat_ukuran+"</td></tr>");
                            }

                        }
                    });
                });
            }
        } );

      
    } );
    </script>