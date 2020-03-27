<?php
session_start(); 
$role = $_SESSION['role'];
$user = $_SESSION['login_user'];
date_default_timezone_set('Asia/jakarta');
$bln=date('F Y');
?>
<section class="mt-md-4 pt-md-2 mb-5 pb-4">
    <!-- Grid row -->
    <div class="row">
    	<div class="col-12 mb-2">
			<h3><?php echo $bln; ?></h3>
		</div>
        <!-- Grid column -->
        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">
                <!-- Card Data -->
                <div class="admin-up">
                    <i class="far fa-money-bill-alt primary-color mr-3 z-depth-2"></i>
                    <div class="data">
                        <p class="text-uppercase">Omset</p>
                        <h4 class="font-weight-bold dark-grey-text" id="text-omset"></h4>
                    </div>
                </div>
                <!-- Card content -->
            </div>
            <!-- Card -->
        </div>
        <!-- Grid column -->
        <!-- Grid column -->
        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">
                <!-- Card Data -->
                <div class="admin-up">
                    <i class="fas fa-chart-line red mr-3 z-depth-2"></i>
                    <div class="data">
                        <p class="text-uppercase">Uang Masuk</p>
                        <h4 class="font-weight-bold dark-grey-text" id="text-uangmasuk"></h4>
                    </div>
                </div>
                <!-- Card content -->
            </div>
            <!-- Card -->
        </div>
        <!-- Grid column -->
        <!-- Grid column -->
        <div class="col-xl-3 col-md-6 mb-md-0 mb-4">
            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">
                <!-- Card Data -->
                <div class="admin-up">
                    <i class="fas fa-chart-pie warning-color lighten-1 mr-3 z-depth-2"></i>
                    <div class="data">
                        <p class="text-uppercase">Jumlah Transaksi</p>
                        <h4 class="font-weight-bold dark-grey-text" id="text-transaksi"></h4>
                    </div>
                </div>
                <!-- Card content -->
            </div>
            <!-- Card -->
        </div>
        <!-- Grid column -->
        <!-- Grid column -->
        <div class="col-xl-3 col-md-6 mb-0">
            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">
                <!-- Card Data -->
                <div class="admin-up">
                    <i class="fas fa-chart-bar light-blue accent-2 mr-3 z-depth-2"></i>
                    <div class="data">
                        <p class="text-uppercase">Barang Terjual</p>
                        <h4 class="font-weight-bold dark-grey-text" id="text-barang"></h4>
                    </div>
                </div>
                <!-- Card content -->
            </div>
            <!-- Card -->
        </div>
        <!-- Grid column -->
    </div>
    <!-- Grid row -->
</section>
<!-- Heading & Date -->
<div class="row mb-5 mt-lg-5">
    <!-- First column -->
    <div class="col-md-6 panel-title mb-5 mt-3">
        <h5><span class="px-4 py-3 white-text z-depth-1-half blue lighten-1" style="
                    border-radius: 5px;">Grafik Bulan ini</span></h5>
    </div>
    <!-- First column -->
</div>
<!-- Heading & Date -->
<!-- Section: Main chart -->
<section class="mb-5">
    <div class="row">
    	<div class="col-md-6">
    		<!-- Card -->
		    <div class="card card-cascade narrower pb-5">
		        <!-- Card image -->
		        <div class="view view-cascade gradient-card-header blue-gradient">
		            <canvas id="chart-omset"></canvas>
		        </div>
		        <!-- Card image -->
		    </div>
		    <!-- Card -->
    	</div>
    	<div class="col-md-6">
    		<!-- Card -->
		    <div class="card card-cascade narrower pb-5">
		        <!-- Card image -->
		        <div class="view view-cascade gradient-card-header sunny-morning-gradient">
		            <canvas id="chart-transaksi"></canvas>
		        </div>
		        <!-- Card image -->
		    </div>
		    <!-- Card -->
    	</div>
    </div>
