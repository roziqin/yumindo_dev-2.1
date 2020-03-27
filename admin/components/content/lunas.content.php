<?php 
    include '../modals/penagihan.modal.php'; 
?>
    <table id="table-lunas" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>Tanggal</th>
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
        
        $('#table-lunas').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 0, 'desc' ],[ 6, 'desc' ]],
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=lunas", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "pengukuran_tanggal" },
                { "data": "nama_pelanggan" },
                { "data": "alamat" },
                { "data": "telepon" },
                { "data": "nama_petugas" },
                { "data": "pengukuran_status" },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modalpenagihan" data-id="' + full['pengukuran_id'] + '" title="Detail"><i class="fas fa-pen"></i></a>';
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
                            $("a.btn-invoice").attr("href", "export/pdf-invoice.php?id="+data[0].id);
                            $(".btn-proses").addClass("hidden");
                            var totalharga = parseInt(data[0].harga);
                            var subtotal = parseInt(data[0].harga)+parseInt(data[0].diskon)-parseInt(data[0].ppn);
                            $("#modalpenagihan .nama").text(data[0].nama);
                            $("#modalpenagihan .alamat").text(data[0].alamat);
                            $("#modalpenagihan .telepon").text(data[0].telepon);
                            $("#modalpenagihan .status").text(data[0].status);
                            $("#modalpenagihan .harga").text(formatRupiah(totalharga.toString(), 'Rp. '));
                            $("#modalpenagihan .diskon").text(formatRupiah(data[0].diskon.toString(), 'Rp. '));
                            $("#modalpenagihan .subtotal").text(formatRupiah(subtotal.toString(), 'Rp. '));
                            $("#modalpenagihan .ppn").text(formatRupiah(data[0].ppn.toString(), 'Rp. '));
                            $("#modalpenagihan #defaultForm-idpengukuran").val(data[0].id);
                            $("#modalpenagihan .box-tagihan").addClass("hidden");
                            $("#modalpenagihan .box-lunas").removeClass("hidden");
                            //$("#modalpenagihan #defaultForm-cekstatus").text(data[0].kualitas);

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
                                data['listbarang'][i].pengukuran_detail_jumlah+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_kt+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_alat_warna+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_alat_ukuran+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_tinggi+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_lebar+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_volume+"</td><td>"+
                                formatRupiah(data['listbarang'][i].pengukuran_detail_harga.toString(), 'Rp. ')+"</td></tr>");
                            }

                        }
                    });
                });
            }
        });

      
    } );
    </script>