
	<div class="container-fluid p-0 header-admin fadeIn animated">
		<div class="row header-content pt-3 pb-3 info-color text-white">
			<div class="col-md-12">
				<h2 >Laporan Penjualan</h2>
			</div>
		</div>
	</div>
	
	<main class="pt-4 produk pl-md-3 pr-md-3 mr-0">
		<div class="main-wrapper">
		    <div class="container-fluid">
		    	<div class="card">
		    		<div class="card-body">
						<div class="row mt-2 ">
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
				var menu = $(this).attr('id');
				if(menu == "omset"){
					$('.container__load').load('components/content/laporan.content.php?ket=omset');						
				} /*else if(menu == "kasir"){
					$('.container__load').load('components/content/laporan.content.php?ket=kasir');			
				} else if(menu == "nota"){
					$('.container__load').load('components/content/laporan.content.php?ket=nota');			
				} else if(menu == "menu"){
					$('.container__load').load('components/content/laporan.content.php?ket=menu');			
				} else if(menu == "stok"){
					$('.container__load').load('components/content/laporan.content.php?ket=stok');			
				} else if(menu == "stokkeluar"){
					$('.container__load').load('components/content/laporan.content.php?ket=stokkeluar');			
				} else if(menu == "validasi"){
					$('.container__load').load('components/content/laporan.content.php?ket=validasi');			
				}
				*/
			});
	 
			$('.container__load').load('components/content/laporan.content.php?ket=omset');
	 
		});
	</script>


