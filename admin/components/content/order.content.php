<?php 
session_start();
$con = mysqli_connect("localhost","root","","yumindon_new");
include '../../../include/format_rupiah.php';
include '../modals/order.modal.php';
$kond = $_GET['kond'];
$userid = $_SESSION['login_user'];
?>

<?php
if($_SESSION['print']=='ya') {
?>
    <script type="text/javascript">
        window.open("export/pdf-penawaran.php");
        </script>
    <?php
}
if ($kond=='home' || $kond=='') {
    $_SESSION['print']='tidak';

?>
    <div class="card">
        <div class="card-body">
            <form method="post" class="form-transaksi">
                <input type="hidden" id="defaultForm-namajenis" name="ip-namajenis">
                <input type="hidden" id="defaultForm-namabahan" name="ip-namabahan">
                <input type="hidden" id="defaultForm-namamodel" name="ip-namamodel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                          <select class="mdb-select select-jenis md-form" id="defaultForm-jenis" name="ip-jenis">
                            <option value="">Pilih Jenis</option>
                            <?php
                              $sql="SELECT * from jenis";
                              $result=mysqli_query($con,$sql);
                              while ($data1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                    echo "<option value='$data1[jenis_id]'>$data1[jenis_nama]</option>";
                              }
                            ?>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-4 box-namalain hidden">
                        <div class="md-form mb-0">
                            <input type="text" id="defaultForm-nama" class="form-control" name="ip-namalain">
                            <label for="defaultForm-nama">Nama Item</label>
                        </div>
                    </div>
                    <div class="col-md-4 box-model hidden">
                        <div class="md-form mb-0">
                          <select class="mdb-select select-model md-form" id="defaultForm-model" name="ip-model">
                            <option value="0">Pilih Model</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-4 box-bahan hidden">
                        <div class="md-form mb-0">
                          <select class="mdb-select select-bahan md-form" id="defaultForm-bahan" name="ip-bahan">
                            <option value="0">Pilih Bahan</option>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="row box-other">
                    <div class="col-md-2">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-ruang" class="form-control mb-3" name="ip-ruang" disabled>
                            <label for="defaultForm-ruang">Ruang</label>
                        </div>                
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-kodebahan" class="form-control mb-3" name="ip-kodebahan" disabled>
                            <label for="defaultForm-kodebahan">Kode Bahan</label>
                        </div>                
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-kodebahan1" class="form-control mb-3" name="ip-kodebahan1" disabled>
                            <label for="defaultForm-kodebahan1">Kode Bahan Vitras</label>
                        </div>                
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-hargabahan" class="form-control mb-3" name="ip-hargabahan" disabled>
                            <label for="defaultForm-hargabahan">Harga Bahan</label>
                        </div>                
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-hargabox" class="form-control mb-3" name="ip-hargabox" disabled>
                            <label for="defaultForm-hargabahan">Harga Box</label>
                        </div>                
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-1">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-tinggi" class="form-control mb-3" name="ip-tinggi1" value="100" disabled>
                            <label for="defaultForm-tinggi" class="active">Tinggi</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-lebar" class="form-control mb-3" name="ip-lebar1" value="100" disabled>
                            <label for="defaultForm-lebar" class="active">Lebar</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-volume" class="form-control mb-3" name="ip-volume1" value="0" disabled>
                            <label for="defaultForm-volume" class="active">Volume(m)</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="md-form mb-0 mt-0">
                            <input type="number" id="defaultForm-jumlah" class="form-control mb-3" name="ip-jumlah" maxlength="5" value="1"  step="any" disabled>
                            <label for="defaultForm-jumlah" class="active">Jumlah</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="md-form mb-0 mt-0">
                            <input type="text" id="defaultForm-tarikan" class="form-control mb-3" name="ip-tarikan" disabled>
                            <label for="defaultForm-tarikan">Tarikan</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="md-form mb-0 mt-0">
                            <select class="mdb-select md-form select-other" id="defaultForm-kt" name="ip-kt" disabled>
                                <option value="G:KT/V:E">G:KT/V:E</option>
                                <option value="G:KT/V:KT">G:KT/V:KT</option>
                                <option value="G:E/V:E">G:E/V:E</option>
                                <option value="G:E/V:KT">G:E/V:KT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-21">
                        <div class="md-form mb-0 mt-0">
                            <select class="mdb-select md-form select-other" id="defaultForm-relalat1" name="ip-relalat1" disabled>
                                <option value="" >Pilih Rel 1</option>
                                <option value="Rolet">Rolet</option>
                                <option value="Delux">Delux</option>
                                <option value="Lengkung">Lengkung</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-21">
                        <div class="md-form mb-0 mt-0">
                            <select class="mdb-select md-form select-other" id="defaultForm-relalat2" name="ip-relalat2" disabled>
                                <option value="" >Pilih Rel 2</option>
                                <option value="Rolet">Rolet</option>
                                <option value="Delux">Delux</option>
                                <option value="Lengkung">Lengkung</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-21">
                        <div class="md-form mb-0 mt-0">
                            <select class="mdb-select md-form select-other" id="defaultForm-relwarna" name="ip-relwarna" disabled>
                                <option value="">Pilih Warna</option>
                                <option value="Putih">Putih</option>
                                <option value="Coklat Kayu">Coklat Kayu</option>
                                <option value="Gold">Gold</option>
                                <option value="Silver">Silver</option>
                                <option value="Black">Black</option>
                                <option value="Lengkuy">Lengkuy</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-21">
                        <div class="md-form mb-0 mt-0">
                            <button class="btn btn-primary btn-proses" disabled="">&nbsp;&nbsp;Input&nbsp;&nbsp;</button>
                            <button class="btn btn-default btn-openmodal" data-toggle="modal" data-target="#modalorder">Selesai</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php 
}

