<?php 
    include '../modals/orderbahan.modal.php'; 
?>
    <table id="table-orderbahan" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
    </table>

    <script type="text/javascript">
      
    $(document).ready(function() {
        
        $('#table-orderbahan').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [ 0, 'desc' ],
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=order-bahan", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "pengukuran_tanggal" },
                { "data": "name" },
                { "data": "alamat" },
                { "data": "pengukuran_status" },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" data-toggle="modal" data-target="#modalorderbahan" data-id="' + full['pengukuran_id'] + '" title="Follow Up"><i class="fas fa-pen"></i></a>';
                    }
                },
            ],
            "drawCallback": function( settings ) {
              $('.btn-edit').on('click',function(){
                  var id = $(this).data('id');
                  console.log(id)
                  $.ajax({
                      type:'POST',
                      url:'api/view.api.php?func=orderbahan',
                      dataType: "json",
                      data:{id:id},
                      success:function(data){
                        $("a.btn-order").attr("href", "export/pdf-orderbahan.php?id="+data[0].idp);
                        $('#listbarangorder tbody').empty();
                        $('#listbarangorder thead').empty();
                        var thead = '';
                        var nilaikualitas = '';
                        var totalbahan1 = 0;
                        var totalbahan2 = 0;
                        var totalrelalat1 = 0;
                        var totalrelalat1 = 0;
                        var dataorder = [];
                        if (data[0].kualitas=='Premium') {
                            nilaikualitas = data[0].premium;
                            nilaikualitasvitras = data[0].vitraspremium;
                        } else if (data[0].kualitas=='Gold') {
                            nilaikualitas = data[0].gold;
                            nilaikualitasvitras = data[0].vitrasgold;
                        } else {
                            nilaikualitas = data[0].silver;
                            nilaikualitasvitras = data[0].vitrassilver;
                        }
                        $("#modalorderbahan .nama").text(data[0].nama);
                        $("#modalorderbahan .alamat").text(data[0].alamat);
                        $("#modalorderbahan .telepon").text(data[0].telepon);
                        $("#modalorderbahan .status").text(data[0].status);
                        $("#modalorderbahan .kualitas").text(data[0].kualitas);
                        $("#modalorderbahan #defaultForm-idpengukuran").val(data[0].idp);
                        $("#modalorderbahan #defaultForm-cekstatus").val(data[0].status);
                        if (data[0].status!='Deal') {
                            $("#modalorderbahan .btn-proses").addClass('hidden');
                        }
                        for (var i in data['kodebahan']) {
                            thead += "<th>"+
                                data['kodebahan'][i].pengukuran_detail_kode_bahan+"</th>";
                        }
                        
                        for (var i in data['kodebahan1']) {
                            thead += "<th>"+
                                data['kodebahan1'][i].pengukuran_detail_kode_bahan_1+"</th>";
                        }

                        $('#listbarangorder thead').append("<tr>"+
                            "<th>Ruang</th>"+
                            "<th>Tinggi</th>"+
                            "<th>Lebar</th>"+
                            "<th>Jml</th>"+
                            "<th>Tarikan</th>"+
                            thead+
                            "<th>Rolet1</th>"+
                            "<th>Delux1</th>"+
                            "<th>Lengkung1</th>"+
                            "<th>Rolet2</th>"+
                            "<th>Delux2</th>"+
                            "<th>Lengkung2</th>"+
                            "<th></th>"+
                            "</tr>");

                        var tablebahan1 = '';
                        for (var i in data['listbarang']) {
                            var varkualitas = ''
                            var tablebahan = '';
                            if (data['listbarang'][i].jenis_nama=='Vitras') {
                                varkualitas = nilaikualitasvitras;
                            } else if (data['listbarang'][i].jenis_nama=='Gorden & Vitras') {
                                varkualitas = nilaikualitas;
                                varkualitasvitras = nilaikualitasvitras;
                            } else {
                                varkualitas = nilaikualitas;
                            }

                            var cekbutton = '';
                            //console.log('order bahan '+data['orderbahanid'])
                            if (typeof data['orderbahanid']!='undefined') {
                                var stat = 0;
                                for (var k in data['orderbahanid']) {
                                    if (data['orderbahanid'][k].pengukuran_detail_id==data['listbarang'][i].pengukuran_detail_id) { 
                                        var stat = 1
                                        var jmlbahan1 = data['orderbahanid'][k].order_bahan_jumlah_kode_bahan_1;
                                        var jmlbahan2 = data['orderbahanid'][k].order_bahan_jumlah_kode_bahan_2;
                                        var cekkodebahan1 = data['orderbahanid'][k].order_bahan_kode_bahan_1;
                                        var cekkodebahan2 = data['orderbahanid'][k].order_bahan_kode_bahan_2;
                                        //totalbahan1 = parseInt(jmlbahan1);
                                        //totalbahan2 = parseInt(jmlbahan2);
                                    } 
                                }
                                if (stat==0) {
                                    cekbutton = "<button class='btn btn-floating btn-default btn-cek m-0' title='Proses' data-id='"+data['listbarang'][i].pengukuran_detail_id+"' data-jumlah='"+data['listbarang'][i].pengukuran_detail_jumlah+"''><i class='far fa-check-square'></i></button>";

                                    for (var j in data['kodebahan']) {
                                        if (data['kodebahan'][j].pengukuran_detail_kode_bahan==data['listbarang'][i].pengukuran_detail_kode_bahan) {

                                            tablebahan += "<td><input type='hidden' name='ip-namabahan' class='defaultForm-namabahan' value='"+data['listbarang'][i].pengukuran_detail_kode_bahan+"'><input type='text' name='ip-bahan' class='defaultForm-bahan' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitas)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"' style='padding: 0 5px;max-width: 60px;'></td>"; 
                                        } else {
                                            tablebahan += "<td>0</td>";
                                        }
                                    }
                                    
                                    for (var j in data['kodebahan1']) {
                                        if (data['kodebahan1'][j].pengukuran_detail_kode_bahan_1==data['listbarang'][i].pengukuran_detail_kode_bahan_1) {

                                            tablebahan += "<td><input type='hidden' name='ip-namabahan1' class='defaultForm-namabahan1' value='"+data['listbarang'][i].pengukuran_detail_kode_bahan_1+"'><input type='text' name='ip-bahan1' class='defaultForm-bahan1' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitasvitras)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"' style='padding: 0 5px;max-width: 60px;'></td>"; 
                                        } else {
                                            tablebahan += "<td>0</td>";
                                        }
                                    }

                                } else {
                                    cekbutton = 'Cek';

                                    for (var j in data['kodebahan']) {
                                        if (data['kodebahan'][j].pengukuran_detail_kode_bahan==cekkodebahan1) {
                                            tablebahan += "<td>"+jmlbahan1+"</td>"; 
                                        } else {
                                            tablebahan += "<td>0</td>";
                                        }
                                    }
                                    
                                    for (var j in data['kodebahan1']) {
                                        if (data['kodebahan1'][j].pengukuran_detail_kode_bahan_1==cekkodebahan2) {
                                            tablebahan += "<td>"+jmlbahan2+"</td>"; 
                                        } else {
                                            tablebahan += "<td>0</td>";
                                        }
                                    }
                                }
                            } else {
                                cekbutton = "<button class='btn btn-floating btn-default btn-cek m-0' title='Proses' data-id='"+data['listbarang'][i].pengukuran_detail_id+"' data-jumlah='"+data['listbarang'][i].pengukuran_detail_jumlah+"''><i class='far fa-check-square'></i></button>";

                                for (var j in data['kodebahan']) {
                                    if (data['kodebahan'][j].pengukuran_detail_kode_bahan==data['listbarang'][i].pengukuran_detail_kode_bahan) {

                                        tablebahan += "<td><input type='hidden' name='ip-namabahan' class='defaultForm-namabahan' value='"+data['listbarang'][i].pengukuran_detail_kode_bahan+"'><input type='text' name='ip-bahan' class='defaultForm-bahan' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitas)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"' style='padding: 0 5px;max-width: 60px;'></td>"; 
                                    } else {
                                        tablebahan += "<td>0</td>";
                                    }
                                }
                                
                                for (var j in data['kodebahan1']) {
                                    if (data['kodebahan1'][j].pengukuran_detail_kode_bahan_1==data['listbarang'][i].pengukuran_detail_kode_bahan_1) {

                                        tablebahan += "<td><input type='hidden' name='ip-namabahan1' class='defaultForm-namabahan1' value='"+data['listbarang'][i].pengukuran_detail_kode_bahan_1+"'><input type='text' name='ip-bahan1' class='defaultForm-bahan1' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(varkualitasvitras)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"' style='padding: 0 5px;max-width: 60px;'></td>"; 
                                    } else {
                                        tablebahan += "<td>0</td>";
                                    }
                                }
                            }

                            
                            
                            if (data['listbarang'][i].pengukuran_detail_alat_1=="Rolet") {
                                tablebahan += "<td><input type='hidden' name='ip-relalat1' class='defaultForm-relalat1' value='Rolet'>"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"<input type='hidden' name='ip-jmlrelalat1' class='defaultForm-jmlrelalat1' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"'></td>";

                            } else {
                                tablebahan += "<td>0</td>";
                            }

                            if (data['listbarang'][i].pengukuran_detail_alat_1=="Delux") {
                                tablebahan += "<td><input type='hidden' name='ip-relalat1' class='defaultForm-relalat1' value='Delux'>"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"<input type='hidden' name='ip-jmlrelalat1' class='defaultForm-jmlrelalat1' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"'></td>";

                            } else {
                                tablebahan += "<td>0</td>";
                            }

                            if (data['listbarang'][i].pengukuran_detail_alat_1=="Lengkung") {
                                tablebahan += "<td><input type='hidden' name='ip-relalat1' class='defaultForm-relalat1' value='Lengkung'>"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"<input type='hidden' name='ip-jmlrelalat1' class='defaultForm-jmlrelalat1' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"'></td>";

                            } else {
                                tablebahan += "<td>0</td>";
                            }

                            
                            if (data['listbarang'][i].pengukuran_detail_alat_2=="Rolet") {
                                tablebahan += "<td><input type='hidden' name='ip-relalat2' class='defaultForm-relalat2' value='Rolet'>"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"<input type='hidden' name='ip-jmlrelalat2' class='defaultForm-jmlrelalat2' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"'></td>";

                            } else {
                                tablebahan += "<td>0</td>";
                            }

                            if (data['listbarang'][i].pengukuran_detail_alat_2=="Delux") {
                                 tablebahan += "<td><input type='hidden' name='ip-relalat2' class='defaultForm-relalat2' value='Delux'>"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"<input type='hidden' name='ip-jmlrelalat2' class='defaultForm-jmlrelalat2' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"'></td>";

                            } else {
                                tablebahan += "<td>0</td>";
                            }

                            if (data['listbarang'][i].pengukuran_detail_alat_2=="Lengkung") {
                                 tablebahan += "<td><input type='hidden' name='ip-relalat2' class='defaultForm-relalat2' value='Lengkung'>"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"<input type='hidden' name='ip-jmlrelalat2' class='defaultForm-jmlrelalat2' value='"+parseFloat(data['listbarang'][i].pengukuran_detail_lebar)*parseFloat(data['listbarang'][i].pengukuran_detail_jumlah)+"'></td>";

                            } else {
                                tablebahan += "<td>0</td>";
                            }

                            $('#listbarangorder tbody').append("<tr><form method='post' class='form-orderbahancek'><td>"+
                                data['listbarang'][i].pengukuran_detail_ruang+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_tinggi+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_lebar+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_jumlah+"</td><td>"+
                                data['listbarang'][i].pengukuran_detail_tarikan+"</td>"+
                                tablebahan+
                                "<td>"+cekbutton+"</td></form></tr>");


                            
                        }
                        var tabletotalbahan = '';
                        for (var j in data['kodebahan']) {
                            if (data['kodebahan'][j].pengukuran_detail_kode_bahan==cekkodebahan1) {
                                totalbahan1 += parseInt(jmlbahan1);
                                tabletotalbahan += "<td>"+totalbahan1+"</td>"; 
                            } else {
                                tabletotalbahan += "<td>0</td>";
                            }
                        }
                        
                        for (var j in data['kodebahan1']) {
                            if (data['kodebahan1'][j].pengukuran_detail_kode_bahan_1==cekkodebahan2) {
                                tabletotalbahan += "<td>"+totalbahan2+"</td>"; 
                            } else {
                                tabletotalbahan += "<td>0</td>";
                            }
                        }

                        var tfooter = '';
                        for (var i in data['kodebahan']) {
                            for (var j in data['dataorderbahan']) {
                                if(data['kodebahan'][i].pengukuran_detail_kode_bahan==data['dataorderbahan'][j].kode_bahan) {
                                    tfooter += "<td>"+data['dataorderbahan'][j].jumlah+"</td>";
                                }
                            }
                        }
                        for (var i in data['kodebahan1']) {
                            for (var j in data['dataorderbahan']) {
                                if(data['kodebahan1'][i].pengukuran_detail_kode_bahan_1==data['dataorderbahan'][j].kode_bahan) {
                                    tfooter += "<td>"+data['dataorderbahan'][j].jumlah+"</td>";
                                }
                            }
                        }
                        
                        var relalat = ['Rolet','Delux','Lengkung'];
                        for (var i in relalat) {
                            var x = 0;
                            for (var j in data['dataorderrel']) {
                                if(relalat[i]==data['dataorderrel'][j].alat) {
                                    tfooter += "<td>"+data['dataorderrel'][j].jumlah+"</td>";
                                    x = 1;
                                }
                            }
                            if (x==0) {
                                tfooter += "<td>0</td>";
                            }
                        }

                        for (var i in relalat) {
                            var x = 0;
                            for (var j in data['dataorderrel1']) {
                                if(relalat[i]==data['dataorderrel1'][j].alat) {
                                    tfooter += "<td>"+data['dataorderrel1'][j].jumlah+"</td>";
                                    x = 1;
                                }
                            }
                            if (x==0) {
                                tfooter += "<td>0</td>";
                            }
                        }
                        
                        $('#listbarangorder tbody').append("<tr><td colspan='5'>Jumlah</td>"+tfooter+"<td></td></tr>");

                        $(".btn-cek").click(function(e){

                            var idp = $("#modalorderbahan #defaultForm-idpengukuran").val();
                            e.preventDefault(); 
                            var indexitem = $(this).parent().parent().index()+1;
                            console.log(indexitem);
                            var id = $(this).data('id');
                            var jumlah = $(this).data('jumlah');
                            var bahan = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-bahan").val();
                            var namabahan = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-namabahan").val();
                            var bahan1 = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-bahan1").val();
                            var namabahan1 = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-namabahan1").val();
                            var relalat1 = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-relalat1").val();
                            var jmlrelalat1 = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-jmlrelalat1").val();
                            var relalat2 = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-relalat2").val();
                            var jmlrelalat2 = $("#listbarangorder tr:nth-child("+indexitem+") .defaultForm-jmlrelalat2").val();
                            if (typeof bahan1==='undefined') {
                                bahan1 = '';
                            }
                            if (typeof namabahan1==='undefined') {
                                namabahan1 = '';
                            }
                            if (typeof relalat1==='undefined') {
                                relalat1 = '';
                            }
                            if (typeof relalat2==='undefined') {
                                relalat2 = '';
                            }
                            if (typeof jmlrelalat1==='undefined') {
                                jmlrelalat1 = 0;
                            }
                            if (typeof jmlrelalat2==='undefined') {
                                jmlrelalat2 = 0;
                            }
                            console.log('idp: '+idp+
                                'bahan1: '+bahan1+
                                'relalat1: '+relalat1+
                                'jmlrelalat1: '+jmlrelalat1+
                                'relalat2: '+relalat2+
                                'jmlrelalat2: '+jmlrelalat2);
                            //console.log(datacek+" "+index1);
                            
                            $.ajax({
                                type:'POST',
                                url:'controllers/transaksi.ctrl.php?ket=cekorderbahan',
                                dataType: "json",
                                data:{
                                    idp:idp,
                                    id:id,
                                    jumlah:jumlah,
                                    bahan:bahan,
                                    namabahan:namabahan,
                                    bahan1:bahan1,
                                    namabahan1:namabahan1,
                                    relalat1:relalat1,
                                    jmlrelalat1:jmlrelalat1,
                                    relalat2:relalat2,
                                    jmlrelalat2:jmlrelalat2,
                                    indexitem:indexitem
                                },
                                success:function(data){
                                    console.log(data)
                                    $("#listbarangorder tr:nth-child("+indexitem+") td:last-child").empty();
                                    $("#listbarangorder tr:nth-child("+indexitem+") td:last-child").text('Cek');
                                }
                            });
                        });
                      }
                  });
              });
              
            }
        });
        

      
    });
    </script>