
	<div class="container-fluid p-0 header-admin fadeIn animated">
		<div class="row header-content pt-3 pb-0 info-color text-white">
			<div class="col-md-12">
				<h2 class=" border-bottom border-white mb-0 pb-2">Transaksi</h2>
			</div>
			<input type="hidden" name="role" id="cekrole" value="<?php echo $_SESSION['role'];?>">
			<div class="col-md-12 pl-0 pr-0">
				<ul class="nav">
				    <?php if ($_SESSION['role']=="admin" || $_SESSION['role']=="owner") {
				    ?>
					    <li class="nav-item">
					      <a class="nav-link waves-light active show" id="booking">Booking</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="pengukuran">Pengukuran</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="penawaran">Penawaran</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="orderbahan">Order Bahan</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="pemotongan">Pemotongan & jahit</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="finishing">Finishing</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="pemasangan">Pemasangan</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="penagihan">Penagihan</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="lunas">Lunas</a>
					    </li>

				    <?php
				    } elseif ($_SESSION['role']=="pengukur") {
				    ?>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="pengukuran">Pengukuran</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="pemasangan">Pemasangan</a>
					    </li>

				    <?php
				    } elseif ($_SESSION['role']=="potong-jahit") {
				    ?>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="pemotongan">Potong & jahit</a>
					    </li>
					    <li class="nav-item">
					      <a class="nav-link waves-light" id="finishing">Finishing</a>
					    </li>

				    <?php
				    } ?>
				</ul>
			</div>
		</div>
	</div>
	
	<main class="pt-4 produk pl-md-3 pr-md-3 mr-0">
		<div class="main-wrapper">
		    <div class="container-fluid">
		    	<div class="card">
		    		<div class="card-body">
						<div class="row mt-2">
							<div class="col-md-12 container__load fadeIn animated">
								
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</main>


	<?php include 'partials/footer.php'; ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.nav-link').click(function(){
				$("ul.nav .nav-item a.nav-link").removeClass("active");
				$(this).addClass("active");
				var menu = $(this).attr('id');
				if(menu == "booking"){
					$('.container__load').load('components/content/booking.content.php');						
				}else if(menu == "pengukuran"){
					$('.container__load').load('components/content/pengukuran.content.php');						
				}else if(menu == "penawaran"){
					$('.container__load').load('components/content/penawaran.content.php?kond=');						
				}else if(menu == "orderbahan"){
					$('.container__load').load('components/content/orderbahan.content.php?kond=');						
				}else if(menu == "pemotongan"){
					$('.container__load').load('components/content/pemotongan.content.php');						
				}else if(menu == "finishing"){
					$('.container__load').load('components/content/finishing.content.php');						
				}else if(menu == "pemasangan"){
					$('.container__load').load('components/content/pemasangan.content.php');						
				}else if(menu == "penagihan"){
					$('.container__load').load('components/content/penagihan.content.php');						
				}else if(menu == "lunas"){
					$('.container__load').load('components/content/lunas.content.php');						
				}
			});
	 		var role = $("#cekrole").val();
	 		if (role=='pengukur') {
				$('.container__load').load('components/content/pengukuran.content.php');
	 		} else if (role=='potong-jahit') {
				$('.container__load').load('components/content/pemotongan.content.php');
	 		} else {
				$('.container__load').load('components/content/booking.content.php');
	 		}
	 
		});
	</script>


