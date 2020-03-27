<?php
session_start();
include '../modals/laporan.modal.php';
$ket = $_GET['ket'];
$role = $_SESSION['role'];

if ($ket=='omset') {

	$col = 'col-md-8';
	$btn = 'btn-proses-laporan-omset';
	
	?>
	<div class="row justify-content-md-center">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-10">
					<div class="row form-month">
						<div class="col-md-6">
				            <div class="md-form m-0">
				            	<div class="row">
					            	<div class="col-md-6">
								        <select class="mdb-select md-form" id="startmonth" name="ip-startmonth">
						                    <option value="" disabled selected>Bulan Mulai</option>
								            <option value="01">01</option>
								            <option value="02">02</option>
								            <option value="03">03</option>
								            <option value="04">04</option>
								            <option value="05">05</option>
								            <option value="06">06</option>
								            <option value="07">07</option>
								            <option value="08">08</option>
								            <option value="09">09</option>
								            <option value="10">10</option>
								            <option value="11">11</option>
								            <option value="12">12</option>
								        </select>
					            	</div>
					            	<div class="col-md-6">
								        <select class="mdb-select md-form" id="startyear" name="ip-startyear">
						                    <option value="" disabled selected>Tahun Mulai</option>
								            <option value="2018">2018</option>
								            <option value="2019">2019</option>
								            <option value="2020">2020</option>
								            <option value="2021">2021</option>
								            <option value="2022">2022</option>
								            <option value="2023">2023</option>
								        </select>
					            	</div>
					            </div>
				            </div>
						</div>
						<div class="col-md-6">
				            <div class="md-form m-0">
				            	<div class="row">
					            	<div class="col-md-6">
								        <select class="mdb-select md-form" id="endmonth" name="ip-endmonth">
						                    <option value="" disabled selected>Bulan Sampai</option>
								            <option value="01">01</option>
								            <option value="02">02</option>
								            <option value="03">03</option>
								            <option value="04">04</option>
								            <option value="05">05</option>
								            <option value="06">06</option>
								            <option value="07">07</option>
								            <option value="08">08</option>
								            <option value="09">09</option>
								            <option value="10">10</option>
								            <option value="11">11</option>
								            <option value="12">12</option>
								        </select>
					            	</div>
					            	<div class="col-md-6">
								        <select class="mdb-select md-form" id="endyear" name="ip-endyear">
						                    <option value="" disabled selected>Tahun Sampai</option>
								            <option value="2018">2018</option>
								            <option value="2019">2019</option>
								            <option value="2020">2020</option>
								            <option value="2021">2021</option>
								            <option value="2022">2022</option>
								            <option value="2023">2023</option>
								        </select>
					            	</div>
					            </div>
				            </div>
				        </div>
					</div>
				</div>
				<div class="col-md-2">
				    <div class="md-form">
				    	<button class="btn btn-primary btn-proses-laporan-omset">Proses</button>
				    </div>
				</div>
			</div>	
			<div class="row fadeInLeft slow animated col-table">
				<div class="col-md-12"><h2 class="text-center mb-4">Omset</h2></div>
				<div class="col-md-12">
					<table id="table-omset" class="table table-striped table-bordered" style="width:100%">
				        <thead>
				            <tr>
	                            <th>bulan</th>
	                            <th style="text-align: right;">Omset</th>
	                            <th></th>
				            </tr>
				        </thead>
				    </table>
				</div>
				<div class="col-md-12">
				    <div class="md-form">
				    	<a class="btn btn-default export-omset hidden" href="" target="_blank">Export</a>
				    </div>
				</div>
				<div class="col-md-12 mb-4">
					<h5>Grafik Omset</h5>
					<div id="chart-box-omset">
						<canvas id="lineChartomset"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
} 

