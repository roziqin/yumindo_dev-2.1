<?php
session_start();
$con = mysqli_connect("localhost","root","","yumindon_new");
include '../modals/editpenawaran.modal.php'; 
include '../modals/tambahpenawaran.modal.php'; 
?>

    <?php if ($_GET['kond']=='home' || $_GET['kond']=='') { ?>
    <div class="box-home">
        <table id="table-penawaran" class="table table-striped table-bordered fadeInLeft slow animated" style="width:100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Petugas</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Dp</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
    <?php } elseif ($_GET["kond"]=='detail') { 
        $id = $_GET['id'];
        $sql="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$id";
        $query=mysqli_query($con, $sql);
        $data=mysqli_fetch_assoc($query);
    ?>

    <div class="box-detail">
        <h4 class="h4-responsive">Data Pelanggan</h4>
        <div class="row">
            <div class="col-md-3 border-right">
                <form id="form-pelanggan">
                    <input type="hidden" name="ip-idpenawaran" id="defaultForm-idpenawaran">
                    <input type="hidden" name="ip-cekstatus" id="cek-status">
                    <table class="custom">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><p class="nama"></p></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><p class="alamat"></p></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>:</td>
                            <td><p class="telepon"></p></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>:</td>
                            <td><p class="total"></p></td>
                        </tr>
                        <?php
                        if ($data["pengukuran_status"]=="Penawaran") {
                            # code...
                        ?>
                            <tr>
                                <td>Diskon</td>
                                <td>:</td>
                                <td>    
                                    <p class="text-diskon hidden"></p>
                                    <div class="form-group colom-diskon">
                                        <input type="text" name="ip-diskon" class="form-control mb-1 price" id="defaultForm-diskon" style="text-align: right;">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="form-group colom-diskonset">
                                        <select class="mdb-select md-form mt-1 mb-1" id="defaultForm-diskonket" name="ip-diskonket">
                                            <option value="">-- Pilih Jenis Diskon --</option>
                                            <option value="Prosentase" >Prosentase</option>
                                            <option value="Tunai" >Tunai</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            if ($_SESSION['role']=="admin") {
                                
                            ?>
                                <tr>
                                    <td>Kualitas</td>
                                    <td>:</td>
                                    <td>
                                        <p class="text-kualitas hidden"></p>
                                        <div class="form-group colom-kualitas">
                                            <select class="mdb-select md-form mt-1 mb-1 ketkualitas" id="defaultForm-kualitas" name="ip-kualitas">
                                                <option value="Premium" >Premium</option>
                                                <option value="Gold" >Gold</option>
                                                <option value="Silver" >Silver</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dp</td>
                                    <td>:</td>
                                    <td>
                                        <p class="text-dp hidden"></p>
                                        <input type="text" id="defaultForm-dp" name="ip-dp" class="form-control mb-3 colom-dp price1" style="text-align: right; margin-top: 10px; height: auto;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bank Transfer</td>
                                    <td>:</td>
                                    <td>
                                        <p class="text-bank hidden"></p>
                                        <div class="form-group colom-bank">
                                            <select class="mdb-select md-form mt-1 mb-1" id="defaultForm-bank" name="ip-bank">
                                                <option value="" >-- Pilih Bank --</option>
                                                <option value="BCA" >BCA</option>
                                                <option value="Mandiri" >Mandiri</option>
                                                <option value="BRI" >BRI</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PPN 10%</td>
                                    <td>:</td>
                                    <td>
                                        <p class="text-ppn hidden"></p>
                                        <div class="form-group colom-ppn">
                                            <select class="mdb-select md-form mt-1 mb-1" id="defaultForm-ppn" name="ip-ppn">
                                                <option value="tidak" >Tidak</option>
                                                <option value="ya" >Ya</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="3">
                                        <input type="submit" class="btn btn-default pull-right btn-lg" id="btn-negoharga" value="Proses" name="negoharga" style="width:100%; padding: 5px 16px;font-size: 13px; margin-top: 10px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <a href="export/pdf-pengukuran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="width:100%; padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Penawaran</a>
                                    </td>
                                </tr>
                            <?php
                            } else {
                                # code...
                            }
                            

                            
                        }/* elseif ($data["pengukuran_status"]=="Selesai Pemasangan" || $data["pengukuran_status"]=='Selesai Finishing') {
                        ?>

                            <tr>
                                <td>Diskon</td>
                                <td>:</td>
                                <td><p class="text-diskon"></p></td>
                            </tr>
                            <tr>
                                <td>Dp</td>
                                <td>:</td>
                                <td><p class="text-dp"></p></td>
                            </tr>
                            <tr>
                                <td>Sisa</td>
                                <td>:</td>
                                <td><p class="text-sisa"></p></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><?php echo $data["pengukuran_status"]; ?></td>
                            </tr>
                            <tr>
                                <td>Bayar</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="ip-bayar" class="form-control" id="defaultForm-bayar"  style="text-align: right; margin-top: 10px; height: auto;" value="0" id="price">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="btn btn-success pull-right btn-lg" value="Proses" name="pelunasan" style="    padding: 5px 16px;font-size: 13px; margin-top: 10px;">

                                    <a href="pdf/save-pdf-penawaran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;margin-right: 20px;">Download Tagihan</a>
                                </td>
                            </tr>
                        <?php
                        }*/ else {
                        ?>  
                            <p class="text-sisa" style="display: none;"></p>
                            <tr>
                                <td>Diskon</td>
                                <td>:</td>
                                <td><p class="text-diskon"></p></td>
                            </tr>
                            <tr>
                                <td>PPN</td>
                                <td>:</td>
                                <td><p class="text-ppn"></p></td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td>:</td>
                                <td><p class="text-total1"></p></td>
                            </tr>
                            <tr>
                                <td>Dp</td>
                                <td>:</td>
                                <td><p class="text-dp"></p></td>
                            </tr>
                            <tr>
                                <td>Sisa</td>
                                <td>:</td>
                                <td><p class="text-sisa"></p></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><?php echo $data["pengukuran_status"]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php
                                    /*
                                    if ($data["pengukuran_status"]=='Selesai Pemasangan' || $data["pengukuran_status"]=='Selesai Finishing'){
                                        
                                        ?>
                                        <input type="submit" class="btn btn-success" value="Lunas" name="gantistatuslunas" style="padding: 5px 16px;font-size: 13px;margin: 10px auto 0px   ;">
                                    <?php
                                    }
                                    */
                                    ?>
                                </td>
                                <td>

                                    <a href="export/pdf-invoice.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Invoice</a>
                                </td>
                            </tr>
                        <?php
                        }
                        
                        ?>
                    </table> 
                </form>
            </div>
            <div class="col-md-9" style="overflow-x: auto;">
                <table id="hitungharga" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr><th colspan="3">Harga Penawaran</th></tr>
                        <tr>
                            <th>Premium</th>
                            <th>Gold</th>
                            <th>Silver</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <?php
                if ($data["pengukuran_status"]=="Penawaran") {
                ?>
                    <button class="btn btn-primary btn-tambah-item float-right mb-3" data-id="<?php echo $id; ?>" data-toggle="modal" data-target="#modaltambahpengukuran">Tambah <i class="fas fa-box-open ml-1"></i></button>
                <?php
                }
                ?>
                <table id="listpengukuran" class="table table-bordered table-striped text-center">
                    <thead>
                        
                        <th>Ruang</th>
                        <th>Jenis</th>
                        <th>Kode<br>Bahan</th>
                        <th>Model</th>
                        <th>Tarikan</th>
                        <th>Jumlah</th>
                        <th>KT/E</th>
                        <th>Rel/Alat</th>
                        <th>Warna</th>
                        <th>Ukuran<br>Rel</th>
                        <th>T<br><span style="font-size: 11px;">(cm)</span></th>
                        <th>L<br><span style="font-size: 11px;">(cm)</span></th>
                        <th>V<br><span style="font-size: 11px;">(m)</span></th>
                        <th width="100px">Harga</th>
                        <th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php } ?>
    
    <script type="text/javascript">
      
    $(document).ready(function() {

        $('.price').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 });
        $('.price1').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 });
        
        $('.mdb-select').materialSelect();
        $('#table-penawaran').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [ 0, 'desc' ],
            "ajax": 
            {
                "url": "api/datatable.api.php?ket=penawaran", // URL file untuk proses select datanya
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
                { "render": function(data, type, full){
                   return formatRupiah(full['pengukuran_total_harga'].toString(), 'Rp. ');
                  }
                },
                { "render": function(data, type, full){
                   return formatRupiah(full['pengukuran_dp'].toString(), 'Rp. ');
                  }
                },
                { "width": "150px", "render": function(data, type, full){
                   return '<a class="btn-floating btn-sm btn-default mr-2 btn-edit" href="?menu=transaksi&kond=detail" data-id="' + full['pengukuran_id'] + '" title="Detail"><i class="fas fa-pen"></i></a>';
                    }
                },
            ],
            "drawCallback": function( settings ) {
                $('.btn-edit').on('click',function(e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('.container__load').load('components/content/penawaran.content.php?kond=detail&id='+id);
                    //window.location.assign("?menu=transaksi&kond=detail&id="+id);
                    /*
                    $(".box-detail").removeClass("hidden");
                    $(".box-home").addClass("hidden");
                    console.log("tes")
                    */
                    $.ajax({
                        type:'POST',
                        url:'api/view.api.php?func=detailpenawaran',
                        dataType: "json",
                        data:{id:id},
                        success:function(data){

                            dataPelanggan(id);
                            hitungHarga(id);
                            dataTable(id);
                            negoHarga();

                            $('.btn-tambah-item').on('click',function(e){
                                e.preventDefault();
                                var id = $(this).data('id');
                                $("#modaltambahpengukuran #defaultForm-id").val(id);

                                $("#modaltambahpengukuran .btn-proses").click(function(e){
                                      e.preventDefault();
                                      var data = $('#modaltambahpengukuran .form-tambahitem').serialize();
                                      console.log(data);
                                      
                                      $.ajax({
                                        type: 'POST',
                                        url: "controllers/transaksi.ctrl.php?ket=penawaran-tambah-item",
                                        data: data,
                                        success: function(data) {
                                              $('#modaltambahpengukuran .select-other').materialSelect({destroy:true});
                                              $("#modaltambahpengukuran .box-other").children().children().children().attr("disabled", "disabled");
                                              $("#modaltambahpengukuran .btn-openmodal").removeAttr("disabled");
                                              $("#modaltambahpengukuran .box-other").children().children().children().val('');
                                              $('#modaltambahpengukuran .select-other').materialSelect();
                                              $("#modaltambahpengukuran .box-namalain").addClass('hidden');
                                              $("#modaltambahpengukuran .box-model").addClass('hidden');
                                              $("#modaltambahpengukuran .box-bahan").addClass('hidden');
                                              $("delect#defaultForm-jenis").val("");
                                              $("select#defaultForm-bahan").val("");
                                              $("select#defaultForm-model").val("");
                                              $("#modaltambahpengukuran #defaultForm-tinggi").val(100);
                                              $("#modaltambahpengukuran #defaultForm-lebar").val(100);
                                              $("#modaltambahpengukuran #defaultForm-volume").val(0);
                                              $("#modaltambahpengukuran #defaultForm-jumlah").val(1);
                                                
                                                $("#form-pelanggan .total").text(formatRupiah(data.toString(), 'Rp. '));
                                                dataTable(id);
                                                hitungHarga(id);
                                          }
                                      });
                                      
                                });
                                
                            });
                            

                        }
                    });

                });
            }
        });

        function negoHarga() {
            $('#btn-negoharga').on('click', function(e){
                e.preventDefault();
                var idpenawaran = $('#defaultForm-idpenawaran').val();
                var diskon = splitAngka($('#defaultForm-diskon').val());
                var diskonket = $('#defaultForm-diskonket').val();
                var kualitas = $('select#defaultForm-kualitas').val();
                var dp = splitAngka($('#defaultForm-dp').val());
                var bank = $('#defaultForm-bank').val();
                var ppn = $('#defaultForm-ppn').val();
                console.log(kualitas)
                //var data = $('#form-pelanggan').serialize();
                $.ajax({
                    type: 'POST',
                    url: "controllers/transaksi.ctrl.php?ket=negoharga",
                    dataType: "json",
                    data:{
                      idpenawaran:idpenawaran,
                      diskon:diskon,
                      diskonket:diskonket,
                      kualitas:kualitas,
                      dp:dp,
                      bank:bank,
                      ppn:ppn
                    },
                    success: function(data) {
                        console.log(data[0].status);
                        if (data[0].status=='Penawaran') {
                            $("#defaultForm-diskon").val(data[0].diskon);
                            $("#defaultForm-diskonket").val(data[0].diskonket);
                            $("select#defaultForm-kualitas").val(data[0].kualitas);
                            $("#defaultForm-dp").val(data[0].dp);
                            $("#defaultForm-bank").val(data[0].bank);
                            $("#defaultForm-ppn").val(data[0].ppn);
                            $("#form-pelanggan .total").text(formatRupiah(data[0].total.toString(), 'Rp. '));
                        } else {
                            $(".colom-diskon").remove();
                            $(".colom-kualitas").remove();
                            $(".colom-diskonset").remove();
                            $(".colom-bank").remove();
                            $(".colom-ppn").remove();
                            $(".colom-dp").remove();
                            $("#form-pelanggan .text-ppn").removeClass('hidden');
                            $("#form-pelanggan .text-kualitas").removeClass('hidden');
                            $("#form-pelanggan .text-bank").removeClass('hidden');
                            $("#form-pelanggan .text-diskon").removeClass('hidden');
                            $("#form-pelanggan .text-dp").removeClass('hidden');
                            $("#form-pelanggan .text-kualitas").text(data[0].kualitas);
                            $("#form-pelanggan .text-bank").text(data[0].bank);
                            $("#form-pelanggan .text-ppn").text(data[0].ppn);
                            $("#form-pelanggan .total").text(formatRupiah(data[0].total.toString(), 'Rp. '));
                            $("#form-pelanggan .text-diskon").text(formatRupiah(data[0].diskon.toString(), 'Rp. '));
                            $("#form-pelanggan .text-dp").text(formatRupiah(data[0].dp.toString(), 'Rp. '));
                            
                        }
                        hitungHarga(idpenawaran);
                        dataTable(idpenawaran);

                    }
                });
                

            });
        }

        function dataPelanggan(id) {

            $.ajax({
                type:'POST',
                url:'api/view.api.php?func=detailpenawaran',
                dataType: "json",
                data:{id:id},
                success:function(data){
                    $("#defaultForm-idpenawaran").val(data[0].pengukuran_id);
                    $("#cek-status").val(data[0].pengukuran_status);
                    $("#form-pelanggan .nama").text(data[0].name);
                    $("#form-pelanggan .alamat").text(data[0].alamat);
                    $("#form-pelanggan .telepon").text(data[0].telepon);
                    $("#form-pelanggan .total").text(formatRupiah(data[0].pengukuran_total_harga.toString(), 'Rp. '));

                    if (data[0].pengukuran_status=='Penawaran') {
                        $("select#defaultForm-kualitas").val(data[0].pengukuran_kualitas);
                        $("#defaultForm-diskonket").val(data[0].pengukuran_ket_diskon);
                        $("#defaultForm-diskon").val(formatCurrency(data[0].pengukuran_diskon.toString(), ''));
                    } else if(data[0].pengukuran_status=='Selesai Pemasangan' || data[0].pengukuran_status=='Selesai Finishing') {
                        var sisa = parseInt(data[0].pengukuran_total_harga) - parseInt(data[0].pengukuran_dp) - parseInt(data[0].pengukuran_diskon);
                        var total = parseInt(data[0].pengukuran_total_harga) + parseInt(data[0].pengukuran_diskon);
                        $("#form-pelanggan .total").text(formatRupiah(total.toString(), 'Rp. '));
                        $("#form-pelanggan .text-diskon").text(formatRupiah(data[0].pengukuran_diskon.toString(), 'Rp. '));
                        $("#form-pelanggan .text-dp").text(formatRupiah(data[0].pengukuran_dp.toString(), 'Rp. '));
                        $("#form-pelanggan .text-sisa").text(formatRupiah(sisa.toString(), 'Rp. '));

                    } else {
                        var total = parseInt(data[0].pengukuran_total_harga) + parseInt(data[0].pengukuran_diskon) - parseInt(data[0].pengukuran_ppn_jumlah);
                        var sisa = parseInt(data[0].pengukuran_total_harga) - parseInt(data[0].pengukuran_dp);
                        $("#form-pelanggan .total").text(formatRupiah(total.toString(), 'Rp. '));
                        $("#form-pelanggan .text-sisa").text(formatRupiah(sisa.toString(), 'Rp. '));
                        $("#form-pelanggan .text-diskon").text(formatRupiah(data[0].pengukuran_diskon.toString(), 'Rp. '));
                        $("#form-pelanggan .text-dp").text(formatRupiah(data[0].pengukuran_dp.toString(), 'Rp. '));
                        $("#form-pelanggan .text-total1").text(formatRupiah(data[0].pengukuran_total_harga.toString(), 'Rp. '));
                        $("#form-pelanggan .text-ppn").text(formatRupiah(data[0].pengukuran_ppn_jumlah.toString(), 'Rp. '));

                    }
                }
            });
        }

        function hitungHarga(id) {
            $.ajax({
                type:'POST',
                url:'api/view.api.php?func=hitungpenawaran',
                dataType: "json",
                data:{id:id},
                success:function(data){
                    $('#hitungharga tbody').empty();
                    $('#hitungharga tbody').append("<tr><td>"+formatRupiah(data[0].totalpremium.toString(), 'Rp. ')+"</td><td>"+formatRupiah(data[0].totalgold.toString(), 'Rp. ')+"</td><td>"+formatRupiah(data[0].totalsilver.toString(), 'Rp. ')+"</td></tr>");
                }
            });
        }
        function dataTable(id) {
            $.ajax({
                type:'POST',
                url:'api/view.api.php?func=listpengukuran',
                dataType: "json",
                data:{id:id},
                success:function(data){
                    var ipstatus = $("#cek-status").val();
                    var button = '';

                    $('#listpengukuran tbody').empty();
                    for (var i in data) {
                        if (ipstatus=='Penawaran') {
                            button = "<a class='btn-floating btn-sm btn-default mb-2 btn-edit-item' data-toggle='modal' data-target='#modaledititem' data-id='"+data[i].pengukuran_detail_id+"' title='Edit'><i class='fas fa-pen'></i></a> <a class='btn-floating btn-sm btn-danger btn-remove' data-id='"+data[i].pengukuran_detail_id+"' title='Delete'><i class='fas fa-trash'></i></a>";
                        }    
                        $('#listpengukuran tbody').append("<tr><td>"+
                            data[i].pengukuran_detail_ruang+"</td><td>"+
                            data[i].jenis_nama+"</td><td>"+
                            data[i].pengukuran_detail_kode_bahan+"</td><td>"+
                            data[i].model_nama+"</td><td>"+
                            data[i].pengukuran_detail_tarikan+"</td><td>"+
                            data[i].pengukuran_detail_jumlah+"</td><td>"+
                            data[i].pengukuran_detail_kt+"</td><td>"+
                            data[i].pengukuran_detail_alat_1+"</td><td>"+
                            data[i].pengukuran_detail_alat_warna+"</td><td>"+
                            data[i].pengukuran_detail_alat_ukuran+"</td><td>"+
                            data[i].pengukuran_detail_tinggi+"</td><td>"+
                            data[i].pengukuran_detail_lebar+"</td><td>"+
                            data[i].pengukuran_detail_volume+"</td><td>"+
                            formatRupiah(data[i].pengukuran_detail_harga.toString(), 'Rp. ')+"</td><td>"+
                            button+"</td></tr>");
                    }

                    deleteItem();
                    editItem();
                    
                }
            });
        }

        function editItem() {
            $('.btn-edit-item').on('click', function() {
                var id = $(this).data('id');
                var idpenawaran = $("#defaultForm-idpenawaran").val();
                $.ajax({
                    type:'POST',
                    url:'api/view.api.php?func=edititempenawaran',
                    dataType: "json",
                    data:{id:id},
                    success:function(data){
                        $('#modaledititem .select-other').materialSelect({destroy:true});
                        $("#modaledititem #defaultForm-id").val(data[0].pengukuran_detail_id);
                        $("#modaledititem #defaultForm-idpenawaran").val(data[0].pengukuran_id);
                        $("#modaledititem #defaultForm-idjenis").val(data[0].pengukuran_detail_jenis);
                        $("#modaledititem #defaultForm-kualitas").val(data[0].pengukuran_detail_kualitas);
                        $("#modaledititem #defaultForm-namajenis").val(data[0].jenis_nama);
                        $("#modaledititem #defaultForm-namamodel").val(data[0].model_nama);
                        $("#modaledititem #defaultForm-namabahan").val(data[0].bahan_nama);

                        $("#modaledititem #defaultForm-nama").val(data[0].pengukuran_detail_jenis_lain);
                        $("#modaledititem #defaultForm-idmodel").val(data[0].pengukuran_detail_model);
                        $("#modaledititem #defaultForm-idbahan").val(data[0].pengukuran_detail_bahan);
                        $("#modaledititem #defaultForm-ruang").val(data[0].pengukuran_detail_ruang);
                        $("#modaledititem #defaultForm-kodebahan").val(data[0].pengukuran_detail_kode_bahan);
                        $("#modaledititem #defaultForm-kodebahan1").val(data[0].pengukuran_detail_kode_bahan_1);
                        $("#modaledititem #defaultForm-hargabahan").val(data[0].pengukuran_detail_harga_bahan);
                        $("#modaledititem #defaultForm-hargabox").val(data[0].pengukuran_detail_harga_box);
                        $("#modaledititem #defaultForm-tinggi").val(data[0].pengukuran_detail_tinggi);
                        $("#modaledititem #defaultForm-lebar").val(data[0].pengukuran_detail_lebar);
                        $("#modaledititem #defaultForm-volume").val(data[0].pengukuran_detail_volume);
                        $("#modaledititem #defaultForm-jumlah").val(data[0].pengukuran_detail_jumlah);
                        $("#modaledititem #defaultForm-tarikan").val(data[0].pengukuran_detail_tarikan);
                        $("#modaledititem #defaultForm-kt").val(data[0].pengukuran_detail_kt);
                        $("#modaledititem #defaultForm-relalat1").val(data[0].pengukuran_detail_alat_1);
                        $("#modaledititem #defaultForm-relalat2").val(data[0].pengukuran_detail_alat_2);
                        $("#modaledititem #defaultForm-relwarna").val(data[0].pengukuran_detail_alat_warna);
                        $("#modaledititem label").addClass("active");


                        $(".btn-editpenawaran").click(function(){
                            var data = $('#modaledititem .form-edititem').serialize();
                            
                            $.ajax({
                                type: 'POST',
                                url: "controllers/transaksi.ctrl.php?ket=penawaran-edit-item",
                                data: data,
                                success: function(data) {
                                    //console.log(data)
                                    $("#form-pelanggan .total").text(formatRupiah(data.toString(), 'Rp. '));
                                    dataTable(idpenawaran);
                                    hitungHarga(idpenawaran);

                                }
                            });
                        });

                    }
                });
            });
        }

        function deleteItem() {
            $('.btn-remove').on('click', function(){
                  var item_id = $(this).data('id');
                  var id = $("#defaultForm-idpenawaran").val();
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
                                    url: "controllers/transaksi.ctrl.php?ket=penawaran-remove-item",
                                    dataType: "json",
                                    data:{
                                        item_id:item_id,
                                        id:id
                                    },
                                    success: function(data) {
                                        
                                      if (data.ket[0]=="ok") {
                                        dataTable(id);
                                        hitungHarga(id);
                                        $("#form-pelanggan .total").text(formatRupiah(data.total[0].toString(), 'Rp. '));
                                        //$('#listpengukuran').DataTable().ajax.reload();
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
    });
    </script>