?>
    <style type="text/css">
        @media (max-width: 767px) {
            #table-listbarang_wrapper .row {
                overflow-x: auto;
            }
        }
    </style>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col-md-12">
                    <table id="table-listbarang" class="table table-striped table-bordered fadeInLeft slow animated">
                        <thead>
                            <tr>
                                <th>Ruang</th>
                                <th>T<br><span style="font-size: 11px;">(cm)</span></th>
                                <th>L<br><span style="font-size: 11px;">(cm)</span></th>
                                <th>V<br><span style="font-size: 11px;">(m)</span></th>
                                <th>Jenis</th>
                                <th>Bahan</th>
                                <th>Kode<br>Bahan</th>
                                <th>Tarikan</th>
                                <th>Model</th>
                                <th>Jumlah</th>
                                <th>KT/E</th>
                                <th>Rel/Alat</th>
                                <th>Warna</th>
                                <th>Ukuran Rel</th>
                                <th>Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="14" style="text-align:right">Total:</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){

        $('.select-jenis').materialSelect();
        $('.select-other').materialSelect();

        $('#table-listbarang').DataTable( {
            "pageLength": 50,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "language": {
                "emptyTable": "No data available in table"
            },
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=transaksi-listbahan", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "columns": [
                { "data": "pengukuran_detail_temp_ruang" },
                { "data": "pengukuran_detail_temp_tinggi" },
                { "data": "pengukuran_detail_temp_lebar" },
                { "data": "pengukuran_detail_temp_volume" },
                { "render": function(data, type, full){
                        if (full['pengukuran_detail_temp_jenis_lain']!='') {
                           return full['jenis_nama']+' / '+full['pengukuran_detail_temp_jenis_lain'];

                        } else {
                           return full['jenis_nama'];
                        }
                    }
                },
                { "data": "bahan_nama" },
                { "render": function(data, type, full){
                        if (full['pengukuran_detail_temp_kode_bahan_1']!='') {
                           return full['pengukuran_detail_temp_kode_bahan']+' / '+full['pengukuran_detail_temp_kode_bahan_1'];

                        } else {
                           return full['pengukuran_detail_temp_kode_bahan'];
                        }
                    }
                },
                { "data": "pengukuran_detail_temp_tarikan" },
                { "data": "model_nama" },
                { "data": "pengukuran_detail_temp_jumlah" },
                { "data": "pengukuran_detail_temp_kt" },
                { "render": function(data, type, full){
                        if (full['pengukuran_detail_temp_alat_2']!='') {
                           return full['pengukuran_detail_temp_alat_1']+' / '+full['pengukuran_detail_temp_alat_2'];

                        } else {
                           return full['pengukuran_detail_temp_alat_1'];
                        }
                    }
                },
                { "data": "pengukuran_detail_temp_alat_warna" },
                { "data": "pengukuran_detail_temp_alat_ukuran" },
                { "data": "pengukuran_detail_temp_harga" },
                { "width": "90px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-danger btn-remove" data-id="' + full['pengukuran_detail_temp_id'] + '" title="Delete"><i class="fas fa-trash"></i></a>';
                    }
                },
            ],
            "drawCallback": function( settings ) {
              
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
                                    url: "controllers/transaksi.ctrl.php?ket=remove-item",
                                    dataType: "json",
                                    data:{item_id:item_id},
                                    success: function(data) {
                                      if (data[0]=="ok") {
                                        $('#table-listbarang').DataTable().ajax.reload();
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
              
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                total = api
                    .column( 14 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 14 ).footer() ).html(
                    'Rp. '+formatCurrency(total.toString(), '')
                );
            }
        });

        $("#defaultForm-jenis").change(function(){

            $('.select-other').materialSelect({destroy:true});
            $(".box-other").children().children().children().attr("disabled", "disabled");
            $(".btn-openmodal").removeAttr("disabled");
            $('.select-other').materialSelect();
            var idjenis = $(this).val();
            var namajenis = $( "#defaultForm-jenis option:selected" ).text();
            console.log(idjenis);
            $('#defaultForm-model').children('option:not(:first)').remove();
            $('#defaultForm-bahan').children('option:not(:first)').remove();
            $.ajax({
                type:'POST',
                url:'api/view.api.php?func=cekmodel',
                dataType: "json",
                data:{idjenis:idjenis},
                success: function(data) {
                    $("#defaultForm-namajenis").val(namajenis);
                    if(data[0].lengthdata!=0) {
                        $(".box-model").removeClass('hidden');
                        $("#defaultForm-model").change(function(){
                            $("#defaultForm-namamodel").val($("#defaultForm-model option:selected").text());
                        });
                    } else {
                        $(".box-model").addClass('hidden');

                    }
                    for (var i = 0; i < data[0].lengthdata; i++) {
                        $("#defaultForm-model").append('<option value="'+data[0].idmodel[i]+'">'+data[0].namamodel[i]+'</option>');
                    }

                    if(data[0].lengthdatabahan!=0) {
                        $(".box-bahan").removeClass('hidden');
                        $("#defaultForm-bahan").change(function(){
                            $("#defaultForm-namabahan").val($("#defaultForm-bahan option:selected").text());
                            removeDisabled(namajenis);
                        });
                    } else {
                        $("#defaultForm-model").change(function(){
                            $("#defaultForm-namamodel").val($("#defaultForm-model option:selected").text());
                            removeDisabled(namajenis);
                        });
                        $(".box-bahan").addClass('hidden');

                    }
                    for (var i = 0; i < data[0].lengthdatabahan; i++) {
                        $("#defaultForm-bahan").append('<option value="'+data[0].idbahan[i]+'">'+data[0].namabahan[i]+'</option>');
                    }
                    $('.select-model').materialSelect({destroy:true});
                    $('.select-bahan').materialSelect({destroy:true});
                    $('.select-bahan').materialSelect();
                    $('.select-model').materialSelect();
                    
                    if ($( "#defaultForm-jenis option:selected" ).text()=='Lain-lain') {
                        $(".box-namalain").removeClass('hidden');
                        removeDisabled(namajenis);
                    } else {
                        $(".box-namalain").addClass('hidden');

                    }
                }
            });
        });

        $(".btn-proses").click(function(e){
            e.preventDefault();
            var data = $('.form-transaksi').serialize();
            console.log(data);
            $.ajax({
              type: 'POST',
              url: "controllers/transaksi.ctrl.php?ket=inputpengukuran",
              data: data,
              success: function(data) {
                    $('.select-other').materialSelect({destroy:true});
                    $(".box-other").children().children().children().attr("disabled", "disabled");
                    $(".btn-openmodal").removeAttr("disabled");
                    $(".box-other").children().children().children().val('');
                    $('.select-other').materialSelect();
                    $(".box-namalain").addClass('hidden');
                    $(".box-model").addClass('hidden');
                    $(".box-bahan").addClass('hidden');
                    $( "#defaultForm-jenis").val("");
                    $( "#defaultForm-bahan").val("");
                    $( "#defaultForm-model").val("");
                    $( "#defaultForm-tinggi").val(100);
                    $( "#defaultForm-lebar").val(100);
                    $( "#defaultForm-volume").val(0);
                    $( "#defaultForm-jumlah").val(1);
                    $( "#table-listbarang").DataTable().ajax.reload();
                
                }
            });
        
        });

        $('.btn-openmodal').on('click',function(e){
            e.preventDefault();
            $('#listbarang tbody').empty();
            $.ajax({
                type:'POST',
                url:'api/view.api.php?func=detailorder',
                dataType: "json",
                success:function(data){
                    console.log(data);
                    var jml = 0;
                    for (var i in data) {
                        if (i==0) {

                            $('#modalorder p.nama').text('Nama: '+data[i].nama);
                            $('#modalorder p.alamat').text('Alamat: '+data[i].alamat);
                          
                        } else {
                            var namalain = '';
                          if (data[i].pengukuran_detail_temp_jenis_lain!='') {
                            namalain = ' / '+data[i].pengukuran_detail_temp_jenis_lain;
                          }
                          $('#listbarang tbody').append("<tr><td>"+data[i].pengukuran_detail_temp_ruang+"</td><td>"+data[i].jenis_nama+""+namalain+"</td><td class='text-right'>"+formatRupiah(data[i].pengukuran_detail_temp_harga.toString(), '')+"</td></tr>");
                          jml+=parseInt(data[i].pengukuran_detail_temp_harga);

                        }
                    }
                        $('#listbarang tbody').append("<tr><th colspan='2'>Total</th><th class='text-right'>"+formatRupiah(jml.toString(), '')+"</th></tr>");
                        $('#modalorder #defaultForm-total').val(jml);
                }

            });
        });
    });

    function removeDisabled(namajenis) {
        console.log("ok "+namajenis)
        $('.select-other').materialSelect({destroy:true});
        $(".box-other").children().children().children().removeAttr("disabled");

        if (namajenis=="Gorden & Vitras") {
            $("#defaultForm-kodebahan1").removeAttr("disabled");
        } else {
            $("#defaultForm-kodebahan1").attr("disabled", "disabled");
        }
        if (namajenis=='Gorden & Vitras'||namajenis=='Vitras'||namajenis=='Gorden'||namajenis=='Poni Polos'||namajenis=='Poni Motif'||namajenis=='Kaca Film') {
            $("#defaultForm-hargabahan").attr("disabled", "disabled");
        } else {
            $("#defaultForm-hargabahan").removeAttr("disabled");
        }
        if (namajenis=="Lain-lain") {
            $("#defaultForm-volume").removeAttr("disabled");
        } else {
            $("#defaultForm-volume").attr("disabled", "disabled");
        }
        if (namajenis=="Poni Motif" || namajenis=="Poni Polos") {
            $("#defaultForm-hargabox").removeAttr("disabled");
        } else {
            $("#defaultForm-hargabox").attr("disabled", "disabled");
        }
        if (namajenis=='Roller Blind'||namajenis=='Vertikal Blind'||namajenis=='Horizontal Blind'||namajenis=='Wodden Blind') {
            $("#defaultForm-tarikan").removeAttr("disabled");
        } else {
            $("#defaultForm-tarikan").attr("disabled", "disabled");
        }
        if (namajenis=='Gorden & Vitras'||namajenis=='Vitras'||namajenis=='Gorden'||namajenis=='Poni Polos'||namajenis=='Poni Motif') {
            $("#defaultForm-kt").removeAttr("disabled");
            $("#defaultForm-relalat1").removeAttr("disabled");
            $("#defaultForm-relwarna").removeAttr("disabled");
            if (namajenis!='Gorden & Vitras'){
                $("#defaultForm-relalat2").attr("disabled", "disabled");
                $('#defaultForm-kt').children('option').remove();
                $("#defaultForm-kt").append('<option value="KT">KT</option>');
                $("#defaultForm-kt").append('<option value="E">E</option>');
            } else {
                $("#defaultForm-relalat2").removeAttr("disabled");
                $('#defaultForm-kt').children('option').remove();
                $("#defaultForm-kt").append('<option value="G:KT/V:E">G:KT/V:E</option>');
                $("#defaultForm-kt").append('<option value="G:KT/V:KT">G:KT/V:KT</option>');
                $("#defaultForm-kt").append('<option value="G:E/V:E">G:E/V:E</option>');
                $("#defaultForm-kt").append('<option value="G:E/V:KT">G:E/V:KT</option>');
            }
        } else {
            $("#defaultForm-kt").attr("disabled", "disabled");
            $("#defaultForm-relalat1").attr("disabled", "disabled");
            $("#defaultForm-relalat2").attr("disabled", "disabled");
            $("#defaultForm-relwarna").attr("disabled", "disabled");
        }

        $('.select-other').materialSelect();
    }
    /*
	function removeItemTemp(id, index) {
		$.ajax({
			type:'POST',
	        url: "controllers/order.ctrl.php?ket=removeitem",
            dataType: "json",
            data:{
            	id:id,
            	index:index
            },
            success:function(data){
                console.log("remove");
				$('.container__load').load('components/content/order.content.php?kond=home');
            }
        });
	}

	function plusminusItem(id, idbarang, index, keterangan, jumlah) {
		$.ajax({
			type:'POST',
	        url: "controllers/order.ctrl.php?ket=plusminus",
            dataType: "json",
            data:{
            	id:id,
            	idbarang:idbarang,
            	index:index,
            	keterangan:keterangan,
            	jumlah:jumlah
            },
            success:function(data){
            	
            	console.log("plusminus sukses "+data.totalordertemp);
                if (data.totalordertemp.toString()=="Stok Kurang") {
                    $.confirm({
                          title: 'Stok Kurang',
                          content: 'Jumlah stok tidak mencukupi',
                          buttons: {
                              confirm: {
                                  text: 'Close',
                                  btnClass: 'col-md-12 btn btn-primary',
                                  action: function(){
                                      
                                      
                                  }
                              }
                          }
                    });
                } else {
                    $('.container__load').load('components/content/order.content.php?kond=home');
                }

            	/*
                $.confirm({
                      title: 'Stok Kurang',
                      content: 'Jumlah stok tidak mencukupi',
                      buttons: {
                          confirm: {
                              text: 'Close',
                              btnClass: 'col-md-12 btn btn-primary',
                              action: function(){
                                  
                                  
                              }
                          }
                      }
                });
            	if (data.jumlahordertemp==0) {
            		$("#listitem tr").eq(index).remove();
            	} else {
            		$("#listitem tr:eq("+index+") td span.text_total").empty();
	            	$("#listitem tr:eq("+index+") td span.text_total").text(formatRupiah(data.item.order_detail_temp_total, 'Rp. '));
	            	
	            	$("#listitem tr:eq("+index+") td span.text_jumlah").empty();
	            	$("#listitem tr:eq("+index+") td span.text_jumlah").text(data.item.order_detail_temp_jumlah);

	            	$("#listitem tr:eq("+index+") td button.btn-plusminus").attr("data-jumlah", data.item.order_detail_temp_jumlah)
            	}
				
				$('#subtotal').empty();
	            $('#subtotal').append(formatRupiah(data.totalordertemp.toString(), 'Rp. '));

				var tax = parseInt(pajakjml)*data.totalordertemp*0.1;
				if ($('#ip-pajakpembulatan').val()==1) {
					tax = pembulatan(tax);
		        }

	        	$('#pajak').empty();
				$('#pajak').append(formatRupiah(tax.toString(), 'Rp. '))
				
				var total = tax+data.totalordertemp;
				$('#total').empty();
				$('#total').append(formatRupiah(total.toString(), 'Rp. '));
				

				
            }
        });
	}

	function pembulatan(tax) {
		if (tax.toString().length == 3) {
            if (tax.toString().slice(0) == 0 ) {
                tax = 0;
            } else if (tax.toString().slice(0) <= 500 ) {
                tax = 500;
            } else {
                tax = 1000;
            }
            return tax;

        } else if (tax.toString().length == 4) {
            if (tax.toString().slice(1) == 0 ) {
                tax = tax.toString().slice(0,1)+"000";
            } else if (tax.toString().slice(1) <= 500 ) {
                tax = tax.toString().slice(0,1)+"500";
            } else {
                tax = parseInt(tax.toString().slice(0,1))+1+"000";
            }
            tax = parseInt(tax);
            return tax;
        } else if (tax.toString().length == 5) {
            if (tax.toString().slice(2) == 0 ) {
                tax = tax.toString().slice(0,2)+"000";
            } else if (tax.toString().slice(2) <= 500 ) {
                tax = tax.toString().slice(0,2)+"500";
            } else {
                tax = parseInt(tax.toString().slice(0,2))+1+"000";
            }
            tax = parseInt(tax);
            return tax;
        } else {
            if (tax.toString().slice(3) == 0 ) {
                tax = tax.toString().slice(0, 3)+"000";
            } else if (tax.toString().slice(3) <= 500 ) {
                tax = tax.toString().slice(0, 3)+"500";
            } else {
                tax = parseInt(tax.toString().slice(0, 3))+1+"000";
            }
            tax = parseInt(tax);
            return tax;
        }
	}
    */
</script>