?>
<script type="text/javascript">

  $(document).ready(function(){
      	$('.mdb-select').materialSelect();

		
		$('.datepicker').datepicker({
			    format: 'yyyy-mm-dd'
			});
		/*
		$('.datepicker').pickadate({
			weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
			showMonthsShort: true
		})
		*/
		function convertToRupiah(angka)
		{
		  var rupiah = '';    
		  var angkarev = angka.toString().split('').reverse().join('');
		  for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		  return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
		}
		
		var dateformat = ["01","02","03","04","05","06","07","08","09","10",
		            "11","12","13","14","15","16","17","18","19","20",
		            "21","22","23","24","25","26","27","28","29","30","31"];

		
		$('.btn-proses-laporan-omset').on('click',function(){
			
          	var start = $("#startyear").val()+"-"+$("#startmonth").val();
          	var end = $("#endyear").val()+"-"+$("#endmonth").val();
        
			
			var date = start+":"+end;
			$.ajax({
		        type:'POST',
		        url:'api/view.api.php?func=laporan-omset',
		        dataType: "json",
            	data:{
            		start:start,
            		end:end
            	},
		        success:function(data){
		        	console.log(data);
		        	$('#table-omset').DataTable().clear().destroy();
		        	$('#table-omset').DataTable( {
					    paging: false,
					    searching: false,
					    ordering: false,
					    data: data,
			            deferRender: true,
					    columns: [
					        { data: 'laporan_omset_bulan' },
			                { render: function(data, type, full){
			                   return formatRupiah(full['total'].toString(), 'Rp. ');
			                  }
			                },
			                { "width": "110px", render: function(data, type, full){
			                   return '<a class="btn-floating btn-sm btn-primary mr-2 btn-detaillaporan" data-toggle="modal" data-target="#modaldetail" data-id="' + full['laporan_omset_bulan'] + '" title="Detail"><i class="far fa-file-alt"></i></a>';
			                  }
			                }
					    ],
					    drawCallback: function( settings ) {
					    	$('.btn-detaillaporan').on('click',function(){
								var bulan = $(this).data('id');
								var total = 0;

								console.log("bulan "+bulan);
					        	$('#listlaporan tbody').empty();
					          	$.ajax({
							        type:'POST',
							        url:'api/view.api.php?func=detail-laporan',
							        dataType: "json",
					            	data:{
					            		bulan:bulan
					            	},
							        success:function(data){
										console.log("data "+data);
							        	for (var i in data) {

						        			$('#listlaporan tbody').append("<tr><td>"+data[i].laporan_omset_tanggal+"</td><td>"+data[i].name+"</td><td>"+data[i].pengukuran_bank+"</td><td class='text-right'>"+formatRupiah(data[i].laporan_omset_jumlah.toString(), 'Rp. ')+"</td></tr>");
						        			total += parseInt(data[i].laporan_omset_jumlah);
							            }
							            $('#modaldetail p.total').text(formatRupiah(total.toString(), 'Rp. '));
								        $("a.export-omset-detail").attr("href","export/export-laporan-omset-detail.php?bulan="+bulan);

							        }
							    });
							});
					    }
					} );

		        	
		        	$("a.export-omset").removeClass("hidden");
			        $("a.export-omset").attr("href","export/export-laporan-omset.php?date="+date);
			        
		        	console.log(data);
		        }
		    });

		    $.ajax({
		        type:'POST',
		        url:'api/view.api.php?func=laporan-omset',
		        dataType: "json",
	        	data:{
	        		start:start,
	        		end:end
	        	},
		        success:function(data){

		        	var date = [];
		            var total = [];
		            var omset = 0;
		        
		            for (var i in data) {
		                date.push(moment(new Date(data[i].laporan_omset_bulan)).format('MMM YYYY'));
		                total.push(data[i].total);
		                omset += parseInt(data[i].total);
		            }
	        	
		            $("#lineChartomset").remove();
		            $('#chart-box-omset').append('<canvas id="lineChartomset"><canvas>');
		            var ctxL = document.getElementById("lineChartomset").getContext('2d');
		            var myLineChart = new Chart(ctxL, {
		                type: 'line',
		                data: {
		                    labels: date,
		                    datasets: [{
		                            label: "",
		                            data: total,
		                            backgroundColor: [
		                                'rgba(0, 137, 132, .2)',
		                            ],
		                            borderColor: [
		                                'rgba(0, 10, 130, .7)',
		                            ],
		                            borderWidth: 2
		                        }
		                    ]
		                },
		                options: {
		                    responsive: true,
		                    aspectRatio: 2,
		                    tooltips: {
		                      callbacks: {
		                        label: function(t, d) {
		                           var xLabel = d.datasets[t.datasetIndex].label;
		                           var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '$' + t.yLabel;
		                           return xLabel + ': ' + yLabel;
		                        }
		                      }
		                    },
		                    scales: {
		                      yAxes: [{
		                        ticks: {
		                           callback: function(value, index, total) {
		                              if (parseInt(value) >= 1000) {
		                                 return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		                              } else {
		                                 return 'Rp. ' + value;
		                              }
		                           }
		                        }
		                      }]
		                    }
		                }
		            });
					myLineChart.update();

		        }
		    });
		});

		
		           
	});


</script>