
	<div class="container-fluid p-0 header-admin fadeIn animated">
		<div class="row header-content pt-3 pb-0 info-color text-white">
			<div class="col-md-12">
				<h2 class=" border-bottom border-white mb-0 pb-2">Produk</h2>
			</div>
			<div class="col-md-12 pl-0 pr-0 ">
				<ul class="nav">
				    <li class="nav-item">
				      <a class="nav-link waves-light active show" id="listproduk">List Produk</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link waves-light" id="Kategori">Kategori</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link waves-light" id="subkategori">Sub Kategori</a>
				    </li>
				</ul>
			</div>
		</div>
	</div>
	
	<main class="pt-4 produk pl-md-3 pr-md-3 mr-0">
		<div class="main-wrapper">
		    <div class="container-fluid">
				<div class="row mt-2">
					<div class="col-md-12 container__load fadeIn animated">
						
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
				if(menu == "listproduk"){
					$('.container__load').load('components/content/listproduk.content.php');						
				}else if(menu == "subkategori"){
					$('.container__load').load('components/content/subkategori.content.php');						
				}else if(menu == "Kategori"){
					$('.container__load').load('components/content/Kategori.content.php');						
				}
			});
	 
	 
			$('.container__load').load('components/content/listproduk.content.php');					
	 
		});
	</script>