</section>
<!-- Section: Main chart -->

<script type="text/javascript">
	Chart.defaults.global.defaultFontColor = '#fff';
	
	var dateformat = ["01","02","03","04","05","06","07","08","09","10",
	            "11","12","13","14","15","16","17","18","19","20",
	            "21","22","23","24","25","26","27","28","29","30","31"];
	$.ajax({
        type:'POST',
        url:'api/view.api.php?func=text-dashboard',
        dataType: "json",
        success:function(data){
        	console.log("sukses "+data);
			$('#text-omset').text(formatRupiah(data[0].total_harga.toString(), 'Rp. '));
			$('#text-uangmasuk').text(formatRupiah(data[0].uang_masuk.toString(), 'Rp. '));
			$('#text-transaksi').text(data[0].jml);
			$('#text-barang').text(data[0].jumlah_barang);

        }
    });

     $.ajax({
        type:'POST',
        url:'api/view.api.php?func=omset-grafik-dashboard',
        dataType: "json",
        success:function(data){
            var date = [];
            var total = [];
            var omset = 0;

            for (var i in data) {
                date.push(moment(new Date(data[i].pengukuran_tanggal)).format('DD'));
                total.push(data[i].total);
                omset += parseInt(data[i].total);
            }

            var ctxL = document.getElementById("chart-omset").getContext('2d');
	        var myLineChart = new Chart(ctxL, {
	            type: 'line',
	            data: {
	                labels: date,
	                datasets: [{
	                        label: "Omset",
	                        fillColor: "rgba(151,187,205,0.2)",
	                        strokeColor: "rgba(151,187,205,1)",
	                        pointColor: "rgba(151,187,205,1)",
	                        pointStrokeColor: "#fff",
	                        pointHighlightFill: "#fff",
	                        pointHighlightStroke: "rgba(151,187,205,1)",
	                        backgroundColor: 'rgba(255, 255, 255, 0.2)',
	                        borderColor: 'rgba(255, 255, 255, 1)',
	                        borderWidth: 1,
	                        data: total
	                    }
	                ]
	            },
                options: {
                    responsive: true,
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

        }
    });

    $.ajax({
        type:'POST',
        url:'api/view.api.php?func=transaksi-grafik-dashboard',
        dataType: "json",
        success:function(data){
            var date = [];
            var jumlah = [];
            var omset = 0;

            for (var i in data) {
                date.push(moment(new Date(data[i].pengukuran_tanggal)).format('DD'));
                jumlah.push(data[i].jumlah);
                omset += parseInt(data[i].jumlah);
            }

            var ctxL = document.getElementById("chart-transaksi").getContext('2d');
	        var myLineChart = new Chart(ctxL, {
	            type: 'line',
	            data: {
	                labels: date,
	                datasets: [{
	                        label: "jumlah Transaksi",
	                        fillColor: "rgba(151,187,205,0.2)",
	                        strokeColor: "rgba(151,187,205,1)",
	                        pointColor: "rgba(151,187,205,1)",
	                        pointStrokeColor: "#fff",
	                        pointHighlightFill: "#fff",
	                        pointHighlightStroke: "rgba(151,187,205,1)",
	                        backgroundColor: 'rgba(255, 255, 255, 0.2)',
	                        borderColor: 'rgba(255, 255, 255, 1)',
	                        borderWidth: 1,
	                        data: jumlah
	                    }
	                ]
	            },
	            options: {
	                responsive: true
	            }
	        });

        }
    });

    $(function() {
        //line
        

        var ctxL = document.getElementById("chart-transaksi").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                        label: "Jumlah Transaksi",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        backgroundColor: 'rgba(255, 255, 255, 0.2)',
                        borderColor: 'rgba(255, 255, 255, 1)',
                        borderWidth: 1,
                        data: [25, 70, 100, 51, 66, 95, 110]
                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    });
</script>